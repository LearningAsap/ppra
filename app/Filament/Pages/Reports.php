<?php

namespace App\Filament\Pages;

use App\Models\Department;
use App\Models\DepartmentOffice;
use App\Models\DepartmentProcurement;
use Filament\Forms;
use App\Models\Session;
use App\Models\Employee;
use Filament\Pages\Page;
use App\Models\Institution;
use App\Models\Procurement;
use App\Models\Quarter;
use Illuminate\Support\Facades\DB;
use Filament\Forms\Components\Card;
use Filament\Forms\Components\Tabs;
use Filament\Forms\Components\Fieldset;
use Filament\Notifications\Notification;
use Filament\Forms\Components\CheckboxList;
use PDF;
use Illuminate\Http\Response;

class Reports extends Page
{
    use Forms\Concerns\InteractsWithForms;

    protected static ?string $navigationIcon = 'heroicon-s-document';

    protected static string $view = 'filament.pages.reports';

    protected static ?int $navigationSort = 9;


    public $department_procurement_id;
    public $procurement_id;
    public $opening_date;
    public $closing_date;
    public $ddo_code;
    //public $include_columns_employee = [];
    public $page_size_employee;
    public $page_orientation_employee;

    protected static function shouldRegisterNavigation(): bool
    {
        if(auth()->user()->user_role == 0) {
            return true;
        } else if(auth()->user()->user_role == 1) {
            return true;
        } else {
            return false;
        }
    }

    public static function canView(): bool
    {
        if(auth()->user()->user_role == 0) {
            return true;
        } else if(auth()->user()->user_role == 1) {
            return true;
        } else {
            return false;
        }
    }

    public function mount(): void
    {
        if(auth()->user()->user_role == 2) {
            abort(Response::HTTP_NOT_FOUND);
        }
    }

    protected function getEmployeeProfileFormSchema(): array
    {
        return [
            Card::make()
                ->schema([
                    Fieldset::make('Generate Report')
                        ->schema([
                            Forms\Components\Select::make('department_procurement_id')
                                ->label('Department Procurements')
                                ->options(function () {
                                    return DepartmentProcurement::all(['id', DB::raw("CONCAT('[TSE-', DATE_FORMAT(opening_date, '%Y%m%d'), id, '] ', title) AS title")])->pluck('title', 'id');
                                })
                                ->searchable()
                                ->preload()
                                ->multiple(),
                            Forms\Components\Select::make('ddo_code')
                                ->label('Department Office')
                                ->options(function () {
                                    return DepartmentOffice::all(['ddo_code', DB::raw("CONCAT('[', ddo_code, '] ', description) AS title")])->pluck('title', 'ddo_code');
                                })
                                ->searchable()
                                ->preload()
                                ->multiple(),
                            Forms\Components\Select::make('procurement_id')
                                ->label('Procurement')
                                ->options(function () {
                                    return Procurement::all()->pluck('name', 'id');
                                })
                                ->searchable()
                                ->preload()
                                ->multiple(),
                            Forms\Components\DatePicker::make('opening_date'),
                            Forms\Components\DatePicker::make('closing_date')
                                ->after('opening_date'),
                        ])
                        ->columns(2),
                    Fieldset::make('Report Settings')
                        ->schema([
                            Forms\Components\Radio::make('page_size_employee')
                                ->options([
                                    'a4' => 'A4',
                                    'legal' => 'Legal'
                                ])
                                ->required(),
                            Forms\Components\Radio::make('page_orientation_employee')
                                ->options([
                                    'portrait' => 'Portrait',
                                    'landscape' => 'Landscape'
                                ])
                                ->required()
                        ])
                        ->columns(2)
                ])
        ];
    }

    protected function getForms(): array
    {
        return [
            'employeeProfileForm' => $this->makeForm()
                ->schema($this->getEmployeeProfileFormSchema()),
        ];
    }

    public function saveemployeeProfileForm()
    {
        $postData = $this->employeeProfileForm->getState();

        $department_procurement_ids = $postData['department_procurement_id'];
        $procurement_ids = $postData['procurement_id'];
        $ddo_codes = $postData['ddo_code'];

        $opening_date = $postData['opening_date'];
        $closing_date = $postData['closing_date'];

        $page_size = $postData['page_size_employee'];
        $page_orientation = $postData['page_orientation_employee'];

        $query = DepartmentProcurement::query();
        $query->whereIn('status', [1, 2]);
        if (!empty($department_procurement_ids)) {
            $query->whereIn('id', $department_procurement_ids);
        }

        if (!empty($procurement_ids)) {
            $query->whereIn('procurement_id', $procurement_ids);
        }

        if(!empty($ddo_codes)) {
            $query->whereIn('ddo_code', $ddo_codes);
        }

        if (!empty($opening_date) && !empty($closing_date)) {
            $query->whereBetween('opening_date', [$opening_date, $closing_date]);
        } elseif (!empty($opening_date)) {
            $query->where('opening_date', '>=', $opening_date);
        } elseif (!empty($closing_date)) {
            $query->where('closing_date', '<=', $closing_date);
        }


        $dept_procurements = $query->get();


        //dd($dept_procurements);

        $data = [
            'dept_procurements' => $dept_procurements,
            'page_size' => $page_size,
            'page_orientation' => $page_orientation,
            'opening_date' => is_null($opening_date) ? $opening_date : date('d F, Y', strtotime($opening_date)),
            'closing_date' => is_null($closing_date) ? $closing_date : date('d F, Y', strtotime($closing_date)),
            'opening_date_raw' => $opening_date,
        ];

        //Pdf::loadHTML('reports.downloadinstitutionreport')->setPaper('a4', 'landscape')->setWarnings(false)->save('myfile.pdf');

        $pdfContent = PDF::loadView('reports.downloadempreport', $data)->output();
        return response()->streamDownload(
            fn () => print($pdfContent),
            "downloadinvoide".date('d F, Y h:i:s A').".pdf"
        );
    }
}

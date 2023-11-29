<?php

namespace App\Filament\Widgets;

use App\Models\DepartmentProcurement;
use Closure;
use Filament\Tables;
use Filament\Widgets\TableWidget as BaseWidget;
use Illuminate\Database\Eloquent\Builder;
use Filament\Tables\Actions\Action;
use Filament\Tables\Columns\Layout\Grid;
use DB;
class ProcurementsInObjection extends BaseWidget
{

    protected int | string | array $columnSpan = 6;

    protected static ?int $sort = 40;

    protected function getTableQuery(): Builder
    {
        if(auth()->user()->user_role == 0) {
            return DepartmentProcurement::query()->where('status', 2)->latest();
        } else if (auth()->user()->user_role == 1) {
            return DepartmentProcurement::query()->where('status', 2)->latest();
        } else {
            return DepartmentProcurement::query()->where('status', 2)->where('ddo_code', auth()->user()->ddo_code)->latest();
        }
    }

    protected function getTableColumns(): array
    {
        return [
            Tables\Columns\TextColumn::make('id')
                ->label('SE #')
                ->getStateUsing(function($record){
                    return "TSE-". date('Ymd', strtotime($record->opening_date)) .$record->id;
                })
                ->sortable(query: function (Builder $query, string $direction): Builder {
                    return $query
                        //->orderBy(DB::raw("CONCAT('TSE-', DATE_FORMAT(opening_date, '%Y%m%d'), id)"), $direction);
                        ->orderBy('opening_date', $direction)
                        ->orderBy('id', $direction);
                })->searchable(query: function (Builder $query, string $search): Builder {
                    $formattedSearch = strtoupper($search); // Ensure case-insensitive comparison

                    return $query->whereRaw("CONCAT('TSE-', DATE_FORMAT(opening_date, '%Y%m%d'), id) LIKE ?", ["%{$formattedSearch}%"]);
                }),
            Tables\Columns\ViewColumn::make('status')->view('filament.tables.columns.status'),
            Tables\Columns\TextColumn::make('title')->sortable()->searchable(),
            Tables\Columns\TextColumn::make('departmentoffice.description')->label('Department Office')->sortable()->searchable(),
            Tables\Columns\TextColumn::make('created_at')->date('F d, Y h:i:s A'),

        ];
    }

    protected function getTableActions(): array
    {
        return [
            Action::make('view')
                //->url(fn (DepartmentProcurement $record): string => route('department-procurements.edit', $record))
                ->url(function($record){
                    return url('admin/department-procurements', $record->id);
                })
                ->openUrlInNewTab()
        ];
    }

    protected function getTableRecordUrlUsing(): Closure
    {
        return fn (DepartmentProcurement $record): string => url('admin/department-procurements', $record->id);
    }

    protected function getTableRecordsPerPageSelectOptions(): array
    {
        return [5, 10, 15, 20, 25, 50, 70, 100];
    }

}

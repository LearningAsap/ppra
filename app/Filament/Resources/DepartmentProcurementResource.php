<?php

namespace App\Filament\Resources;

use Filament\Forms;
use Filament\Tables;
use App\Models\Procurement;
use Filament\Resources\Form;
use Filament\Resources\Table;
use App\Models\DepartmentOffice;
use Filament\Resources\Resource;
use Filament\Forms\Components\Card;
use App\Models\DepartmentProcurement;
use Filament\Tables\Filters\SelectFilter;
use Illuminate\Database\Eloquent\Builder;
use Filament\Tables\Filters\TernaryFilter;
use Webbingbrasil\FilamentAdvancedFilter\Filters\DateFilter;
use Webbingbrasil\FilamentAdvancedFilter\Filters\TextFilter;
use App\Filament\Resources\DepartmentProcurementResource\Pages;
use AlperenErsoy\FilamentExport\Actions\FilamentExportBulkAction;
use App\Filament\Resources\DepartmentProcurementResource\RelationManagers\ContractorProcurementsRelationManager;
use App\Filament\Resources\DepartmentProcurementResource\RelationManagers\DeptProcCommentResourceRelationManager;
use App\Filament\Resources\DepartmentProcurementResource\RelationManagers\ProcurementDocumentsRelationManager;
use DB;
class DepartmentProcurementResource extends Resource
{
    protected static ?string $model = DepartmentProcurement::class;

    protected static ?string $navigationIcon = 'heroicon-o-newspaper';

    protected static ?int $navigationSort = 5;

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Card::make()
                    ->label('Download Tender Documents')
                    ->schema([
                        Forms\Components\ViewField::make('tender_documents')
                            ->view('filament.forms.components.download-documents')
                            ->label('Download Tender Document')
                            ->id(function ($livewire) {
                                if (isset($livewire->data['id'])) {
                                    return $livewire->data['id'];
                                }
                                return null;
                            }),
                    ])
                    ->columns(1),
                Card::make()
                    ->schema([
                        Forms\Components\Select::make('ddo_code')
                            ->label('DDO Code')
                            ->options(function () {
                                if (auth()->user()->user_role == 0) {
                                    return DepartmentOffice::all()->pluck('description', 'ddo_code');
                                } else {
                                    return DepartmentOffice::where('ddo_code', auth()->user()->ddo_code)->get()->pluck('description', 'ddo_code');
                                }
                            })
                            ->visible(function () {
                                if (auth()->user()->user_role == 0) {
                                    return true;
                                } else if(auth()->user()->user_role == 1) {
                                    return true;
                                } else {
                                    return false;
                                }
                            })
                            ->disabled(function () {
                                if (auth()->user()->user_role == 0) {
                                    return false;
                                } else if(auth()->user()->user_role == 1) {
                                    return true;
                                } else {
                                    return true;
                                }
                            })
                            ->required()
                            ->searchable(),
                        Forms\Components\Hidden::make('ddo_code')
                            ->visible(function(){
                                if (auth()->user()->user_role == 0) {
                                    return false;
                                } else if(auth()->user()->user_role == 1) {
                                    return false;
                                } else {
                                    return true;
                                }
                            })
                            ->disabled(function(){
                                if (auth()->user()->user_role == 0) {
                                    return true;
                                } else if(auth()->user()->user_role == 1) {
                                    return true;
                                } else {
                                    return false;
                                }
                            })
                            ->dehydrateStateUsing(function(){
                                return auth()->user()->ddo_code;
                            }),
                        Forms\Components\Select::make('procurement_id')
                            ->label('Procurement')
                            ->options(function () {
                                return Procurement::all()->pluck('name', 'id');
                            })
                            ->disabled(function () {
                                if (auth()->user()->user_role == 1) {
                                    return true;
                                }

                                return false;
                            })
                            ->required()
                            ->searchable(),
                        Forms\Components\TextInput::make('title')
                            ->required()
                            ->disabled(function () {
                                if (auth()->user()->user_role == 1) {
                                    return true;
                                }

                                return false;
                            })
                            ->minLength(3)
                            ->maxLength(255),
                        Forms\Components\RichEditor::make('description')
                            ->toolbarButtons([
                                'blockquote',
                                'bold',
                                'bulletList',
                                'codeBlock',
                                'h2',
                                'h3',
                                'italic',
                                'link',
                                'orderedList',
                                'redo',
                                'strike',
                                'undo',
                            ])
                            ->disabled(function () {
                                if (auth()->user()->user_role == 1) {
                                    return true;
                                }

                                return false;
                            })
                            ->maxLength(65535),
                        Forms\Components\FileUpload::make('tender_notice')
                            ->disabled(function () {
                                if (auth()->user()->user_role == 1) {
                                    return true;
                                }

                                return false;
                            })
                            ->directory('proc_files')
                            ->required(),
                        Forms\Components\FileUpload::make('tender_document')
                            ->disabled(function () {
                                if (auth()->user()->user_role == 1) {
                                    return true;
                                }

                                return false;
                            })
                            ->directory('proc_files')
                            ->required(),

                        Forms\Components\DatePicker::make('opening_date')
                            ->reactive()
                            //->afterOrEqual('today')
                            ->afterStateUpdated(function ($get, $set) {
                                $opening_date = $get('opening_date');

                                $newDate = date('Y-m-d', strtotime($opening_date . ' +15 days'));

                                $set('closing_date', $newDate);
                            })
                            ->disabled(function () {
                                if (auth()->user()->user_role == 1) {
                                    return true;
                                }

                                return false;
                            })
                            ->required(),
                        Forms\Components\DatePicker::make('closing_date')
                            ->after('opening_date')
                            ->disabled(function () {
                                if (auth()->user()->user_role == 1) {
                                    return true;
                                }

                                return false;
                            })
                            //->afterOrEqual('today')
                            ->gt(function ($get, $state) {
                                $opening_date = $get('opening_date');
                                $closing_date = $state;

                                //dd($opening_date, $closing_date);

                                $openingTimestamp = strtotime($opening_date);
                                $closingTimestamp = strtotime($closing_date);

                                // Calculate the difference in seconds
                                $dateDifference = $closingTimestamp - $openingTimestamp;

                                // Convert seconds to days
                                $daysDifference = $dateDifference / (60 * 60 * 24);

                                //dd($opening_date, $closing_date, $daysDifference);

                                // Check if the difference is exactly 15 days
                                if ($daysDifference >= 15) {
                                    return false;
                                } else {
                                    return true;
                                }
                            })
                            ->required(),
                        Forms\Components\Select::make('status')
                            ->required()
                            ->options([
                                '0' => 'Rejected',
                                '1' => 'Approved',
                                '2' => 'In Objection',
                            ])
                            ->visible(function () {
                                if (auth()->user()->user_role == 0) {
                                    return true;
                                } else if(auth()->user()->user_role == 1) {
                                    return true;
                                } else {
                                    return false;
                                }
                            }),
                        Forms\Components\Hidden::make('status')
                            ->visible(function () {
                                if (auth()->user()->user_role == 0) {
                                    return false;
                                } else if(auth()->user()->user_role == 1) {
                                    return false;
                                } else {
                                    return true;
                                }
                            })
                            ->disabled(function () {
                                if (auth()->user()->user_role == 0) {
                                    return true;
                                } else if(auth()->user()->user_role == 1) {
                                    return true;
                                } else {
                                    return false;
                                }
                            })
                            ->dehydrateStateUsing(function () {
                                return 3;
                            }),
                        /* Forms\Components\Toggle::make('is_approved')
                            ->required()
                            ->visible(function () {
                                if (auth()->user()->user_role == 0) {
                                    return true;
                                } else {
                                    return false;
                                }
                            }),
                        Forms\Components\Toggle::make('is_rejected')
                            ->required()
                            ->visible(function () {
                                if (auth()->user()->user_role == 0) {
                                    return true;
                                } else {
                                    return false;
                                }
                            }),
                        Forms\Components\Toggle::make('is_in_objection')
                            ->required()
                            ->visible(function () {
                                if (auth()->user()->user_role == 0) {
                                    return true;
                                } else {
                                    return false;
                                }
                            }), */
                        Forms\Components\ViewField::make('qr_code')
                            ->view('filament.forms.components.qr-code')
                            ->label('QR Code')
                            ->id(function ($livewire) {
                                if (isset($livewire->data['id'])) {
                                    return $livewire->data['id'];
                                }

                                return null;
                            }),
                    ])
                    ->columns(2)

            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('id')
                    ->label('SE #')
                    ->getStateUsing(function ($record) {
                        return "TSE-" . date('Ymd', strtotime($record->opening_date)) . $record->id;
                    })
                    ->sortable(query: function (Builder $query, string $direction): Builder {
                        return $query
                            //->orderBy(DB::raw("CONCAT('TSE-', DATE_FORMAT(opening_date, '%Y%m%d'), id)"), $direction);
                            ->orderBy('opening_date', $direction)
                            ->orderBy('id', $direction);
                    })
                    ->searchable(query: function (Builder $query, string $search): Builder {
                        $formattedSearch = strtoupper($search); // Ensure case-insensitive comparison

                        return $query->whereRaw("CONCAT('TSE-', DATE_FORMAT(opening_date, '%Y%m%d'), id) LIKE ?", ["%{$formattedSearch}%"]);
                    }),
                Tables\Columns\ViewColumn::make('qr_code')
                    ->getStateUsing(function ($record) {
                        return $record;
                    })->label('QR Code')->view('filament.tables.columns.collapsible-row-qr-code'),
                Tables\Columns\TextColumn::make('departmentoffice.description')->label('Department Office')->sortable()->searchable(),
                Tables\Columns\TextColumn::make('procurement.name')->sortable()->searchable(),
                Tables\Columns\TextColumn::make('title')->sortable()->searchable(),
                Tables\Columns\ViewColumn::make('description')->view('filament.tables.columns.collapsible-row-content'),
                Tables\Columns\ViewColumn::make('tender_notice')->view('filament.tables.columns.download-button'),
                Tables\Columns\ViewColumn::make('tender_document')->view('filament.tables.columns.download-button'),
                Tables\Columns\ViewColumn::make('status')->view('filament.tables.columns.status'),
                /* Tables\Columns\TextColumn::make('status')
                    ->enum([
                        '0' => 'Rejected',
                        '1' => 'Approved',
                        '2' => 'In Objection',
                    ]), */
                Tables\Columns\TextColumn::make('opening_date')->sortable()->searchable()
                    ->date('d M, Y'),
                Tables\Columns\TextColumn::make('closing_date')->sortable()->searchable()
                    ->date('d M, Y'),
                Tables\Columns\TextColumn::make('created_at')->sortable()
                    ->dateTime('d M, Y'),
                Tables\Columns\TextColumn::make('updated_at')->sortable()
                    ->dateTime('d M, Y'),
            ])
            ->filters([
                SelectFilter::make('ddo_code')
                    ->options(function () {
                        return DepartmentOffice::all()->pluck('description', 'ddo_code');
                    })
                    ->multiple()
                    ->searchable(),
                SelectFilter::make('procurement_id')
                    ->options(function () {
                        return Procurement::all()->pluck('name', 'id');
                    })
                    ->multiple()
                    ->searchable(),
                SelectFilter::make('status')
                    ->options([
                        '0' => 'Rejected',
                        '1' => 'Approved',
                        '2' => 'In Objection',
                    ]),
                TextFilter::make('title'),
                DateFilter::make('opening_date'),
                DateFilter::make('closing_date'),
                TernaryFilter::make('is_approved'),
                TernaryFilter::make('is_paid'),
                TernaryFilter::make('is_in_objection'),
                DateFilter::make('created_at'),
                DateFilter::make('updated_at'),
            ])
            ->actions([
                Tables\Actions\ViewAction::make(),
                Tables\Actions\EditAction::make()
                    ->visible(function ($record) {
                        if (auth()->user()->user_role == 0) {
                            return true;
                        } else if(auth()->user()->user_role == 1) {
                            return true;
                        } else {
                            if($record->status == 2) {
                                return true;
                            } else {
                                return false;
                            }
                        }
                    }),
                Tables\Actions\DeleteAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\DeleteBulkAction::make()
                    ->visible(function () {
                        if (auth()->user()->user_role == 0) {
                            return true;
                        }

                        return false;
                    }),
                FilamentExportBulkAction::make('export'),
            ]);
    }

    public static function getRelations(): array
    {
        return [
            ProcurementDocumentsRelationManager::class,
            DeptProcCommentResourceRelationManager::class,
        ];
    }

    public static function tableSearchQuery(Builder $query, $search): Builder
    {
        dd("here");
        return $query->orWhere('id_searchable', 'like', '%' . $search . '%');
    }

    public static function getEloquentQuery(): Builder
    {
        if (auth()->user()->user_role == 0) {
            $department_procurement = DepartmentProcurement::with(['departmentoffice', 'procurement']);
        } else if(auth()->user()->user_role == 1) {
            $department_procurement = DepartmentProcurement::with(['departmentoffice', 'procurement']);
        } else {
            $department_procurement = DepartmentProcurement::with(['departmentoffice', 'procurement'])->where('ddo_code', auth()->user()->ddo_code);
        }

        return $department_procurement;
    }


    public static function getPages(): array
    {
        return [
            'index' => Pages\ListDepartmentProcurements::route('/'),
            'create' => Pages\CreateDepartmentProcurement::route('/create'),
            'view' => Pages\ViewDepartmentProcurement::route('/{record}'),
            'edit' => Pages\EditDepartmentProcurement::route('/{record}/edit'),
        ];
    }


}

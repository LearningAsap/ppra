<?php

namespace App\Filament\Resources\DepartmentProcurementResource\RelationManagers;

use Filament\Forms;
use Filament\Tables;
use App\Models\Employee;
use App\Models\Procurement;
use Filament\Resources\Form;
use Filament\Resources\Table;
use PhpParser\Node\Stmt\Label;
use App\Models\DepartmentOffice;
use Illuminate\Support\Facades\DB;
use App\Models\DepartmentProcurement;
use Filament\Tables\Filters\SelectFilter;
use Illuminate\Database\Eloquent\Builder;
use Filament\Tables\Filters\TernaryFilter;
use Filament\Forms\Components\TextInput\Mask;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use Filament\Resources\RelationManagers\RelationManager;
use Webbingbrasil\FilamentAdvancedFilter\Filters\DateFilter;
use Webbingbrasil\FilamentAdvancedFilter\Filters\TextFilter;
use AlperenErsoy\FilamentExport\Actions\FilamentExportBulkAction;

class ProcurementDocumentsRelationManager extends RelationManager
{
    protected static ?string $title = "Procurement Documents";

    protected static string $relationship = 'procurementdocuments';

    protected static ?string $recordTitleAttribute = 'department_procurement_id';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Select::make('procurement_id')
                    ->label('Procurement')
                    ->options(function () {
                        return Procurement::all()->pluck('name', 'id');
                    })
                    ->required()
                    ->searchable(),
                Forms\Components\TextInput::make('title')
                    ->required()
                    ->minLength(3)
                    ->maxLength(255),
                Forms\Components\FileUpload::make('file')
                    ->label('Upload Document')
                    ->directory('proc_documents')
                    ->required(),

            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('id')->label('ID')->sortable()->searchable(),
                Tables\Columns\TextColumn::make('departmentprocurement.title')->searchable()->sortable(),
                Tables\Columns\TextColumn::make('title')->searchable()->sortable(),
                Tables\Columns\ViewColumn::make('file')->view('filament.tables.columns.download-button'),
                Tables\Columns\TextColumn::make('procurement.name')->sortable()->searchable(),
                Tables\Columns\TextColumn::make('created_at')->sortable()
                    ->dateTime('d M, Y'),
                Tables\Columns\TextColumn::make('updated_at')->sortable()
                    ->dateTime('d M, Y'),
            ])
            ->filters([
                SelectFilter::make('procurement_id')
                    ->options(function () {
                        return Procurement::all()->pluck('name', 'id');
                    })
                    ->multiple()
                    ->searchable(),
                TextFilter::make('title'),
                DateFilter::make('created_at'),
                DateFilter::make('updated_at')
            ])
            ->headerActions([
                Tables\Actions\CreateAction::make()
                    ->visible(function($livewire){
                        if(auth()->user()->user_role == 0) {
                            return true;
                        } else if(auth()->user()->user_role == 1) {
                            return true;
                        } else {
                            if($livewire->getOwnerRecord()->status == 1) {
                                return true;
                            } else {
                                return false;
                            }
                        }
                        //return true;
                    })
                    ->label('New Document')
                    ->modalHeading('Create New Document'),
            ])
            ->actions([
                Tables\Actions\EditAction::make()
                    ->visible(function(){
                        if(auth()->user()->user_role == 0) {
                            return true;
                        } else if(auth()->user()->user_role == 1) {
                            return true;
                        } else {
                            return false;
                        }
                    }),
                Tables\Actions\DeleteAction::make()
                    ->visible(function(){
                        if(auth()->user()->user_role == 0) {
                            return true;
                        } else if(auth()->user()->user_role == 1) {
                            return true;
                        } else {
                            return false;
                        }
                    }),
                Tables\Actions\ViewAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\DeleteBulkAction::make()
                    ->visible(function(){
                        if(auth()->user()->user_role == 0) {
                            return true;
                        } else if(auth()->user()->user_role == 1) {
                            return true;
                        } else {
                            return false;
                        }
                    }),
                FilamentExportBulkAction::make('export'),
            ]);
    }
}

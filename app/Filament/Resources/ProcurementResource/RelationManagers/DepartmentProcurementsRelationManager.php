<?php

namespace App\Filament\Resources\ProcurementResource\RelationManagers;

use Filament\Forms;
use Filament\Tables;
use App\Models\Employee;
use App\Models\Procurement;
use Filament\Resources\Form;
use Filament\Resources\Table;
use PhpParser\Node\Stmt\Label;
use App\Models\DepartmentOffice;
use Illuminate\Support\Facades\DB;
use Filament\Tables\Filters\SelectFilter;
use Illuminate\Database\Eloquent\Builder;
use Filament\Tables\Filters\TernaryFilter;
use Filament\Forms\Components\TextInput\Mask;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use Filament\Resources\RelationManagers\RelationManager;
use Webbingbrasil\FilamentAdvancedFilter\Filters\DateFilter;
use Webbingbrasil\FilamentAdvancedFilter\Filters\TextFilter;
use AlperenErsoy\FilamentExport\Actions\FilamentExportBulkAction;

class DepartmentProcurementsRelationManager extends RelationManager
{
    protected static ?string $title = "Department Procurements";

    protected static string $relationship = 'departmentprocurements';

    protected static ?string $recordTitleAttribute = 'procurement_id';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Select::make('ddo_code')
                    ->label('DDO Code')
                    ->options(function(){
                        return DepartmentOffice::all()->pluck('description', 'ddo_code');
                    })
                    ->required()
                    ->searchable(),
                Forms\Components\TextInput::make('title')
                    ->required()
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
                    ->maxLength(65535),
                Forms\Components\FileUpload::make('tender_notice')
                    ->directory('proc_files')
                    ->required(),
                Forms\Components\FileUpload::make('tender_document')
                    ->directory('proc_files')
                    ->required(),
                Forms\Components\DatePicker::make('opening_date')
                    ->required(),
                Forms\Components\DatePicker::make('closing_date')
                    ->after('opening_date')
                    ->required(),
                Forms\Components\Toggle::make('is_approved')
                    ->required(),
                Forms\Components\Toggle::make('is_paid')
                    ->required(),
                Forms\Components\Toggle::make('is_in_objection')
                    ->required(),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('departmentoffice.description')->label('Department Office')->sortable()->searchable(),
                Tables\Columns\TextColumn::make('procurement.name')->sortable()->searchable(),
                Tables\Columns\TextColumn::make('title')->sortable()->searchable(),
                Tables\Columns\ViewColumn::make('description')->view('filament.tables.columns.collapsible-row-content'),
                Tables\Columns\ViewColumn::make('tender_notice')->view('filament.tables.columns.download-button'),
                Tables\Columns\ViewColumn::make('tender_document')->view('filament.tables.columns.download-button'),
                Tables\Columns\TextColumn::make('opening_date')->sortable()->searchable()
                    ->date('d M, Y'),
                Tables\Columns\TextColumn::make('closing_date')->sortable()->searchable()
                    ->date('d M, Y'),
                Tables\Columns\IconColumn::make('is_approved')->sortable()
                    ->boolean(),
                Tables\Columns\IconColumn::make('is_paid')->sortable()
                    ->boolean(),
                Tables\Columns\IconColumn::make('is_in_objection')->sortable()
                    ->boolean(),
                Tables\Columns\TextColumn::make('created_at')->sortable()
                    ->dateTime('d M, Y'),
                Tables\Columns\TextColumn::make('updated_at')->sortable()
                    ->dateTime('d M, Y'),
            ])
            ->filters([
                SelectFilter::make('ddo_code')
                    ->options(function() {
                        return DepartmentOffice::all()->pluck('description', 'ddo_code');
                    })
                    ->multiple()
                    ->searchable(),
                SelectFilter::make('procurement_id')
                    ->options(function() {
                        return Procurement::all()->pluck('name', 'id');
                    })
                    ->multiple()
                    ->searchable(),
                TextFilter::make('title'),
                DateFilter::make('opening_date'),
                DateFilter::make('closing_date'),
                TernaryFilter::make('is_approved'),
                TernaryFilter::make('is_paid'),
                TernaryFilter::make('is_in_objection'),
                DateFilter::make('created_at'),
                DateFilter::make('updated_at')
            ])
            ->headerActions([
                //Tables\Actions\CreateAction::make()->label('New Contact Detail')->modalHeading('Create New Employee Contact Details'),
            ])
            ->actions([
                //Tables\Actions\EditAction::make(),
                //Tables\Actions\DeleteAction::make(),
                Tables\Actions\ViewAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\DeleteBulkAction::make(),
                FilamentExportBulkAction::make('export'),
            ]);
    }
}

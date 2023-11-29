<?php

namespace App\Filament\Resources\DepartmentResource\RelationManagers;

use Filament\Forms;
use Filament\Tables;
use App\Models\Employee;
use App\Models\Department;
use App\Models\Procurement;
use Filament\Resources\Form;
use Filament\Resources\Table;
use PhpParser\Node\Stmt\Label;
use App\Models\DepartmentOffice;
use App\Models\AttachedDepartment;
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

class AttachedDepartmentsRelationManager extends RelationManager
{
    protected static ?string $title = "Attached Departments";

    protected static string $relationship = 'attacheddepartments';

    protected static ?string $recordTitleAttribute = 'department_id';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\TextInput::make('attached_department_code')
                    ->required()
                    ->unique(ignorable: fn ($record) => $record)
                    ->maxLength(255),
                Forms\Components\Textarea::make('description')
                    ->minLength(3)
                    ->maxLength(65535),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('department_id')->sortable()->searchable(),
                Tables\Columns\TextColumn::make('attached_department_code')->sortable()->searchable(),
                Tables\Columns\TextColumn::make('description')->sortable()->searchable(),
                Tables\Columns\TextColumn::make('created_at')
                    ->dateTime('d M, Y'),
                Tables\Columns\TextColumn::make('updated_at')
                    ->dateTime('d M, Y'),
            ])
            ->filters([
                SelectFilter::make('department_id')
                    ->options(function() {
                        return Department::all()->pluck('department_id', 'department_id');
                    })
                    ->multiple()
                    ->searchable(),
                SelectFilter::make('attached_department_code')
                    ->options(function() {
                        return AttachedDepartment::all()->pluck('attached_department_code', 'attached_department_code');
                    })
                    ->multiple()
                    ->searchable(),
                TextFilter::make('description'),
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

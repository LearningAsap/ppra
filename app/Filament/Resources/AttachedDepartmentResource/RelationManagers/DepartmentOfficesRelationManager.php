<?php

namespace App\Filament\Resources\AttachedDepartmentResource\RelationManagers;

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

class DepartmentOfficesRelationManager extends RelationManager
{
    protected static ?string $title = "Department Offices";

    protected static string $relationship = 'departmentoffices';

    protected static ?string $recordTitleAttribute = 'attached_department_code';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\TextInput::make('ddo_code')
                    ->required()
                    ->unique(ignorable: fn ($record) => $record)
                    ->maxLength(255),
                Forms\Components\Textarea::make('description')
                    ->required()
                    ->minLength(3)
                    ->maxLength(65535),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('department_id')
                    ->getStateUsing(function ($record) {
                        $department = AttachedDepartment::join('department_offices', 'department_offices.attached_department_code', '=', 'attached_departments.attached_department_code')->where('ddo_code', $record->ddo_code)->first();
                        return $department->department_id;
                    }),
                Tables\Columns\TextColumn::make('attached_department_code')->sortable()->searchable(),
                Tables\Columns\TextColumn::make('ddo_code')->sortable()->searchable(),
                Tables\Columns\TextColumn::make('description')->sortable()->searchable(),
                Tables\Columns\TextColumn::make('created_at')->sortable()
                    ->dateTime('d M, Y'),
                Tables\Columns\TextColumn::make('updated_at')->sortable()
                    ->dateTime('d M, Y'),
            ])
            ->filters([
                SelectFilter::make('attached_department_code')
                    ->options(function() {
                        return AttachedDepartment::all()->pluck('attached_department_code', 'attached_department_code');
                    })
                    ->multiple()
                    ->searchable(),
                SelectFilter::make('ddo_code')
                    ->options(function() {
                        return DepartmentOffice::all()->pluck('ddo_code', 'ddo_code');
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

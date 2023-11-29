<?php

namespace App\Filament\Resources;

use Filament\Forms;
use Filament\Tables;
use Filament\Resources\Form;
use Filament\Resources\Table;
use App\Models\DepartmentOffice;
use Filament\Resources\Resource;
use App\Models\AttachedDepartment;
use Filament\Tables\Filters\SelectFilter;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use App\Filament\Resources\DepartmentOfficeResource\Pages;
use Webbingbrasil\FilamentAdvancedFilter\Filters\DateFilter;
use Webbingbrasil\FilamentAdvancedFilter\Filters\TextFilter;
use AlperenErsoy\FilamentExport\Actions\FilamentExportBulkAction;
use App\Filament\Resources\DepartmentOfficeResource\RelationManagers;
use App\Filament\Resources\ProcurementResource\RelationManagers\DepartmentProcurementsRelationManager;
use App\Models\Department;

class DepartmentOfficeResource extends Resource
{
    protected static ?string $model = DepartmentOffice::class;

    protected static ?string $navigationIcon = 'heroicon-o-cake';

    protected static ?int $navigationSort = 4;

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Select::make('attached_department_code')
                    ->options(function() {
                        return AttachedDepartment::all()->pluck('description', 'attached_department_code');
                    })
                    ->required()
                    ->searchable(),
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
            ->actions([
                Tables\Actions\ViewAction::make(),
                Tables\Actions\EditAction::make(),
                Tables\Actions\DeleteAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\DeleteBulkAction::make(),
                FilamentExportBulkAction::make('export'),
            ]);
    }

    public static function getRelations(): array
    {
        return [
            DepartmentProcurementsRelationManager::class
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListDepartmentOffices::route('/'),
            'create' => Pages\CreateDepartmentOffice::route('/create'),
            'edit' => Pages\EditDepartmentOffice::route('/{record}/edit'),
        ];
    }
}

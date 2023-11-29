<?php

namespace App\Filament\Resources;

use Filament\Forms;
use Filament\Tables;
use App\Models\Department;
use Filament\Resources\Form;
use Filament\Resources\Table;
use Filament\Resources\Resource;
use App\Models\AttachedDepartment;
use Filament\Tables\Filters\SelectFilter;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use App\Filament\Resources\AttachedDepartmentResource\Pages;
use Webbingbrasil\FilamentAdvancedFilter\Filters\DateFilter;
use Webbingbrasil\FilamentAdvancedFilter\Filters\TextFilter;
use AlperenErsoy\FilamentExport\Actions\FilamentExportBulkAction;
use App\Filament\Resources\AttachedDepartmentResource\RelationManagers;
use App\Filament\Resources\AttachedDepartmentResource\RelationManagers\DepartmentOfficesRelationManager;

class AttachedDepartmentResource extends Resource
{
    protected static ?string $model = AttachedDepartment::class;

    protected static ?string $navigationIcon = 'heroicon-o-briefcase';

    protected static ?int $navigationSort = 3;

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Select::make('department_id')
                    ->options(function() {
                        return Department::all()->pluck('name', 'department_id');
                    })
                    ->required()
                    ->searchable(),
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
            DepartmentOfficesRelationManager::class
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListAttachedDepartments::route('/'),
            'create' => Pages\CreateAttachedDepartment::route('/create'),
            'edit' => Pages\EditAttachedDepartment::route('/{record}/edit'),
        ];
    }
}

<?php

namespace App\Filament\Resources\DistrictResource\RelationManagers;

use Filament\Forms;
use Filament\Tables;
use App\Models\Employee;
use Filament\Resources\Form;
use Filament\Resources\Table;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Eloquent\Builder;
use Filament\Forms\Components\TextInput\Mask;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use Filament\Resources\RelationManagers\RelationManager;
use PhpParser\Node\Stmt\Label;

class EmpcontactdetailsRelationManager extends RelationManager
{
    protected static ?string $title = "Employee Contact Details";

    protected static string $relationship = 'empcontactdetails';

    protected static ?string $recordTitleAttribute = 'domicile_district_id';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Select::make('employee_id')
                    ->required()
                    ->label('Employee')
                    ->options(Employee::get([DB::raw('CONCAT(employees.first_name, " ", employees.last_name) AS full_name'), 'employees.id'])->pluck('full_name', 'id'))
                    ->searchable(),
                Forms\Components\Select::make('domicile_province')
                    ->options([
                        0 => 'Gilgit Baltistan',
                        1 => 'KPK',
                        2 => 'Sindh',
                        3 => 'Punjab',
                        4 => 'Balochistan',
                    ])
                    ->required(),
                Forms\Components\Select::make('residence_type')
                    ->options([
                        0 => 'Government Alloted',
                        1 => 'Hired',
                        2 => 'Own',
                        3 => 'Rented / Other',
                        4 => 'Inside Institution',
                    ])
                    ->required(),
                Forms\Components\TextInput::make('residential_address')
                    ->required()
                    ->maxLength(255),
                Forms\Components\TextInput::make('res_address_sector')->label('Residential Address (Sector)')
                    ->required()
                    ->maxLength(255),
                Forms\Components\TextInput::make('res_address_city')->Label('Residential Address (City)')
                    ->required()
                    ->maxLength(255),
                Forms\Components\TextInput::make('permanent_address_teh')->label('Permanent Address (Tehsil)')
                    ->required()
                    ->maxLength(255),
                Forms\Components\TextInput::make('permanent_address_dist')->label('Permanent Address (District)')
                    ->required()
                    ->maxLength(255),
                Forms\Components\TextInput::make('tehsil_code')
                    ->required()
                    ->maxLength(255),
                Forms\Components\TextInput::make('district_code')
                    ->required()
                    ->maxLength(255),
                Forms\Components\TextInput::make('phone_residence')
                    ->mask(fn (Mask $mask) => $mask->pattern('00000-000000'))
                    ->required()
                    ->maxLength(255),
                Forms\Components\TextInput::make('phone_office')
                    ->mask(fn (Mask $mask) => $mask->pattern('00000-000000'))
                    ->required()
                    ->maxLength(255),
                Forms\Components\TextInput::make('phone_cell')
                    ->mask(fn (Mask $mask) => $mask->pattern('0000-0000000'))
                    ->required()
                    ->maxLength(255),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('employee.first_name')->label('First Name')->searchable()->sortable(),
                Tables\Columns\TextColumn::make('employee.last_name')->label('Last Name')->searchable()->sortable(),
                Tables\Columns\TextColumn::make('domiciledistrict.name')->label('Domicile District')->searchable()->sortable(),
                Tables\Columns\TextColumn::make('domicile_province')->searchable()->sortable()
                    ->enum([
                        0 => 'Gilgit Baltistan',
                        1 => 'KPK',
                        2 => 'Sindh',
                        3 => 'Punjab',
                        4 => 'Balochistan',
                    ]),
                Tables\Columns\TextColumn::make('residence_type')->searchable()->sortable()
                    ->enum([
                        0 => 'Government Alloted',
                        1 => 'Hired',
                        2 => 'Own',
                        3 => 'Rented / Other',
                        4 => 'Inside Institution',
                    ]),
                Tables\Columns\TextColumn::make('residential_address')->searchable()->sortable(),
                Tables\Columns\TextColumn::make('res_address_sector')->searchable()->sortable(),
                Tables\Columns\TextColumn::make('res_address_city')->searchable()->sortable(),
                Tables\Columns\TextColumn::make('permanent_address_teh')->searchable()->sortable(),
                Tables\Columns\TextColumn::make('tehsil_code')->searchable()->sortable(),
                Tables\Columns\TextColumn::make('district_code')->searchable()->sortable(),
                Tables\Columns\TextColumn::make('phone_residence')->searchable()->sortable(),
                Tables\Columns\TextColumn::make('phone_cell')->searchable()->sortable(),
                Tables\Columns\TextColumn::make('phone_office')->searchable()->sortable(),
                Tables\Columns\TextColumn::make('created_at')
                    ->dateTime('d-m-Y h:i:s A'),
                Tables\Columns\TextColumn::make('updated_at')
                    ->dateTime('d-m-Y h:i:s A'),
            ])
            ->filters([
                //
            ])
            ->headerActions([
                Tables\Actions\CreateAction::make()->label('New Contact Detail')->modalHeading('Create New Employee Contact Details'),
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
                Tables\Actions\DeleteAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\DeleteBulkAction::make(),
            ]);
    }
}

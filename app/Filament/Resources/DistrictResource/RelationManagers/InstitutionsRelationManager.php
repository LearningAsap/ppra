<?php

namespace App\Filament\Resources\DistrictResource\RelationManagers;

use Filament\Forms;
use Filament\Tables;
use Filament\Resources\Form;
use Filament\Resources\Table;
use Illuminate\Database\Eloquent\Builder;
use Filament\Forms\Components\TextInput\Mask;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use Filament\Resources\RelationManagers\RelationManager;

class InstitutionsRelationManager extends RelationManager
{
    protected static string $relationship = 'institutions';

    protected static ?string $recordTitleAttribute = 'district_id';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\TextInput::make('name')
                    ->required()
                    ->maxLength(255),
                Forms\Components\TextInput::make('ddo_code')
                    ->required()
                    ->minLength(3)
                    ->maxLength(255),
                Forms\Components\Select::make('location')
                    ->options([
                        0 => 'Urban',
                        1 => 'Rural',
                    ])
                    ->required(),
                Forms\Components\Select::make('location')
                    ->options([
                        0 => 'Government',
                        1 => 'Semi Government',
                        1 => 'Private',
                    ])
                    ->required(),
                Forms\Components\TextInput::make('established_year')
                    ->integer()
                    ->minLength(4)
                    ->required(),
                Forms\Components\Select::make('is_approved_inter')
                    ->label('Intermediate')
                    ->options([
                        0 => 'Unapproved',
                        1 => 'Approved',
                    ])
                    ->required(),
                Forms\Components\Select::make('is_approved_grad')
                    ->label('Graduation')
                    ->options([
                        0 => 'Unapproved',
                        1 => 'Approved',
                    ])
                    ->required(),
                Forms\Components\Select::make('gender')
                    ->options([
                        0 => 'Male',
                        1 => 'Female',
                        1 => 'Both',
                    ])
                    ->required(),
                Forms\Components\Select::make('status')
                    ->options([
                        0 => 'Non Functional',
                        1 => 'Functional',
                    ])
                    ->required(),
                Forms\Components\Select::make('working_shifts')
                    ->options([
                        0 => 'Morning',
                        1 => 'Evening',
                        1 => 'Both',
                    ])
                    ->required(),
                Forms\Components\Select::make('instruction_medium')
                    ->options([
                        0 => 'English',
                        1 => 'Urdu',
                        1 => 'Both',
                    ])
                    ->required(),
                Forms\Components\TextInput::make('phone_no_1')
                    ->mask(fn (Mask $mask) => $mask->pattern('00000-000000'))
                    ->required()
                    ->maxLength(255),
                Forms\Components\TextInput::make('phone_no_2')
                    ->mask(fn (Mask $mask) => $mask->pattern('00000-000000'))
                    ->maxLength(255),
                Forms\Components\TextInput::make('fax_no')
                    ->mask(fn (Mask $mask) => $mask->pattern('00000-000000'))
                    ->maxLength(255),
                Forms\Components\TextInput::make('email')
                    ->email()
                    ->maxLength(255),
                Forms\Components\TextInput::make('website')
                    ->url()
                    ->maxLength(255),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('district.name')->searchable()->sortable(),
                Tables\Columns\TextColumn::make('name')->searchable()->sortable(),
                Tables\Columns\TextColumn::make('ddo_code')->searchable()->sortable(),
                Tables\Columns\TextColumn::make('location')->searchable()->sortable()
                    ->enum([
                        0 => 'Urban',
                        1 => 'Rural'
                    ]),
                Tables\Columns\TextColumn::make('type')->searchable()->sortable()
                    ->enum([
                        0 => 'Government',
                        1 => 'Semi Government',
                        2 => 'Private'
                    ]),
                Tables\Columns\TextColumn::make('established_year')->searchable()->sortable(),
                Tables\Columns\TextColumn::make('is_approved_inter')->label('Intermediate')->searchable()->sortable()
                    ->enum([
                        0 => 'Unapproved',
                        1 => 'Approved'
                    ]),
                Tables\Columns\TextColumn::make('is_approved_grad')->label('Graduation')->searchable()->sortable()
                    ->enum([
                        0 => 'Unapproved',
                        1 => 'Approved'
                    ]),
                Tables\Columns\TextColumn::make('gender')->searchable()->sortable()
                    ->enum([
                        0 => 'Male',
                        1 => 'Female',
                        2 => 'Both'
                    ]),
                Tables\Columns\TextColumn::make('status')->searchable()->sortable()
                    ->enum([
                        0 => 'Non Functional',
                        1 => 'Functional'
                    ]),
                Tables\Columns\TextColumn::make('working_shifts')->searchable()->sortable()
                    ->enum([
                        0 => 'Morning',
                        1 => 'Evening',
                        2 => 'Both'
                    ]),
                Tables\Columns\TextColumn::make('instruction_medium')->searchable()->sortable()
                    ->enum([
                        0 => 'English',
                        1 => 'Urdu',
                        2 => 'Both'
                    ]),
                Tables\Columns\TextColumn::make('phone_no_1')->searchable()->sortable(),
                Tables\Columns\TextColumn::make('phone_no_2')->searchable()->sortable(),
                Tables\Columns\TextColumn::make('fax_no')->searchable()->sortable(),
                Tables\Columns\TextColumn::make('email')->searchable()->sortable(),
                Tables\Columns\TextColumn::make('website')->searchable()->sortable(),
                Tables\Columns\TextColumn::make('created_at')
                    ->dateTime('d-m-Y h:i:s A'),
                Tables\Columns\TextColumn::make('updated_at')
                    ->dateTime('d-m-Y h:i:s A'),
            ])
            ->filters([
                //
            ])
            ->headerActions([
                Tables\Actions\CreateAction::make(),
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

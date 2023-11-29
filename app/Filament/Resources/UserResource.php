<?php

namespace App\Filament\Resources;

use Filament\Forms;
use App\Models\User;
use Filament\Tables;
use Filament\Pages\Page;
use App\Models\Department;
use Filament\Resources\Form;
use Filament\Resources\Table;
use App\Models\DepartmentOffice;
use Filament\Resources\Resource;
use Illuminate\Support\Facades\Hash;
use Filament\Tables\Filters\SelectFilter;
use Filament\Tables\Filters\TernaryFilter;
use App\Filament\Resources\UserResource\Pages;
use App\Filament\Resources\UserResource\Pages\CreateUser;
use Webbingbrasil\FilamentAdvancedFilter\Filters\DateFilter;
use Webbingbrasil\FilamentAdvancedFilter\Filters\TextFilter;

class UserResource extends Resource
{
    protected static ?string $model = User::class;

    protected static ?string $navigationIcon = 'heroicon-o-user';

    protected static ?int $navigationSort = 9;

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Select::make('ddo_code')
                    ->label('Department Office')
                    ->options(DepartmentOffice::all()->pluck('description', 'ddo_code'))
                    ->searchable(),
                Forms\Components\TextInput::make('user_name')
                    ->required()
                    ->maxLength(255),
                Forms\Components\Select::make('user_role')
                    ->options(function(){
                        if(auth()->user()->user_role == 0) {
                            return [
                                0 => 'Super Admin',
                                1 => 'Admin',
                                2 => 'Department'
                            ];
                        }else if(auth()->user()->user_role == 1) {
                            return [
                                1 => 'Admin',
                                2 => 'Department'
                            ];
                        } else {
                            return [];
                        }
                    })
                    ->required(),
                Forms\Components\TextInput::make('email')
                    ->email()
                    ->required()
                    ->maxLength(255),
                Forms\Components\TextInput::make('password')
                    ->password()
                    ->minLength(8)
                    ->string()
                    ->regex('/^(?=.*[a-z])(?=.*[0-9]).{8,}$/')
                    ->maxLength(255)
                    ->dehydrateStateUsing(static fn(null|string $state):
                        null|string =>
                        filled($state) ? Hash::make($state) : null,
                    )
                    //->required()
                    ->required(static fn(Page $livewire):
                        string =>
                        $livewire instanceof CreateUser,
                    )
                    ->dehydrated(static fn(null|string $state) : bool =>
                        filled($state),
                    ),
                Forms\Components\TextInput::make('confirm_password')
                    ->visible(static fn(Page $livewire):
                        string => $livewire instanceof CreateUser,
                    )
                    ->password()
                    ->required()
                    ->same('password'),
                Forms\Components\Toggle::make('is_active')
                    ->required()
                    ->visible(function () {
                        if (auth()->user()->user_role == 0) {
                            return true;
                        }else if(auth()->user()->user_role == 1) {
                            return true;
                        }
                         else {
                            return false;
                        }
                    }),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('departmentoffice.description')->label('Department')->sortable()->searchable(),
                Tables\Columns\TextColumn::make('user_name')->label('User Name')->sortable()->searchable(),
                Tables\Columns\TextColumn::make('user_role')->label('Role')->sortable()->searchable()
                    ->enum([
                        0 => 'Super Admin',
                        1 => 'Admin',
                        2 => 'Department'
                    ]),
                Tables\Columns\TextColumn::make('email')->searchable()->sortable(),
                Tables\Columns\IconColumn::make('is_active')->sortable()
                    ->boolean(),
                Tables\Columns\TextColumn::make('created_at')
                    ->dateTime('d-m-Y h:i:s A'),
                Tables\Columns\TextColumn::make('updated_at')
                    ->dateTime('d-m-Y h:i:s A'),
            ])
            ->filters([
                SelectFilter::make('ddo_code')
                    ->options(function(){
                        return DepartmentOffice::all()->pluck('description', 'ddo_code');
                    })
                    ->searchable()
                    ->multiple(),
                TextFilter::make('user_name'),
                SelectFilter::make('user_role')
                    ->options([
                        0 => 'Super Admin',
                        1 => 'Admin',
                        2 => 'Department'
                    ]),
                TextFilter::make('email'),
                TernaryFilter::make('is_active'),
                DateFilter::make('created_at'),
                DateFilter::make('updated_at')
            ])
            ->actions([
                Tables\Actions\ViewAction::make(),
                Tables\Actions\EditAction::make()
                    ->visible(function($record){
                        if(auth()->user()->user_role == 0) {
                            return true;
                        }else if(auth()->user()->user_role == 1) {
                            if(auth()->user()->id == $record->id) {
                                return false;
                            } elseif($record->user_role == 0) {
                                return false;
                            } else {
                                return true;
                            }
                        } else {
                            return false;
                        }
                    }),
                Tables\Actions\DeleteAction::make()
                    ->visible(function($record){
                        if(auth()->user()->user_role == 0) {
                            if(auth()->user()->id == $record->id) {
                                return false;
                            } else {
                                return true;
                            }
                        }else if(auth()->user()->user_role == 1) {
                            if(auth()->user()->id == $record->id) {
                                return false;
                            } elseif($record->user_role == 0) {
                                return false;
                            } else {
                                return true;
                            }
                        } else {
                            return false;
                        }
                    }),
            ])
            ->bulkActions([
                Tables\Actions\DeleteBulkAction::make(),
            ]);
    }

    public static function getRelations(): array
    {
        return [
            //
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListUsers::route('/'),
            'create' => Pages\CreateUser::route('/create'),
            'view' => Pages\ViewUser::route('/{record}'),
            'edit' => Pages\EditUser::route('/{record}/edit'),
        ];
    }
}

<?php

namespace App\Filament\Resources;

use Closure;
use Filament\Forms;
use Filament\Tables;
use App\Models\Event;
use Filament\Resources\Form;
use Filament\Resources\Table;
use Filament\Resources\Resource;
use Illuminate\Database\Eloquent\Builder;
use App\Filament\Resources\EventResource\Pages;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use App\Filament\Resources\EventResource\RelationManagers;
use AlperenErsoy\FilamentExport\Actions\FilamentExportBulkAction;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Filters\SelectFilter;
use Webbingbrasil\FilamentAdvancedFilter\Filters\DateFilter;
use Webbingbrasil\FilamentAdvancedFilter\Filters\TextFilter;

class EventResource extends Resource
{
    protected static ?string $model = Event::class;

    protected static ?string $navigationIcon = 'heroicon-o-bell';

    protected static ?int $navigationSort = 10;

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Select::make('type')
                    ->options([
                        0 => 'Downloads',
                        1 => 'News',
                        2 => 'Publications',
                        3 => 'Press Clippings'
                    ])
                    ->reactive()
                    ->required(),
                Forms\Components\TextInput::make('title')
                    ->required()
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
                    ->hidden(function (Closure $get) {
                        $ap_t = $get('type');
                        if($ap_t == null)
                        {
                            return true;
                        } else if($ap_t == 0) {
                            return true;
                        } else if($ap_t == 1) {
                            return false;
                        } else if($ap_t == 2) {
                            return true;
                        } else if($ap_t == 3) {
                            return true;
                        }

                        return false;
                    })
                    ->required(function (Closure $get) {
                        $ap_t = $get('type');
                        if($ap_t == 1) {
                            return true;
                        }

                        return false;
                    })
                    ->maxLength(65535),
                Forms\Components\FileUpload::make('image')->image()
                    ->directory('site_files')
                    ->hidden(function (Closure $get) {
                        $ap_t = $get('type');
                        if($ap_t == null)
                        {
                            return true;
                        } else if($ap_t == 0) {
                            return true;
                        } else if($ap_t == 1) {
                            return false;
                        } else if($ap_t == 2) {
                            return true;
                        } else if($ap_t == 3) {
                            return true;
                        }

                        return false;
                    })
                    ->required(function (Closure $get) {
                        $ap_t = $get('type');
                        if($ap_t == 1) {
                            return true;
                        }

                        return false;
                    }),
                Forms\Components\FileUpload::make('file')
                    ->directory('site_files')
                    ->required(function (Closure $get) {
                        $ap_t = $get('type');
                        if($ap_t == 0) {
                            return true;
                        }

                        return false;
                    })
                    ->hidden(function (Closure $get) {
                        $ap_t = $get('type');
                        if($ap_t == null)
                        {
                            return true;
                        } else if($ap_t == 0) {
                            return false;
                        } else if ($ap_t == 1) {
                            return true;
                        } else if($ap_t == 2) {
                            return false;
                        } else if($ap_t == 3) {
                            return false;
                        }

                        return true;
                    }),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('type')
                    ->enum([
                        0 => 'Downloads',
                        1 => 'News',
                        2 => 'Publications',
                        3 => 'Press Clippings'
                    ]),
                Tables\Columns\TextColumn::make('title')->searchable()->sortable(),
                Tables\Columns\ViewColumn::make('description')->view('filament.tables.columns.collapsible-row-content'),
                Tables\Columns\ImageColumn::make('image'),
                Tables\Columns\ViewColumn::make('file')->view('filament.tables.columns.download-button'),
                Tables\Columns\TextColumn::make('created_at')->sortable()
                    ->dateTime('d M, Y'),
                Tables\Columns\TextColumn::make('updated_at')->sortable()
                    ->dateTime('d M, Y'),
            ])
            ->filters([
                SelectFilter::make('type')
                    ->options([
                        0 => 'Downloads',
                        1 => 'News',
                        2 => 'Publications',
                        3 => 'Press Clippings'
                    ])
                    ->multiple(),
                TextFilter::make('title'),
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
            //
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListEvents::route('/'),
            'create' => Pages\CreateEvent::route('/create'),
            'edit' => Pages\EditEvent::route('/{record}/edit'),
        ];
    }
}

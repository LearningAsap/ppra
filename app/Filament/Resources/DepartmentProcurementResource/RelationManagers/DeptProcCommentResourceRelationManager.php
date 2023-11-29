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

class DeptProcCommentResourceRelationManager extends RelationManager
{
    protected static ?string $title = "Comments";

    protected static string $relationship = 'departmentprocurementcomments';

    protected static ?string $recordTitleAttribute = 'department_procurement_id';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\RichEditor::make('comment')
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
                    ->required()
                    ->minLength(3)
                    ->maxLength(65535),
            ])->columns(1);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('departmentprocurement.title')->searchable()->sortable(),
                Tables\Columns\ViewColumn::make('comment')->view('filament.tables.columns.collapsible-row-content'),
                Tables\Columns\TextColumn::make('created_at')->sortable()
                    ->dateTime('d M, Y'),
                Tables\Columns\TextColumn::make('updated_at')->sortable()
                    ->dateTime('d M, Y'),
            ])
            ->filters([
                /* SelectFilter::make('department_procurement_id')
                    ->options(function() {
                        return DepartmentProcurement::all()->pluck('title', 'id');
                    })
                    ->multiple()
                    ->searchable()
                    ->visible(function(){
                        if(auth()->user()->user_role == 0) {
                            return true;
                        }

                        return false;
                    }), */
                DateFilter::make('created_at'),
                DateFilter::make('updated_at')
            ])
            ->headerActions([
                Tables\Actions\CreateAction::make()
                    ->visible(function(){
                        if(auth()->user()->user_role == 0) {
                            return true;
                        } else if(auth()->user()->user_role == 1) {
                            return true;
                        } else {
                            return false;
                        }
                    })
                    ->label('New Comment')
                    ->modalHeading('Create New Comment'),
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
                        if(auth()->user()->user_role == 0){
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

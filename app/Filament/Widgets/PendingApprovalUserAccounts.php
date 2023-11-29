<?php

namespace App\Filament\Widgets;

use App\Models\DepartmentProcurement;
use App\Models\User;
use Closure;
use Filament\Tables;
use Filament\Widgets\TableWidget as BaseWidget;
use Illuminate\Database\Eloquent\Builder;
use Filament\Tables\Actions\Action;
use Filament\Tables\Columns\Layout\Grid;
use DB;
class PendingApprovalUserAccounts extends BaseWidget
{

    protected int | string | array $columnSpan = 6;

    protected static ?int $sort = 42;

    protected function getTableQuery(): Builder
    {
        return User::query()->where('is_active', 0)->latest();
    }

    public static function canView(): bool
    {
        if(auth()->user()->user_role == 0) {
            return true;
        } else if(auth()->user()->user_role == 1) {
            return true;
        } else {
            return false;
        }
    }

    protected function getTableColumns(): array
    {
        return [
            Tables\Columns\TextColumn::make('departmentoffice.description')->label('Department')->sortable()->searchable(),
            Tables\Columns\TextColumn::make('user_name')->label('User Name')->sortable()->searchable(),
            Tables\Columns\TextColumn::make('user_role')->label('Role')->sortable()->searchable()
                ->enum([
                    0 => 'Super Admin',
                    1 => 'Admin',
                    2 => 'Department'
                ]),
            Tables\Columns\IconColumn::make('is_active')->sortable()
                ->boolean(),
            Tables\Columns\TextColumn::make('created_at')
                ->dateTime('d-m-Y h:i:s A'),

        ];
    }

    protected function getTableActions(): array
    {
        return [
            Action::make('view')
                //->url(fn (DepartmentProcurement $record): string => route('department-procurements.edit', $record))
                ->url(function($record){
                    return url('admin/users', $record->id. '/edit');
                })
                ->openUrlInNewTab()
        ];
    }

    protected function getTableRecordUrlUsing(): Closure
    {
        return fn (User $record): string => url('admin/users', $record->id. '/edit');
    }

    protected function getTableRecordsPerPageSelectOptions(): array
    {
        return [5, 10, 15, 20, 25, 50, 70, 100];
    }

}

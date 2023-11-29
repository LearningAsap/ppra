<?php

namespace App\Filament\Resources\DepartmentProcurementResource\Widgets;

use App\Models\DepartmentProcurement;
use Closure;
use Filament\Tables;
use Filament\Widgets\TableWidget as BaseWidget;
use Illuminate\Database\Eloquent\Builder;

class LatestProcurements extends BaseWidget
{
    protected function getTableQuery(): Builder
    {
        return DepartmentProcurement::query()->latest();
    }

    protected function getTableColumns(): array
    {
        return [
            Tables\Columns\TextColumn::make('id')->label('ID')->sortable()->searchable(),
      Tables\Columns\ViewColumn::make('qr_code')
                ->getStateUsing(function($record){
                    return $record;
                })->label('QR Code')->view('filament.tables.columns.collapsible-row-qr-code'),
            Tables\Columns\TextColumn::make('departmentoffice.description')->label('Department Office')->sortable()->searchable(),
            Tables\Columns\TextColumn::make('procurement.name')->sortable()->searchable(),
            Tables\Columns\TextColumn::make('title')->sortable()->searchable(),
        ];
    }
}

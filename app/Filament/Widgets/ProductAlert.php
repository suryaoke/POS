<?php

namespace App\Filament\Widgets;

use App\Models\Product;
use Filament\Tables;
use Filament\Tables\Columns\BadgeColumn;
use Filament\Tables\Table;
use Filament\Widgets\TableWidget as BaseWidget;

class ProductAlert extends BaseWidget
{

    protected static ?int $sort = 3;
    protected static ?string $heading = 'Produk Hampir Habis';

    public function table(Table $table): Table
    {

        return $table
            ->query(
                Product::query()->where('stok', '<=', 10)->orderBy('stok', 'asc')
            )
            ->columns([
                Tables\Columns\ImageColumn::make('image'),
                Tables\Columns\TextColumn::make('name')->searchable(),
                BadgeColumn::make('stok')
                    ->label('Stok')
                    ->numeric()
                    ->color(static function ($state): string {
                        if ($state < 5) {
                            return 'danger';
                        } elseif ($state <= 10) {
                            return 'warning';
                        }
                    })
                    ->sortable()
            ])->defaultPaginationPageOption(5);
    }
}

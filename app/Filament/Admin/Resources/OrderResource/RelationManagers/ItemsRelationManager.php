<?php

namespace App\Filament\Admin\Resources\OrderResource\RelationManagers;

use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\RelationManagers\RelationManager;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;

class ItemsRelationManager extends RelationManager
{
    protected static string $relationship = 'items';

    protected static ?string $title = 'Productos del Pedido';

    protected static ?string $recordTitleAttribute = 'product.name';

    public function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Select::make('product_id')
                    ->label('Producto')
                    ->relationship(
                        name: 'product',
                        titleAttribute: 'name',
                        modifyQueryUsing: fn (Builder $query) => $query->orderBy('name')
                    )
                    ->searchable()
                    ->preload()
                    ->required()
                    ->columnSpan(2),

                Forms\Components\TextInput::make('quantity')
                    ->label('Cantidad')
                    ->numeric()
                    ->minValue(1)
                    ->default(1)
                    ->required(),

                Forms\Components\TextInput::make('unit_price')
                    ->label('Precio Unitario')
                    ->numeric()
                    ->minValue(0)
                    ->required()
                    ->prefix('$'),
            ])
            ->columns(2);
    }

    public function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('product.name')
                    ->label('Producto')
                    ->searchable()
                    ->sortable(),

                Tables\Columns\TextColumn::make('quantity')
                    ->label('Cantidad')
                    ->sortable()
                    ->alignCenter(),

                Tables\Columns\TextColumn::make('unit_price')
                    ->label('Precio Unitario')
                    ->money('USD')
                    ->sortable(),

                Tables\Columns\TextColumn::make('total')
                    ->label('Subtotal')
                    ->money('USD')
                    ->state(fn ($record) => $record->quantity * $record->unit_price)
                    ->sortable(),
            ])
            ->filters([
                // Puedes agregar filtros aquí si es necesario
            ])
            ->headerActions([
                Tables\Actions\CreateAction::make()
                    ->label('Agregar Producto')
                    ->modalHeading('Agregar Producto al Pedido'),
            ])
            ->actions([
                Tables\Actions\EditAction::make()
                    ->label('Editar')
                    ->modalHeading('Editar Producto del Pedido'),
                
                Tables\Actions\DeleteAction::make()
                    ->label('Eliminar'),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make()
                        ->label('Eliminar seleccionados'),
                ]),
            ])
            ->emptyStateActions([
                Tables\Actions\CreateAction::make()
                    ->label('Agregar Producto')
                    ->modalHeading('Agregar Producto al Pedido'),
            ]);
    }
}

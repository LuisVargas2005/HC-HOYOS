<?php

namespace App\Filament\App\Resources;

use Filament\Forms;
use Filament\Tables;
use App\Models\Product;
use Filament\Forms\Form;
use Filament\Tables\Table;
use App\Models\ProductCategory;
use Filament\Resources\Resource;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\Toggle;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Tables\Columns\ImageColumn;
use App\Filament\App\Resources\ProductResource\Pages;
use Filament\Forms\Components\Grid;
use Filament\Forms\Components\Repeater;

class ProductResource extends Resource
{
    protected static ?string $model = Product::class;

    protected static ?string $navigationIcon = 'heroicon-o-circle-stack';

    protected static ?int $navigationSort = 5;

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\TextInput::make('name')
                    ->required()
                    ->maxLength(255),

                Select::make('category_id')
                    ->label('Category')
                    ->required()
                    ->relationship('category', 'name'),

                TextInput::make('short_description')
                    ->maxLength(255)
                    ->columnSpanFull(),

                Textarea::make('long_description')
                    ->maxLength(65535)
                    ->columnSpanFull(),

                Grid::make()
                    ->schema([
                        Toggle::make('is_variable')->label('Variable'),
                        Toggle::make('is_grouped')->label('Grouped'),
                        Toggle::make('is_simple')->label('Simple'),
                    ]),

                Forms\Components\FileUpload::make('featured_image')
                    ->label('Imagen principal')
                    ->image()
                    ->acceptedFileTypes(['image/jpeg', 'image/png', 'image/webp', 'image/jpg'])
                    ->maxSize(2048)
                    ->directory('products')
                    ->disk('public')
                    ->preserveFilenames()
                    ->required() // ← Agrega esto para asegurarte que no se envíe vacío
                    ->visibility('public'),
                    Repeater::make('images')
                        ->relationship()
                        ->schema([
                            Forms\Components\FileUpload::make('image')
                                ->disk('public')
                                ->directory('products')
                                ->image()
                                ->visibility('public')
                                ->preserveFilenames()
                                ->required() // <- Este es crucial para evitar valores null
                        ]),

                TextInput::make('price')
                    ->numeric()
                    ->required()
                    ->minValue(0)
                    ->prefix('$'),

                TextInput::make('sku')
                    ->label('SKU/Código de producto')
                    ->maxLength(50)
                    ->unique(ignoreRecord: true),

                TextInput::make('inventory_count')
                    ->label('Existencias')
                    ->numeric()
                    ->default(0),

                TextInput::make('weight')
                    ->label('Peso (kg)')
                    ->numeric()
                    ->step(0.01),

                TextInput::make('dimensions')
                    ->label('Dimensiones (L x W x H)')
                    ->placeholder('Ej: 10x5x2'),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                ImageColumn::make('featured_image')
                    ->label('Imagen')
                    ->getStateUsing(fn ($record) => $record->featured_image) // Asegura que tenga el path como 'products/teclado.jpg'
                    ->url(fn ($record) => asset('storage/' . $record->featured_image)) // URL completa para ver imagen
                    ->disk('public') // <-- CORRECTO
                    ->circular(),    // Estilo opcional

                Tables\Columns\TextColumn::make('name')
                    ->searchable()
                    ->sortable(),

                Tables\Columns\TextColumn::make('category.name')
                    ->label('Categoría'),

                Tables\Columns\TextColumn::make('price')
                    ->money('USD')
                    ->formatStateUsing(callback: function (string $state): string {
                        return number_format(num: $state, decimals: 2, decimal_separator: '.', thousands_separator: ',');
                    })
                    ->sortable(),

                Tables\Columns\TextColumn::make('inventory_count')
                    ->label('Existencias')
                    ->sortable(),
            ])
            ->filters([
                Tables\Filters\SelectFilter::make('category')
                    ->relationship('category', 'name'),
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                ]),
            ]);
    }

    public static function getRelations(): array
    {
        return [];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListProducts::route('/'),
            'create' => Pages\CreateProduct::route('/create'),
            'edit' => Pages\EditProduct::route('/{record}/edit'),
        ];
    }
}

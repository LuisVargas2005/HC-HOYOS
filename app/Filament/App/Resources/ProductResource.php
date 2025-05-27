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
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use App\Filament\App\Resources\ProductResource\Pages;
use App\Filament\App\Resources\ProductResource\RelationManagers;
use Filament\Forms\Components\Grid;
use Filament\Forms\Components\Repeater;
use Filament\Forms\Components\Section;

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
                
            Forms\Components\Select::make('category_id')
                ->label('Category')
                ->required()
                ->relationship('category', 'name'),
                
            Forms\Components\TextInput::make('short_description')
                ->maxLength(255)
                ->columnSpanFull(),
                
            Forms\Components\Textarea::make('long_description')
                ->maxLength(65535)
                ->columnSpanFull(),
                
            Grid::make()
                ->schema([
                    Forms\Components\Toggle::make('is_variable')
                        ->label('Variable'),
                    Forms\Components\Toggle::make('is_grouped')
                        ->label('Grouped'),
                    Forms\Components\Toggle::make('is_simple')
                        ->label('Simple'),
                ]),
                
            Forms\Components\FileUpload::make('featured_image')
                ->image()
                ->disk('public')
                ->directory('products')
                ->visibility('public')
                ->label('Featured Image'),
                
            Repeater::make('images')
                ->relationship('images')
                ->schema([
                    Forms\Components\FileUpload::make('image')
                        ->hiddenLabel()
                        ->image()
                        ->disk('public')
                        ->directory('products')
                        ->visibility('public')
                ]),
                Forms\Components\TextInput::make('price')
                    ->numeric()
                    ->required()
                    ->prefix('$'),
                    
                Forms\Components\TextInput::make('sku')
                    ->label('SKU/Código de producto')
                    ->maxLength(50)
                    ->unique(ignoreRecord: true),
                    
                Forms\Components\TextInput::make('inventory_count')
                    ->label('Existencias')
                    ->numeric()
                    ->default(0),
                    
                Forms\Components\TextInput::make('weight')
                    ->label('Peso (kg)')
                    ->numeric()
                    ->step(0.01),
                    
                Forms\Components\TextInput::make('dimensions')
                    ->label('Dimensiones (L x W x H)')
                    ->placeholder('Ej: 10x5x2'),
        
        

                // Forms\Components\TextInput::make('meta_title')
                //     ->label('Meta Title')
                //     ->maxLength(60)
                //     ->helperText('Recommended length: 50-60 characters'),

                // Forms\Components\Textarea::make('meta_description')
                //     ->label('Meta Description')
                //     ->maxLength(160)
                //     ->helperText('Recommended length: 150-160 characters'),

                // Forms\Components\TagsInput::make('meta_keywords')
                //     ->label('Meta Keywords')
                //     ->helperText('Enter keywords separated by commas'),
            ]);
    }

    public static function table(Table $table): Table
{
    return $table
        ->columns([
            Tables\Columns\ImageColumn::make('featured_image')
                ->label('Imagen'),
            Tables\Columns\TextColumn::make('name')
                ->searchable()
                ->sortable(),
            Tables\Columns\TextColumn::make('category.name')
                ->label('Categoría'),
            Tables\Columns\TextColumn::make('price')
                ->money('USD')
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
        return [
            //
        ];
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

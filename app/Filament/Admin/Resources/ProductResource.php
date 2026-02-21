<?php

namespace App\Filament\Admin\Resources;

use App\Filament\Admin\Resources\ProductResource\Pages;
use App\Models\Product;
use BackedEnum;
use Filament\Forms;
use Filament\Schemas\Schema;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Str;

class ProductResource extends Resource
{
    protected static ?string $model = Product::class;
    protected static string|BackedEnum|null $navigationIcon = 'heroicon-o-cube';

    protected static ?string $modelLabel = 'Produit';
    protected static ?string $pluralModelLabel = 'Produits';
    protected static ?string $navigationLabel = 'Produits';

    public static function form(Schema $schema): Schema
    {
        return $schema->components([
            Forms\Components\Section::make('Informations générales')
                ->components([
                    Forms\Components\TextInput::make('name')
                        ->label('Nom du produit')
                        ->required()
                        ->maxLength(255)
                        ->live(onBlur: true)
                        ->afterStateUpdated(function (string $operation, $state, Forms\Set $set) {
                            if ($operation === 'create') {
                                $set('slug', Str::slug($state));
                            }
                        })
                        ->columnSpan(2),

                    Forms\Components\TextInput::make('slug')
                        ->label('Slug')
                        ->required()
                        ->maxLength(255)
                        ->unique(ignoreRecord: true)
                        ->readOnly()
                        ->dehydrated()
                        ->columnSpan(2),

                    Forms\Components\TextInput::make('sku')
                        ->label('SKU')
                        ->required()
                        ->unique(ignoreRecord: true)
                        ->maxLength(100)
                        ->helperText('Référence unique du produit')
                        ->columnSpan(2),

                    Forms\Components\Select::make('category_id')
                        ->label('Catégorie')
                        ->relationship('category', 'name')
                        ->searchable()
                        ->preload()
                        ->required()
                        ->columnSpan(2),

                    Forms\Components\Select::make('brand_id')
                        ->label('Marque')
                        ->relationship('brand', 'name')
                        ->searchable()
                        ->preload()
                        ->nullable()
                        ->columnSpan(2),

                    Forms\Components\Select::make('condition')
                        ->label('État')
                        ->options([
                            'new' => 'Neuf',
                            'refurbished' => 'Reconditionné',
                            'used' => 'Occasion',
                        ])
                        ->default('new')
                        ->required()
                        ->native(false)
                        ->columnSpan(2),

                    Forms\Components\TextInput::make('warranty_months')
                        ->label('Garantie (mois)')
                        ->numeric()
                        ->default(0)
                        ->minValue(0)
                        ->maxValue(120)
                        ->suffix('mois')
                        ->columnSpan(1),

                    Forms\Components\Toggle::make('is_active')
                        ->label('Actif')
                        ->default(true)
                        ->required()
                        ->columnSpan(1),
                ])
                ->columns(2),

            Forms\Components\Section::make('Prix et Stock')
                ->components([
                    Forms\Components\TextInput::make('price_eur')
                        ->label('Prix (€)')
                        ->required()
                        ->numeric()
                        ->prefix('€')
                        ->step(0.01)
                        ->minValue(0)
                        ->helperText('Le prix sera automatiquement converti en centimes')
                        ->dehydrated(false)
                        ->live(onBlur: true)
                        ->afterStateUpdated(function ($state, Forms\Set $set) {
                            $value = is_numeric($state) ? (float) $state : 0.0;
                            $set('price_cents', (int) round($value * 100));
                        })
                        ->afterStateHydrated(function ($component, $state, ?Product $record) {
                            if ($record && $record->price_cents !== null) {
                                $component->state($record->price_cents / 100);
                            }
                        })
                        ->columnSpan(1),

                    Forms\Components\Hidden::make('price_cents')
                        ->required()
                        ->default(0),

                    Forms\Components\TextInput::make('vat_rate')
                        ->label('TVA (%)')
                        ->numeric()
                        ->default(20.00)
                        ->step(0.01)
                        ->minValue(0)
                        ->maxValue(100)
                        ->suffix('%')
                        ->required()
                        ->columnSpan(1),

                    Forms\Components\TextInput::make('stock_qty')
                        ->label('Quantité en stock')
                        ->numeric()
                        ->default(0)
                        ->minValue(0)
                        ->required()
                        ->columnSpan(1),
                ])
                ->columns(2),

            Forms\Components\Section::make('Descriptions')
                ->components([
                    Forms\Components\Textarea::make('short_description')
                        ->label('Description courte')
                        ->maxLength(500)
                        ->rows(3)
                        ->columnSpanFull(),

                    Forms\Components\RichEditor::make('description')
                        ->label('Description complète')
                        ->toolbarButtons([
                            'bold',
                            'italic',
                            'link',
                            'bulletList',
                            'orderedList',
                            'h2',
                            'h3',
                        ])
                        ->columnSpanFull(),
                ])
                ->columns(1),

            Forms\Components\Section::make('Images')
                ->components([
                    Forms\Components\Repeater::make('images')
                        ->relationship('images')
                        ->components([
                            Forms\Components\TextInput::make('path')
                                ->label("Chemin / URL de l'image")
                                ->required()
                                ->maxLength(255)
                                ->helperText('Ex: assets/img/products/... ou https://...')
                                ->columnSpan(2),

                            Forms\Components\TextInput::make('alt')
                                ->label('Texte alternatif')
                                ->maxLength(255)
                                ->columnSpan(2),

                            Forms\Components\TextInput::make('sort_order')
                                ->label('Ordre')
                                ->numeric()
                                ->default(0)
                                ->minValue(0)
                                ->required(),

                            Forms\Components\Toggle::make('is_main')
                                ->label('Image principale')
                                ->default(false)
                                ->reactive(),
                        ])
                        ->columns(3)
                        ->defaultItems(0)
                        ->addActionLabel('Ajouter une image')
                        ->reorderable()
                        ->orderColumn('sort_order')
                        ->collapsible()
                        ->itemLabel(fn(array $state): ?string => $state['alt'] ?? 'Image')
                        ->columnSpanFull(),
                ])
                ->columns(1),

            Forms\Components\Section::make('Attributs')
                ->components([
                    Forms\Components\Repeater::make('attributes')
                        ->relationship('attributes')
                        ->components([
                            Forms\Components\TextInput::make('attribute_key')
                                ->label('Clé')
                                ->required()
                                ->maxLength(100)
                                ->placeholder('Ex: ram, storage, color...')
                                ->columnSpan(1),

                            Forms\Components\TextInput::make('value')
                                ->label('Valeur')
                                ->required()
                                ->maxLength(255)
                                ->placeholder('Ex: 4GB, 128GB, Black...')
                                ->columnSpan(2),

                            Forms\Components\TextInput::make('sort_order')
                                ->label('Ordre')
                                ->numeric()
                                ->default(0)
                                ->minValue(0)
                                ->required(),
                        ])
                        ->columns(4)
                        ->defaultItems(0)
                        ->addActionLabel('Ajouter un attribut')
                        ->reorderable()
                        ->orderColumn('sort_order')
                        ->collapsible()
                        ->itemLabel(fn(array $state): ?string => $state['attribute_key'] ?? 'Attribut')
                        ->columnSpanFull(),
                ])
                ->columns(1),
        ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('name')->searchable()->sortable()->limit(40),
                Tables\Columns\TextColumn::make('sku')->searchable()->sortable()->copyable(),
                Tables\Columns\TextColumn::make('category.name')->sortable()->searchable(),
                Tables\Columns\TextColumn::make('brand.name')->sortable()->searchable()->placeholder('—'),
                Tables\Columns\TextColumn::make('price_cents')->label('Prix')->money('EUR', divideBy: 100)->sortable(),
                Tables\Columns\TextColumn::make('stock_qty')->sortable()
                    ->badge()
                    ->color(fn(int $state): string => match (true) {
                        $state === 0 => 'danger',
                        $state < 10 => 'warning',
                        default => 'success',
                    }),
                Tables\Columns\IconColumn::make('is_active')->boolean()->sortable(),
                Tables\Columns\TextColumn::make('created_at')->dateTime('d/m/Y H:i')->sortable()->toggleable(isToggledHiddenByDefault: true),
            ])
            ->filters([
                Tables\Filters\SelectFilter::make('category_id')->relationship('category', 'name')->searchable()->preload(),
                Tables\Filters\SelectFilter::make('brand_id')->relationship('brand', 'name')->searchable()->preload(),
                Tables\Filters\TernaryFilter::make('is_active')
                    ->label('Actif')
                    ->trueLabel('Produits actifs')
                    ->falseLabel('Produits inactifs')
                    ->native(false),
            ])
            ->actions([
                Tables\Actions\ViewAction::make(),
                Tables\Actions\EditAction::make(),
                Tables\Actions\DeleteAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                ]),
            ])
            ->defaultSort('created_at', 'desc');
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListProducts::route('/'),
            'create' => Pages\CreateProduct::route('/create'),
            'view' => Pages\ViewProduct::route('/{record}'),
            'edit' => Pages\EditProduct::route('/{record}/edit'),
        ];
    }

    public static function getEloquentQuery(): Builder
    {
        return parent::getEloquentQuery()
            ->with(['category', 'brand', 'images', 'attributes']);
    }
}
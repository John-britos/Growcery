<?php

namespace App\Filament\Resources;

use App\Filament\Resources\ProductResource\Pages;
use App\Filament\Resources\ProductResource\RelationManagers;
use App\Models\Product;
use Filament\Resources\Pages\Page;
use Filament\Forms;
use Filament\Forms\Components\Select;
use Filament\Forms\Form;
use Filament\Forms\Components\Grid;
use Filament\Resources\Resource;
use Filament\Tables\Table;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\SpatieMediaLibraryFileUpload;
use Filament\Tables;
use Filament\Forms\Components\RichEditor;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Filters\SelectFilter;
use Illuminate\Database\Eloquent\Builder;
use Filament\Tables\Columns\SpatieMediaLibraryImageColumn;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use App\Enums\Enums\ProductStatusEnum;
use App\Filament\Resources\ProductResource\Pages\ProductImages;
use App\Filament\Resources\ProductResource\Pages\EditProduct;
use Filament\Pages\SubNavigationPosition;


class ProductResource extends Resource
{
    protected static ?string $model = Product::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';
    protected static SubNavigationPosition $subNavigationPosition = SubNavigationPosition::End;

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Grid::make()
                ->schema([
                TextInput::make('title')
                    ->live(onBlur: true)
                    ->required()
                    ->afterStateUpdated(
                        function(string $operation, $state, callable $set) {
                            if ($operation === 'updated') {
                                $set('slug', \Illuminate\Support\Str::slug($state));
                            }
                        }
                    ),
                    
                TextInput::make('slug')
                    ->required(),
                Select::make('department_id')
                    ->relationship('department', 'name')
                    ->required()
                    ->label('Department')
                    ->preload()
                    ->searchable()
                    ->reactive()
                    ->afterStateUpdated(
                        function(callable $set) {
                                $set('category_id', null);   
                        }),
                Select::make('category_id')
                    ->relationship(
                        name: 'category',
                        titleAttribute: 'name',
                        modifyQueryUsing: function (Builder $query, callable $get){
                            $departmentId = $get('department_id');
                            if ($departmentId) {
                                $query->where('department_id', $departmentId);
                            }
                        })
                    ->required()
                    ->label('Category')
                    ->preload()
                    ->searchable()
                    ->reactive()
                    ])
                    ->columnSpan(2),

                    RichEditor::make('description')
                    ->required()
                    ->toolbarButtons([
                        'blockQuote',
                        'attachFiles',
                        'bold',
                        'bulletList',
                        'h2',
                        'h3',
                        'italic',
                        'link',
                        'orderedList',
                        'redo',
                        'strike',
                        'underline',
                        'undo',
                        'table'
                    ])
                    ->columnSpan(2),
                TextInput::make('price')
                    ->required()
                    ->numeric(),
                TextInput::make('quantity_kg')
                    ->label('Quantity (kg)')
                    ->required()
                    ->numeric()
                    ->step(0.01),
                Select::make('status')
                    ->label('Status')
                    ->options(ProductStatusEnum::label())
                    ->required()
                    ->default(ProductStatusEnum::Draft->value)
                    ->columnSpan(2),
                
                    

            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                SpatieMediaLibraryImageColumn::make('images')
                    ->collection('images')
                    ->label('Image')
                    ->limit(1)
                    ->conversion('thumb'),

                TextColumn::make('title')
                    ->sortable()
                    ->searchable()
                    ->limit(50),
                TextColumn::make('status')
                    ->badge()
                    ->colors(ProductStatusEnum::colors()),
                TextColumn::make('department.name')
                    ->label('Department')
                    ->searchable(),
                TextColumn::make('category.name')
                    ->label('Category')
                    ->searchable(),
                TextColumn::make('price')
                    ->sortable()
                    ->searchable()
                    ->money('PHP', true)
                    ->formatStateUsing(fn ($state) => number_format($state, 2)),

            ])
            ->filters([
                SelectFilter::make('status')
                    ->options(ProductStatusEnum::label())
                    ->default(ProductStatusEnum::Draft->value)
                    ->placeholder('Select Status')
                    ->multiple(),
                SelectFilter::make('department_id')
                    ->relationship('department', 'name')
                    ->placeholder('Select Department'),
                SelectFilter::make('category_id')
                    ->relationship('category', 'name')
                    ->placeholder('Select Category')
                    ->multiple(),
         
                
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
            'images' => Pages\ProductImages::route('/{record}/images'), 
        ];
    }

    public static function getRecordSubNavigation(Page $page): array 
    {
        return $page -> generateNavigationItems([
                EditProduct::class,
                ProductImages::class,        
        ]);
    }
}

<?php

namespace App\Filament\Resources;

use App\Filament\Resources\CatagoriesResource\Pages;
use App\Filament\Resources\CatagoriesResource\RelationManagers\PostsRelationManager;
use App\Models\Catagories;
use Filament\Forms\Form;
use Filament\Forms\Components\TextInput;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Filament\Tables\Columns\TextColumn;



class CatagoriesResource extends Resource
{
    protected static ?string $model = Catagories::class;

    protected static ?string $navigationIcon = 'heroicon-o-document-duplicate';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                TextInput::make('name')->required(),
                TextInput::make('slug')->required(),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('name')
                    ->sortable()
                    ->searchable(),
                TextColumn::make('slug'),
            ])
            ->filters([
                //
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
                Tables\Actions\DeleteAction::make(),
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
            // PostsRelationManager::class,
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListCatagories::route('/'),
            'create' => Pages\CreateCatagories::route('/create'),
            'edit' => Pages\EditCatagories::route('/{record}/edit'),
        ];
    }
}

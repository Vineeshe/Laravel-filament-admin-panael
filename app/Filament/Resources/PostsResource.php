<?php

namespace App\Filament\Resources;

use App\Models\Catagories;


use App\Filament\Resources\PostsResource\Pages;

use App\Models\Posts;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\RichEditor;
use Filament\Forms\Components\TagsInput;
use Filament\Forms\Components\Checkbox;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\FileUpload;
use Filament\Tables\Columns\CheckboxColumn;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Columns\ImageColumn;
use Filament\Infolists\Components\Section;
use Filament\Tables\Filters\Filter;
use Filament\Tables\Filters\SelectFilter;

class PostsResource extends Resource
{
    protected static ?string $model = Posts::class;

    protected static ?string $navigationIcon = 'heroicon-o-document-text';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([


                TextInput::make('title')->rules(['min:3', 'max:50'])->required(),
                TextInput::make('slug')->required(),

                Select::make('catagory_id')
                    ->label('Category')
                    // ->options(Catagories::all()->pluck('name', 'id'))->native(false),
                    ->relationship('catagory', 'name')->native(false),

                FileUpload::make('thumbnail')->disk('public')->directory('thumbnail'),

                RichEditor::make('content')->required()->columnSpanFull(),


                TagsInput::make('tags')->required(),
                Checkbox::make('published')




            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('title')
                    ->sortable()
                    ->searchable(),
                TextColumn::make('slug'),
                TextColumn::make('catagory.name')
                    ->sortable()
                    ->searchable(),

                ImageColumn::make('thumbnail'),
                TextColumn::make('tags'),
                CheckboxColumn::make('published')
            ])
            ->filters([
                Filter::make('Published Posts')->query(
                    function ($query) {
                        return $query->where('published', true);
                    }
                ),
                SelectFilter::make('catagory_id')
                    ->relationship('catagory', 'name')
                    ->native(false)

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
            'index' => Pages\ListPosts::route('/'),
            'create' => Pages\CreatePosts::route('/create'),
            'edit' => Pages\EditPosts::route('/{record}/edit'),
        ];
    }
}

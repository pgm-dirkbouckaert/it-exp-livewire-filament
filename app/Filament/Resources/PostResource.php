<?php

namespace App\Filament\Resources;

use Filament\Forms;
use App\Models\Post;
use Filament\Tables;
use Filament\Forms\Form;
use Filament\Tables\Table;
use Illuminate\Support\Str;
use Filament\Resources\Resource;
use Illuminate\Database\Eloquent\Builder;
use App\Filament\Resources\PostResource\Pages;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use App\Filament\Resources\PostResource\RelationManagers;

class PostResource extends Resource
{
  protected static ?string $model = Post::class;

  protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

  public static function form(Form $form): Form
  {
    return $form
      ->schema([
        // Forms\Components\TextInput::make('user_id')
        //   ->required()
        //   ->numeric(),
        Forms\Components\Select::make('user_id')
          ->relationship('author', 'name')
          ->required()
          ->searchable(),
        Forms\Components\FileUpload::make('image')
          ->image()
          ->directory('images/posts'),
        Forms\Components\TextInput::make('title')
          ->required()
          ->maxLength(255)
          ->live(true)
          ->afterStateUpdated(function (
            string $operation,
            string|null $state,
            Forms\Set $set
          ) {
            if ($operation === 'edit') return;
            $set('slug', Str::slug($state));
          }),
        Forms\Components\TextInput::make('slug')
          ->required()
          ->unique()
          ->maxLength(255),
        Forms\Components\Textarea::make('body')
          ->required()
          ->maxLength(65535)
          ->columnSpanFull(),
        Forms\Components\Toggle::make('featured')
          ->required(),
      ]);
  }

  public static function table(Table $table): Table
  {
    return $table
      ->columns([
        // Tables\Columns\TextColumn::make('user_id')
        //   ->numeric()
        //   ->sortable(),
        Tables\Columns\TextColumn::make('author.name')
          ->sortable()
          ->searchable(),
        Tables\Columns\ImageColumn::make('image'),
        Tables\Columns\TextColumn::make('title')
          ->searchable(),
        // Tables\Columns\TextColumn::make('slug')
        //   ->searchable(),
        // Tables\Columns\IconColumn::make('featured')
        //   ->boolean(),
        Tables\Columns\TextColumn::make('created_at')
          ->dateTime()
          ->sortable()
          ->toggleable(isToggledHiddenByDefault: true),
        Tables\Columns\TextColumn::make('updated_at')
          ->dateTime()
          ->sortable()
          ->toggleable(isToggledHiddenByDefault: true),
      ])
      ->filters([
        //
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
      'create' => Pages\CreatePost::route('/create'),
      'edit' => Pages\EditPost::route('/{record}/edit'),
    ];
  }
}

<?php

namespace App\Filament\Admin\Resources;

use App\Filament\Admin\Resources\CommentResource;
use App\Filament\Admin\Resources\PostResource\Pages;
use App\Filament\Admin\Resources\PostResource\RelationManagers;
use App\Filament\Admin\Resources\PostResource\RelationManagers\CommentRelationManager;
use App\Models\Post;
use Filament\Forms;
use Filament\Forms\Components\Checkbox;
use Filament\Forms\Components\DateTimePicker;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\RichEditor;
use Filament\Forms\Components\Section;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Form;
use Filament\Forms\Components\Tabs;
use Filament\Forms\Components\Tabs\Tab;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Columns\CheckboxColumn;
use Filament\Tables\Columns\Column;
use Filament\Tables\Columns\ImageColumn;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Filters\Filter;
use Filament\Tables\Filters\SelectFilter;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use Illuminate\Support\Str;

class PostResource extends Resource
{
    protected static ?string $model = Post::class;
    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';
    protected static ?string $navigationGroup = 'Blogs';
    protected static ?int $navigationSort = 1;
    public static function form(Form $form): Form
    {
        return $form->schema([

            Tabs::make('Post Content')->tabs([
                Tab::make('Post Content')->icon('heroicon-o-clipboard-document-list')->schema([
                    TextInput::make('title')
                    ->live()
                    ->required()
                    ->maxLength(50)
                    ->afterStateUpdated(function ($operation, $state, Forms\Set $set) {
                        if ($operation === 'edit') {
                            return;
                        }
                        $set('slug', Str::slug($state));
                    }),

                TextInput::make('slug')
                    ->required()
                    ->unique(ignoreRecord: true)
                    ->maxLength(250),

                RichEditor::make('content')
                    ->columnSpanFull()
                    ->required()
                    ->fileAttachmentsDirectory('single-post/images')
                    ->maxLength(500),
                ]),

            ])->columnSpanFull()->persistTabInQueryString(),


            Section::make('Uploading Section')->schema([
                FileUpload::make('image')
                    ->image()
                    ->directory('bolgs/thumbnails'),

                    DateTimePicker::make('published_at')
                    ->native(false),

                Checkbox::make('Featured Post'),

                Select::make('user_id')
                    ->label('Author')
                    ->relationship('user', 'name')
                    ->searchable()
                    ->required(),

                Select::make('Category')
                    ->relationship('categories', 'title')
                    ->preload()
                    ->searchable()
                    ->required()
                    ->multiple(),
            ]),
        ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                ImageColumn::make('image')
                ->sortable()
                ->searchable(),
                TextColumn::make('title')
                    ->sortable()
                    ->searchable(),
                TextColumn::make('slug')
                    ->sortable()
                    ->searchable(),

                    TextColumn::make('user.name')
                    ->sortable()
                    ->searchable(),

                    TextColumn::make('categories.title')
                    ->sortable()
                    ->searchable(),

                    TextColumn::make('published_at')->sortable(),
                    CheckboxColumn::make('featured'),

                  
                    
            ])
            ->filters([
                Filter::make('Featured Post')->query(function($query){
                   return  $query->where('featured' , true);
                }
            ),
         ])
            ->actions([Tables\Actions\EditAction::make()])
            ->bulkActions([Tables\Actions\BulkActionGroup::make([Tables\Actions\DeleteBulkAction::make(), Tables\Actions\ForceDeleteBulkAction::make(), Tables\Actions\RestoreBulkAction::make()])]);
    }

    public static function getRelations(): array
    {
        return [
                CommentRelationManager::class,
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

    public static function getEloquentQuery(): Builder
    {
        return parent::getEloquentQuery()->withoutGlobalScopes([SoftDeletingScope::class]);
    }
}

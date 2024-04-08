<?php

namespace App\Filament\Admin\Resources\CommentResource\Widgets;

use App\Filament\Admin\Resources\CommentResource;
use App\Models\Comment;
use Filament\Pages\Actions\Action;
use Filament\Tables;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;
use Filament\Widgets\TableWidget as BaseWidget;
use Illuminate\Support\Carbon;

class LatestCommentWidget extends BaseWidget
{
    protected int|string|array $columnSpan = 'full';
    public function table(Table $table): Table
    {
        return $table
            ->query(
                Comment::whereDate('created_at','>',Carbon::now()
                        ->subDays(14)
                        ->startOfDay(),
                ),
            )
            ->columns([
                TextColumn::make('comment_content')->sortable(), 
                TextColumn::make('user.name')->sortable(),
                TextColumn::make('post.title')->sortable(),
                TextColumn::make('created_at')->sortable()
            ])
            ->actions([
                \Filament\Tables\Actions\Action::make('View')
                // record is the passed in comment from the table when clicking on view
                // ->url(function(Comment $record){
                //     CommentResource::getUrl('edit', ['record' => $record]);
                // }),

                    // getting the url for the comment when clicking on it
                    ->url(fn ($record) => CommentResource::getUrl('edit' , ['record'=>$record]))
                    ->openUrlInNewTab()
            ]);
    }
}

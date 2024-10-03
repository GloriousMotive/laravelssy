<?php

namespace App\Filament\Dashboard\Resources\PerformerResource\RelationManagers;

use Filament\Forms;
use Filament\Tables;
use Filament\Forms\Form;
use Filament\Tables\Table;
use App\Models\MediaLibraryItem;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use Filament\Resources\RelationManagers\RelationManager;

class MediaLibraryItemRelationManager extends RelationManager
{
    protected static string $relationship = 'mediaLibraryItems';

    public function isReadOnly(): bool
    {
        return false;
    }

    protected static bool $isLazy = false;

    public function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\TextInput::make('id')
                    ->required()
                    ->maxLength(255),
            ]);
    }

    public function table(Table $table): Table
    {
        return $table
            ->recordTitleAttribute('id')
            ->columns([
                Tables\Columns\ImageColumn::make('media_library_item_id')
                    ->label('Image')
                    ->getStateUsing(function ($record) {
                        $mediaLibraryItem = MediaLibraryItem::find($record->media_library_item_id);
                        return $mediaLibraryItem ? $mediaLibraryItem->getItem()->getUrl('thumb') : null;
                    })
                    ->label('Image')
                    ->square()
                    ->size(50),

                Tables\Columns\TextColumn::make('id'),
            ])
            ->filters([
                //
            ])
            ->headerActions([
                Tables\Actions\AttachAction::make()
                    ->multiple(),
            ])
            ->actions([
                //Tables\Actions\ViewAction::make(),
                Tables\Actions\Action::make('view')
                    ->label('View')
                    ->url(fn($record) => route('filament.dashboard.resources.media-library-items.view', $record)),
                Tables\Actions\DetachAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DetachBulkAction::make(),
                ]),
            ]);
    }
}

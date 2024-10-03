<?php

namespace App\Filament\Dashboard\Resources\MediaLibraryItemResource\RelationManagers;

use Filament\Forms;
use Filament\Tables;
use Filament\Forms\Form;
use Filament\Tables\Table;
use App\Models\MediaLibraryItem;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use Filament\Resources\RelationManagers\RelationManager;

class PerformersRelationManager extends RelationManager
{
    protected static string $relationship = 'performers';

    public function isReadOnly(): bool
    {
        return false;
    }

    protected static bool $isLazy = false;

    public function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\TextInput::make('name')
                    ->required()
                    ->maxLength(255),
            ]);
    }

    public function table(Table $table): Table
    {
        return $table
            ->recordTitleAttribute('name')
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

                Tables\Columns\TextColumn::make('name'),
            ])
            ->filters([
                //
            ])
            ->headerActions([
                Tables\Actions\AttachAction::make()
                    ->multiple(),
            ])
            ->actions([
                Tables\Actions\DetachAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DetachBulkAction::make(),
                ]),
            ])
            ->paginated(false);
    }
}

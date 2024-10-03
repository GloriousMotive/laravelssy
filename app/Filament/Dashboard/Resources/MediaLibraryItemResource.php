<?php

namespace App\Filament\Dashboard\Resources;

use Filament\Forms;
use Filament\Tables;
use Filament\Infolists;
use Filament\Forms\Form;
use Filament\Tables\Table;
use App\Models\MediaLibraryItem;
use Filament\Infolists\Infolist;
use Filament\Resources\Resource;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use App\Filament\Dashboard\Resources\MediaLibraryItemResource\Pages;
use App\Filament\Dashboard\Resources\MediaLibraryItemResource\RelationManagers;

class MediaLibraryItemResource extends Resource
{
    protected static ?string $model = MediaLibraryItem::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Section::make('')
                    ->schema([
                        \App\Forms\Components\MediaField::make('id')
                            ->label(''),
                    ]),



                Forms\Components\TextInput::make('id')
                    ->required()
                    ->columnSpan('full'),

                Forms\Components\TextInput::make('uploaded_by_user_id')
                    ->required()
                    ->columnSpan('full'),

                Forms\Components\TextInput::make('caption')
                    ->columnSpan('full'),

                Forms\Components\TextInput::make('alt_text')
                    ->columnSpan('full'),

                Forms\Components\TextInput::make('folder_id')
                    ->columnSpan('full'),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('id'),
                Tables\Columns\TextColumn::make('uploaded_by_user_id'),
                Tables\Columns\TextColumn::make('caption'),
                Tables\Columns\TextColumn::make('alt_text'),
                Tables\Columns\TextColumn::make('folder_id'),
                Tables\Columns\TextColumn::make('contributors.name')
                    ->label('Contributors')
                    ->sortable()
                    ->searchable()
                    ->wrap()
            ])
            ->filters([
                //
            ])
            ->actions([
                Tables\Actions\ViewAction::make(),
                Tables\Actions\EditAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                ]),
            ]);
    }

    public static function infolist(Infolist $infolist): Infolist
    {
        return $infolist
            ->schema([
                Infolists\Components\Section::make()
                    ->schema([
                        \App\Infolists\Components\MediaEntry::make('id')
                            ->label(''),
                    ]),
                Infolists\Components\TextEntry::make('id'),
                Infolists\Components\TextEntry::make('uploaded_by_user_id'),
                Infolists\Components\TextEntry::make('caption'),
                Infolists\Components\TextEntry::make('alt_text'),
                Infolists\Components\TextEntry::make('folder_id')
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
            'index' => Pages\ListMediaLibraryItems::route('/'),
            'create' => Pages\CreateMediaLibraryItem::route('/create'),
            'view' => Pages\ViewMediaLibraryItem::route('/{record}'),
            'edit' => Pages\EditMediaLibraryItem::route('/{record}/edit'),
        ];
    }
}

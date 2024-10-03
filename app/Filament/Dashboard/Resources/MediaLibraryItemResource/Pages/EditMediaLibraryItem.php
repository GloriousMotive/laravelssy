<?php

namespace App\Filament\Dashboard\Resources\MediaLibraryItemResource\Pages;

use App\Filament\Dashboard\Resources\MediaLibraryItemResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditMediaLibraryItem extends EditRecord
{
    protected static string $resource = MediaLibraryItemResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\ViewAction::make(),
            Actions\DeleteAction::make(),
        ];
    }
}

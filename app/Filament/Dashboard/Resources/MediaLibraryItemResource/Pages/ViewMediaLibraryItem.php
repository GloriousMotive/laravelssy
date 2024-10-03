<?php

namespace App\Filament\Dashboard\Resources\MediaLibraryItemResource\Pages;

use App\Filament\Dashboard\Resources\MediaLibraryItemResource;
use Filament\Actions;
use Filament\Resources\Pages\ViewRecord;

class ViewMediaLibraryItem extends ViewRecord
{
    protected static string $resource = MediaLibraryItemResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\EditAction::make(),
        ];
    }
}

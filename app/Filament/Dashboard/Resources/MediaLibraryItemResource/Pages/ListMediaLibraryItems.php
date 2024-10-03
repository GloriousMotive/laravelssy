<?php

namespace App\Filament\Dashboard\Resources\MediaLibraryItemResource\Pages;

use App\Filament\Dashboard\Resources\MediaLibraryItemResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListMediaLibraryItems extends ListRecords
{
    protected static string $resource = MediaLibraryItemResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}

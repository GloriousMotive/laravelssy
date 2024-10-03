<?php

namespace App\Filament\Dashboard\Resources\PerformerResource\Pages;

use App\Filament\Dashboard\Resources\PerformerResource;
use Filament\Actions;
use Filament\Resources\Pages\ViewRecord;

class ViewPerformer extends ViewRecord
{
    protected static string $resource = PerformerResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\EditAction::make(),
        ];
    }
}

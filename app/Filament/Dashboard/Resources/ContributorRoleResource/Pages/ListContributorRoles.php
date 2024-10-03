<?php

namespace App\Filament\Dashboard\Resources\ContributorRoleResource\Pages;

use App\Filament\Dashboard\Resources\ContributorRoleResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListContributorRoles extends ListRecords
{
    protected static string $resource = ContributorRoleResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}

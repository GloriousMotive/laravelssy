<?php

namespace App\Filament\Dashboard\Resources\PerformerResource\Pages;

use Filament\Actions;
use App\Models\ContributorMeta;
use Illuminate\Support\Facades\Log;
use Filament\Resources\Pages\CreateRecord;
use App\Filament\Dashboard\Resources\PerformerResource;

class CreatePerformer extends CreateRecord
{
    protected static string $resource = PerformerResource::class;

    protected function afterCreate(): void
    {
        $formState = $this->form->getState();

        // Log the form state to ensure it is being processed
        Log::info($formState);

        // Iterate through the form state and extract meta fields
        foreach ($formState as $key => $value) {
            // Check if the key starts with 'meta['
            if (preg_match('/^meta\[(\d+)\]$/', $key, $matches)) {
                $metaFieldId = $matches[1]; // Extract the meta field ID from the key

                // Create a new ContributorMeta entry for each meta field
                ContributorMeta::create([
                    'contributor_id' => $this->record->id,
                    'contributor_meta_field_id' => $metaFieldId, // Use the extracted meta field ID
                    'value' => $value, // The value from the form
                ]);
            }
        }
    }
}

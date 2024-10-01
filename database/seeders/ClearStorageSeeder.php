<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Storage;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class ClearStorageSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $this->clear('public');
        $this->clear('livewire-tmp');
        $this->clear('invoices');
    }

    private function clear($directory): void
    {
        if (Storage::exists($directory)) {
            // Hole alle Dateien in dem Verzeichnis
            $files = Storage::allFiles($directory);

            // Lösche jede Datei
            foreach ($files as $file) {
                if (basename($file) !== '.gitignore') {
                    Storage::delete($file);
                }
            }

            // Optional: Auch alle leeren Verzeichnisse löschen
            $directories = Storage::allDirectories($directory);
            foreach ($directories as $dir) {
                Storage::deleteDirectory($dir);
            }

            $this->command->info('Alle Dateien und Verzeichnisse im public storage wurden gelöscht.');
        }
    }
}

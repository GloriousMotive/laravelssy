<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('contributor_filament_media_library', function (Blueprint $table) {
            $table->id();

            $table->foreignId('media_library_item_id')->constrained('filament_media_library')->cascadeOnDelete();
            $table->foreignId('contributor_id')->constrained()->cascadeOnDelete();

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('contributor_filament_media_library');
    }
};

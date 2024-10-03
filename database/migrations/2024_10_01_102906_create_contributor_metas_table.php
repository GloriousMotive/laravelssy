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
        Schema::create('contributor_metas', function (Blueprint $table) {
            $table->id();

            $table->foreignId('contributor_id')->constrained('contributors')->cascadeOnDelete(); // Foreign key to contributors
            $table->foreignId('contributor_meta_field_id')->constrained('contributor_meta_fields')->cascadeOnDelete(); // Foreign key to meta fields
            $table->text('value')->nullable(); // Value for the meta field, allowing flexible types of data (text, number, etc.)

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('contributor_metas');
    }
};

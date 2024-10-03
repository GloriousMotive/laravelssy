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
        Schema::create('contributor_meta_fields', function (Blueprint $table) {
            $table->id();

            $table->foreignId('contributor_role_id')->constrained('contributor_roles')->cascadeOnDelete();
            $table->string('name'); // Name of the meta field (e.g., Spezialisierung)
            $table->string('type'); // Type of the meta field (e.g., text, number, date)
            $table->json('options')->nullable(); // Optional JSON options for select dropdowns or other field types
            $table->integer('sort_order')->default(0); // Field for sorting order (renamed from order_id)
            $table->string('description')->nullable(); // Optional description for meta fields (could be useful for frontend or admin explanation)

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('contributor_meta_fields');
    }
};

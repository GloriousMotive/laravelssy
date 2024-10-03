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
        Schema::create('contributors', function (Blueprint $table) {
            $table->id();

            $table->foreignId('created_by_user_id');
            $table->integer('media_library_item_id')->nullable();
            $table->string('name');
            $table->foreignId('role_id')->constrained('contributor_roles')->cascadeOnDelete(); // Foreign key to contributor role

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('contributors');
    }
};

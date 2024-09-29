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
        Schema::table('filament_media_library_folders', function (Blueprint $table) {
            $table->foreignId('created_by_user_id')->after('parent_id');
        });
    }
};

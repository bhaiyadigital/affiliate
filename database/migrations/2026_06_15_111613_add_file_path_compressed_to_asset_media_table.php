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
        if (!Schema::hasColumn('asset_media', 'file_path_compressed')) {
            Schema::table('asset_media', function (Blueprint $table) {
                $table->string('file_path_compressed')->nullable();
            });
        }
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('asset_media', function (Blueprint $table) {
            //
        });
    }
};

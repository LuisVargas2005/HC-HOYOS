<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
public function up()
{
    Schema::table('products', function (Blueprint $table) {
        // Verificar y eliminar cada columna solo si existe
        if (Schema::hasColumn('products', 'is_downloadable')) {
            $table->dropColumn('is_downloadable');
        }
        if (Schema::hasColumn('products', 'downloadable_file')) {
            $table->dropColumn('downloadable_file');
        }
        if (Schema::hasColumn('products', 'download_limit')) {
            $table->dropColumn('download_limit');
        }
        if (Schema::hasColumn('products', 'expiration_time')) {
            $table->dropColumn('expiration_time');
        }
    });
}

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('products', function (Blueprint $table) {
            //
        });
    }
};

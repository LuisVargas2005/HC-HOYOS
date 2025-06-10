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
        if (!Schema::hasColumn('products', 'inventory_count')) {
            Schema::table('products', function (Blueprint $table) {
                $table->integer('inventory_count')->default(0)->after('price');
            });
        }
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        if (Schema::hasColumn('products', 'inventory_count')) {
            Schema::table('products', function (Blueprint $table) {
                $table->dropColumn('inventory_count');
            });
        }
    }
};

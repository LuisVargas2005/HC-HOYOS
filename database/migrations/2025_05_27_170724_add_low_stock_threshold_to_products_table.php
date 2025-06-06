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
        $table->integer('low_stock_threshold')->default(5)->after('inventory_count');
    });
}

public function down()
{
    Schema::table('products', function (Blueprint $table) {
        $table->dropColumn('low_stock_threshold');
    });
}
};
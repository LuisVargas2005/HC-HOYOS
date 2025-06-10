<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('products', function (Blueprint $table) {
            if (!Schema::hasColumn('products', 'sku')) {
                $table->string('sku')->after('name');
            }

            if (!Schema::hasColumn('products', 'inventory_count')) {
                $table->integer('inventory_count')->default(0)->after('price');
            }

            if (!Schema::hasColumn('products', 'low_stock_threshold')) {
                $table->integer('low_stock_threshold')->default(5)->after('inventory_count');
            }

            if (!Schema::hasColumn('products', 'pricing_type')) {
                $table->string('pricing_type')->nullable()->after('featured_image');
            }

            if (!Schema::hasColumn('products', 'suggested_price')) {
                $table->decimal('suggested_price', 10, 2)->nullable()->after('pricing_type');
            }

            if (!Schema::hasColumn('products', 'minimum_price')) {
                $table->decimal('minimum_price', 10, 2)->nullable()->after('suggested_price');
            }

            if (!Schema::hasColumn('products', 'team_id')) {
                $table->unsignedBigInteger('team_id')->nullable()->after('minimum_price');
            }

            if (!Schema::hasColumn('products', 'description')) {
                $table->text('description')->nullable()->after('team_id');
            }
        });
    }

    public function down(): void
    {
        Schema::table('products', function (Blueprint $table) {
            if (Schema::hasColumn('products', 'sku')) {
                $table->dropColumn('sku');
            }

            if (Schema::hasColumn('products', 'inventory_count')) {
                $table->dropColumn('inventory_count');
            }

            if (Schema::hasColumn('products', 'low_stock_threshold')) {
                $table->dropColumn('low_stock_threshold');
            }

            if (Schema::hasColumn('products', 'pricing_type')) {
                $table->dropColumn('pricing_type');
            }

            if (Schema::hasColumn('products', 'suggested_price')) {
                $table->dropColumn('suggested_price');
            }

            if (Schema::hasColumn('products', 'minimum_price')) {
                $table->dropColumn('minimum_price');
            }

            if (Schema::hasColumn('products', 'team_id')) {
                $table->dropColumn('team_id');
            }

            if (Schema::hasColumn('products', 'description')) {
                $table->dropColumn('description');
            }
        });
    }
};

<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up()
    {
        Schema::table('orders', function (Blueprint $table) {
        if (!Schema::hasColumn('orders', 'shipping_address')) {
            $table->text('shipping_address')->nullable();
        }

        if (!Schema::hasColumn('orders', 'shipping_method_id')) {
            $table->unsignedBigInteger('shipping_method_id')->nullable();
        }

        if (!Schema::hasColumn('orders', 'payment_method')) {
            $table->string('payment_method')->nullable();
        }

        if (!Schema::hasColumn('orders', 'total_amount')) {
            $table->decimal('total_amount', 10, 2)->default(0);
        }

        if (!Schema::hasColumn('orders', 'status')) {
            $table->string('status')->default('pending');
        }

        if (!Schema::hasColumn('orders', 'is_dropshipping')) {
            $table->boolean('is_dropshipping')->default(false);
        }

        if (!Schema::hasColumn('orders', 'recipient_name')) {
            $table->string('recipient_name')->nullable();
        }

        if (!Schema::hasColumn('orders', 'recipient_email')) {
            $table->string('recipient_email')->nullable();
        }

        if (!Schema::hasColumn('orders', 'gift_message')) {
            $table->text('gift_message')->nullable();
        }
    });

    }

    public function down()
    {
        Schema::table('orders', function (Blueprint $table) {
            $table->dropColumn([
                'customer_email',
                'shipping_address',
                'shipping_method_id',
                'payment_method',
                'total_amount',
                'status',
                'is_dropshipping',
                'recipient_name',
                'recipient_email',
                'gift_message',
            ]);
        });
    }
};

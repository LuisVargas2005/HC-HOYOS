<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    private string $table = 'orders';

    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create($this->table, function (Blueprint $table) {
            $table->id();
            // Cambia 'users' si la tabla de clientes tiene otro nombre
            $table->foreignId('customer_id')->constrained('users')->onUpdate('cascade')->onDelete('cascade');
            $table->date('order_date');
            $table->decimal('total_amount', 10, 2);
            $table->string('payment_status');
            $table->string('shipping_status');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists($this->table);
    }
};
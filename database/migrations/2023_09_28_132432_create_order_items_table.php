<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    private string $table = 'order_items';

    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create($this->table, function (Blueprint $table) {
            $table->id();
            $table->foreignId('order_id')
                ->constrained() // Asume tabla orders
                ->onUpdate('cascade')
                ->onDelete('cascade');
            $table->morphs('orderable');
            $table->integer('quantity');
            $table->decimal('price', 10, 2); // Corregido aquí
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
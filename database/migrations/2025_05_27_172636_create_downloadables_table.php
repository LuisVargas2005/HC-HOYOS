<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('downloadables', function (Blueprint $table) {
            $table->id();
            $table->foreignId('product_id')->constrained()->cascadeOnDelete();
            $table->string('file_path'); // Ruta del archivo (ej: 'downloadables/file.zip')
            $table->integer('download_limit')->nullable(); // Límite de descargas (ej: 3)
            $table->integer('expiration_days')->nullable(); // Días hasta expirar (ej: 30)
            $table->string('file_name'); // Nombre original (ej: 'manual.pdf')
            $table->string('file_size'); // Tamaño legible (ej: '2.5 MB')
            $table->timestamps();
            
            // Índice opcional para mejor rendimiento
            $table->index('product_id');
        });
    }

    public function down()
    {
        Schema::dropIfExists('downloadables');
    }
};
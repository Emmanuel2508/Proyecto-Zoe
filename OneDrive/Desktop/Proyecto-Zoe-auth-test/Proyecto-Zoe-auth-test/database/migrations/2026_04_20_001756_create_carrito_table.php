<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.jijija
     */
    public function up(): void
    {
        Schema::create('carrito', function (Blueprint $table) {
            $table->id("id_carrito");
            $table->foreignId('id_cliente')->constrained('clientes', 'id_cliente')->onDelete('cascade');
            $table->decimal('subtotal', 10, 2);
            $table->timestamp('fecha_Compra');
            $table->string('status')->default('pendiente');               
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('carrito');
    }
};

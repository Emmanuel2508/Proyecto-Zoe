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
            $table->id("ID_Carrito");
            $table->foreignId('ID_Cliente')->constrained('clientes', 'ID_Cliente')->onDelete('cascade');
            $table->decimal('Subtotal', 10, 2);
            $table->timestamp('Fecha_Compra');
            $table->string('Status')->default('Pendiente');               
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

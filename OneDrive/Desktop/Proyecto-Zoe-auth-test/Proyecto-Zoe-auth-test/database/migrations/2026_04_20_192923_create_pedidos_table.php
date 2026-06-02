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
        Schema::create('pedidos', function (Blueprint $table) {
            $table->id("id_pedido");
            $table->foreignId("id_carrito")->constrained("carrito", "id_carrito")->cascadeOnUpdate()->cascadeOnDelete();
            $table->date("fecha_compra");
            $table->decimal("total", 10, 2);
            $table->string("status")->default("pendiente");
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('pedidos');
    }
};

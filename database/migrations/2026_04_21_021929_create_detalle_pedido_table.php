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
        Schema::create('detalle_pedido', function (Blueprint $table) {
            $table->id("ID_Detalle_Pedido");
            $table->foreignId("ID_Pedido")->constrained("pedidos")->cascadeOnUpdate()->cascadeOnDelete();
            $table->foreignId("ID_Productos")->constrained("productos")->cascadeOnDelete()->cascadeOnUpdate();
            $table->integer("Cantidad");
            $table->decimal("Subtotal", 10, 2);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('detalle_pedido');
    }
};

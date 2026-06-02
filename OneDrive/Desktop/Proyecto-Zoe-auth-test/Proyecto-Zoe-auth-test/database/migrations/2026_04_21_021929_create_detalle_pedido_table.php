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
            $table->id("id_detalle_Pedido"); //mayúsculas
            $table->foreignId("id_pedido")->constrained("pedidos", "id_pedido")->cascadeOnUpdate()->cascadeOnDelete();
            $table->foreignId("id_productos")->constrained("productos", "id_productos")->cascadeOnDelete()->cascadeOnUpdate();
            $table->integer("cantidad");
            $table->decimal("subtotal", 10, 2);
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

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
        Schema::create('detalle_carrito', function (Blueprint $table) {
            $table->id("id_detalle");
            $table->foreignId("id_carrito")->constrained("carrito", "id_carrito")->onDelete("cascade");
            $table->foreignId("ID_Productos")->constrained("productos", "id_productos")->onDelete("cascade");
            $table->integer("cantidad");
            $table->decimal("subototal", 10, 2);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('detalle_carrito');
    }
};

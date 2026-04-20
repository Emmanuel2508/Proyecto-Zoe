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
            $table->id("ID_Detalle");
            $table->foreignId("ID_Carrito")->constrained("carrito", "ID_Carrito")->onDelete("cascade");
            $table->foreignId("ID_Productos")->constrained("productos", "ID_Productos")->onDelete("cascade");
            $table->integer("Cantidad");
            $table->decimal("Subototal", 10, 2);
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

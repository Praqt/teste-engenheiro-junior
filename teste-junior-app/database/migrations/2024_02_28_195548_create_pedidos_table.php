<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     */

    public function up(): void
    {
        Schema::create('pedidos', function (Blueprint $table) {
            $table->uuid('uuid')->unique();
            $table->uuid('cliente_uuid');
            $table->foreign('cliente_uuid')->references('uuid')->on('clientes');
            $table->string('status');
            $table->json('produtos');
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

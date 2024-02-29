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
        Schema::create('orders', function (Blueprint $table) {
            $table->uuid('uuid')->unique();
            $table->uuid('client_uuid');
            $table->foreign('client_uuid')->references('uuid')->on('clients');
            $table->string('status');
            $table->json('products');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('orders');
    }
};

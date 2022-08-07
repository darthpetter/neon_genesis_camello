<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tbc_pagos', function (Blueprint $table) {
            $table->id();
            $table->foreignId('id_cliente')->constrained('users')->onDelete('cascade');
            $table->foreignId('id_usuario_creador')->constrained('users')->onDelete('cascade');
            $table->enum('status', ['A','E']);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('tbc_pagos');
    }
};

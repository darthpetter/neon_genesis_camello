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
        Schema::create('tbd_detpagos', function (Blueprint $table) {
            $table->id();
            $table->foreignId('id_pago')->constrained('tbc_pagos')->onDelete('cascade');
            $table->foreignId('id_forma_pago')->constrained('tbr_formas_pago')->onDelete('cascade');
            $table->foreignId('id_cuenta')->constrained('tbr_cuentas')->onDelete('cascade');
            $table->foreignId('id_usuario')->constrained('users')->onDelete('cascade');
            $table->string('numero_deposito');
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
        Schema::dropIfExists('tbd_detpagos');
    }
};

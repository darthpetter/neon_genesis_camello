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
        Schema::create('tbm_calificaciones_usu', function (Blueprint $table) {
            $table->id();
            $table->foreignId('usu_calificador_id')->constrained('users');
            $table->foreignId('usu_calificado_id')->constrained('users');
            $table->string('titulo')->nullable();
            $table->string('contenido')->nullable();
            $table->double('score',2,2);
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
        Schema::dropIfExists('tbm_calificaciones_usu');
    }
};

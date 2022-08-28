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
        Schema::create('postulaciones', function (Blueprint $table) {
            $table->id();
            $table->string('titulo')->nullable();
            $table->longText('descripcion')->nullable();
            $table->foreignId('id_area_labor')->constrained('areas_labor')->onDelete('cascade');
            $table->foreignId('id_postulante_seleccionado')->nullable()->constrained('users')->onDelete('cascade');
            $table->enum('estado',['A','E','C']);
            $table->foreignId('id_usuario_creador')->constrained('users')->onDelete('cascade');
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
        Schema::dropIfExists('postulaciones');
    }
};

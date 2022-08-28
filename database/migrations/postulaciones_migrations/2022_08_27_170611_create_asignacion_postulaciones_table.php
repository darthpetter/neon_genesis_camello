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
        Schema::create('asignacion_postulaciones', function (Blueprint $table) {
            $table->id();
            $table->foreignId('id_postulacion')->constrained('postulaciones')->onDelete('cascade');
            $table->decimal('monto_propuesto',16,2);
            $table->text('comentario')->nullable();
            $table->foreignId('id_usuario_creador')->constrained('users')->onDelete('cascade');
            $table->enum('estado',['A','E']);
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
        Schema::dropIfExists('asignacion_postulaciones');
    }
};

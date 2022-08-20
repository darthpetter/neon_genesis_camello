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
        Schema::create('perfiles', function (Blueprint $table) {
            $table->id();
            $table->foreignId('id_usuario')->constrained('users')->unique();
            $table->foreignId('id_redes_sociales')->nullable()->constrained('redes_sociales_perfil')->unique();
            $table->foreignId('id_sexo')->nullable()->constrained('sexos');

            $table->string('nombres')->nullable();
            $table->string('apellidos')->nullable();
            $table->text('bio')->nullable();
            $table->date('fecha_nacimiento')->nullable();
            $table->string('escolaridad')->nullable();
            
            $table->tinyText('direccion_domicilio')->nullable();
            $table->tinyText('direccion_trabajo')->nullable();
            $table->string('telefono1')->nullable();
            $table->string('telefono2')->nullable();
            $table->string('celular1')->nullable();
            $table->string('celular2')->nullable();
            
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
        Schema::dropIfExists('perfiles');
    }
};

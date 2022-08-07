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
        Schema::create('tbd_publicaciones_recurso', function (Blueprint $table) {
            $table->id();
            $table->foreignId('id_publicacion')->constrained('tbm_publicaciones')->onDelete('cascade');
            $table->string('srcElement');
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
        Schema::dropIfExists('tbd_publicaciones_recurso');
    }
};

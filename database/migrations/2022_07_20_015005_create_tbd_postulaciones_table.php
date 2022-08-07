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
        Schema::create('tbd_postulaciones', function (Blueprint $table) {
            $table->id();
            $table->foreignId('id_postulacion')->constrained('tbm_postulaciones')->onDelete('cascade');
            $table->foreignId('id_profesionista')->constrained('users')->onDelete('cascade');
            $table->enum('status',['A','E']);
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
        Schema::dropIfExists('tbd_postulaciones');
    }
};

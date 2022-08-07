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
        Schema::create('tbr_tipos_identificacion', function (Blueprint $table) {
            $table->id();
            $table->string("descripcion");
            $table->integer("max_caracteres");
            $table->boolean("alfanumerico");
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
        Schema::dropIfExists('tbr_tipos_identificacion');
    }
};

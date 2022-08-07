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
        Schema::table('tbm_perfiles', function (Blueprint $table) {
            $table->after('id_usuario',function($table){
                $table->foreignId('id_tipo_identificacion')->nullable()->constrained('tbr_tipos_identificacion');
                $table->string('identificacion')->nullable()->unique();
            });
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('tbm_perfiles');
    }
};

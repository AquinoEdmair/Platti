<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCajasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tbl_cajas', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('estatuscajas_id');
            $table->integer('usuario_id');
            $table->timestamp('fecha_inicio');
            $table->timestamp('fecha_fin');
            $table->decimal('caja_inicial', 8, 3);    
            $table->decimal('caje_final', 8, 3);
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
        Schema::table('tbl_cajas', function (Blueprint $table) {
            //
        });
    }
}

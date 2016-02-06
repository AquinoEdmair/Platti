<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateMesasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tbl_mesas', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('estatusmesas_id');
            $table->string('nombre');
            $table->string('uuid');
            $table->tinyInteger('asignacion');
            $table->tinyInteger('activo');
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
        Schema::table('tbl_mesas', function (Blueprint $table) {
            //
        });
    }
}

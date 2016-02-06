<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePedidosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tbl_pedidos', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('mesas_id');
            $table->integer('cajas_id');
            $table->integer('tipopagos_id');
            $table->integer('estatuspedidos_id');
            $table->string('folio');
            $table->tinyInteger('notificacion');
            $table->decimal('total', 8, 3);       
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
        Schema::table('tbl_pedidos', function (Blueprint $table) {
            //
        });
    }
}

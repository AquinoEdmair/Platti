<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateDetallespedidosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tbl_detallespedidos', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('pedidos_id');
            $table->integer('productos_id');
            $table->string('observaciones');
            $table->decimal('precio', 8, 3); 
            $table->tinyInteger('cantidad');
            $table->decimal('subtotal', 8, 3); 
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
        Schema::table('tbl_detallespedidos', function (Blueprint $table) {
            //
        });
    }
}

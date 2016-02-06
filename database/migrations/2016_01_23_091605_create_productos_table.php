<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateProductosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tbl_productos', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('categorias_id');
            $table->string('nombre');
            $table->text('detalles');
            $table->string('imagen_principal');
            $table->decimal('precio', 8, 3);    
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
        Schema::table('tbl_productos', function (Blueprint $table) {
            //
        });
    }
}

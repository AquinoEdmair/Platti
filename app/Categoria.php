<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Categoria extends Model
{
    protected $table = 'tbl_categorias';

    public function productos(){
        return $this->hasMany('App\Producto','categorias_id','id')->where('activo',1);
    }
}

<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class DetallePedido extends Model
{
    protected $table = 'tbl_detallespedidos';

    public function producto(){
        return $this->hasOne('App\Producto','id','productos_id');
    }

    public function pedidostodos(){
        return $this->hasOne('App\Pedido','id','pedidos_id');
    }
}

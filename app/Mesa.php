<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\EstatusMesa;

class Mesa extends Model
{
    protected $table = 'tbl_mesas';

    public function estatusmesas(){
        return $this->hasOne('App\EstatusMesa','id','estatusmesas_id');
    }

    public function pedido(){
        return $this->hasOne('App\Pedido','mesas_id','id')->where(function ($query) {$query->where('estatuspedidos_id',1)->orWhere('estatuspedidos_id',2);})->with('detallespedidos');
    }

    public function pedidos(){
        return $this->hasOne('App\Pedido','mesas_id','id')->where(function ($query) {$query->where('estatuspedidos_id',1)->orWhere('estatuspedidos_id',2);})->with('detallespedidostodos');
    }
}

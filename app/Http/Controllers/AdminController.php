<?php

namespace App\Http\Controllers;

use Illuminate\Routing\Controller as BaseController;
use App\Mesa;
use App\Categoria;
use App\Pedido;
use App\DetallePedido;
use Illuminate\Http\Request;

class AdminController extends BaseController
{
   public function verMesas()
   {
        return view('servicios.servicios');
   }
   public function vermesashtml()
   {
      $servicios = Mesa::where('activo',1)->orderBy('nombre')->with('estatusmesas')->with('pedido')->get();
      $html = "";
        foreach ($servicios as $servicio) {
        $html .='<div class="col-md-3 col-sm-3 col-xs-12" id ="'.$servicio->id.'">';     
                    $html .='<td style="padding-right:5px;">';
                        if($servicio->asignacion==0)
                           $html .='<div class="swatch swatchNoAsignada">';
                        else if($servicio->asignacion==1)
                            if($servicio->estatusmesas_id==1)
                               $html .='<div class="swatch swatchDisponible">';
                            else if($servicio->estatusmesas_id==2) 
                               $html .='<div class="swatch swatchOcupada">';   
                            $html .='<br>';
                                $html .=$servicio->nombre;
                                $html .='<br>';
                                if($servicio->pedido)
                                $html .='$ '.$servicio->pedido->total;
                                else
                                $html .='$ 0.000';
                                $html .='<br>';
                                $html .='<br>';
                                $html .='<a href="nuevosPedidosmesalaravel/'.$servicio->id.'" data-toggle="modal" class="verNotificaciones" style="cursor:pointer"><span class="badge">';if($servicio->pedido) $html .=$servicio->pedido->detallespedidos->count(); $html .='</span><i class="fa fa-book"></i></a>';                                                                                                                
                                $html .='<a href="pedidosMesalaravel/'.$servicio->id. '" data-toggle="modal" class="verPedidos" style="cursor:pointer"><i class="fa fa-credit-card"></i></a>';
                    $html .='</div>';
                $html .='</td>';
            $html .='</div>';
        }
        return \Response::json(['error' => 'false', 'msg' => $html , 'status' => '200'], 200);
   }
    public function obtieneMesas()
    {
    	$mesas = Mesa::where('activo',1)->orderBy('nombre')->with('estatusmesas')->get();
    	return \Response::json(['error' => 'false', 'msg' => $mesas, 'status' => '200'], 200);
    }

    public function actualizaMesa(Request $request)
    {
    	$mesa = Mesa::find($request->idMesa);
    	$mesa->asignacion = 1;
    	$mesa->uuid = $request->uuid;
    	$mesa->save();

    	return \Response::json(['error' => 'false', 'msg' => $mesa, 'status' => '200'], 200);
    }

    public function obtieneCategorias()
    {
    	$categorias = Categoria::where('activo',1)->with('productos')->get();
    	return \Response::json(['error' => 'false', 'msg' => $categorias, 'status' => '200'], 200);
    }

    public function nuevosPedidosmesalaravel($id)
    {
        $mesa = Mesa::where('id',$id)->where('estatusmesas_id',2)->where('activo',1)->with('estatusmesas')->with('pedido')->first();
        $html = "";
        $html2 = "";
        $ids_detallePedido = "";
        if($mesa->pedido){
            if($mesa->pedido->detallespedidos){
                foreach ($mesa->pedido->detallespedidos as $detalle) {
                    $ids_detallePedido .=  $detalle->id.',';
                    $html .='<div class="media">'
                                .'<div class="media-left">'
                                    .'<a href="#">'
                                        .'<img class="media-object" src="'.$detalle->producto->imagen_principal.'" class="thumb" height="75" width="75" alt="a picture">'
                                    .'</a>'
                                .'</div>'
                                .'<div class="media-body">'
                                    .'<ul class="list-group">'
                                        .'<li class="list-group-item">'
                                            .'<font color="black"><strong><td>Nombre:</td></strong></font>'
                                            .'<td> '.$detalle->producto->nombre.' </td>'
                                        .'</li>'
                                        .'<li class="list-group-item">'
                                            .'<font color="black"><strong><td>Descripción:</td></strong></font>'
                                            .'<td> '.$detalle->producto->detalles.' </td>'
                                        .'</li>'
                                        .'<li class="list-group-item">'
                                            .'<font color="black"><strong><td> Cantidad: </td></strong></font>'
                                            .'<font color="red"><td>'.$detalle->cantidad.' &nbsp; &nbsp; &nbsp;</td></font>'
                                            .'<font color="black"><strong><td> Precio: </td></strong></font>'
                                            .'<font color="red"><td>$'.$detalle->precio.' &nbsp; &nbsp; &nbsp;</td></font>'
                                            .'<font color="black"><strong><td> Subtotal: </td></strong></font>'
                                            .'<font color="red"><td>$'.$detalle->subtotal.' </td></font>'
                                        .'</li>'
                                        .'<li class="list-group-item">'
                                            .'<font color="black"><strong><td> Observaciones: </td></strong></font>'
                                            .'<td> '.$detalle->observaciones.' </td>'
                                        .'</li>' 
                                    .'</ul>'
                                .'</div>'
                            .'</div>';
                }
                
            }
            if(strlen($ids_detallePedido) > 0)
            {
                $html2 .='<form action="downNotificationsByMesa" method="post">'       
                    .'<input type="hidden" name="id_mesa" value="'.$id.'">'
                    .'<input type="hidden" name="id_detallePedido" value="'.$ids_detallePedido.'">'
                    .'<button type="button" class="btn btn-default" data-dismiss="modal">Cancelar</button>'
                    .'<button type="submit" class="btn btn-primary arriba">Aceptar</button>'
                .'</form>';
            }
        }
        return \Response::json(['error' => 'false', 'msg' => $html, 'msg2' => $html2 , 'status' => '200'], 200);
    }

    public function pedidosMesalaravel($id)
    {
        $mesa = Mesa::where('id',$id)->where('estatusmesas_id',2)->where('activo',1)->with('estatusmesas')->with('pedidos')->first();
        $html = "";
        $html2 = "";
        if($mesa->pedido){
            if($mesa->pedido->detallespedidostodos){

                foreach ($mesa->pedido->detallespedidostodos as $detalle) {
                    $html .='<div class="ventanaModal">'
                    .'<div class="media">'
                                .'<div class="media-left">'
                                    .'<a href="#">'
                                        .'<img class="media-object" src="'.$detalle->producto->imagen_principal.'" class="thumb" height="75" width="75" alt="a picture">'
                                    .'</a>'
                                .'</div>'
                                .'<div class="media-body">'
                                    .'<ul class="list-group">'
                                        .'<li class="list-group-item">'
                                            .'<font color="black"><strong><td>Nombre:</td></strong></font>'
                                            .'<td> '.$detalle->producto->nombre.' </td>'
                                        .'</li>'
                                        .'<li class="list-group-item">'
                                            .'<font color="black"><strong><td>Descripción:</td></strong></font>'
                                            .'<td> '.$detalle->producto->detalles.' </td>'
                                        .'</li>'
                                        .'<li class="list-group-item">'
                                            .'<font color="black"><strong><td>Cantidad:</td></strong></font>'
                                            .'<font color="red"><td>'.$detalle->cantidad.' &nbsp; &nbsp; &nbsp;</td></font>'
                                            .'<font color="black"><strong><td>Precio:</td></strong></font>'
                                            .'<font color="red"><td>$'.$detalle->precio.' &nbsp; &nbsp; &nbsp;</td></font>'
                                            .'<font color="black"><strong><td>Subtotal:</td></strong></font>'
                                            .'<font color="red"><td>$'.$detalle->subtotal.' </td></font>'
                                        .'</li>'
                                        .'<li class="list-group-item">'
                                            .'<font color="black"><strong><td>Observaciones:</td></strong></font>'
                                            .'<td> '.$detalle->observaciones.' </td>'
                                        .'</li>' 
                                    .'</ul>'
                                .'</div>'
                            .'</div>'
                            .'</div>';
                }
                
            }
            if($mesa->pedido){
            $html2 .='<form action="toPayByMesa" method="post">'       
                .'<input type="hidden" name="id_mesa" value="'.$id.'">'
                .'<input type="hidden" name="id_pedido" value="'.$mesa->pedido->id.'">'
                .'<button type="button" class="btn btn-default" data-dismiss="modal">Cancelar</button>'
                .'<button type="submit" class="btn btn-primary arriba">Pagar</button>'
            .'</form>';
            }
        }
        return \Response::json(['error' => 'false', 'msg' => $html, 'msg2' => $html2 , 'status' => '200'], 200);
    }

    public function downNotificationsByMesa(Request $request)
    {
        $id_mesa = $request->id_mesa;
        if(strlen($request->id_detallePedido) > 0)
        {
            $ids_detallePedido = $myString = trim($request->id_detallePedido, ',');
            $myArray = explode(',', $ids_detallePedido);
            foreach($myArray as $id_detallePedido){
                $detallespedidos = DetallePedido::find($id_detallePedido);
                $detallespedidos->estatusdetallespedidos_id = 2;
                $detallespedidos->save();
            }
        }       
        return redirect()->back();
    }

    public function toPayByMesa(Request $request)
    {
        $id_mesa = $request->id_mesa;
        $id_pedido = $request->id_pedido;

        $mesa = Mesa::find($id_mesa);
        $mesa->estatusmesas_id = 1;
        $mesa->save();

        $pedido = Pedido::find($id_pedido);
        $pedido->estatuspedidos_id = 3;
        $pedido->save();

        //Imprimir Ticket
        return redirect()->back();
    }

    public function pedidos()
    {
        $pedidos = Pedido::where('activo',1)->orderBy('created_at')->with('mesa')->with('estatuspedido')->get();
        return view('pedidos.pedidos')->with(compact('pedidos'));
    }

    public function pedidosCajalaravel($id)
    {
        $pedido = Pedido::where('id',$id)->where('activo',1)->with('detallespedidostodos')->first();
        $html = "";
        $html2 = "";
            if($pedido->detallespedidostodos){
                foreach ($pedido->detallespedidostodos as $detalle) {
                    $html .='<div class="media">'
                                .'<div class="media-left">'
                                    .'<a href="#">'
                                        .'<img class="media-object" src="'.$detalle->producto->imagen_principal.'" class="thumb" height="75" width="75" alt="a picture">'
                                    .'</a>'
                                .'</div>'
                                .'<div class="media-body">'
                                    .'<ul class="list-group">'
                                        .'<li class="list-group-item">'
                                            .'<font color="black"><strong><td>Nombre:</td></strong></font>'
                                            .'<td> '.$detalle->producto->nombre.' </td>'
                                        .'</li>'
                                        .'<li class="list-group-item">'
                                            .'<font color="black"><strong><td>Descripción:</td></strong></font>'
                                            .'<td> '.$detalle->producto->detalles.' </td>'
                                        .'</li>'
                                        .'<li class="list-group-item">'
                                            .'<font color="black"><strong><td>Cantidad:</td></strong></font>'
                                            .'<font color="red"><td>'.$detalle->cantidad.' &nbsp; &nbsp; &nbsp;</td></font>'
                                            .'<font color="black"><strong><td>Precio:</td></strong></font>'
                                            .'<font color="red"><td>$'.$detalle->precio.' &nbsp; &nbsp; &nbsp;</td></font>'
                                            .'<font color="black"><strong><td>Subtotal:</td></strong></font>'
                                            .'<font color="red"><td>$'.$detalle->subtotal.' </td></font>'
                                        .'</li>'
                                        .'<li class="list-group-item">'
                                            .'<font color="black"><strong><td>Observaciones:</td></strong></font>'
                                            .'<td> '.$detalle->observaciones.' </td>'
                                        .'</li>' 
                                    .'</ul>'
                                .'</div>'
                            .'</div>';
                }
                
            }
        return \Response::json(['error' => 'false', 'msg' => $html , 'status' => '200'], 200);
    }

    public function cancelarPedidos($id)
    {
        $Pedidos = Pedido::find($id);
        $Pedidos->activo = 0;
        $Pedidos->save();     
        return redirect('pedidos');
    }

    public function iniciarServicio(Request $request)
    {
        $mesa = Mesa::find($request->idMesa);
        $mesa->estatusmesas_id = 2;
        $mesa->save();

        return \Response::json(['error' => 'false', 'msg' => $mesa, 'status' => '200'], 200);
    }

    public function agregarPedido(Request $request)
    {
        $mesa_id    = urldecode($request->idMesa);
        $total      = urldecode($request->total);
        $productos  = urldecode($request->productos);
        $productos  = json_decode($productos);

        $pedido = new Pedido();
        $pedido->mesas_id           = $mesa_id;
        $pedido->tipopagos_id       = 0;
        $pedido->cajas_id           = 0;
        $pedido->estatuspedidos_id  = 1;
        $pedido->notificacion       = 1;
        $pedido->total              = $total;
        $pedido->activo             = 1;
        $pedido->folio = md5(uniqid(rand(), true));
        $pedido->save();

        foreach ($productos as $producto) {
            $det = new DetallePedido();
            $det->productos_id  = $producto->producto_id;
            $det->pedidos_id    = $pedido->id;
            $det->observaciones = $producto->detalles;
            $det->cantidad      = $producto->cantidad;
            $det->activo        = 1;
            $det->estatusdetallespedidos_id = 1;
            $det->precio        = $producto->precio;
            $det->subtotal      = $producto->precio * $producto->cantidad;
            $det->save();
        }

        return \Response::json(['error' => 'false', 'msg' => $pedido->id, 'status' => '200'], 200);
    }


    public function agregarProductos(Request $request)
    {
        $pedido_id  = urldecode($request->idPedido);
        $total      = urldecode($request->total);
        $productos  = urldecode($request->productos);
        $productos  = json_decode($productos);

        $pedido = Pedido::find($pedido_id);
        $pedido->total = $pedido->total + $total;
        $pedido->save();

        foreach ($productos as $producto) {
            $det = new DetallePedido();
            $det->productos_id  = $producto->producto_id;
            $det->pedidos_id    = $pedido_id;
            $det->observaciones = $producto->detalles;
            $det->cantidad      = $producto->cantidad;
            $det->activo        = 1;
            $det->estatusdetallespedidos_id = 1;
            $det->precio        = $producto->precio;
            $det->subtotal      = $producto->precio * $producto->cantidad;
            $det->save();
        }

        return \Response::json(['error' => 'false', 'msg' => "Se ha guardado correctamente", 'status' => '200'], 200);
    }
}

@extends('layout')

@section('contenido')

            <div class="right_col" role="main">
                <div class="">
                    <div class="clearfix"></div>
                    <div class="row">

                        <div class="col-md-12 col-sm-12 col-xs-12">
                            <div class="x_panel">
                                <div class="x_title">
                                    <h2>Servicio de Mesas</h2>
                                    <div class="BotonesStatus">
                                    <br>
                                    &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;                                  
                                    <span class="label label-default">No asiganada</span>
                                    <span class="label label-success">Disponible</span>
                                    <span class="label label-danger Ocupada">Ocupada</span>
                                    <span class="label label-warning">En Espera de Cobro</span>
                                    </div>
                                    <div class="clearfix"></div>
                                </div>
                                <div class="x_content">
                                    <div class="col-md-12 col-sm-12 col-xs-6" >
                                        <div id="paint_mesas">
                                            
                                        </div>
                                    </div>
                                    <div class="modal fade" id="myModalNotificaciones" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
                                      <div class="modal-dialog" role="document">
                                        <div class="modal-content">
                                          <div class="modal-header">
                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                                            <h4 class="modal-title" id="myModalLabel">Nuevos Pedidos</h4>
                                          </div>
                                          <div class="modalScroll">
                                          <div class="modal-body" id="notificaciones_pedidos">
                                          <div align="left">TOTAL:</div>
                                          </div>

                                          </div>
                                          <div class="modal-footer">
                                            <div id="notificaciones_pedidos_submit"></div>
                                          </div>
                                        </div>
                                      </div>
                                    </div>

                                    <div class="modal fade" id="myModalPedidos" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
                                      <div class="modal-dialog" role="document">
                                        <div class="modal-content">
                                          <div class="modal-header">
                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                                            <h4 class="modal-title" id="myModalLabel">Pedidos</h4>
                                          </div>
                                          <div class="modalScroll">
                                          <div class="modal-body" id="pedidos_detalle">
                                          </div>  
                                          </div>
                                          <div class="modal-footer">
                                            <div id="pedidos_detalle_submit"></div> 
                                          </div>
                                        </div>
                                      </div>
                                    </div>
                            </div>
                        </div>
                        <br />
                        <br />
                        <br />
                    </div>
                </div>
                </div>
                <!-- /page content -->


@stop
@section('scripts')
<script type="text/javascript" src="{{URL::asset('js/Servicios.js')}}"></script>
@stop
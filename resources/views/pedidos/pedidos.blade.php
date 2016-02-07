@extends('layout')

@section('contenido')
            <div class="right_col" role="main">
                <div class="">
                    <div class="clearfix"></div>
                    <div class="row">
                        <div class="col-md-12 col-sm-12 col-xs-12">
                            <div class="x_panel">
                                <div class="x_title">
                                    <h2>Lista Pedidos Caja</h2>
                                    <div class="clearfix"></div>
                                </div>
                                <div class="x_content">
                                    <table id="example" class="table table-striped responsive-utilities jambo_table">
                                        <thead>
                                            <tr class="headings">      
                                                <th>Follio </th>
                                                <th>Mesa </th>
                                                <th>Fecha Hora</th>
                                                <th>Estatus </th>
                                                <th>Total </th>
                                                <th class=" no-link last"><span class="nobr">Acciones</span>
                                                </th>
                                            </tr>
                                        </thead>

                                        <tbody>
                                            @foreach($pedidos as $pedido)
                                                <tr class="even pointer"> 
                                                    <td class=" ">{{$pedido->folio}}</td>
                                                    <td class=" ">{{$pedido->mesa->nombre}}</td>
                                                    <td class=" ">{{$pedido->created_at}}</td>
                                                    <td class=" ">{{$pedido->estatuspedido->descripcion}}</td>
                                                    <td class=" ">{{$pedido->total}}</td>
                                                    <td class=" last">
                                                        <a href="pedidosCajalaravel/{{$pedido->id}}" data-toggle="modal" class="btn btn-success verPedidos" style="cursor:pointer">Detalle</a>
                                                        <a href="cancelarPedidos/{{$pedido->id}}" data-toggle="modal" class="btn btn-danger" style="cursor:pointer">Cancelar</a>
                                                    </td>
                                                </tr>
                                            @endforeach
                                        </tbody>

                                    </table>
                                </div>
                            </div>
                        </div>

                        <br />
                        <br />
                        <br />

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
                      <div class="modal-body" id="pedidos_detalle">
                        
                      </div>
                      <div class="modal-footer">
                        <div id="pedidos_detalle_submit"></div>
                      </div>
                    </div>
                  </div>
                </div>
@stop
@section('scripts')
        <script type="text/javascript" src="{{URL::asset('js/Servicios.js')}}"></script>
        <!-- Datatables -->
        <script type="text/javascript" src="{{URL::asset('js/datatables/js/jquery.dataTables.js')}}"></script>
        <script type="text/javascript" src="{{URL::asset('js/datatables/tools/js/dataTables.tableTools.js')}}"></script>

        <script>
            $(document).ready(function () {
                $('input.tableflat').iCheck({
                    checkboxClass: 'icheckbox_flat-green',
                    radioClass: 'iradio_flat-green'
                });
            });

            var asInitVals = new Array();
            $(document).ready(function () {
                var oTable = $('#example').dataTable({
                    "oLanguage": {
                        "sSearch": "Search all columns:"
                    },
                    "aoColumnDefs": [
                        {
                            'bSortable': false,
                            'aTargets': [0]
                        } //disables sorting for column one
            ],
                    'iDisplayLength': 10,
                    "sPaginationType": "full_numbers",
                });
                $("tfoot input").keyup(function () {
                    /* Filter on the column based on the index of this element's parent <th> */
                    oTable.fnFilter(this.value, $("tfoot th").index($(this).parent()));
                });
                $("tfoot input").each(function (i) {
                    asInitVals[i] = this.value;
                });
                $("tfoot input").focus(function () {
                    if (this.className == "search_init") {
                        this.className = "";
                        this.value = "";
                    }
                });
                $("tfoot input").blur(function (i) {
                    if (this.value == "") {
                        this.className = "search_init";
                        this.value = asInitVals[$("tfoot input").index(this)];
                    }
                });
            });
        </script>

@stop

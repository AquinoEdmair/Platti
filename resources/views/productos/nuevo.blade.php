@extends('layout')

@section('contenido')

            <div class="right_col" role="main">
                <div class="">
                    <div class="clearfix"></div>
                    <div class="row">

                        <div class="col-md-12 col-sm-12 col-xs-12">
                            <div class="x_panel">
                                <div class="x_title">
                                    <h2>Nuevo Producto</h2>
                                    <div class="clearfix"></div>
                                </div>
                                <div class="x_content">
                                    <br />
                                    {{ Form::open(array('url' => 'productos', 'class' => 'form-horizontal form-label-left', 'files' => true)) }}
                                        <div class="form-group">
                                            <label class="control-label col-md-3 col-sm-3 col-xs-12" for="nombre">Nombre <span class="required">*</span>
                                            </label>
                                            <div class="col-md-6 col-sm-6 col-xs-12">
                                                <input type="text" value="{{old('nombre')}}" name="nombre" required="required" class="form-control col-md-7 col-xs-12">
                                                <p class="text-danger">{{$errors->first('nombre')}}</p>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label class="control-label col-md-3 col-sm-3 col-xs-12" for="detalles">Detalles
                                            </label>
                                            <div class="col-md-6 col-sm-6 col-xs-12">
                                                <textarea class="form-control" name="detalles" rows="3">{{old('detalles')}}</textarea>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label class="control-label col-md-3 col-sm-3 col-xs-12" for="precio">Precio <span class="required">*</span>
                                            </label>
                                            <div class="col-md-6 col-sm-6 col-xs-12">
                                                <input type="text" value="{{old('precio')}}" name="precio" required="required" class="form-control col-md-7 col-xs-12">
                                                <p class="text-danger">{{$errors->first('precio')}}</p>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label class="control-label col-md-3 col-sm-3 col-xs-12" for="categoria">Categoría <span class="required">*</span>
                                            </label>
                                            <div class="col-md-6 col-sm-6 col-xs-12">
                                                <select name="categoria" class="form-control">
                                                    <option>Seleccionar Categoría</option>
                                                    @foreach($categorias as $categoria)
                                                      @if(old('categoria')==$categoria->id)
                                                        <option value="{{$categoria->id}}" selected>{{$categoria->nombre}}</option>
                                                      @else
                                                        <option value="{{$categoria->id}}">{{$categoria->nombre}}</option>
                                                      @endif
                                                    @endforeach
                                                </select>
                                                <p class="text-danger">{{$errors->first('categoria')}}</p>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label class="control-label col-md-3 col-sm-3 col-xs-12" for="imagenactual">Imagen
                                            </label>
                                            <div class="col-md-6 col-sm-6 col-xs-12">
                                                <img src='{{asset('/imagenes/productos/default.png')}}' class="thumb" height="100" width="100" alt="a picture" id="blah">
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label class="control-label col-md-3 col-sm-3 col-xs-12" for="imagen">Seleccionar Imagen <span class="required">*</span>
                                            </label>
                                            <div class="col-md-6 col-sm-6 col-xs-12">
                                                <input type="file" name="imagen" required="required" class="form-control col-md-7 col-xs-12" id="imgInp">
                                                <p class="text-danger">{{$errors->first('imagen')}}</p>
                                            </div>
                                        </div>
                                        <div class="ln_solid"></div>
                                        <div class="form-group">
                                            <div class="col-md-6 col-sm-6 col-xs-12 col-md-offset-3">
                                                <button type="submit" class="btn btn-success">Agregar Producto</button>
                                            </div>
                                        </div>
                                    {{Form::close()}}
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
<script type="text/javascript" src="{{URL::asset('js/InputFile.js')}}"></script>
@stop

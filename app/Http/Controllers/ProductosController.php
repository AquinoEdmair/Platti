<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Producto;
use App\Categoria;
use Validator;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Redirect;

class ProductosController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $productos = Producto::where('activo',1)->get();
        return view('productos.productos')->with(compact('productos'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $categorias = Categoria::where('activo',1)->get();
        return view('productos.nuevo')->with(compact('categorias'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $nombre=Input::get('nombre');

        $producto=Producto::where('nombre','=',$nombre)->where('activo','=','0')->first();

        // Si es nulo el producto no existe
        if (is_null($producto)) {

        $validaciones = [
            'nombre' => 'required|min:3|max:100|unique:tbl_productos',
            'imagen' => 'required|image',
            'precio'   => 'required|numeric',
            'categoria'  => 'required',
        ];

        $mensajes = [
            'nombre.required' => 'El nombre no debe de ser vacío',
            'nombre.min' => 'El nombre debe ser mayor a 3 caracteres',
            'nombre.max' => 'El nombre no debe ser mayor a 100 caracteres',
            'nombre.unique' => 'El nombre ya existe',
            'imagen.required' => 'Se necesita una imagen',
            'imagen.image' => 'El archivo no es valido',
            'precio.required' => 'El precio no debe ser vacío',
            'precio.numeric' => 'Precio no valido',
            'categoria.integer' => 'Se necesita una categoria',

        ];

        $validar = Validator::make($request->all(),$validaciones,$mensajes);

        if($validar->fails()){
            return Redirect::back()->withErrors($validar)->withInput();
        }else{
            $file = Input::file('imagen');
            $destinationPath = 'imagenes/productos/';
            $filename =uniqid().".".$file->getClientOriginalExtension();
            $imagename =$destinationPath.$filename;
            if($file->move($destinationPath,$filename))
            {
                $producto = new Producto();
                $producto->nombre  = $request->nombre;
                $producto->detalles = $request->detalles;
                $producto->precio = $request->precio;
                $producto->categorias_id = $request->categoria;
                $producto->imagen_principal = $imagename;
                $producto->activo   = 1;
                $producto->save();
            }

            return redirect('productos');
        }
      }
      else
      {
        $validaciones = [
            'nombre' => 'required|min:3|max:100|',
            'imagen' => 'required|image',
            'precio'   => 'required|numeric',
            'categoria'  => 'required',
        ];

        $mensajes = [
            'nombre.required' => 'El nombre no debe de ser vacío',
            'nombre.min' => 'El nombre debe ser mayor a 3 caracteres',
            'nombre.max' => 'El nombre no debe ser mayor a 100 caracteres',
            'nombre.unique' => 'El nombre ya existe',
            'imagen.required' => 'Se necesita una imagen',
            'imagen.image' => 'El archivo no es valido',
            'precio.required' => 'El precio no debe ser vacío',
            'precio.numeric' => 'Precio no valido',
            'categoria.integer' => 'Se necesita una categoria',

        ];

        $validar = Validator::make($request->all(),$validaciones,$mensajes);

        if($validar->fails()){
            return Redirect::back()->withErrors($validar)->withInput();
        }else{
            $file = Input::file('imagen');
            $destinationPath = 'imagenes/productos/';
            $filename =uniqid().".".$file->getClientOriginalExtension();
            $imagename =$destinationPath.$filename;
            if($file->move($destinationPath,$filename))
            {
                $producto->nombre  = $request->nombre;
                $producto->detalles = $request->detalles;
                $producto->precio = $request->precio;
                $producto->categorias_id = $request->categoria;
                $producto->imagen_principal = $imagename;
                $producto->activo   = 1;
                $producto->save();
            }
            return redirect('productos');
        }
      }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {

      $producto = Producto::find($id);
      $categorias = Categoria::where('activo',1)->get();
      return view('productos.edita')->with(compact('producto'))->with(compact('categorias'));
      //return var_dump($producto);

    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
      $validaciones = [
          'nombre' => 'required|min:3|max:100|unique:tbl_productos,nombre,'.$id,
          'precio'   => 'required|numeric',
          'categoria'  => 'required',
          'imagen' => 'image',
      ];
      $mensajes = [
          'nombre.required' => 'El nombre no debe de ser vacío',
          'nombre.min' => 'El nombre debe ser mayor a 3 caracteres',
          'nombre.max' => 'El nombre no debe ser mayor a 100 caracteres',
          'nombre.unique' => 'El nombre ya existe',
          'precio.required' => 'El precio no debe ser vacío',
          'precio.numeric' => 'Precio no valido',
          'categoria.integer' => 'Se necesita una categoria',
          'imagen.image' => 'El archivo no es valido',
      ];
      $validar = Validator::make($request->all(),$validaciones,$mensajes);
      if($validar->fails()){
          return Redirect::back()->withErrors($validar)->withInput();
      }
      else{
          $producto = Producto::find($id);
          $producto->nombre  = $request->nombre;
          $producto->detalles = $request->detalles;
          $producto->precio = $request->precio;
          $producto->categorias_id = $request->categoria;

          if (Input::hasFile('imagen')){
              $file = Input::file('imagen');
              $destinationPath = 'imagenes/categorias/';
              $filename =uniqid().".".$file->getClientOriginalExtension();
              $imagename =$destinationPath.$filename;
              if($file->move($destinationPath,$filename)){
                  $producto->imagen_principal=$imagename;
              }
          }
          $producto->save();
          return redirect('productos');
      }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $producto = Producto::find($id);
        $producto->activo  = 0;
        $producto->save();
        return redirect('productos');
    }
}

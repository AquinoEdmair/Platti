<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Categoria;
use Validator;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Redirect;

class CategoriasController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $categorias = Categoria::where('activo',1)->get();
        return view('categorias.categorias')->with(compact('categorias'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('categorias.nueva');
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

        $categoria=Categoria::where('nombre','=',$nombre)->where('activo','=','0')->first();

        // Si es nulo la categoría no existe
        if (is_null($categoria)) {

            $validaciones = [
                'nombre' => 'required|min:3|max:100|regex:/^[A-Za-z \t]*$/i|unique:tbl_categorias',
                'imagen' => 'required|image',
            ];

            $mensajes = [
                'nombre.required' => 'El nombre no debe de ser vacío',
                'nombre.min' => 'El nombre debe ser mayor a 3 caracteres',
                'nombre.max' => 'El nombre no debe ser mayor a 100 caracteres',
                'nombre.regex' => 'El nombre es invalido',
                'nombre.unique' => 'El nombre ya existe',
                'imagen.required' => 'Se necesita una imagen',
                'imagen.image' => 'El archivo no es valido',
            ];

            $validar = Validator::make($request->all(),$validaciones,$mensajes);

            if($validar->fails()){
                return Redirect::back()->withErrors($validar)->withInput();
            }else{

                $file = Input::file('imagen');
                $destinationPath = 'imagenes/categorias/';
                $filename =uniqid().".".$file->getClientOriginalExtension();
                $imagename =$destinationPath.$filename;
                if($file->move($destinationPath,$filename))
                {
                    $categoria = new Categoria();
                    $categoria->nombre   = $request->nombre;
                    $categoria->imagen=$imagename;
                    $categoria->activo   = 1;
                    $categoria->save();
                }

                return redirect('categorias');
            }

        }else{
            //Esta eliminada se reactiva
            $validaciones = [
                'nombre' => 'required|min:3|max:100|regex:/^[A-Za-z \t]*$/i',
                'imagen' => 'required|image',
            ];

            $mensajes = [
                'nombre.required' => 'El nombre no debe de ser vacío',
                'nombre.min' => 'El nombre debe ser mayor a 3 caracteres',
                'nombre.max' => 'El nombre no debe ser mayor a 100 caracteres',
                'nombre.regex' => 'El nombre es invalido',
                'imagen.required' => 'Se necesita una imagen',
                'imagen.image' => 'El archivo no es valido',
            ];

            $validar = Validator::make($request->all(),$validaciones,$mensajes);

            if($validar->fails()){
                return Redirect::back()->withErrors($validar)->withInput();
            }else{

                $file = Input::file('imagen');
                $destinationPath = 'imagenes/categorias/';
                $filename =uniqid().".".$file->getClientOriginalExtension();
                $imagename =$destinationPath.$filename;
                if($file->move($destinationPath,$filename))
                {
                    $categoria->nombre = $request->nombre;
                    $categoria->imagen = $imagename;
                    $categoria->activo = 1;
                    $categoria->save();
                }

                return redirect('categorias');
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
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $categoria = Categoria::find($id);
        return view('categorias.edita')->with(compact('categoria'));
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
            'nombre' => 'required|min:3|max:100|regex:/^[A-Za-z \t]*$/i|unique:tbl_categorias,nombre,'.$id,
            'imagen' => 'image',
        ];

        $mensajes = [
            'nombre.required' => 'El nombre no debe de ser vacío',
            'nombre.min' => 'El nombre debe ser mayor a 3 caracteres',
            'nombre.max' => 'El nombre no debe ser mayor a 100 caracteres',
            'nombre.regex' => 'El nombre es invalido',
            'nombre.unique' => 'El nombre ya existe',
            'imagen.image' => 'El archivo no es valido',
        ];

        $validar = Validator::make($request->all(),$validaciones,$mensajes);

        if($validar->fails()){
          return Redirect::back()->withErrors($validar)->withInput();
        }else{

            $categoria = Categoria::find($id);
            $categoria->nombre   = $request->nombre;

            if (Input::hasFile('imagen')){
                $file = Input::file('imagen');
                $destinationPath = 'imagenes/categorias/';
                $filename =uniqid().".".$file->getClientOriginalExtension();
                $imagename =$destinationPath.$filename;
                if($file->move($destinationPath,$filename)){
                    $categoria->imagen=$imagename;
                }
            }
            $categoria->save();

            return redirect('categorias');
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
        $categoria = Categoria::find($id);
        $categoria->activo  = 0;
        $categoria->save();
        return redirect('categorias');
    }
}

<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Mesa;
use Validator;
use Illuminate\Support\Facades\Input;

class MesasController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $mesas = Mesa::where('activo',1)->with("estatusmesas")->get();
        return view('mesas.mesas')->with(compact('mesas'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('mesas.nueva');
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

        $mesa=Mesa::where('nombre','=',$nombre)->where('activo','=','0')->first();

        // Si es nulo la mesa no existe
        if (is_null($mesa)) {

        $validaciones = [
            'nombre' => 'required|min:3|max:100|regex:/^[A-Za-z0-9 \t]*$/i|unique:tbl_mesas',
        ];

        $mensajes = [
            'nombre.required' => 'El nombre no debe de ser vacío',
            'nombre.min' => 'El nombre debe ser mayor a 3 caracteres',
            'nombre.max' => 'El nombre no debe ser mayor a 100 caracteres',
            'nombre.regex' => 'El nombre es invalido',
            'nombre.unique' => 'El nombre ya existe',
        ];

        $validar = Validator::make($request->all(),$validaciones,$mensajes);

        if($validar->fails()){
            return \Response::json(['error' => 'true', 'msg' => $validar->messages(), 'status' => '200'], 200);
        }else{
                $mesa = new Mesa();
                $mesa->estatusmesas_id  = 1;
                $mesa->nombre  = $request->nombre;
                $mesa->uuid = '';
                $mesa->asignacion = 0;
                $mesa->activo   = 1;
                $mesa->save();
                return redirect('mesas');          

            }

        }
        else
        {

        $validaciones = [
            'nombre' => 'required|min:3|max:100|regex:/^[A-Za-z0-9 \t]*$/i|',
        ];

        $mensajes = [
            'nombre.required' => 'El nombre no debe de ser vacío',
            'nombre.min' => 'El nombre debe ser mayor a 3 caracteres',
            'nombre.max' => 'El nombre no debe ser mayor a 100 caracteres',
            'nombre.regex' => 'El nombre es invalido',
            'nombre.unique' => 'El nombre ya existe',
        ];

         $validar = Validator::make($request->all(),$validaciones,$mensajes);

        if($validar->fails()){
            return \Response::json(['error' => 'true', 'msg' => $validar->messages(), 'status' => '200'], 200);
        }else{
                //Esta eliminada se reactiva
                $mesa->estatusmesas_id  = 1;
                $mesa->nombre  = $request->nombre;
                $mesa->uuid = '';
                $mesa->asignacion = 0;
                $mesa->activo   = 1;
                $mesa->save();
                return redirect('mesas');
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
        $mesa = Mesa::find($id);
        return view('mesas.edita')->with(compact('mesa'));
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
            'nombre' => 'required|min:3|max:100|regex:/^[A-Za-z0-9 \t]*$/i|unique:tbl_mesas,nombre,'.$id,
        ];

        $mensajes = [
            'nombre.required' => 'El nombre no debe de ser vacío',
            'nombre.min' => 'El nombre debe ser mayor a 3 caracteres',
            'nombre.max' => 'El nombre no debe ser mayor a 100 caracteres',
            'nombre.regex' => 'El nombre es invalido',
            'nombre.unique' => 'El nombre ya existe',
        ];

        $validar = Validator::make($request->all(),$validaciones,$mensajes);

        if($validar->fails()){
            return \Response::json(['error' => 'true', 'msg' => $validar->messages(), 'status' => '200'], 200);
        }else{
                $mesa = Mesa::find($id);
                $mesa->nombre = $request->nombre;
                $mesa->activo  = 1;
                $mesa->save();
            return redirect('mesas');
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
        $mesa = Mesa::find($id);
        $mesa->activo  = 0;
        $mesa->save();
        return redirect('mesas');
    }
}

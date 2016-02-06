<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Usuario;
use App\TipoUsuario;
use Validator;
use Illuminate\Support\Facades\Input;

class UsuariosController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $usuarios = Usuario::where('activo',1)->get();
        return view('usuarios.usuarios')->with(compact('usuarios'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $tipousuarios = TipoUsuario::all();
        return view('usuarios.nuevo')->with(compact('tipousuarios'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $_usuario=Input::get('usuario');

        $usuario=Usuario::where('usuario','=',$_usuario)->where('activo','=','0')->first();

        // Si es nulo el usuario no existe
        if (is_null($usuario)) {

            $validaciones = [
                'tipousuario_id' => 'required',
                'nombre' => 'required|min:3|max:100|regex:/^[A-Za-z \t]*$/i|',
                'usuario' => 'required|min:3|max:20|regex:/^[A-Za-z \t]*$/i|unique:tbl_usuarios',
                'password' => 'required|min:3|max:20|',
            ];

            $mensajes = [
                'tipousuario_id.required' => 'Debe seleccionar el tipo de usuario',
                'nombre.required' => 'El nombre no debe de ser vacío',
                'nombre.min' => 'El nombre debe ser mayor a 3 caracteres',
                'nombre.max' => 'El nombre no debe ser mayor a 100 caracteres',
                'nombre.regex' => 'El nombre es invalido',
                'usuario.required' => 'El usuario no debe de ser vacío',
                'usuario.min' => 'El usuario debe ser mayor a 3 caracteres',
                'usuario.max' => 'El usuario no debe ser mayor a 20 caracteres',
                'usuario.regex' => 'El usuario es invalido',
                'password.required' => 'El password no debe de ser vacío',
                'password.min' => 'El password debe ser mayor a 3 caracteres',
                'password.max' => 'El password no debe ser mayor a 20 caracteres',
                'password.regex' => 'El password es invalido',
            ];

            $validar = Validator::make($request->all(),$validaciones,$mensajes);

            if($validar->fails()){
                return \Response::json(['error' => 'true', 'msg' => $validar->messages(), 'status' => '200'], 200);
            }else{

                    $usuario = new Usuario();
                    $usuario->tipousuario_id = $request->tipousuario_id;
                    $usuario->nombre = $request->nombre;
                    $usuario->usuario = $request->usuario;
                    $usuario->password = $request->password;
                    $usuario->activo  = 1;
                    $usuario->save();

                return redirect('usuarios');
            }
        }
        else
        {
             $validaciones = [
                'tipousuario_id' => 'required',
                'nombre' => 'required|min:3|max:100|regex:/^[A-Za-z \t]*$/i|',
                'usuario' => 'required|min:3|max:20|regex:/^[A-Za-z \t]*$/i|',
                'password' => 'required|min:3|max:20|',
            ];

            $mensajes = [
                'tipousuario_id.required' => 'Debe seleccionar el tipo de usuario',
                'nombre.required' => 'El nombre no debe de ser vacío',
                'nombre.min' => 'El nombre debe ser mayor a 3 caracteres',
                'nombre.max' => 'El nombre no debe ser mayor a 100 caracteres',
                'nombre.regex' => 'El nombre es invalido',
                'usuario.required' => 'El usuario no debe de ser vacío',
                'usuario.min' => 'El usuario debe ser mayor a 3 caracteres',
                'usuario.max' => 'El usuario no debe ser mayor a 20 caracteres',
                'usuario.regex' => 'El usuario es invalido',
                'password.required' => 'El password no debe de ser vacío',
                'password.min' => 'El password debe ser mayor a 3 caracteres',
                'password.max' => 'El password no debe ser mayor a 20 caracteres',
                'password.regex' => 'El password es invalido',
            ];

            $validar = Validator::make($request->all(),$validaciones,$mensajes);

            if($validar->fails()){
                return \Response::json(['error' => 'true', 'msg' => $validar->messages(), 'status' => '200'], 200);
            }else{

                    $usuario->tipousuario_id = $request->tipousuario_id;
                    $usuario->nombre = $request->nombre;
                    $usuario->usuario = $request->usuario;
                    $usuario->password = $request->password;
                    $usuario->activo  = 1;
                    $usuario->save();

                return redirect('usuarios');
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
        $tipousuarios = TipoUsuario::all();
        $usuario = Usuario::find($id);
        return view('usuarios.edita')->with(compact('usuario','tipousuarios'));
       
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
            'tipousuario_id' => 'required',
            'nombre' => 'required|min:3|max:100|regex:/^[A-Za-z \t]*$/i|',
            'usuario' => 'required|min:3|max:20|regex:/^[A-Za-z \t]*$/i|unique:tbl_usuarios,nombre,'.$id,
            'password' => 'required|min:3|max:20|',
        ];

        $mensajes = [
            'tipousuario_id.required' => 'Debe seleccionar el tipo de usuario',
            'nombre.required' => 'El nombre no debe de ser vacío',
            'nombre.min' => 'El nombre debe ser mayor a 3 caracteres',
            'nombre.max' => 'El nombre no debe ser mayor a 100 caracteres',
            'nombre.regex' => 'El nombre es invalido',
            'usuario.required' => 'El usuario no debe de ser vacío',
            'usuario.min' => 'El usuario debe ser mayor a 3 caracteres',
            'usuario.max' => 'El usuario no debe ser mayor a 20 caracteres',
            'usuario.regex' => 'El usuario es invalido',
            'password.required' => 'El password no debe de ser vacío',
            'password.min' => 'El password debe ser mayor a 3 caracteres',
            'password.max' => 'El password no debe ser mayor a 20 caracteres',
            'password.regex' => 'El password es invalido',
        ];

        $validar = Validator::make($request->all(),$validaciones,$mensajes);

        if($validar->fails()){
            return \Response::json(['error' => 'true', 'msg' => $validar->messages(), 'status' => '200'], 200);
        }else{

            $usuario = Usuario::find($id);
            $usuario->tipousuario_id = $request->tipousuario_id;
            $usuario->nombre = $request->nombre;
            $usuario->usuario = $request->usuario;
            $usuario->password = $request->password;
            $usuario->save();
            return redirect('usuarios');
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
        $usuario = Usuario::find($id);
        $usuario->activo  = 0;
        $usuario->save();
        return redirect('usuarios');
    }
}

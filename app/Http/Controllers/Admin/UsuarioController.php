<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\User;

class UsuarioController extends Controller
{
    public function __construct() {
        $this->middleware('auth');
        $this->middleware('admin');
    }
    
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $usuarios = User::all();
        $argumentos = array();
        $argumentos['usuarios'] = $usuarios;
        return view('admin.usuarios.index',
            $argumentos);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.usuarios.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $verificacion = 
            //where(columna,valor)
            //first encuentra el primer registro que coincida,
            //si no encuentra regresa NULL
            User::where('email',$request->input('email'))->first();
        if($verificacion) {
            return redirect()->
                route('usuarios.create')->
                with('error',
                'El usuario ' . $request->input('email') . ' ya existe');
        }
        $usuario = new User();
        $usuario->name = 
            $request->input('name');
        $usuario->email =
            $request->input('email');
        if ($request->input('password')) {
            $usuario->password =
                bcrypt($request->input('password'));
        }
        if($usuario->save()) {
            return redirect()->
                route('usuarios.index')->
                with('exito',
                'El usuario fue guardado correctamente');
        }
        //Aquí no se pudo guardar
        return redirect()->
            route('usuarios.index')->
            with('error',
            'No se pudo agregar el usuario');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $usuario = User::find($id);
        if ($usuario) {
            $argumentos = array();
            $argumentos['usuario'] = $usuario;
            return view('admin.usuarios.show', 
                $argumentos);
        }
        return redirect()->
                route('usuarios.index')->
                with('error','No se encontró el usuario');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $usuario = User::find($id);
        if ($usuario) {
            $argumentos = array();
            $argumentos['usuario'] = $usuario;
            return view('admin.usuarios.edit', 
                $argumentos);
        }
        return redirect()->
                route('usuarios.index')->
                with('error','No se encontró el usuario');
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
        $usuario = User::find($id); 
        if ($usuario) {
            $usuario->name = 
                $request->input('name');
            $usuario->email =
                $request->input('email');
            if ($request->input('password')) {
                $usuario->password =
                    bcrypt($request->input('password'));
            }
            if ($usuario->save()) {
                return redirect()->
                    route('usuarios.edit',$id)->
                    with('exito',
                    'El usuario se actualizó exitosamente');
            }
            return redirect()->
                route('usuarios.edit',$id)->
                with('error',
                    'No se pudo actualizar el usuario');
        }
        return redirect()->
            route('usuarios.index')->
            with('error',
                'No se encontró el usuario');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $usuario = User::find($id);
        if ($usuario) {
            if($usuario->delete()) {
                return redirect()->
                        route('usuarios.index')->
                        with('exito','Usuario eliminado exitosamente');
            }
            return redirect()->
                    route('usuarios.index')->
                    with('error','No se pudo eliminar usuario');
        }
        return redirect()->
                route('usuarios.index')->
                with('error','No se encotró el usuario');
    }
}

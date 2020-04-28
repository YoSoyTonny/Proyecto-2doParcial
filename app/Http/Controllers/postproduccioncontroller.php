<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\postproduccion;

class postproduccioncontroller extends Controller
{
    public function __construct() {
        $this->middleware('auth');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

     //http://localhost:8000/admin/noticas?criterio=hola
     //http://localhost:8000/admin/noticas?criterio=hola&fechaInicio=2020-03-01&fechaFin=2020-03-31
     public function index(Request $request)
    {
        $criterio = $request->input('criterio');
        $fechainicio = $request->input('fechainicio');
        $fechafin = $request->input('fechafin');
        $postproducciones= array();
if($fechainicio && $fechafin) {
 $postproducciones= postproduccion::where(
                'fecha', '>=', $fechainicio
 
                )-> where('fecha', '<=', $fechafin)->
                get();

}else
{

        
            //Me trae todas
            $postproducciones = postproduccion::all();
}

        $argumentos = array();
        $argumentos['postproducciones'] = $postproducciones ;
        return view('admin.postproduccion.index',
            $argumentos);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.postproduccion.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $postproduccion = new postproduccion();
        $postproduccion->categoria = 
            $request->input('txtcategoria');
        $postproduccion->tema =
            $request->input('txttema');
        $postproduccion->fecha =
            $request->input('txtfecha');
        $postproduccion->lugar =
            $request->input('txtlugar');
        $postproduccion->estado = 
            $request->input('txtestado');
        
        if($postproduccion->save()) {
            //Si pude guardar la noticia
            return redirect()->
                route('postproduccion.index')->
                with('exito',
                'La postproduccion fue guardada correctamente');
        }
        //Aquí no se pudo guardar
        return redirect()->
            route('postproduccion.index')->
            with('error',
            'No se pudo agregar al postproduccion');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $postproducciones = postproduccion::find($id);
        if ($postproducciones) {
            $argumentos = array();
            $argumentos['postproduccion'] = $postproducciones;
            return view('admin.postproduccion.show', 
                $argumentos);
        }
        return redirect()->
                route('postproduccion.index')->
                with('error','No se encontró la postproduccion');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $postproduccion = postproduccion::find($id);
        if ($postproduccion) {
            $argumentos = array();
            $argumentos['postproduccion'] = $postproduccion;
            return view('admin.postproduccion.edit', 
                $argumentos);
        }
        return redirect()->
                route('postproduccion.index')->
                with('error','No se encontró la postproduccion');
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
        $postproduccion = postproduccion::find($id); 
        if ($postproduccion) {
            $postproduccion->categoria =
                $request->input('txtcategoria');
            $postproduccion->tema =
                $request->input('txttema');
            $postproduccion->fecha =
                $request->input('txtfecha');
            $postproduccion->lugar =
                $request->input('txtlugar');
            $postproduccion->estado = 
                $request->input('txtestado');

            if ($postproduccion->save()) {
                return redirect()->
                    route('postproduccion.edit',$id)->
                    with('exito',
                    'La postproduccion se actualizó exitosamente');
            }
            return redirect()->
                route('postproduccion.edit',$id)->
                with('error',
                    'No se pudo actualizar postproduccion');
        }
        return redirect()->
            route('postproduccion.index')->
            with('error',
                'No se encontró la postproduccion');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $postproducciones = postproduccion::find($id);
        if ($postproducciones) {
            if($postproducciones->delete()) {
                return redirect()->
                        route('postproduccion.index')->
                        with('exito','postproduccion eliminada exitosamente');
            }
            return redirect()->
                    route('postproduccion.index')->
                    with('error','No se pudo eliminar postproduccion');
        }
        return redirect()->
                route('postproduccion.index')->
                with('error','No se encotró la postproduccion');
    }
    

}

<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\produccion;

class ProduccionController extends Controller
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
        $producciones= array();
if($fechainicio && $fechafin) {
 $producciones= produccion::where(
                'fecha', '>=', $fechainicio
 
                )-> where('fecha', '<=', $fechafin)->
                get();

}else
{

        
            //Me trae todas
            $producciones = produccion::all();
}

        $argumentos = array();
        $argumentos['producciones'] = $producciones ;
        return view('admin.noticias.index',
            $argumentos);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.noticias.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $produccion = new produccion();
        $produccion->titulo = 
            $request->input('txttitulo');
        $produccion->descripcion =
            $request->input('txtdescripcion');
        $produccion->fecha =
            $request->input('txtfecha');
        $produccion->lugar =
            $request->input('txtlugar');
        $produccion->estado =
            $request->input('txtestado');
        
        if($produccion->save()) {
            //Si pude guardar la noticia
            return redirect()->
                route('produccion.index')->
                with('exito',
                'La noticia fue guardada correctamente');
        }
        //Aquí no se pudo guardar
        return redirect()->
            route('produccion.index')->
            with('error',
            'No se pudo agregar al noticia');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $producciones = produccion::find($id);
        if ($producciones) {
            $argumentos = array();
            $argumentos['produccion'] = $producciones;
            return view('admin.noticias.show', 
                $argumentos);
        }
        return redirect()->
                route('noticias.index')->
                with('error','No se encontró la noticia');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $produccion = produccion::find($id);
        if ($produccion) {
            $argumentos = array();
            $argumentos['produccion'] = $produccion;
            return view('admin.noticias.edit', 
                $argumentos);
        }
        return redirect()->
                route('produccion.index')->
                with('error','No se encontró la noticia');
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
        $produccion = produccion::find($id); 
        if ($produccion) {
            $produccion->titulo =
                $request->input('txttitulo');
            $produccion->descripcion =
                $request->input('txtdescripcion');
            $produccion->fecha =
                $request->input('txtfecha');
            $produccion->lugar =
                $request->input('txtlugar');
            $produccion->estado =
                $request->input('txtestado');

            if ($produccion->save()) {
                return redirect()->
                    route('produccion.edit',$id)->
                    with('exito',
                    'La noticia se actualizó exitosamente');
            }
            return redirect()->
                route('produccion.edit',$id)->
                with('error',
                    'No se pudo actualizar noticia');
        }
        return redirect()->
            route('produccion.index')->
            with('error',
                'No se encontró la noticia');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $producciones = produccion::find($id);
        if ($producciones) {
            if($producciones->delete()) {
                return redirect()->
                        route('produccion.index')->
                        with('exito','Noticia eliminada exitosamente');
            }
            return redirect()->
                    route('produccion.index')->
                    with('error','No se pudo eliminar noticia');
        }
        return redirect()->
                route('produccion.index')->
                with('error','No se encotró la noticia');
    }
    


}


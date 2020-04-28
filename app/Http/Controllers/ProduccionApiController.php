<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Produccion;

class ProduccionApiController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:api');
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $produccion = produccion::where([
            ['id_user','=',$request->user()->id]])->get();
    //Construyo respuesta
    $respuesta = array();
    $respuesta['produccion'] = $produccion;

    //Envió respuesta
    return $respuesta;
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
        $produccion->titulo = $request->input('titulo');
        $produccion->descripcion = $request->input('descripcion');
        $produccion->fecha = $request->input('fecha');
        $produccion->lugar = $request->input('lugar');
        $produccion->estado = $request->input('estado');
            // Arma una respuesta
            $respuesta = array();
            $respuesta['exito'] = false;
            if($produccion -> save()){
                $respuesta['exito'] = true;
            }

            // Regresa una respuesta
            return $respuesta;
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $produccion = produccion::find($id);
        if($produccion){

            $respuesta = array();
            $respuesta['produccion'] = $produccion;
        }else
        $respuesta['produccion']= "no se encontro la produccion";
        return $respuesta;
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
        if($produccion){

            $produccion = new produccion();
            $produccion->titulo = $request->input('titulo');
            $produccion->descripcion = $request->input('descripcion');
            $produccion->fecha = $request->input('fecha');
            $produccion->lugar = $request->input('lugar');
            $produccion->estado = $request->input('estado');




            if($produccion->save()){

                $respuesta = array();
               return $respuesta['produccion'] = $produccion;

            }

            $respuesta = array();
          return  $respuesta['produccion'] = "no se pudo guardar la tarea";

        }
        $respuesta = array();
       return  $respuesta['produccion'] = "no se pudo guardar la tarea";
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}

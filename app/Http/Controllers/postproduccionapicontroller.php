<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\postproduccion;

class postproduccionapicontroller extends Controller
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
        $postproduccion = postproduccion::where([
            ['id_user','=',$request->user()->id]])->get();
    //Construyo respuesta
    $respuesta = array();
    $respuesta['postproduccion'] = $postproduccion;

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
        $postproduccion = new postproduccion();
        $postproduccion->categoria = $request->input('categoria');
        $postproduccion->tema = $request->input('tema');
        $postproduccion->fecha = $request->input('fecha');
        $postproduccion->lugar = $request->input('lugar');
        $postproduccion->estado = $request->input('estado');
            // Arma una respuesta
            $respuesta = array();
            $respuesta['exito'] = false;
            if($postproduccion -> save()){
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
        $postproduccion = postproduccion::find($id);
        if($postproduccion){

            $respuesta = array();
            $respuesta['postproduccion'] = $postproduccion;
        }else
        $respuesta['postproduccion']= "no se encontro la postproduccion";
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
        $postproduccion = postproduccion::find($id);
        if($postproduccion){

            $postproduccion = new postproduccion();
            $postproduccion->categoria = $request->input('categoria');
            $postproduccion->tema = $request->input('tema');
            $postproduccion->fecha = $request->input('fecha');
            $postproduccion->lugar = $request->input('lugar');
            $postproduccion->estado = $request->input('estado');




            if($postproduccion->save()){

                $respuesta = array();
               return $respuesta['postproduccion'] = $postproduccion;

            }

            $respuesta = array();
          return  $respuesta['postproduccion'] = "no se pudo guardar la tarea";

        }
        $respuesta = array();
       return  $respuesta['postproduccion'] = "no se pudo guardar la tarea";
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

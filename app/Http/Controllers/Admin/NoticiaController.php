<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use Illuminate\Support\Facades\Storage;

use App\Noticia;

class NoticiaController extends Controller
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
        //Verificar si en la solicitud viene un parametro
        //llamado criterio
        $fechaInicio = $request->input('fechaInicio');
        $fechaFin = $request->input('fechaFin');
        $criterio = $request->input('criterio');
        $noticias = array();
        if ($fechaInicio && $fechaFin && $criterio) {
            $noticias = Noticia::leftJoin(
                'categorias_noticia', //la tabla a unir
                'categorias_noticia.id', //primer columna a evaluar (id de la table que voy a juntar)
                '=',                   //como lo va a evaluar
                'noticias.id_categoria' // segunda columna a evaluar (fk con el que se relaciona la tabla)
            )->
                where('titulo',
                'LIKE','%'.$criterio.'%')->
                where('fecha','>=',$fechaInicio)->
                where('fecha','<=',$fechaFin)->
                get();
                //SELECT * FROM noticias WHERE criterio = '%$criterio%'
                //AND fecha >= '$fechaInicio' AND
                // fecha <= '$fechaFin' LEFT JOIN....
        } else {
            if($criterio) {
                //Busca noticias por criterio
                //SELECT * FROM noticias WHERE titulo LIKE '%criterio%'
                $noticias = Noticia::leftJoin(
                    'categorias_noticia', //la tabla a unir
                    'categorias_noticia.id', //primer columna a evaluar (id de la table que voy a juntar)
                    '=',                   //como lo va a evaluar
                    'noticias.id_categoria' // segunda columna a evaluar (fk con el que se relaciona la tabla)
                )->
                    where('titulo',
                    'LIKE','%'.$criterio.'%')->get();
    
                    //dd($noticias);
            } else {
                //Me trae todas
                $noticias = Noticia::leftJoin(
                    'categorias_noticia', //la tabla a unir
                    'categorias_noticia.id', //primer columna a evaluar (id de la table que voy a juntar)
                    '=',                   //como lo va a evaluar
                    'noticias.id_categoria' // segunda columna a evaluar (fk con el que se relaciona la tabla)
                )->get();
            }
        }
        
        
        $argumentos = array();
        $argumentos['noticias'] = $noticias;
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
        $noticia = new Noticia();
        $noticia->titulo = 
            $request->input('txtTitulo');
        $noticia->cuerpo =
            $request->input('txtCuerpo');
        if ($request->hasFile('imgPortada')) {
            $archivoPortada = 
                $request->file('imgPortada');
            $rutaArchivo =
                $archivoPortada->store('public/portadas');
            $rutaArchivo =
                substr($rutaArchivo,16);
            $noticia->portada =
                $rutaArchivo;
        }
        if($noticia->save()) {
            //Si pude guardar la noticia
            return redirect()->
                route('noticias.index')->
                with('exito',
                'La noticia fue guardada correctamente');
        }
        //Aquí no se pudo guardar
        return redirect()->
            route('noticias.index')->
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
        $noticia = Noticia::find($id);
        if ($noticia) {
            $argumentos = array();
            $argumentos['noticia'] = $noticia;
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
        $noticia = Noticia::find($id);
        if ($noticia) {
            $argumentos = array();
            $argumentos['noticia'] = $noticia;
            return view('admin.noticias.edit', 
                $argumentos);
        }
        return redirect()->
                route('noticias.index')->
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
        $noticia = Noticia::find($id); 
        if ($noticia) {
            $noticia->titulo =
                $request->input('txtTitulo');
            $noticia->cuerpo =
                $request->input('txtCuerpo');
            if ($request->hasFile('imgPortada')) {
               
                Storage::delete('public/portadas/' . $noticia->portada);

                $archivoPortada = 
                    $request->file('imgPortada');
                //Nombre establecido por Laravel
                /*$rutaArchivo =
                    $archivoPortada->store('public/portadas');*/
                //Nombre establecido por nosotros

                $textoArchivoSeparado = 
                    explode('.',
                        $archivoPortada->getClientOriginalName());
                $extension =
                    $textoArchivoSeparado[count($textoArchivoSeparado) - 1];
                

                $rutaArchivo =
                    Storage::putFileAs('public/portadas',
                        $archivoPortada,
                        $noticia->id . time() .
                       "portada." . $extension);
                $rutaArchivo =
                    substr($rutaArchivo,16);
                $noticia->portada =
                    $rutaArchivo;
            }

            if ($noticia->save()) {
                return redirect()->
                    route('noticias.edit',$id)->
                    with('exito',
                    'La noticia se actualizó exitosamente');
            }
            return redirect()->
                route('noticias.edit',$id)->
                with('error',
                    'No se pudo actualizar noticia');
        }
        return redirect()->
            route('noticias.index')->
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
        $noticia = Noticia::find($id);
        if ($noticia) {
            if($noticia->delete()) {
                return redirect()->
                        route('noticias.index')->
                        with('exito','Noticia eliminada exitosamente');
            }
            return redirect()->
                    route('noticias.index')->
                    with('error','No se pudo eliminar noticia');
        }
        return redirect()->
                route('noticias.index')->
                with('error','No se encotró la noticia');
    }
}

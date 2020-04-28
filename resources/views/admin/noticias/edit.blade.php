@extends('layouts.admin')

@section('titulo','Administración | Editar noticia')
@section('titulo2','Noticias')

@section('breadcrumbs')
@endsection

@section('contenido')
<a class="btn btn-secondary btn-sm"
    style="margin-bottom: 10px;"
    href="{{route('produccion.index')}}">
    <i class="fas fa-arrow-left"></i>
    Volver a lista de noticias</a>
<div class="container-fluid">
    <div class="row">
        <div class="col-md-12">
            @if(Session::has('exito'))
                <div class="alert alert-success alert-dismissible">
                    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                    <h5><i class="icon fas fa-check"></i> ¡Éxito!</h5>
                    {{Session::get('exito')}}
                </div>
            @endif
            @if(Session::has('error'))
                <div class="alert alert-danger alert-dismissible">
                    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                    <h5><i class="icon fas fa-check"></i> Error!</h5>
                    {{Session::get('error')}}
                </div>
            @endif
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">Editar noticia: {{$produccion->id}}</h3>
                </div>
                <div class="card-body">
                    <form method="POST" enctype="multipart/form-data"
                        action="{{route('produccion.update',$produccion->id)}}">
                        @csrf
                        @method('PUT')
                        
                        

                       
                        <div class="form-group">
                            <label>titulo</label>
                            <textarea class="form-control" 
                                rows="12" name="txttitulo">{{$produccion->titulo}}</textarea>
                        </div>
                        <div class="form-group">
                            <label>descripcion</label>
                            <textarea class="form-control" 
                                rows="12" name="txtdescripcion">{{$produccion->descripcion}}</textarea>
                        </div>
                        <div class="form-group">
                            <label>fecha</label>
                            <textarea class="form-control" 
                                rows="12" name="txtfecha">{{$produccion->fecha}}</textarea>
                        </div>
                        <div class="form-group">
                            <label>lugar</label>
                            <textarea class="form-control" 
                                rows="12" name="txtlugar">{{$produccion->lugar}}</textarea>
                        <div class="form-group">
                            <label>estado</label>
                            <textarea class="form-control" 
                                rows="12" name="txtestado">{{$produccion->estado}}</textarea>        
                        <div class="form-group">
                            <button type="submit"
                                class="btn btn-primary">Actualizar</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@section('scripts')
@endsection

@section('estilos')
@endsection
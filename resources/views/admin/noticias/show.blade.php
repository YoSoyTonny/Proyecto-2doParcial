@extends('layouts.admin')


@section('titulo2','videos')

@section('breadcrumbs')
@endsection

@section('contenido')
<a class="btn btn-secondary btn-sm"
    style="margin-bottom: 10px;"
    href="{{route('produccion.index')}}">
    <i class="fas fa-arrow-left"></i>
    Volver a lista de videos</a>
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
                    <h3 class="card-title">Mostrar videos: {{$produccion->id}}</h3>
                </div>
                <div class="card-body">
                   <h1>{{$produccion->titulo}}</h1>
                   <p>{{$produccion->descripcion}}</p>
                   <p>{{$produccion->fecha}}</p>
                   <p>{{$produccion->lugar}}</p>
                   <p>{{$produccion->estado}}</p>

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
@extends('layouts.admin')

@section('titulo','Administración | Crear noticia')
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
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">Crear noticia</h3>
                </div>
                <div class="card-body">
                    <form method="POST" enctype="multipart/form-data"
                        action="{{route('produccion.store')}}">
                        @csrf
                        <div class="form-group">
                            <label>titulo</label>
                            <textarea class="form-control" 
                                rows="12" name="txttitulo"></textarea>
                        </div>
                        <div class="form-group">
                            <label>descripcion</label>
                            <textarea class="form-control" 
                                rows="12" name="txtdescripcion"></textarea>
                        </div>
                        <div class="form-group">
                            <label>fecha</label>
                            <textarea class="form-control" 
                                rows="12" name="txtfecha"></textarea>
                        </div>
                        <div class="form-group">
                            <label>lugar</label>
                            <textarea class="form-control" 
                                rows="12" name="txtlugar"></textarea>
                        </div>
                        <div class="form-group">
                            <label>estado</label>
                            <textarea class="form-control" 
                                rows="12" name="txtestado"></textarea>
                        </div>
                        <div class="form-group">
                            <button type="submit"
                                class="btn btn-primary">Guardar</button>
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
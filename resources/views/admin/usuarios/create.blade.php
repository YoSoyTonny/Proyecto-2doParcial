@extends('layouts.admin')

@section('titulo','Administración | Crear usuario')
@section('titulo2','Usuarios')

@section('breadcrumbs')
@endsection

@section('contenido')
<a class="btn btn-secondary btn-sm"
    style="margin-bottom: 10px;"
    href="{{route('usuarios.index')}}">
    <i class="fas fa-arrow-left"></i>
    Volver a lista de usuarios</a>
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
                    <h3 class="card-title">Crear usuarios</h3>
                </div>
                <div class="card-body">
                    <form method="POST" id="formGuardar"
                        action="{{route('usuarios.store')}}">
                        @csrf
                        <div class="form-group">
                            <label>Nombre</label>
                            <input type="text" 
                                name="name" class="form-control"/>
                        </div>
                        <div class="form-group">
                            <label>Correo</label>
                            <input type="text" 
                                name="email" class="form-control"/>
                        </div>
                        <div class="form-group">
                            <label>Password</label>
                            <input type="password" id="txtPassword"
                                name="password" class="form-control"/>
                        </div>
                        <div class="form-group">
                            <label>Confirmar password</label>
                            <input type="password" id="txtConfirmar"
                               class="form-control"/>
                            <span class="text-danger" id="alertPassword">Las contraseñas no coinciden</span>
                        </div>
                        
                        <div class="form-group">
                            <button type="submit" id="btnGuardar"
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
<script>
    function doChangePassword(e) {
        $("#alertPassword").hide();
    }
    function doClickGuardar(e) {
        e.preventDefault();
        if($("#txtPassword").val() != null && $("#txtPassword").val() != '' &&
            $("#txtPassword").val() == $("#txtConfirmar").val()) {
            $("#formGuardar").submit();
        } else {
            $("#alertPassword").show();
        }
    }
    $(function() {
        $("#btnGuardar").click(doClickGuardar);
        $("#txtPassword").change(doChangePassword);
        $("#txtConfirmar").change(doChangePassword);
        $("#alertPassword").hide();
    });
</script>
@endsection

@section('estilos')
@endsection
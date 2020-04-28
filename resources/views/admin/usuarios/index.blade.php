@extends('layouts.admin')

@section('titulo','Administración | Usuarios')
@section('titulo2','Usuarios')

@section('breadcrumbs')
@endsection

@section('contenido')
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
                    <h3 class="card-title">Lista de usuarios</h3>
                </div>
                <div class="card-body">
                    
                    <a href="{{route('usuarios.create')}}" class="btn btn-primary">
                        <i class="fas fa-plus"></i>Agregar usuario
                    </a>
                    <table class="table">
                        <thead>
                            <tr>
                                <th>Usuario</th>
                                <th>Acciones</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($usuarios as $usuario)
                                <tr>
                                    <td class="nombre_usuario">{{$usuario->name}}</td>
                                    <td>
                                        <form method="POST" 
                                            action="{{route('usuarios.destroy',$usuario->id)}}">
                                            @csrf
                                            @method('DELETE')
                                            <a 
                                            href="{{route('usuarios.show',$usuario->id)}}"
                                            class="btn btn-primary">
                                            <i class="fas fa-eye"></i>
                                            </a>
                                            <a href="{{route('usuarios.edit',$usuario->id)}}" class="btn btn-primary">
                                                <i class="fas fa-edit"></i>
                                            </a>
                                            <button type="button" id_usuario="{{$usuario->id}}"
                                            
                                                class="btn btn-danger btnEliminar">
                                                <i class="fas fa-times"></i>
                                            </button>
                                        </form>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- Modal Confirmar -->
<div class="modal fade" id="modalConfirmarEliminar" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Confirmar eliminación</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        Seguro que deseas eliminar el usuario: <strong><span id="spnUsuario"></span></strong>?
      </div>
      <div class="modal-footer">
        <form action="#" method="POST" id="formEliminar">
            @csrf
            @method('DELETE')
            <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
            <button type="submit" class="btn btn-danger">Eliminar</button>
        </form>
      </div>
    </div>
  </div>
</div>
@endsection

@section('scripts')
<script>
    function doClickEliminar(e) {
        var nombre = $(this).parent().parent().parent().find(".nombre_usuario").text();
        var idUsuario = $(this).attr('id_usuario');
        $("#spnUsuario").text(nombre);
        $("#formEliminar").attr('action','/admin/usuarios/' + idUsuario);
        $("#modalConfirmarEliminar").modal('show');
    }
    $(function() {
        $(".btnEliminar").click(doClickEliminar);
    });
</script>
@endsection

@section('estilos')
@endsection
@extends('layouts.admin')


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
                    <h3 class="card-title">Lista de videos</h3>
                </div>
                <div class="card-body">
                <div class="row">
                        <div class="col-md-12">
                            <form>
                                <div class="form-group">
                                    <input class="form-control" 
                                        type="date" name="fechainicio" 
                                        id="txtCriterio" />
                                        <input class="form-control" 
                                        type="text" name="fechafin" 
                                        id="txtCriterio" />
                                </div>
                                <div class="form-group">
                                    <button class="btn btn-primary" type="submit">
                                        Buscar
                                    </button>
                                </div>
                            </form>
                        </div>
                    </div>
                <a href="{{route('produccion.create')}}" class="btn btn-primary">
                        <i class="fas fa-plus"></i>Agregar video
                    </a>
                    
                    <div class="row">
                        <div class="col-md-12">
                       
                        </div>
                    </div>
                    <table class="table">
                        <thead>
                            <tr>
                                <th>Lista de videos</th>
                                <th>Categoria</th>
                                <th>Estado</th>
                                <th>Acciones</th>
                            </tr>
                        </thead>
                        <tbody>
                            <!-- Aquí van las noticias -->
                            @foreach($producciones ?? '' as $produccion)
                                <tr>
                                    <td class="titulo_noticia">{{$produccion->titulo}}</td>
                                    <td>{{$produccion->descripcion}}</td>
                                    <td>{{$produccion->estado}}</td>

                                    <td>
                                    <form method="POST" action="{{route('produccion.index', $produccion->id)}}">
                                                        <a href="{{route('produccion.show',$produccion->id)}}" class="btn btn-primary">
                                                            <i class="fas fa-eye"></i>
                                                        </a>

                                                        <a href="{{route('produccion.edit',$produccion->id)}}" class="btn btn-success">
                                                            <i class="fas fa-edit"></i>
                                                        </a>
                                                        </a>
                                                        @csrf
                                            @method('DELETE')
                                            <button type="button" id_noticia="{{$produccion->id}}"
                                            
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
        Seguro que deseas eliminar el video: <strong><span id="spnNoticia"></span></strong>?
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
        var titulo = $(this).parent().parent().parent().find(".titulo_noticia").text();
        var idNoticia = $(this).attr('id_noticia');
        $("#spnNoticia").text(titulo);
        $("#formEliminar").attr('action','/produccion/' + idNoticia);
        $("#modalConfirmarEliminar").modal('show');
    }
    $(function() {
        $(".btnEliminar").click(doClickEliminar);
    });
</script>
@endsection

@section('estilos')
@endsection
@extends('master')

@section('content-header')
<h1>
<b>{{ $colCurso->colegio }}</b>
<small>Curso {{ $colCurso->curso }} nivel {{ $colCurso->nivelname }}</small>
</h1>
<ol class="breadcrumb">
    <li><a href="{{ url('/') }}"><i class="fa fa-dashboard"></i><b>Principal</b></a></li>
    <li class="active">Colegio</li>
</ol>
@endsection
@section('content')
<div class="row">
<div class="col-md-8">
  <div class="box box-primary">
    <div class="box-header with-border">
    <i class="fa fa-user-plus"></i>
    <h3 class="box-title">Cargar Estudiantes</h3>
    </div><!-- /.box-header -->
    <div class="box-body">            
      <form class="form-horizontal" action="{{ url('cargarUsuarios') }}" name="frmestudiantes" method="post" enctype="multipart/form-data">{{ csrf_field() }}
        <input hidden name="idcurso" value="{{ $colCurso->id }}">
        <div class="box-body">
          <div class="form-group">
            <label class="col-sm-2 control-label">Archivo</label>
          <div class="col-sm-10">
          <div class="input-group">
              <div class="input-group-addon">
                <i style="color:red" class="fa fa-file-excel-o"></i>
              </div>
            <input type="file" value="" class="form-control" id="exampleInputFile" name="archivo">
          </div>
          </div>
          </div>                
        </div><!-- /.box-body -->                              
      </form>
        <a  onclick="registrar('Guardar','¿ Esta seguro de cargar los estudiantes al curso?');" class="btn pull-right btn-info ">Cargar estudiantes</a>
        <a href="{{ url('estudiante') }}/{{ Crypt::encrypt($colCurso->id) }}" class="btn btn-primary">Registrar un estudiante</a>
    </div><!-- /.box-body -->
  </div><!-- /.box -->
  
          <div class="box box-warning collapsed-box">
            <div class="box-header with-border">
              <h3 class="box-title">LISTADO DE ESTUDIANTES</h3>

              <div class="box-tools pull-right">
                <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
                </button>
              </div>
              <!-- /.box-tools -->
            </div>
            <!-- /.box-header -->
            <div class="box-body">
    <div class="box-body table-responsive"> 
        <table class="example table table-bordered table-striped">
                <thead>
                <tr>
                  <th style="width: 100px">CI</th>
                  <th style="width: 100px">Estudiante</th>
                  <th style="width: 60px">Celular</th>
                  <th style="width: 80px">Fecha de nacimiento</th>
                  <th align="center">Acción</th>
                </tr>
                </thead>
                <tbody>
                @foreach ($estudiante as $item)
                  <tr id="{{ $item->id }}">
                    <td>{{ $item->ci }}</td>
                    <td>{{ $item->name.' '.$item->apellido }}</td>
                    <td>{{ $item->celular }}</td>
                    <td>{{ $item->fechaNacimiento }}</td>
                    <td align="center" >
                    <a class="btn btn-primary  hint--top  hint--info" aria-label="Editar" href="{{ url('updateEstudiante') }}/{{ Crypt::encrypt($item->id) }}" role="button"><i class="fa fa-edit"></i></a>                      
                      <button type="button" class="btn btn-warning  hint--top  hint--warning eliminarEstudiante" aria-label="Eliminar"><i class="fa fa-eraser"></i></button>
                    </td>
                  </tr>
                @endforeach
                
                </tbody>
                <tfoot>
                <tr>
                  <th>CI</th>
                  <th>Estudiante</th>
                  <th>Celular</th>
                  <th>Fecha de nacimiento</th>
                  <th>Acción</th>
                </tr>
                </tfoot>
        </table>
    </div>
            </div>
            <!-- /.box-body -->
          </div>
          <!-- /.box -->
<div class="box box-warning collapsed-box">
            <div class="box-header with-border">
              <h3 class="box-title">LISTADO DE DOCENTES POR MATERIA</h3>

              <div class="box-tools pull-right">
                <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
                </button>
              </div>
              <!-- /.box-tools -->
            </div>
            <!-- /.box-header -->
            <div class="box-body">
    <div class="box-body table-responsive"> 
        <table class="example table table-bordered table-striped display">
                <thead>
                <tr>
                  <th>MATERIA</th>
                  <th>DOCENTE</th>
                  <th>ACCIÓN</th>
                </tr>
                </thead>
                <tbody>
                @foreach ($materia as $item)
                  <tr id="{{ $item->idmateriacurso }}">
                    <td>{{ $item->nombre }}</td>
                    <td>
                    @if ($item->docentename == '')
                      <span class="badge bg-red">NO ASIGNADO</span>
                      @else
                      {{ $item->docentename.' '.$item->docenteapellido }}
                    @endif
                    </td>
                    <td align="center">
                    @if ($item->docente == '')
                      <a role="button" class="btn btn-success  hint--top  hint--success asignarDocente" aria-label="Asignar docente"><i class="fa  fa-plus-square"></i></a>
                      @else
                      <button type="button" class="btn btn-warning  hint--top  hint--warning asignarDocente" aria-label="Cambiar docente"><i class="fa  fa-wrench"></i></button>
                    @endif
                    </td>
                  </tr>
                @endforeach                
                </tbody>
                <tfoot>
                <tr>
                  <th>MATERIA</th>
                  <th>DOCENTE</th>
                  <th>ACCIÓN</th>
                </tr>
                </tfoot>
        </table>
    </div>
            </div>
            <!-- /.box-body -->
          </div>
          <!-- /.box -->        
</div>



<div class="col-md-4">
<div class="box box-info">
    <div class="box-header with-border">
        <h3 class="box-title">Datos del curso</h3>
    </div>
    <form role="form">
              <div class="box-body">
                <div class="form-group">
                  <label>NOMBRE</label>
                  <input type="text" class="form-control" name="nombre" value="{{ $colCurso->curso }}" >
                </div>
                <div class="form-group">
                  <label for="exampleInputPassword1">PARALELO</label>
                  <input type="text" class="form-control" name="paralelo" value="{{ $colCurso->paralelo }}">
                </div>
                <div class="form-group">
                  <label for="exampleInputFile">NIVEL</label>
                  <select class="form-control select2" style="width: 100%;" name="nivel">
                        <option selected="selected" value="{{ $colCurso->idnivel }}">{{ $colCurso->nivelname }}</option>
                        @foreach ($nivel as $item)
                            <option value="{{ $item->id }}">{{ $item->nombre }}</option>
                        @endforeach              
                    </select>  
                </div>
              </div>
              <!-- /.box-body -->
              <div class="box-footer">
                <button type="submit" class="btn btn-info pull-right">Modificar</button>
              </div>
    </form>
</div>   
</div>

</div>    


<div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
  <div class="modal-dialog ">
    <div class="modal-content">
      <div class="modal-header">                        
          <h4 class="modal-title" id="myModalLabel"></h4>
      </div>
        <div class="modal-body" id="modal-bodyku">
          {{-- content --}}
        </div>
      <div class="modal-footer" id="modal-footerq">
        <button type="button" class="btn btn-default" data-dismiss="modal">Cancelar</button><button id="enviar" class="btn btn-primary">Aceptar</button>
      </div>
    </div>
  </div>
</div>

@endsection
@section('script')
<script type="text/javascript">

$(document).ready(function() {
$(".example").DataTable({});
  

//Modificar Estudiante
    _modal = $('#myModal');
        $('.example').on('click','.eliminarEstudiante',function(e){
            e.preventDefault();
            _fila = $(this).closest('tr');
            id = _fila.attr('id');             

                    _modal.find('#myModalLabel').html('Eliminar Estudiante');
                    _modal.find('.modal-body').html('Esta seguro de eliminar el estudiante?');    
                    _modal.find('.btn-primary').unbind().bind('click',function(e){
                        e.preventDefault();
                        $.ajax({
                            type:'post',   
                            dataType: 'json',
                            url: "{{ url('deleteUser') }}",
                            data: {id:id},
                            success: function(response){
                                console.log(response);
                                _modal.modal('hide');
                                location.reload(true);
                            },
   
                        });
                    });
                    _modal.modal('show');                     
            
        });//EDN MODIFICAR ESTUDIANTE


//asignar docente
    _modal = $('#myModal');
        $('.example').on('click','.asignarDocente',function(e){
            e.preventDefault();
            _fila = $(this).closest('tr');
            id = _fila.attr('id');            
            $.ajax({
                url: "{{ url('asignarDocente') }}/"+id,
                
                success:function(response){
                    _modal.find('#myModalLabel').html('Asignar Docente');
                    _modal.find('.modal-body').html(response);    
                    _modal.find('.btn-primary').unbind().bind('click',function(e){
                        e.preventDefault();
                        $.ajax({
                            type:'post',   
                            dataType: 'json',
                            url: "{{ url('saveAsignarDocente') }}",
                            data: _modal.find('#docente').serialize(),
                            success: function(response){
                                console.log(response);
                                _modal.modal('hide');
                                location.reload(true);
                            },
                            error: function (error) {             
                   _modal.modal('hide');
              $.notify({
                        icon: 'fa fa-cog fa-spin fa-2x fa-fw',
                        title: 'Error',              
                        message: 'Ingrese los datos requeridos',            
                        },
                        {
                        type: "danger",
                      placement: {
                        from: "bottom",
                        align: "right"
                        },
                        animate: {
                        enter: 'animated bounceIn',
                        exit: 'animated bounceOut'
                       }
                    });             
                      }
                        });
                    });
                    _modal.modal('show');     
                }
            });
        });//EDN asignar docente

});

function enviar_formulario(){ 
    document.frmestudiantes.submit();
    }
</script>
@endsection

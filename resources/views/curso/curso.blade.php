@extends('master')

@section('content-header')
<h1>
<b>{{ $colCurso->colegio }}</b>
<small>Curso {{ $colCurso->curso.' '.$colCurso->paralelo }} nivel {{ $colCurso->nivelname }}</small>
</h1>
<ol class="breadcrumb">
    <li><a href="{{ url('/') }}"><i class="fa fa-dashboard"></i><b>Principal</b></a></li>
    <li class="active">Curso</li>
</ol>
@endsection


@section('content')

<div class="row">
	<div class="col-md-6">
		<div class="box box-warning">
            <div class="box-header with-border">
				<button type="button" class="btn pul btn-info btn-xs"><i class="glyphicon glyphicon-print"></i>Reporte</button>
              <h3 class="box-title"> &nbsp ESTUDIANTES</h3>
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
			                  <th>CI</th>
			                  <th>Nombre</th>                  
			                  <th>Acción</th>
			                </tr>
			                </thead>
			                <tbody>
			                @foreach ($estudiante as $item)
			                	<tr id="{{ $item->iduser }}">
			                		<td style="width: 20px">{{ $item->ci }}</td>
			                		<td>{{ $item->name.' '.$item->apellido }}</td>
			                		<td align="center">			                		
			                		@if (isset($item->idhistorial))
                          @permission('registrarNota')
			                			<span class="hint--top  hint--info" aria-label="Registrar notas">
			                				<a href="{{ url('registrarNota') }}/{{ Crypt::encrypt($item->iduser) }}" role="button" class="btn btn-primary btn-sm registrarNota"><i class="glyphicon glyphicon-pencil"></i></a>
			                			</span>
                          @endpermission
			                			<span class="hint--top  hint--i" aria-label="Ver notas">
			                				<button type="button" class="btn btn-info btn-sm"><i class="glyphicon glyphicon-search"></i></button>
			                			</span>
			                		@endif
			                		@if (is_null($item->idhistorial))
			                			<span class="hint--top  hint--warning" aria-label="Crear Agenda">
			                				<button type="button" class="createAgenda btn btn-warning btn-sm"><i class="glyphicon glyphicon-folder-open"></i></button>
			                			</span>
			                		@endif
			                		</td>
			                	</tr>
			                @endforeach
			                </tbody>
			                <tfoot>
			                <tr>
			                  <th>CI</th>
			                  <th>Nombre</th>                  
			                  <th>Acción</th>
			                </tr>
			                </tfoot>
			        </table>
      			</div>
            </div>
            <!-- /.box-body -->
          </div>
	</div>

	<div class="col-md-6">
		<div class="box box-warning">
            <div class="box-header with-border">
				<button type="button" class="btn pul btn-info btn-xs"><i class="glyphicon glyphicon-print"></i>Reporte</button>
              <h3 class="box-title"> &nbsp MATERIAS</h3>
              <div class="box-tools pull-right">
                <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
                </button>
              </div>
              <!-- /.box-tools -->
            </div>
            <!-- /.box-header -->
            <div class="box-body">
              
            </div>
            <!-- /.box-body -->
          </div>
	</div>
</div>{{-- END ROW --}}

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
{{-- END CONTET --}}
@section('script')
<script type="text/javascript">
$(document).ready(function() {
	$(".example").DataTable({});
	_modal = $('#myModal');
	//crear historial
   $('.example').on('click','.createAgenda',function(e){
            e.preventDefault();
            _fila = $(this).closest('tr');
            id = _fila.attr('id');
                    _modal.find('#myModalLabel').html('Crear Agenda');
                    _modal.find('.modal-body').html('Esta seguro de crear la agenda?');    
                    _modal.find('.btn-primary').unbind().bind('click',function(e){
                        e.preventDefault();
                        $.ajax({
                            type:'post',   
                            dataType: 'json',
                            url: "{{ url('createAgenda') }}",
                            data: {iduser:id},
                            success: function(response){
                                console.log(response);
                                _modal.modal('hide');
                                location.reload(true);
                            },
   
                        });
                    });
                    _modal.modal('show');                     
            
        });//EDN crear historial   
});
</script>
@endsection
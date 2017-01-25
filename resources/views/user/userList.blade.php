@extends('master')

@section('content-header')
<h1>
<b>Roles & Permisos</b>
<small>de usuarios</small>
</h1>
<ol class="breadcrumb">
    <li><a href="{{ url('/') }}"><i class="fa fa-dashboard"></i><b>Principal</b></a></li>
    <li class="active">Roles & Permisos</li>
</ol>
@endsection


@section('content')

<div class="row">
	<div class="col-md-6">
	<div class="box box-primary box-solid">
	    <div class="box-header"><h3 class="box-title">LISTA DE USUARIOS</h3></div>            
	    <div class="box-body table-responsive">
			<table class="example table table-bordered table-striped">
                <thead>                
                <tr>
                  	<th style="width: 100px">CI</th>
                  	<th style="width: 100px">USUARIO</th>                  
                  	<th style="width: 80px">ROL</th>
                  	<th align="center">ACCIÓN</th>
                </tr>
                </thead>
                <tbody>
                @foreach ($user as $item)
                <tr id="{{ $item->iduser }}">
                	<td>{{ $item->ci }}</td>
                	<td>{{ $item->name.' '.$item->apellido }}</td>
                	<td>
                	@if ($item->display_name == '')
                		<span class="badge bg-orange">No asignado</span>
                		@else
                		<span class="badge bg-green">{{ $item->display_name }}</span>
                	@endif
                	</td>
                	<td align="center">
                	@if ($item->idrol != '')
                		<a class="btn btn-warning modificarRol hint--top  hint--warning" aria-label="Modificar rol" href="#" role="button">
                			<i class="glyphicon glyphicon-wrench"></i>
                		</a>
                		@else
                		<a class="btn btn-primary asignarRol hint--top  hint--info" aria-label="Asignar rol" href="#" role="button">
                			<i class="glyphicon glyphicon-list-alt"></i>
                		</a>
                	@endif
                	</td>		
                </tr>
                @endforeach
                </tbody>
            </table>
	    </div>
	</div>
	</div>

	<div class="col-md-6">
	<div class="box box-primary box-solid">
	    <div class="box-header"><h3 class="box-title">ROLES & PERMISOS</h3></div>            
	    <div class="box-body table-responsive">
	    	<div class="input-group">
                <div class="input-group-btn">
                  <button type="button" class="btn btn-success crearRol"><i class="glyphicon glyphicon-list-alt"></i>&nbsp  Crear Rol</button>
                </div>
                <!-- /btn-group -->
                <input type="text" class="form-control" id="nameRol" placeholder="Nombre del rol">
            </div><br>
            <table class="example table table-bordered table-striped">
                <thead>
                <tr>
                  <th style="width: 200px">ROL</th>
                  <th style="width: 5px">PERMISOS</th>                  
                </tr>
                </thead>
                <tbody>
                @foreach ($rol as $item)
                <tr id="{{ $item->id }}">
                	<td>{{ $item->display_name }}</td>
                	<td align="center">
                		<a class="btn btn-primary btn-sm permisos hint--top  hint--info" aria-label="Asignar permisos" href="#" role="button">
                			<i class="glyphicon glyphicon-th"></i>
                		</a>
                	</td>               	
                </tr>		
                @endforeach
                </tbody>
            </table>
	    </div>
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

<div class="modal fade" id="myModal1" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
  <div class="modal-dialog ">
    <div class="modal-content">
      <div class="modal-header">                        
          <h4 class="modal-title" id="myModalLabel"></h4>
      </div>
        <div class="modal-body" id="modal-bodyku">
          {{-- content --}}
        </div>
      <div class="modal-footer" id="modal-footerq">
        <button type="button" class="btn btn-primary" data-dismiss="modal">Aceptar</button>
      </div>
    </div>
  </div>
</div>

@endsection
@section('script')
<script type="text/javascript">
$(document).ready(function() {
	$(".example").DataTable({});
	_modal = $('#myModal');
	_modal1 = $('#myModal1');
//CREAR ROL
$('.crearRol').unbind().bind('click',function(e){
    e.preventDefault();
    nameRol = $('#nameRol').val();
    if(nameRol != '')
    {
        _modal.find('#myModalLabel').html('Crear Rol ');
        _modal.find('.modal-body').html('<p class="text-yellow">Esta seguro de crear el rol..?</p>');    
		_modal.find('.btn-primary').unbind().bind('click',function(e){
		e.preventDefault();
			$.ajax({
					type:'post',   
                    dataType: 'json',
                    url: "{{ url('saveRol') }}",
                    data: {nameRol:nameRol},
                   		success: function(response){
                        	console.log(response);
                        	_modal.modal('hide');
                        	location.reload(true);
                    	},
                    });
        });
        	_modal.modal('show');
    }
});//EDN CREAR ROL

//PERMISOS    
        $('.permisos').unbind().bind('click',function(e){
            e.preventDefault();
           	_fila = $(this).closest('tr');
            idRol = _fila.attr('id');
            $.ajax({
                url: "{{ url('permisos') }}/"+idRol,
                
                success:function(response){
                    _modal1.find('#myModalLabel').html('PERMISOS DEL ROL');
                    _modal1.find('.modal-body').html(response);
                    _modal1.modal('show');
                }
            });
        });//EDN PERMISOS
//ASIGNAR ROL
$('.example').on('click','.asignarRol',function(e){
            e.preventDefault();
           	_fila = $(this).closest('tr');
            iduser = _fila.attr('id');         	
            $.ajax({
                url: "{{ url('asignarRol') }}/"+iduser,
                
                success:function(response){
                    _modal.find('#myModalLabel').html('Asignar Rol');
                    _modal.find('.modal-body').html(response);    
                    _modal.find('.btn-primary').unbind().bind('click',function(e){
                        e.preventDefault();
                        $.ajax({
                            type:'post',   
                            dataType: 'json',
                            url: "{{ url('asignarRol') }}",
                            data: _modal.find('#rol').serialize(),
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
        });
//END ASIGNAR ROL

//MODIFICAR ROL
$('.example').on('click','.modificarRol',function(e){
            e.preventDefault();
           	_fila = $(this).closest('tr');
            iduser = _fila.attr('id');         	
            $.ajax({
                url: "{{ url('asignarRol') }}/"+iduser,                
                success:function(response){
                    _modal.find('#myModalLabel').html('Modificar Rol');
                    _modal.find('.modal-body').html(response);    
                    _modal.find('.btn-primary').unbind().bind('click',function(e){
                        e.preventDefault();
                        $.ajax({
                            type:'post',   
                            dataType: 'json',
                            url: "{{ url('modificarRol') }}",
                            data: _modal.find('#rol').serialize(),
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
        });
//END ASIGNAR ROL


});
</script>
@endsection
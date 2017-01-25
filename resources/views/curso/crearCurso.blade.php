@extends('master')

@section('content-header')
<h1>
<b>{{ $colegio->nombre }}</b>
<small>Administracion</small>
</h1>
<ol class="breadcrumb">
    <li><a href="{{ url('/') }}"><i class="fa fa-dashboard"></i><b>Principal</b></a></li>
    <li class="active">Colegio</li>
</ol>
@endsection
@section('content')
<div class="row">
<div class="col-md-12">
	<div class="box box-primary">
		<div class="box-body si-padding">
			@permission('createCurso')
            <div class="col-lg-3 col-xs-6">          
				<div class="small-box bg-aqua">
        			<div class="inner">
            			<h3>CREAR</h3>
            			<h4><b>CURSO</b></h4>
        			</div>
    				<div class="icon"><i class="ion ion-easel"></i></div>
       				<a href="#" id="{{ $colegio->idColegio }}" class="crearCurso small-box-footer">Continuar <i class="fa fa-arrow-circle-right"></i></a>
    			</div>
			</div>
            @endpermission
            @permission('createMateria')
			<div class="col-lg-3 col-xs-6">          
				<div class="small-box bg-yellow">
        			<div class="inner">
            			<h3>CREAR</h3>
            			<h4><b>MATERIA</b></h4>
        			</div>
    				<div class="icon"><i class="ion ion-ios-bookmarks"></i></div>
       				<a href="#" id="{{ $colegio->idColegio }}" class="crearMateria small-box-footer">Continuar <i class="fa fa-arrow-circle-right"></i></a>
    			</div>
			</div>
            @endpermission
            @permission('createDocentes')
			<div class="col-lg-3 col-xs-6">          
				<div class="small-box bg-green">
        			<div class="inner">
            			<h3>REGISTRAR</h3>
            			<h4><b>DOCENTE</b></h4>
        			</div>
    				<div class="icon"><i class="ion ion-person-add"></i></div>
       				<a href="{{ url('registrarDocente') }}/{{ Crypt::encrypt($colegio->idColegio) }}" class="small-box-footer">Continuar <i class="fa fa-arrow-circle-right"></i></a>
    			</div>
			</div>
            @endpermission
		</div>
	</div>
</div>{{-- END COL --}}
</div>{{-- END ROW collapsed-box--}}
<div class="row">
<div class="col-md-6">
<div class="box box-warning  box-solid collapsed-box">
    <div class="box-header with-border">
        <h3 class="box-title" id="botones">Cursos nivel primario   </h3>
        <div class="box-tools pull-right">
            <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
        </div>
        <!-- /.box-tools -->
    </div>
    <!-- /.box-header -->
    <div class="box-body table-responsive">        
        <table id="" class="example table table-bordered table-striped">
                <thead>
                <tr>
                  <th style="width: 100px">Curso</th>
                  <th style="width: 20px">Paralelo</th>
                  @permission('asignarMateria')
                  <th>Asignar Materias</th>
                  @endpermission
                  @permission('adminCurso')
                  <th>Administar</th>
                  @endpermission
                </tr>
                </thead>
                <tbody>
                @foreach ($primario as $item)
                <tr id="{{ $item->id }}">
                	<td align="center" >{{ $item->curso }}</td>
                  	<td align="center" >
                       <a class="btn btn-social-icon btn-flickr"><i>{{ $item->paralelo }}</i></a> 
                    </td>
                    @permission('asignarMateria')
                  	<td align="center">
                       <span class="hint--top  hint--info" aria-label="asignar materias"><a href="{{ url('asignarMateria') }}/{{ Crypt::encrypt($item->id) }}" class="btn btn-social-icon btn-twitter"><i class="ion ion-ios-bookmarks"></i></a></span>
                    </td>
                    @endpermission
                    @permission('adminCurso')
                    <td align="center">
                        <a href="{{ url('administrarCurso') }}/{{ Crypt::encrypt($item->id) }}" class="btn btn-social-icon btn-warning"><i class="ion ion-android-settings"></i></a>
                    </td>
                    @endpermission
                </tr>                      
                @endforeach
                </tbody>
                <tfoot>
                <tr>
                  <th>Curso</th>
                  <th>Paralelo</th>
                  @permission('asignarMateria')
                  <th>Asignar Materias</th>
                  @endpermission
                  @permission('adminCurso')
                  <td>Administar</td> 
                  @endpermission
                </tr>
                </tfoot>
        </table>
    </div>
    <!-- /.box-body -->
</div>                  
</div>{{-- END COL --}}
<div class="col-md-6">
<div class="box box-primary collapsed-box box-solid">
    <div class="box-header with-border">
        <h3 class="box-title" id="botones">Materias nivel primario   </h3>
        <div class="box-tools pull-right">
            <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
        </div>
        <!-- /.box-tools -->
    </div>
    <!-- /.box-header -->
    <div class="box-body">
    @foreach ($materiaPrimaria as $item)        
        <a href="#" onclick="modificarMateria({{ $item->idmateria }})" class="modificarMateria btn btn-app">
            <i class="ion ion-ios-bookmarks text-info"></i> <b>{{ $item->nombre }}</b>
        </a>
    @endforeach
    </div>
    <!-- /.box-body -->
</div>                  
</div>{{-- END COL --}}
</div>{{-- END ROW --}}

<div class="row">
<div class="col-md-6">
<div class="box box-warning collapsed-box box-solid">
    <div class="box-header with-border">
        <h3 class="box-title" id="botones2">Cursos nivel secundario  </h3>
        <div class="box-tools pull-right">
            <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
        </div>
        <!-- /.box-tools -->
    </div>
    <!-- /.box-header -->
    <div class="box-body table-responsive"> 
        <table class="example table table-bordered table-striped">
                <thead>
                <tr>
                  <th style="width: 100px">Curso</th>
                  <th style="width: 20px">Paralelo</th>
                  @permission('asignarMateria')
                  <th>Asignar Materias</th>
                  @endpermission
                  @permission('adminCurso')
                  <th>Administar</th>
                  @endpermission
                </tr>
                </thead>
                <tbody>
                @foreach ($secundario as $item)
                <tr id="{{ $item->id }}">
                    <td align="center" >{{ $item->curso }}</td>
                    <td align="center" >
                       <a class="btn btn-social-icon btn-flickr"><i>{{ $item->paralelo }}</i></a> 
                    </td>
                    @permission('asignarMateria')
                    <td align="center">
                       <span class="hint--top  hint--info" aria-label="asignar materias"><a href="{{ url('asignarMateria') }}/{{ Crypt::encrypt($item->id) }}" class="btn btn-social-icon btn-twitter"><i class="ion ion-ios-bookmarks"></i></a></span>
                    </td>
                    @endpermission
                    @permission('adminCurso')
                    <td align="center">
                         <a href="{{ url('administrarCurso') }}/{{ Crypt::encrypt($item->id) }}" class="btn btn-social-icon btn-warning"><i class="ion ion-android-settings"></i></a>
                    </td>
                    @endpermission
                </tr>             
                @endforeach
                </tbody>
                <tfoot>
                <tr>
                  <th>Curso</th>
                  <th>Paralelo</th>
                  @permission('asignarMateria')
                  <th>Asignar Materias</th>
                  @endpermission
                  @permission('adminCurso')
                  <td>Administar</td> 
                  @endpermission
                </tr>
                </tfoot>
              </table>
    </div>
    <!-- /.box-body -->
</div>
</div>{{-- END COL --}}


<div class="col-md-6">
<div class="box box-primary collapsed-box box-solid">
    <div class="box-header with-border">
        <h3 class="box-title" id="botones">Materias nivel secundario   </h3>
        <div class="box-tools pull-right">
            <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
        </div>
        <!-- /.box-tools -->
    </div>
    <!-- /.box-header -->
    <div class="box-body">
    @foreach ($materiaSecundaria as $item)        
        <a href="#" onclick="modificarMateria({{ $item->idmateria }})" class="modificarMateria btn btn-app">
            <i class="ion ion-ios-bookmarks text-info"></i> <b>{{ $item->nombre }}</b>
        </a>              
    @endforeach                
    </div>
    <!-- /.box-body -->
</div>                  
</div>{{-- END COL --}}

</div>{{-- END ROW --}}
<!-- Modal form-->
    <div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
        <div class="modal-dialog ">
            <div class="modal-content">
                <div class="modal-header">
			
                    
                    <h4 class="modal-title" id="myModalLabel"></h4>
                </div>
            <div class="modal-body" id="modal-bodyku">

            </div>
            <div class="modal-footer" id="modal-footerq">
            <button type="button" class="btn btn-default" data-dismiss="modal">Cancelar</button><button id="enviar" class="btn btn-primary">Registrar</button>
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

            </div>
            <div class="modal-footer" id="modal-footerq">
            <button type="button" class="btn btn-default" data-dismiss="modal">Cancelar</button>
            <button id="enviar" class="btn btn-danger">Eliminar</button>
            <button id="enviar" class="btn btn-primary">Modificar</button>
            </div>
            </div>
        </div>
    </div>
    <!-- end of modal -->
@endsection
@section('script')
<script type="text/javascript">
//MODIFICAR Materia
_modal1 = $('#myModal1');
    function modificarMateria(idCurso){    
         $.ajax({
                url: "{{ url('modificarMateria') }}/"+idCurso,
                
                success:function(response){
                    _modal1.find('#myModalLabel').html('Administrar materia');
                    _modal1.find('.modal-body').html(response);    
                    _modal1.find('.btn-primary').unbind().bind('click',function(e){
                        e.preventDefault();
                        $.ajax({
                            type:'post',   
                            dataType: 'json',
                            url: "{{ url('updatemateria') }}",
                            data: _modal1.find('#materia').serialize(),
                            success: function(response){
                                console.log(response);
                                _modal1.modal('hide');
                                location.reload(true);
                            },
                            error: function (error) {                           
                                 _modal1.modal('hide');
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
                    _modal1.find('.btn-danger').unbind().bind('click',function(e){
                        e.preventDefault();
                        $.ajax({
                            type:'post',   
                            dataType: 'json',
                            url: "{{ url('deleteMateria') }}",
                            data: _modal1.find('#materia').serialize(),
                            success: function(response){
                                console.log(response);
                                _modal1.modal('hide');
                                location.reload(true);
                            },
                            error: function (error) {                           
                                 _modal1.modal('hide');
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
                    _modal1.modal('show');     
                }
            });    
    }//EDN MODIFICAR MATERIA
$(document).ready(function() {
    $(".example").DataTable();
    
    //Crear Curso
    _modal = $('#myModal');
        $('.crearCurso').unbind().bind('click',function(e){
            e.preventDefault();
           	id = $('.crearCurso').attr('id');           	
            $.ajax({
                url: "{{ url('frmcurso') }}/"+id,
                
                success:function(response){
                    _modal.find('#myModalLabel').html('Crear Curso');
                    _modal.find('.modal-body').html(response);    
                    _modal.find('.btn-primary').unbind().bind('click',function(e){
                        e.preventDefault();
                        $.ajax({
                            type:'post',   
                            dataType: 'json',
                            url: "{{ url('curso') }}",
                            data: _modal.find('#curso').serialize(),
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
        });//EDN CREAR CURSO


            //Crear Materia    
        $('.crearMateria').unbind().bind('click',function(e){
            e.preventDefault();
           	id = $('.crearMateria').attr('id');           	
            $.ajax({
                url: "{{ url('frmmateria') }}/"+id,
                
                success:function(response){
                    _modal.find('#myModalLabel').html('Crear materia');
                    _modal.find('.modal-body').html(response);    
                    _modal.find('.btn-primary').unbind().bind('click',function(e){
                        e.preventDefault();
                        $.ajax({
                            type:'post',   
                            dataType: 'json',
                            url: "{{ url('materia') }}",
                            data: _modal.find('#materia').serialize(),
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
        });//EDN CREAR MATERIA

        

});


</script>
@endsection
{{-- END CONTET --}}
{{-- <div class="box box-primary">
    <div class="box-body si-padding">
    </div>
    </div> --}}
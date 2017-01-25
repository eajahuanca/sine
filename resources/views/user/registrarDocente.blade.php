@extends('master')

@section('content-header')
<h1>
<b>Registrar Docente</b>
<small>registrar nuevo usuario</small>
</h1>
<ol class="breadcrumb">
    <li><a href="{{ url('/') }}"><i class="fa fa-dashboard"></i><b>Principal</b></a></li>    
    <li class="active">Registrar usuario</li>
</ol>
@endsection

{{--START TITULO --}}
@section('contentheader_title')
<h1>
  <b>Crear Colegio</b>
    <small>nuevo colegio</small>
</h1>
<ol class="breadcrumb">
    <li><a href="#"><i class="glyphicon glyphicon-home"></i><b>Principal</b></a></li>
    <li class="active">crear colegio</li>
</ol>
@endsection
{{-- END TITULO --}}

{{-- START CONTENT --}}
@section('content')
<div class="row">
<div class="col-md-12 box-body">
    <div class="box box-body box-primary">
    <div class="box-header with-border">
    <i class="fa fa-user-plus"></i>
    <h3 class="box-title">Cargar Docentes</h3>
    </div><!-- /.box-header -->
    <div class="box-body">
      <form class="form-horizontal" action="{{ url('cargarDocente') }}" name="frmdocente" method="post" enctype="multipart/form-data">{{ csrf_field() }}
        <input hidden name="idcolegio" value="{{ $idcolegio }}">
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
          <div class="form-group">
            <label class="col-sm-2 control-label">Nivel</label>

          <div class="col-sm-10">
            <select class="form-control" style="width: 100%;" name="nivel" >
                <option selected="selected"></option>
                @if (isset($niveles))
                    @foreach ($niveles as $item)
                    <option value="{{ $item->id }}">{{ $item->nombre }}</option>
                    @endforeach
                @else
                    <option value="{{ $nivel }}">
                @if ($nivel==1)
                    Primario
                @else
                    Secundario
                @endif
                    </option>
                @endif
            </select>
          </div>
          </div>

        </div><!-- /.box-body -->                              
      </form>
        <a  onclick="registrarDocente('Guardar','¿ Esta seguro de cargar los docentes?');" class="btn pull-right btn-info ">Cargar docentes</a>        
    </div><!-- /.box-body -->
  </div><!-- /.box -->
</div>
</div>
<div class="row">

		<div class="col-md-6">
                <div class="box box-primary">
                    <div class="box-body si-padding">
                        <fieldset>
                            <legend>Datos Personales</legend>
                            <form action="{{ url('saveDocente') }}" method="post" enctype="multipart/form-data" name="frmusuario">
                            {{ csrf_field() }}
                            <input hidden name="idcolegio" value="{{ $idcolegio }}">
                            <label><span style="color:red">*</span> CI :</label>
                            <div class="input-group">
                                <div class="input-group-addon">
                                <i class="glyphicon glyphicon-credit-card"></i>
                                </div>
                                <input type="text" class="form-control" value="{{ old('ci') }}" placeholder="Nro de carnet.." name="ci"/>
                            </div>

                            <label><span style="color:red">*</span> Nombres :</label>
                            <div class="input-group">
                                <div class="input-group-addon">
                                <i class="glyphicon glyphicon-user"></i>
                                </div>
                                <input type="text" class="form-control" value="{{ old('nombre') }}" placeholder="Nombres.." name="nombre"/>
                            </div>                            

                            <label><span style="color:red">*</span> Apellidos :</label>
                            <div class="input-group">
                                <div class="input-group-addon">
                                <i class="glyphicon glyphicon-user"></i>
                                </div>
                                <input type="text" class="form-control" value="{{ old('apellido') }}" placeholder="Apellidos.." name="apellido"/>
                            </div>

                            <label>Fecha de nacimiento :</label>
                            <div class="input-group">
                              <div class="input-group-addon">
                                <i class="fa fa-calendar"></i>
                              </div>
                              <input type="text" value="{{ old('fechaNacimiento') }}" class="form-control" data-inputmask="'alias': 'yyyy/mm/dd'" data-mask name="fechaNacimiento">
                            </div>                            

                            <div class="form-group">
                				<label>Telefono:</label>
	                			<div class="input-group">
	                  				<div class="input-group-addon">
		                    			<i class="fa fa-phone"></i>
	                  				</div>
	                  				<input type="text" name="telefono" value="{{ old('telefono') }}" class="form-control" data-inputmask='"mask": "(999) 999-99"' data-mask>
	                			</div>                
              				</div>

              				<div class="form-group">
                				<label>Celular:</label>
	                			<div class="input-group">
	                  				<div class="input-group-addon">
		                    			<i class="fa fa-mobile-phone"></i>
	                  				</div>
	                  				<input type="text" value="{{ old('celular') }}" name="celular" class="form-control" data-inputmask='"mask": "(999) 999-99"' data-mask>
	                			</div>                
              				</div>

                            <label><span style="color:red">*</span> Genero :</label>
                            <div class="form-group">                
				                <select class="form-control" style="width: 100%;" name="genero" >
				                  <option selected="selected"></option>
				                  <option value="Masculino">Masculino</option>
				                  <option value="Femenino">Femenino</option>                  
				                </select>
             				 </div>
                        </fieldset>
                    </div>
                </div>
                        <a  onclick="registrar('Guradar','¿ Esta seguro de crear el colegio?');" class="btn btn-block btn-primary btn-lg"><i class="fa fa-pencil"></i> Registrar Usuario</a>
            </div>
            


            <div class="col-md-6">
                <div class="box box-primary">
                <div class="box-body si-padding">
                        <fieldset>
                            <legend>Datos Generales</legend>
                           
                            <label><span style="color:red">*</span> Email :</label>
                            <div class="input-group">
                                <div class="input-group-addon">
                                <i class=""><b>@</b></i>
                                </div>
                                <input type="text" class="form-control" value="{{ old('email') }}" placeholder="email.." name="email"/>
                            </div>                           

                            <label><span style="color:red">*</span> Password :</label>
                            <div class="input-group">
                                <div class="input-group-addon">
                                <i class="fa fa-key"></i>
                                </div>
                                <input type="password" class="form-control" name="password"/>
                            </div>

                            <label><span style="color:red">*</span> Confirmar Password :</label>
                            <div class="input-group">
                                <div class="input-group-addon">
                                <i class="fa fa-key"></i>
                                </div>
                                <input type="password" class="form-control"   name="password_confirmation"/>
                            </div>                            
                          
                            <label> Dirección</label>
                            <div class="input-group">
                              <div class="input-group-addon">
                                <i class="fa fa-tasks"></i>
                              </div>
                              <textarea class="form-control" rows="3" placeholder="Dirección ..." name="direccion">
                                {{ old('direccion') }}
                              </textarea>
                            </div>
                            

                          <label><span style="color:red">*</span> Nivel :</label>
                            <div class="form-group">                
				                <select class="form-control" style="width: 100%;" name="nivel" >
				                  <option selected="selected"></option>
				                    @if (isset($niveles))
                                        @foreach ($niveles as $item)
                                          <option value="{{ $item->id }}">{{ $item->nombre }}</option>
                                        @endforeach
                                        @else
                                          <option value="{{ $nivel }}">
                                          @if ($nivel==1)
                                            Primario
                                          @else
                                            Secundario
                                          @endif
                                          </option>
                                    @endif
				                </select>
             				 </div>                        
							
						<label><span style="color:red">*</span> Tipo :</label>
                            <div class="form-group">                
				                <select class="form-control" style="width: 100%;" name="tipo" >
				                  <option selected="selected" value="Docente">Docente</option>
				                </select>
             				 </div>                        
                            </form>
                        </fieldset>
                    </div>
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
            </div>
            <div class="modal-footer" id="modal-footerq">
            </div>
            </div>
        </div>
</div>

<script type="text/javascript">
  function registrarDocente(title,content){
            var size='standart';
            var title = '<b>'+title+'</b>';
            var content = content;
            var footer = 
            '<button type="button" class="btn btn-default" data-dismiss="modal">Cancelar</button><button type="submit" onclick="enviar_formulario1();" class="btn btn-primary">Registrar</button>';
            setModalBox(title,content,footer,size);
            $('#myModal').modal('show');
            }
        function setModalBox(title,content,footer,$size)
        {
            document.getElementById('modal-bodyku').innerHTML=content;
            document.getElementById('myModalLabel').innerHTML=title;
            document.getElementById('modal-footerq').innerHTML=footer;

            if($size == 'standart')
            {
                $('#myModal').attr('class', 'modal fade')
                             .attr('aria-labelledby','myModalLabel');
                $('.modal-dialog').attr('class','modal-dialog');
            }

        }
</script>
<script type="text/javascript">
    function enviar_formulario(){ 
    document.frmusuario.submit();
    }
    function enviar_formulario1(){ 
    document.frmdocente.submit();
    }
</script>
@endsection
{{-- END CONTET --}}




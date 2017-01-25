@extends('master')

@section('content-header')
<h1>
<b>{{ $colCurso->colegio }}</b>
<small>Curso {{ $colCurso->curso.' '.$colCurso->paralelo }} nivel {{ $colCurso->nivelname }}</small>
</h1>
<ol class="breadcrumb">
    <li><a href="{{ url('/') }}"><i class="fa fa-dashboard"></i><b>Principal</b></a></li>    
    <li class="active">Registrar usuario</li>
</ol>
@endsection


{{-- START CONTENT --}}
@section('content')
	<div class="row">

		<div class="col-md-6">
                <div class="box box-primary">
                    <div class="box-body si-padding">
                        <fieldset>
                            <legend>Datos personales del estudiante</legend>
                            <form action="{{ url('estudiante') }}" method="post" enctype="multipart/form-data" name="frmusuario">
                            {{ csrf_field() }}
                            <input hidden name="idColegio" value="{{ $colCurso->idColegio }}">
                            <input hidden name="idCurso" value="{{ $colCurso->id }}">
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
                            
                            <label> Foto del usuario :</label>
                            <div class="input-group">
                              <div class="input-group-addon">
                                <i class="glyphicon glyphicon-picture"></i>
                              </div>
                              <input type="file" value="{{ old('imagen') }}" class="form-control" id="exampleInputFile" name="imagen">
                            </div>

                          <label><span style="color:red">*</span> Nivel :</label>
                            <div class="form-group">                
				                <select class="form-control" style="width: 100%;" name="nivel" >
				                  <option selected="selected" value="{{ $colCurso->idNivel }}">{{ $colCurso->nivelname }}</option>
				                  
				                </select>
             				 </div>                        
							
						<label><span style="color:red">*</span> Tipo :</label>
                            <div class="form-group">                
				                <select class="form-control" style="width: 100%;" name="tipo" >
				                  <option value="Estudiante" selected="selected">Estudiante</option>
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
    function enviar_formulario(){ 
    document.frmusuario.submit();
    }
</script>
@endsection
{{-- END CONTET --}}




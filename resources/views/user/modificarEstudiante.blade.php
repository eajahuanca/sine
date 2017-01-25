@extends('master')

@section('content-header')
<h1>
<b>MODIFICAR ESTUDIANTE</b>

</h1>
<ol class="breadcrumb">
    <li><a href="{{ url('/') }}"><i class="fa fa-dashboard"></i><b>Principal</b></a></li>    
    <li class="active">Modificar estudiante</li>
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

		<div class="col-md-6">
                <div class="box box-primary">
                    <div class="box-body si-padding">
                        <fieldset>
                            <legend>Datos Personales</legend>
                            <form action="{{ url('updateEstudiante') }}" method="post" enctype="multipart/form-data" name="frmusuario">
                            {{ csrf_field() }}
                            <input hidden name="idUser" value="{{ $user->id }}">
                            <input hidden name="idColegio" value="{{ $user->colegio }}">
                            <label><span style="color:red">*</span> CI :</label>
                            <div class="input-group">
                                <div class="input-group-addon">
                                <i class="glyphicon glyphicon-credit-card"></i>
                                </div>
                                <input type="text" class="form-control" value="{{ $user->ci }}" placeholder="Nro de carnet.." name="ci"/>
                            </div>

                            <label><span style="color:red">*</span> Nombres :</label>
                            <div class="input-group">
                                <div class="input-group-addon">
                                <i class="glyphicon glyphicon-user"></i>
                                </div>
                                <input type="text" class="form-control" value="{{ $user->name }}" placeholder="Nombres.." name="nombre"/>
                            </div>                            

                            <label><span style="color:red">*</span> Apellidos :</label>
                            <div class="input-group">
                                <div class="input-group-addon">
                                <i class="glyphicon glyphicon-user"></i>
                                </div>
                                <input type="text" class="form-control" value="{{ $user->apellido }}" placeholder="Apellidos.." name="apellido"/>
                            </div>

                            <label>Fecha de nacimiento :</label>
                            <div class="input-group">
                              <div class="input-group-addon">
                                <i class="fa fa-calendar"></i>
                              </div>
                              <input type="text" value="{{ $user->fechaNacimiento }}" class="form-control" data-inputmask="'alias': 'yyyy/mm/dd'" data-mask name="fechaNacimiento">
                            </div>                            

                            <div class="form-group">
                				<label>Telefono:</label>
	                			<div class="input-group">
	                  				<div class="input-group-addon">
		                    			<i class="fa fa-phone"></i>
	                  				</div>
	                  				<input type="text" name="telefono" value="{{ $user->telefono }}" class="form-control" data-inputmask='"mask": "(999) 999-99"' data-mask>
	                			</div>                
              				</div>

              				<div class="form-group">
                				<label>Celular:</label>
	                			<div class="input-group">
	                  				<div class="input-group-addon">
		                    			<i class="fa fa-mobile-phone"></i>
	                  				</div>
	                  				<input type="text" value="{{ $user->celular }}" name="celular" class="form-control" data-inputmask='"mask": "(999) 999-99"' data-mask>
	                			</div>                
              				</div>

                            <label><span style="color:red">*</span> Genero :</label>
                            <div class="form-group">                
				                <select class="form-control" style="width: 100%;" name="genero" >
				                  <option selected="selected" value="{{ $user->sexo }}">{{ $user->sexo }}</option>
				                  <option value="Masculino">Masculino</option>
				                  <option value="Femenino">Femenino</option>                  
				                </select>
             				 </div>
                        </fieldset>
                    </div>
                </div>                       
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
                                <input type="text" class="form-control" value="{{ $user->email }}" placeholder="email.." name="email"/>
                            </div>                           

                            <label> Password :</label>
                            <div class="input-group">
                                <div class="input-group-addon">
                                <i class="fa fa-key"></i>
                                </div>
                                <input type="password" class="form-control" name="password"/>
                            </div>

                            <label> Confirmar Password :</label>
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
                              <textarea class="form-control" rows="3" placeholder="Dirección ..." name="direccion">{{ $user->direccion }}</textarea>
                            </div>
                            </form>
                        </fieldset>
                    </div>
                </div>
                 <a  onclick="registrar('Guradar','¿ Esta seguro de actualizar los datos?');" class="btn btn-block btn-primary btn-lg"><i class="fa fa-pencil"></i> Actualizar datos</a>
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




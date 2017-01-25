@extends('master')

@section('content-header')
<h1>
<b>BIEN VENIDO AL SISTEMA</b>
<small>Director</small>
</h1>
<ol class="breadcrumb">
    <li><a href="#"><i class="fa fa-dashboard"></i><b>Principal</b></a></li>
    <li class="active">Pagina principal</li>
</ol>
@endsection


@section('content')

<div class="row">
<div class="col-md-5">
	<div class="box box-primary box-body si-padding">
		<div class="box-body box-profile">
              <img class="profile-user-img img-responsive img-circle" src="{{ URL::asset($colegio->logo) }}" alt="User profile picture">

              <h3 class="profile-username text-center">{{ $colegio->colegio }}</h3>

              <p class="text-muted text-center">{{ $colegio->descripcion }}</p>

              <ul class="list-group list-group-unbordered">
                <li class="list-group-item">
                  <b>Director</b> <a class="pull-right">{{ Auth::user()->name.' '.Auth::user()->apellido }}</a>
                </li>
                <li class="list-group-item">
                  <b>Nivel</b> <a class="pull-right">{{ $colegio->nivelname }}</a>
                </li>
                <li class="list-group-item">
                  <b>Direccion</b> <a class="pull-right">{{ $colegio->ubicacion }}</a>
                </li>
                <li class="list-group-item">
                  <b>Telefono</b> <a class="pull-right">{{ $colegio->telefono }}</a>
                </li>
                <li class="list-group-item">
                  <b>Total Docentes</b> <a class="pull-right">26</a>
                </li>
                <li class="list-group-item">
                  <b>Total Estudiantes</b> <a class="pull-right">100</a>
                </li>
                <li class="list-group-item">
                  <b>Total Cursos</b> <a class="pull-right">25</a>
                </li>
              </ul>

              <a href="{{ url('curso') }}/{{ Crypt::encrypt($colegio->idcolegio) }}" class="btn btn-primary btn-block"><b>Administrar colegio</b></a>
            </div>
	</div>
</div>
  
</div>{{-- END ROW --}}

@endsection
{{-- END CONTET --}}
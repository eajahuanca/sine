@extends('master')

@section('content-header')
<h1>
<b>{{ $colegio->nombre }}</b>
<small>Panel General</small>
</h1>
<ol class="breadcrumb">
    <li><a href="{{ url('/') }}"><i class="fa fa-dashboard"></i><b>Principal</b></a></li>
    <li class="active">Colegio</li>
</ol>
@endsection


@section('content')
<div class="row">
<div class="col-md-5">
	<div class="box box-primary">
    <div class="box-body si-padding">
		<div class="box-body box-profile">
              <img class="profile-user-img img-responsive img-circle" src="{{ URL::asset($colegio->logo) }}" alt="User profile picture">

              <h3 class="profile-username text-center">{{ $colegio->nombre }}</h3>

              <p class="text-muted text-center">{{ $colegio->descripcion }}</p>

              <ul class="list-group list-group-unbordered">
                <li class="list-group-item">
                  <b>Director</b> <a class="pull-right">{{ $colegio->username.' '.$colegio->apellido }}</a>
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

              <a href="{{ url('curso') }}/{{ Crypt::encrypt($colegio->idColegio) }}" class="btn btn-primary btn-block"><b>Administrar colegio</b></a>
            </div>
    </div>
    </div>
</div>{{-- END COL --}}

<div class="col-md-7">
  <div class="box box-primary collapsed-box box-solid">
    <div class="box-header with-border">
      <h3 class="box-title"><i class="fa  fa-institution"></i>&nbsp Cursos nivel primario</h3>
      <div class="box-tools pull-right">
        <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-plus"></i></button>
      </div>  
    </div>    
    <div class="box-body">
      <div class="box-body table-responsive"> 
        <table class="example table table-bordered table-striped">
                <thead>
                <tr>
                  <th>Curso</th>
                  <th>Paralelo</th>                  
                  <th>Ver</th>
                </tr>
                </thead>
                <tbody>
                @foreach ($primario as $item)
                <tr id="{{ $item->id }}">
                  <td align="center" >{{ $item->curso }}</td>
                    <td align="center" >
                       <a class="btn btn-social-icon btn-flickr"><i>{{ $item->paralelo }}</i></a> 
                    </td>
                    <td align="center">
                        <a href="{{ url('detalleCurso') }}/{{ Crypt::encrypt($item->id) }}" class="btn btn-social-icon btn-warning"><i class="glyphicon glyphicon-search"></i></a>
                    </td> 
                </tr>                      
                @endforeach
                </tbody>
                <tfoot>
                <tr>
                  <th>Curso</th>
                  <th>Paralelo</th>                  
                  <td>Ver</td> 
                </tr>
                </tfoot>
        </table>
      </div>
    </div>  
  </div>
</div>

<div class="col-md-7">
  <div class="box box-primary collapsed-box box-solid">
    <div class="box-header with-border">
      <h3 class="box-title"><i class="fa  fa-group"></i>&nbsp Docentes nivel primario</h3>
      <div class="box-tools pull-right">
        <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-plus"></i></button>
      </div>  
    </div>    
    <div class="box-body">
      The body of the box
    </div>  
  </div>
</div>

<div class="col-md-7">
  <div class="box box-primary collapsed-box box-solid">
    <div class="box-header with-border">
      <h3 class="box-title"><i class="fa  fa-institution"></i>&nbsp Cursos nivel secundario</h3>
      <div class="box-tools pull-right">
        <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-plus"></i></button>
      </div>  
    </div>    
    <div class="box-body">
      <div class="box-body table-responsive"> 
        <table class="example table table-bordered table-striped">
                <thead>
                <tr>
                  <th>Curso</th>
                  <th>Paralelo</th>                  
                  <th>Ver</th>
                </tr>
                </thead>
                <tbody>
                @foreach ($secundario as $item)
                <tr id="{{ $item->id }}">
                  <td align="center" >{{ $item->curso }}</td>
                    <td align="center" >
                       <a class="btn btn-social-icon btn-flickr"><i>{{ $item->paralelo }}</i></a> 
                    </td>
                    <td align="center">
                        <a href="{{ url('detalleCurso') }}/{{ Crypt::encrypt($item->id) }}" class="btn btn-social-icon btn-warning"><i class="glyphicon glyphicon-search"></i></a>
                    </td> 
                </tr>                      
                @endforeach
                </tbody>
                <tfoot>
                <tr>
                  <th>Curso</th>
                  <th>Paralelo</th>                  
                  <td>Ver</td> 
                </tr>
                </tfoot>
        </table>
      </div>
    </div>  
  </div>
</div>

<div class="col-md-7">
  <div class="box box-primary collapsed-box box-solid">
    <div class="box-header with-border">
      <h3 class="box-title"><i class="fa  fa-group"></i>&nbsp Docentes nivel secundario</h3>
      <div class="box-tools pull-right">
        <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-plus"></i></button>
      </div>  
    </div>    
    <div class="box-body">
      The body of the box
    </div>  
  </div>
</div>


</div>{{-- END ROW --}}

@endsection
{{-- END CONTET --}}
@section('script')
<script type="text/javascript">
  $(document).ready(function() {
    $(".example").DataTable({});
  });
</script>
@endsection
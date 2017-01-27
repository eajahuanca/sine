@extends('master')

@section('content-header')
<h1>
<b>Colegios</b>
<small>listado de colegios</small>
</h1>
<ol class="breadcrumb">
    <li><a href="{{ url('/') }}"><i class="fa fa-dashboard"></i><b>Principal</b></a></li>
    <li class="active">Listado de colegios</li>
</ol>
@endsection


@section('content')

<div class="row">
<div class="col-md-12">
@foreach ($colegio as $item)
    <div class="col-md-5">
          <div class="box box-widget widget-user">
            <!-- Add the bg color to the header using any of the bg-* classes -->
            <div class="widget-user-header bg-yellow" >
              <span class="info-box-text">{{ $item->nombre }}</span>
              <h5 class="widget-user-desc">Direccion {{ $item->ubicacion }}</h5>
            </div>
            <a href="{{ url('adminColegio') }}/{{ Crypt::encrypt($item->idColegio) }}" class="widget-user-image">            
              <img class="img-circle" src="{{ $item->logo }}" alt="User Avatar">
            </a>
            <div class="box-footer">
              <div class="row">
                <div class="col-sm-4 border-right">
                  <div class="description-block">
                    <h5 class="description-header">Director</h5>
                    <span class="description-text ">{{ $item->username.''.$item->apellido }}</span>
                  </div>
                  <!-- /.description-block -->
                </div>
                <!-- /.col -->
                <div class="col-sm-4 border-right">
                  <div class="description-block">
                    <h5 class="description-header">Nivel</h5>
                    <span class="description-text">{{ $item->nivelname }}</span>
                  </div>
                  <!-- /.description-block -->
                </div>
                <!-- /.col -->
                <div class="col-sm-4">
                  <div class="description-block">
                    <h5 class="description-header">Telefono</h5>
                    <span class="description-text"><b>{{ $item->telefono }}</b></span>
                  </div>
                  <!-- /.description-block -->
                </div>
                <!-- /.col -->
              </div>
              <!-- /.row -->
            </div>
          </div>      
      </div>
@endforeach
</div>{{-- END COL --}}
  
</div>{{-- END ROW --}}

@endsection
{{-- END CONTET --}}
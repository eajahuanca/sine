@extends('master')

@section('content-header')
<h1>
<b>Crear colegio</b>
<small>crear nuevo colegio</small>
</h1>
<ol class="breadcrumb">
    <li><a href="{{ url('/') }}"><i class="fa fa-dashboard"></i><b>Principal</b></a></li>
    <li class="active">Crear nuevo colegio</li>
</ol>
@endsection


@section('content')

<div class="row">
  <div class="col-md-6">
        <div class="box box-primary">
            <div class="box-body si-padding">
            <form class="form-horizontal" id="sample-form" action="{{ url('colegio') }}" name="frmcolegio" method="post" enctype="multipart/form-data">
              {{ csrf_field() }}
              <div class="box-body">

                <div class="form-group">
                  <label for="inputEmail3" class="col-sm-2 control-label">Nombre</label>
                  <div class="col-sm-10">
                    <input type="text" class="form-control" placeholder="Nombre del colegio" name="nombre" value="{{ old('nombre') }}">
                  </div>
                </div>                  

                <div class="form-group">
                  <label for="inputPassword3" class="col-sm-2 control-label">Descripcion</label>
                  <div class="col-sm-10">
                    <textarea id="form-field-11" class="form-control" name="descripcion">{{ old('descripcion') }}</textarea>
                  </div>
                </div>

                <div class="form-group">
                  <label for="inputPassword3" class="col-sm-2 control-label">Ubicación</label>
                  <div class="col-sm-10">
                    <textarea id="form-field-11" class="form-control" name="ubicacion">{{ old('ubicacion') }}</textarea>
                  </div>
                </div>

                <div class="form-group">
                  <label for="inputPassword3" class="col-sm-2 control-label">telefono</label>
                <div class="col-sm-10">
                <input type="text" name="telefono" value="{{ old('telefono') }}" class="form-control" data-inputmask='"mask": "(999) 999-99"' data-mask>
                </div>
                </div>

                

              </div><!-- /.box-body -->
            </div>
        </div>
  </div>
  {{-- ............................ --}}
  <div class="col-md-6">
    <div class="box box-primary">
      <div class="box-body si-padding">
      <div class="box-body form-horizontal">

        <div class="form-group">
          <label for="director" class="col-sm-2 control-label">Director</label>
          <div class="col-sm-10">
            <select class="form-control select2" style="width: 100%;" name="director">
              <option selected="selected" value="">Seleccione</option>
            @foreach ($director as $item)
            @if ($item->idcolegio == '')
              <option value="{{ $item->iduser }}">{{ $item->name.' '.$item->apellido }}</option>
            @else
              <option value="{{ $item->iduser }}" disabled>{{ $item->name.' '.$item->apellido }}</option>
            @endif
            @endforeach              
            </select>          
          </div>
        </div>

        <div class="form-group">
          <label for="nivel" class="col-sm-2 control-label">Nivel</label>
          <div class="col-sm-10">
            <select class="form-control select2" style="width: 100%;" name="nivel">
              <option selected="selected" value="">Seleccione</option>
            @foreach ($nivel as $item)
              <option value="{{ $item->id }}">{{ $item->nombre }}</option>
            @endforeach              
            </select>          
          </div>
        </div>

        <div class="form-group">
          <label for="inputPassword3" class="col-sm-2 control-label">Logo</label>
            <div class="col-sm-10">
            <input type="file" value="{{ old('logo') }}" class="form-control" id="exampleInputFile" name="logo">
            </div>
        </div>                     
        <a onclick="registrar('Guradar','¿ Esta seguro de crear el colegio?');" class="btn btn-info btn-lg pull-right col-md-12"><i class="fa fa-floppy-o"></i> Crear Colegio</a>
      </form>
      </div>
      </div>
    </div>
  </div>
</div>
<script type="text/javascript">
  function enviar_formulario(){ 
   document.frmcolegio.submit();
  }
</script>
@endsection
{{-- END CONTET --}}

@section('script')
<script src="{{ URL::asset('plugins/select2/select2.full.min.js') }}"></script>
<script type="text/javascript">
   $(function () {
    //Initialize Select2 Elements
    $(".select2").select2();
});
</script>
@endsection

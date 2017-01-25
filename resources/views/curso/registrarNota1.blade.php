@extends('master')

@section('content-header')

@endsection


@section('content')
<div class="row">
<div class="col-md-3">          
    <div class="box box-primary">
        <div class="box-body box-profile">
            <img class="profile-user-img img-responsive img-circle" src="{{ url($estudiante->imagen) }}" alt="User profile picture">
              <h3 class="profile-username text-center">{{ $estudiante->nombreusuario.' '.$estudiante->apellido }}</h3>
              <p class="text-muted text-center">Curso <b>{{ $estudiante->nombrecurso.' '.$estudiante->paralelo }}</b></p>
            <ul class="list-group list-group-unbordered">
                <li class="list-group-item">
                  <b>CI</b> <a class="pull-right">{{ $estudiante->ci }}</a>
                </li>
                <li class="list-group-item">
                  <b>Fecha de Nacimiento</b> <a class="pull-right">{{ $estudiante->fechaNacimiento }}</a>
                </li>
                <li class="list-group-item">
                  <b>Celular</b> <a class="pull-right">{{ $estudiante->celularusuario }}</a>
                </li>
                <li class="list-group-item">
                  <b>Telefono</b> <a class="pull-right">{{ $estudiante->telefonousuario }}</a>
                </li>
            </ul>            
        </div>        
    </div>
</div>

<div class="col-md-9">
@foreach ($materiAsignada as $itemateria)
    <div class="col-md-4">
    <div class="box box-widget widget-user-2">            
        <div class="widget-user-header bg-yellow">
           @if ($itemateria->imagendocente != '')
                <div class="widget-user-image">
                <img class="img-circle" src="{{ url($itemateria->imagendocente) }}" alt="User Avatar">
            </div>   
            @endif            
            <h5 class="widget-user-desc"><b>{{ $itemateria->docentename.' '.$itemateria->docenteapellido }}</b>
            <p>
                {{ $itemateria->nombre }}
            </p>
            </h5>
            
        </div>
        <div class="box-footer no-padding">
            <ul class="nav nav-stacked">
                @foreach ($notaBimestre as $item)
                <li>
                <a href="#" idbimestre="{{ $item->id }}" bimestre="{{ $item->nombre }}" idmateria="{{ $itemateria->idmateriacurso }}"  class="registrarNota disabled">
                @if ($item->nombre == 1) (1) Primer Bimestre
                <span class="pull-right badge bg-blue">31</span>
                @endif
                @if ($item->nombre == 2) (2) Segundo Bimestre
                    <span class="pull-right badge bg-aqua">31</span>
                @endif
                @if ($item->nombre == 3) (3) Tercer Bimestre 
                    <span class="pull-right badge bg-green">31</span>
                @endif
                @if ($item->nombre == 4) (4) Cuarto Bimestre 
                <span class="pull-right badge bg-orange">31</span>
                @endif 
                
                </a>
                </li>
                @endforeach
                
            </ul>
        </div>
    </div>
    </div>
@endforeach
</div>
</div>
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
    //REGISTRAR NOTA
   $('.registrarNota').unbind().bind('click',function(e){
    e.preventDefault();
    idbimestre = $(this).attr('idbimestre');
    idmateria = $(this).attr('idmateria');
    bimestre = $(this).attr('bimestre');    
        $.ajax({
                type:'post',   
                dataType: 'json',
                url: "{{ url('frmregistrarNota') }}",
                data: {idbimestre:idbimestre, idmateria:idmateria, bimestre:bimestre},
                success:function(response){
                    _modal.find('#myModalLabel').html('Registrar Nota ');
                    _modal.find('.modal-body').html(response);    
                    _modal.find('.btn-primary').unbind().bind('click',function(e){
                        e.preventDefault();
                        $.ajax({
                            type:'post',   
                            dataType: 'json',
                            url: "{{ url('saveNota') }}",
                            data: _modal.find('#nota').serialize(),
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
    });//EDN REGISTRAR NOTA
});
</script>
@endsection
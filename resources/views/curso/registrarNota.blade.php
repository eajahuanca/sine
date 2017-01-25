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
<div class="box box-body box-primary">
            <div class="box-header">
              <h3 class="box-title">REGISTRO DE NOTAS</h3>

              <div class="box-tools">
                <div class="input-group input-group-sm" style="width: 150px;">
                  <input type="text" name="table_search" class="form-control pull-right" placeholder="Search">

                  <div class="input-group-btn">
                    <button type="submit" class="btn btn-default"><i class="fa fa-search"></i></button>
                  </div>
                </div>
              </div>
            </div>
            <!-- /.box-header -->
            <div class="box-body table-responsive no-padding">
              <table class="table table-hover table-bordered">
                <thead>
                    <tr>
                      <th>MATERIA</th>
                      <th>DOCENTE</th>
                      <th>1er Bimestre</th>
                      <th>2do Bimestre</th>
                      <th>3er Bimestre</th>
                      <th>4to Bimestre</th>
                    </tr>
                </thead>
                <tbody>
                <?php $c=0; ?>                
                @foreach ($materiAsignada as $itemateria)
                    <tr>
                        <td>{{ $itemateria->nombre }}</td>
                        <td>
                        @if ($itemateria->docentename == '')
                            <span class="label label-danger">NO ASIGNADO</span>
                        @else
                        {{ $itemateria->docentename.' '.$itemateria->docenteapellido }}
                        </td>
                        @endif
                        @foreach ($notaBimestre as $item)
                          <td align="center">                            
                          @foreach ($nota as $itemnota)
                            @if ($itemateria->idmateriacurso == $itemnota->idmateria )
                              @if ($itemnota->idbimestre == $item->id)
                                @if ($itemnota->nota >= 51)
                                  <span class="badge bg-green">{{ $itemnota->nota }}</span>
                                @else
                                  <span class="badge bg-orange">{{ $itemnota->nota }}</span>
                                @endif
                                <?php $c1=1; ?>
                              @endif
                            @endif
                            @if ($c == 0)
                                <a class="btn btn-info registrarNota pull-right" href="#" role="button" 
                                materia="{{ $itemateria->nombre }}" idbimestre="{{ $item->id }}" bimestre="{{ $item->nombre }}" idmateria="{{ $itemateria->idmateriacurso }}" idhistorial="{{ $estudiante->idhistorial }}">
                                    <i class="glyphicon glyphicon-pencil"></i>
                                </a>                              
                            @endif
                            <?php $c = 1; ?>
                          @endforeach
                            <?php $c = 0; ?>
                          </td>
                        @endforeach

                       
                    </tr>
                @endforeach
                
                </tbody>
              </table>
            </div>
            <!-- /.box-body -->
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
    materia = $(this).attr('materia');
    idhistorial = $(this).attr('idhistorial');
        $.ajax({
                type:'post',   
                dataType: 'json',
                url: "{{ url('frmregistrarNota') }}",
                data: {idbimestre:idbimestre, idmateria:idmateria, bimestre:bimestre, materia:materia,idhistorial:idhistorial},
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
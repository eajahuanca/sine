@extends('master')

@section('content-header')
<h1>
<b>{{ $colCurso->colegio }}</b>
<small>Curso {{ $colCurso->curso.' '.$colCurso->paralelo }}</small>
</h1>
<ol class="breadcrumb">
    <li><a href="{{ url('/') }}"><i class="fa fa-dashboard"></i><b>Principal</b></a></li>
    <li class="active">Colegio</li>
</ol>
@endsection

{{--  --}}
@section('content')
<div class="row"></div>
<div class="row">
<div class="col-md-10 col-lg-offset-1">
    <div class="box box-primary">
        <div class="box-body si-padding">
        
        <div class=" bg-blue text-center" ><b>PANEL DE ASIGNACION DE CURSOS</b></div><br>    
            <select id='callbacks' multiple='multiple'>
            @foreach ($materia as $item)
            <?php $flag=0; ?>
                @foreach ($materiAsignada as $itemAsignado)
                    @if ($item->idmateria == $itemAsignado->idmateria)
                        <?php $flag=1; break; ?> 
                    @endif
                @endforeach
                @if ($flag == 1)            
                    <option value='{{ $item->idmateria.'/,/'.$colCurso->id }}' selected>{{ $item->nombre }}</option>
                @else
                    <option value='{{ $item->idmateria.'/,/'.$colCurso->id }}'>{{ $item->nombre }}</option>
                @endif
            @endforeach                
            </select>
        </div>
    </div>
</div>
</div>
@endsection
@section('script')
<script type="text/javascript">
$(document).ready(function() {    

$('#callbacks').multiSelect({   
      afterSelect: function(values){
            $.ajax({
                    type:'post',   
                    dataType: 'json',
                    url: "{{ url('asignarMateria') }}",
                    data: {data:values},
                    success: function(response){
                    console.log(response);
                     }
                });
      },
      afterDeselect: function(values){
        $.ajax({
                    type:'post',   
                    dataType: 'json',
                    url: "{{ url('desasignarMateria') }}",
                    data: {data:values},
                    success: function(response){
                    console.log(response);
                     }
                });
      }
    });
$('.ms-selection').append('<div class=" bg-green text-center" ><b>Cursos Asignados</b></div>');
$('.ms-selectable').append('<div class=" bg-orange text-center" ><b>Cursos no asignados</b></div>');
});
</script>
@endsection
{{-- END CONTET --}}
{{-- <div class="box box-primary">
    <div class="box-body si-padding">
    </div>
    </div> --}}
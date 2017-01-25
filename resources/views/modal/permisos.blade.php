<select id='callbacks' multiple='multiple'>
@foreach ($permisos as $item)
<?php $flag=0; ?>
    @foreach ($permisosAsignados as $itemasignado)
        @if ($item->id == $itemasignado->idpermission)
            <?php $flag=1; break; ?> 
        @endif
    @endforeach
    @if ($flag == 1)
    <option value='{{ $idrol.'/,/'.$item->id }}' selected>{{ $item->display_name }}</option>
    @else
    <option value='{{ $idrol.'/,/'.$item->id }}'>{{ $item->display_name }}</option>            
    @endif
    
@endforeach
</select>
<script type="text/javascript">
$(document).ready(function() {    
//ASIGNAR PERMISOS
$('#callbacks').multiSelect({
      afterSelect: function(values){            
            $.ajax({
                    type:'post',   
                    dataType: 'json',
                    url: "{{ url('permisos') }}",
                    data: {data:values},
                    success: function(response){
                    console.log(response);
                     }
                });
      },
//QUITAR PERMISOS
      afterDeselect: function(values){
        $.ajax({
                type:'post',   
                dataType: 'json',
                url: "{{ url('quitarPermiso') }}",
                data: {data:values},
                success: function(response){
                console.log(response);
                }
            });
        }
    });
$('.ms-selection').append('<div class=" bg-green text-center" ><b>PERMISOS ASIGNADOS</b></div>');
$('.ms-selectable').append('<div class=" bg-orange text-center" ><b>PERMISOS NO ASIGNADOS</b></div>');
});
</script>
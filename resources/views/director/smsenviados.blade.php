@extends('master')

@section('content-header')
<h1>
<b>MENSAJES ENVIADOS</b>
</h1>
<ol class="breadcrumb">
    <li><a href="{{ url('/') }}"><i class="fa fa-dashboard"></i><b>Principal</b></a></li>
    <li class="active">MailBox</li>
</ol>
@endsection


@section('content')
<div class="row">
<div class="col-md-4">          
        <div class="box box-solid">
           	<div class="box-header with-border">
              <h3 class="box-title">Folders</h3>
              <div class="box-tools">
                <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
                </button>
              </div>
            </div>
            <div class="box-body no-padding">
              <ul class="nav nav-pills nav-stacked">
                <li><a href="{{ url('smsenviados') }}"><i class="fa fa-paper-plane-o"></i> Enviados
                  <span class="label label-primary pull-right">1</span></a></li>        
                <li><a href="{{ url('sendsmsDocente') }}"><i class="fa fa-envelope-o"></i> Nuevo</a></li>                
              </ul>
            </div>        
        </div>          
</div>
<div class="col-md-8">
	<div class="box box-primary">
		<div class="box-header with-border">
			<i class="fa fa-bullhorn"></i>
            <h3 class="box-title">Mensajes</h3>
		</div>    
    	<div class="box-body table-responsive"> 
        <table class="table table-hover table-striped example">
				<thead>
					<tr>
						<th>Para:</th>
						<th>Asunto</th>
						<th>Mensaje</th>
						<th>Estado</th>
					</tr>
				</thead>
                <tbody>
                  @foreach ($allsms as $item)
                    <tr id="1">
                        <td class="mailbox-name">
                            <a href="#" class="versms">{{ $item->name.' '.$item->apellido }}</a>
                        </td>
                        <td class="mailbox-subject">
                            <b>{{ $item->asunto }}</b>
                        </td>
                        <td class="mailbox-subject">
                            {!! str_limit($item->mensaje, 40) !!}
                        </td>
                        <td>
                        {{-- @if ($item->estado == 0)
                            <span class="badge bg-yellow">{{ $item->fechaEnvio }}</span>
                        @else
                            <span class="badge bg-green">{{ $item->fechaRecepcion }}</span>
                        @endif
                        comment --}}
                        <?php setlocale(LC_TIME, 'Spanish_Bolivia');
                        $fechaRecepcion=Carbon::parse($item->fechaEnvio);
                        ?>

                        @if (Carbon::now()->format('Y-m-d') == $fechaRecepcion->format('Y-m-d') )
                                {{ $fechaRecepcion->addSeconds(Carbon::now()->second)->diffForHumans() }}
                            @else
                                {!! $fechaRecepcion->subDays(Carbon::now()->isToday())->diffForHumans() !!}
                        @endif
                        </td>
                    </tr>
                  @endforeach
                </tbody>
            </table>
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

	
$('.example').on('click','.versms',function(e){
            e.preventDefault();
            _fila = $(this).closest('tr');
            id = _fila.attr('id');
            $.ajax({
                url: "{{ url('versms') }}/"+id,                
                success:function(response){
                    _modal1.find('#modalheader').remove();
                    _modal1.find('#modal-footerq').remove();
                    _modal1.find('#modal-bodyku').removeAttr('class');
                    _modal1.find('#modal-bodyku').html(response);
                    _modal1.find('.btn-primary').unbind().bind('click',function(e){
                        e.preventDefault();                        
                    });
                    _modal1.modal('show');     
                }
            });
        });//EDN CREAR LEER SMS

});
</script>
@endsection
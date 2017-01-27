@extends('master')

@section('content-header')
<h1>
Enviar Notificación
<small>docente</small>
</h1>
<ol class="breadcrumb">
    <li><a href="{{ url('/') }}"><i class="fa fa-dashboard"></i><b>Principal</b></a></li>
    <li class="active">Enviar notificación</li>
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
                <li><a href="{{ url('smsenviados') }}"><i class="fa fa-paper-plane-o"></i> Enviados</a></li>
                <li><a href="#"><i class="fa fa-envelope-o"></i> Nuevo</a></li>                
              </ul>
            </div>        
        </div>          
</div>
    
   	<div class="col-md-8">
        <div class="box box-primary">
           	<div class="box-header with-border">
              <h3 class="box-title">Redactar Nuevo Mensaje</h3>
            </div>
            <!-- /.box-header -->
            <div class="box-body">
            <form action="{{ url('sendsmsDocente') }}" method="post" name="frmmensaje">
            	{{ csrf_field() }}
            	<input hidden name="emisor" value="{{ Auth::user()->id }}">
            	<input hidden id="receptor" name="destino" value="">
              	<div class="form-group">
                	<select class="form-control select2" multiple="multiple" data-placeholder="Para:" style="width: 100%;">	
	                  @foreach ($docente as $item)
	                  	<option value="{{ $item->id }}">{{ $item->name.' '.$item->apellido }}</option>	                  	
	                  @endforeach
	                </select>
              	</div>
              	<div class="form-group">
                	<input class="form-control" name="asunto" value="{{ old('asunto') }}" placeholder="Asunto:">
              	</div>
            	<div class="form-group">
                	<textarea id="compose-textarea" name="mensaje" class="form-control" style="height: 200px">{{ old('mensaje') }}</textarea>
            	</div>
            	</div>
            </form>
            
            <div class="box-footer">
              <div class="pull-right">                
                <a  onclick="registrar('Enviar','¿ Esta seguro de enviar el mensaje?');" class="btn btn-block btn-primary btn-lg"><i class="fa fa-envelope-o"></i> Enviar</a>
              </div>
              <button type="reset" class="btn btn-lg btn-warning"><i class="fa fa-times"></i> Descartar</button>
            </div>            
        </div>
    </div>
</div><!-- /.row -->
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
@endsection
{{-- END CONTET --}}
@section('script')
<script src="{{ asset('plugins/select2/select2.full.min.js') }}"></script>
<script type="text/javascript">
    function enviar_formulario(){ 
    document.frmmensaje.submit();
    }
$(function () {
    //Add text editor
    $("#compose-textarea").wysihtml5({
    	"font-styles": true, //Font styling, e.g. h1, h2, etc. Default true
    	"emphasis": true, //Italics, bold, etc. Default true
    	"lists": true, //(Un)ordered lists, e.g. Bullets, Numbers. Default true    	
    	"link": true, //Button to insert a link. Default true
    	"image": true, //Button to insert an image. Default true,
    	"color": true, //Button to change color of font  
    	"blockquote": true, //Blockquote    		
    });

    select = $(".select2").select2();

    select.on("select2:select", function (e) {
    	data = select.val();
    	$("#receptor").attr("value",data);
    	console.log(data); 
 	});

 	select.on("select2:unselect", function (e) { 
 		data = select.val();
    	$("#receptor").attr("value",data);
    	console.log(data);
 	});
});
</script>
@endsection
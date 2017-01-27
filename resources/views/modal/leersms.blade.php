<div class="box box-primary">            
    <div class="box-body no-padding">
      <div class="mailbox-read-info">
        <h3><b>Asunto: </b> {{ $notificacion->asunto }}</h3>
        <h5><b>De: </b> {{ $notificacion->name.' '.$notificacion->apellido }}
        <span class="mailbox-read-time pull-right">{{ $notificacion->fechaEnvio }}</span></h5>
      </div>                  
      <div class="mailbox-read-message bg-gray disabled color-palette">
      {!! $notificacion->mensaje !!}
      </div>
    </div>
</div>
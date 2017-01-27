<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Notificacion extends Model
{
    protected $table = 'notificacion';	
	protected $fillable = ['emisor','receptor','colegio','tipo','asunto','mensaje','historial','materia','fechaEnvio','fechaRecepcion','estado'];
	public $timestamps = false;
}

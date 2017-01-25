<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class DetalleNota extends Model
{
    protected $table = 'detallenota';
	protected $fillable = ['estado','materia','bimestre','nota'];
	public $timestamps = false;
}

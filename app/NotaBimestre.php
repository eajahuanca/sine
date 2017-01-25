<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\DetalleNota as DetalleNota;
class NotaBimestre extends Model
{
    protected $table = 'notabimestre';	
	protected $fillable = ['gestion','nombre','historial','estado'];
	public $timestamps = false;

	public function scopenotaMateriaBimestre($query,$idhistorial)
    {
        return 
        DetalleNota::rightjoin('notabimestre','notabimestre.id','=','detallenota.bimestre')
        ->leftjoin('materiacurso','materiacurso.id','=','detallenota.materia')
        ->select('detallenota.id as idnota','detallenota.nota as nota','materiacurso.id as idmateria','notabimestre.id as idbimestre','notabimestre.nombre as notabimestre','notabimestre.historial as historial')
        ->where('notabimestre.historial',$idhistorial)
        ->get();
    } 
}

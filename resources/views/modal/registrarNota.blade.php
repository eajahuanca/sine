
<form class="form-horizontal" id="nota">
	<div class="box-body">
	@if ($bimestre == 1)
		<p class="text-light-blue">{{ $materia }} PRIMER BIMESTRE</p>
	@endif
	@if ($bimestre == 2)
		<p class="text-light-blue">{{ $materia }} SEGUNDO BIMESTRE</p>
	@endif
	@if ($bimestre == 3)
		<p class="text-light-blue">{{ $materia }} TERCER BIMESTRE</p>
	@endif
	@if ($bimestre == 4)
		<p class="text-light-blue">{{ $materia }} CUARTO BIMESTRE</p>
	@endif
	<input hidden="hidden" name="idmateriacurso" value="{{ $idmateriacurso }}">
	<input hidden="hidden" name="idbimestre" value="{{ $idbimestre }}">
        <div class="form-group">
        	<label for="inputEmail3" class="col-sm-2 control-label">Nota</label>
            <div class="col-sm-10">            	
            	<input type="number" class="form-control" name="nota" placeholder="Enter number" step="0.01" max="100"/>
            </div>
        </div>        
        <p class="text-yellow"><i class="glyphicon glyphicon-warning-sign"></i>  ATENCIÓN!! UNA VES REGISTRADA LA NOTA USTED NO PODRA MODIFICARLA</p>
    </div>
</form>

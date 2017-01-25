<form id="docente">
<input hidden="hidden" name="idmateriaCurso" value="{{ $idmateriaCurso }}" >
<input hidden="hidden" name="idcolegio" value="{{ $idcolegio }}" >
<div class="form-group">
  <label>Docentes</label>
    <select class="form-control" id="select2" style="width: 100%;" name="docente">
      <option selected="selected" value=""></option>
    @foreach ($docente as $item)
      <option value="{{ $item->id }}">{{ $item->name.' '.$item->apellido }}</option>
    @endforeach
    </select>
</div>
</form>
@section('script')
<script src="{{ URL::asset('plugins/select2/select2.full.min.js') }}"></script>
<script type="text/javascript">
   $(function () {
    
    $("#select2").select2();
});
</script>
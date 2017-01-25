<form class="form-horizontal" id="materia" >

  <div class="box-body">
    <div class="form-group">
      <label  class="col-sm-2 control-label">Nombre</label>
    <div class="col-sm-10">
      <input type="text" class="form-control" name="nombre" value="{{ $materia->nombre }}" placeholder="Nombre de la materia...">
    </div>
    </div>

    <div class="form-group">
      <label  class="col-sm-2 control-label">Descripcion</label>
    <div class="col-sm-10">
      <textarea class="form-control" rows="3" placeholder="Descripcion de la materia ..." name="descripcion">{{ $materia->descripcion }}</textarea>
    </div>
    </div>
    <input type="text" hidden value="{{ $materia->id }}" name="idMateria">
  </div>               
</form>
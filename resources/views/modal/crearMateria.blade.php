<form class="form-horizontal" id="materia" >

  <div class="box-body">
    <div class="form-group">
      <label  class="col-sm-2 control-label">Nombre</label>
    <div class="col-sm-10">
      <input type="text" class="form-control" name="nombre" value="{{ old('nombre') }}" placeholder="Nombre de la materia...">
    </div>
    </div>

    <div class="form-group">
      <label  class="col-sm-2 control-label">Descripcion</label>
    <div class="col-sm-10">
      <textarea class="form-control" rows="3" placeholder="Descripcion de la materia ..." name="descripcion">{{ old('descripcion') }}</textarea>
    </div>
    </div>

    <div class="form-group">
          <label for="nivel" class="col-sm-2 control-label">Nivel</label>
          <div class="col-sm-10">
            <select class="form-control select2" name="nivel" style="width: 100%;">
              <option selected="selected" value="">Seleccione</option>
              @if (isset($niveles))
                @foreach ($niveles as $item)
                  <option value="{{ $item->id }}">{{ $item->nombre }}</option>
                @endforeach
              @else
                  <option value="{{ $nivel }}">
                  @if ($nivel==1)
                    Primario
                  @else
                    Secundario
                  @endif
                  </option>
              @endif
                                 
            </select>          
          </div>
    </div>
    <input type="text" hidden value="{{ $id }}" name="colegio">
  </div>               
</form>
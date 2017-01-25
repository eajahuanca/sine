<form class="form-horizontal" id="curso" >

  <div class="box-body">
    <div class="form-group">
      <label  class="col-sm-2 control-label">Nombre</label>
    <div class="col-sm-10">
      <input type="text" class="form-control" name="nombre" value="{{ old('nombre') }}" placeholder="Nombre del curso...">
    </div>
    </div>

    <div class="form-group">
      <label  class="col-sm-2 control-label">Paralelo</label>
    <div class="col-sm-10">
      <input type="text" class="form-control" name="paralelo" value="{{ old('paralelo') }}" placeholder="Paralelo...">
    </div>
    </div>

    <div class="form-group">
          <label for="nivel" class="col-sm-2 control-label">Nivel</label>
          <div class="col-sm-10">
            <select class="form-control select2" style="width: 100%;" name="nivel">
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
    <input hidden name="colegio" value="{{ $id }}">
  </div>               
</form>
<form role="form" id="rol">
  <div class="box-body">
    <div class="form-group">
    <input type="hidden" name="iduser" value="{{ $iduser }}">
      <label >Rol</label>
        <select class="form-control" name="idrol">
        <option value=" " selected> Seleccione </option>
          @foreach ($rol as $item)
            <option value="{{ $item->id }}">{{ $item->display_name }}</option>
          @endforeach
        </select>
    </div>
  </div>
</form>
    @include('include.head')
    @include('include.menu')
    @include('include.menu-mobile')
    <!--Cuerpo-->
    <div class="row cuerpo">
      <div class="row titulo center">
        <h4>PAGO</h4>
      </div>
      <div class="col s10 offset-s1 m8 offset-m2 l6 offset-l3">
          <form name="tipomovimiento" method="POST" accept-charset="UTF-8">
            <div class="col s12 input-field">
                {{ csrf_field() }}
                <input type="hidden" name="modo" value="{{$modo}}">
                <input type="hidden" name="id" value="{{$pago->id}}">
                <input type="text" name="nombre" value="{{$pago->nombre}}" required id="nombre-agregar">
                <label for="nombre-agregar">NOMBRE</label>
            </div>
            <div class="col s12 input-field">
                @if($modo=="nuevo")
                    <select id="tipo-agregar" name="tipo" required="">
                        <option value="E" @if($pago->tipo=="E") selected @endif>EGRESO</option>
                        <option value="I" @if($pago->tipo=="I") selected @endif>INGRESO</option>
                    </select>
                    <label for="tipo-agregar">MODO</label>
                @else
                    @if($pago->tipo=="E")
                        <input type="text"  value="EGRESO" readonly>
                    @else
                        <input type="text" value="INGRESO" readonly>
                    @endif
                @endif
            </div>
            <div class="col s12 center">
                <button type="submit" class="btn-large">GUARDAR</button>
            </div>
        </form>
      </div>
    </div>
    @include('include.footer')
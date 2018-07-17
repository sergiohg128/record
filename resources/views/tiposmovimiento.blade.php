    @include('include.head')
    @include('include.menu')
    @include('include.menu-mobile')
    <!--Cuerpo-->
    <div class="row cuerpo">
        <a href="tipomovimiento" class="btn-floating btn-large waves-effect red"><i class="material-icons">add</i></a>
      <div class="row titulo center">
        <h4>TIPOS DE MOVIMIENTO</h4>
      </div>
      <div class="col s10 offset-s1 tabla">
        <table class="centered striped resp2">
          <thead>
            <th>N°</th>
            <th>Nombre</th>
            <th>Modo</th>
            <th>Movimientos</th>
            <th>Editar</th>
          </thead>
          <tbody id="filas">
            @php($w = 1)
            @forelse($pagos as $pago)
                <tr>
                  <td>{{$w++}}</td>
                  <td>{{$pago->nombre}}</td>
                  @if($pago->tipo=="E")
                    <td>EGRESO</td>
                  @else
                    <td>INGRESO</td>
                  @endif
                  <td><a href="movimientos?id={{$pago->id}}" class="btn"><i class="material-icons">input</i></a></td>
                  <td><a href="tipomovimiento?id={{$pago->id}}" class="btn green"><i class="material-icons">edit</i></a></td>
                </tr>
            @empty
                <tr id="filaempty">
                    <td colspan="4">No hay pagos</td>
                </tr>
            @endforelse
          </tbody>
        </table>
        <div class="row center">
            {{$pagos->links()}}
        </div>
      </div>
    </div>
    @include('include.footer')
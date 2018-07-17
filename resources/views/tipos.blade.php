    @include('include.head')
    @include('include.menu')
    @include('include.menu-mobile')
    <!--Cuerpo-->
    <div class="row cuerpo">
        <a onclick="agregar('tipo')" class="btn-floating btn-large waves-effect red"><i class="material-icons">add</i></a>
      <div class="row titulo center">
        <h4>TIPOS</h4>
      </div>
      <div class="col s10 offset-s1 tabla">
        <table class="centered striped responsive-table">
          <thead>
            <th>N</th>
            <th>Nombre</th>
            <th>Permisos</th>
            <th>Usuarios</th>
            <th>Editar</th>
            <th>Eliminar</th>
          </thead>
          <tbody id="filas">
            @forelse($tipos as $tipo)
                <tr id="fila{{$tipo->id}}">
                  <td>{{$w = $w + 1}}</td>
                  <td id="filanombre{{$tipo->id}}">{{$tipo->nombre}}</td>
                  <td><a href="permisos?id={{$tipo->id}}" class="btn"><i class="material-icons">input</i></a></td>
                  <td><a href="usuarios?id={{$tipo->id}}" class="btn brown"><i class="material-icons">input</i></a></td>
                  <td id="filaeditar{{$tipo->id}}"><a onclick="editar('tipo',{{$tipo->id}},'{{$tipo->nombre}}')" class="btn green"><i class="material-icons">edit</i></a></td>
                  @if($tipo->id=='1' || $tipo->id=='2')
                    <td><a class="btn disabled"><i class="material-icons">delete</i></a></td>
                  @else
                    <td><a onclick="eliminar('tipo',{{$tipo->id}})" class="btn red"><i class="material-icons">delete</i></a></td> 
                  @endif
                </tr>
            @empty
                <tr id="filaempty">
                    <td colspan="5">No hay tipos</td>
                </tr>
            @endforelse
          </tbody>
        </table>
      </div>
    </div>
    @include('include.footer')
    @include('include.modal-agregar')
    @include('include.modal-editar')
    @include('include.modal-eliminar')
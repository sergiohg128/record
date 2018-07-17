    @include('include.head')
    @include('include.menu')
    @include('include.menu-mobile')
    <!--Cuerpo-->
    <div class="row cuerpo">
      <div class="row titulo center">
        <h4>LINEAS DE {{$programa->nombre}}</h4>
      </div>
        <div class="row">
            <a href="linea-formulario?p={{$programa->id}}" class="btn-floating btn-large waves-effect red"><i class="material-icons">add</i></a>
            <div class="col s10 offset-s1 tabla">
             <table class="centered striped responsive-table">
               <thead>
                 <th>N</th>
                 <th>Nombre</th>
                 <th>Editar</th>
                 <th>Eliminar</th>
               </thead>
               <tbody id="filas">
                 @forelse($lineas as $linea)
                    <tr id="fila{{$linea->id}}">
                       <td>{{$w = $w + 1}}</td>
                       <td>{{$linea->nombre}}</td>
                       <td><a href="linea-formulario?id={{$linea->id}}" class="btn green"><i class="material-icons">edit</i></a></td>
                       <td><a onclick="modalusuario({{$linea->id}},'{{$linea->paterno}} {{$linea->materno}} {{$linea->nombre}}','eliminar')" class="btn red"><i class="material-icons">delete</i></a></td>
                     </tr>
                 @empty
                     <tr id="filaempty">
                         <td colspan="6">No hay lineas</td>
                     </tr>
                 @endforelse
               </tbody>
             </table>
           </div> 
        </div>
    </div>
    @include('include.footer')
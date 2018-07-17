    @include('include.head')
    @include('include.menu')
    @include('include.menu-mobile')
    <!--Cuerpo-->
    <div class="row cuerpo">
      <div class="row titulo center">
        <h4>PROGRAMAS DE {{$escuela->nombre}}</h4>
      </div>
        <div class="row">
            <a href="programa-formulario?e={{$escuela->id}}" class="btn-floating btn-large waves-effect red"><i class="material-icons">add</i></a>
            <div class="col s10 offset-s1 tabla">
             <table class="centered striped responsive-table">
               <thead>
                 <th>N</th>
                 <th>Nombre</th>
                 <th>Lineas</th>
                 <th>Editar</th>
                 <th>Eliminar</th>
               </thead>
               <tbody id="filas">
                 @forelse($programas as $programa)
                    <tr id="fila{{$programa->id}}">
                       <td>{{$w = $w + 1}}</td>
                       <td>{{$programa->nombre}}</td>
                       <td><a href="lineas?id={{$programa->id}}" class="btn"><i class="material-icons">input</i></a></td>
                       <td><a href="programa-formulario?id={{$programa->id}}" class="btn green"><i class="material-icons">edit</i></a></td>
                       <td><a onclick="modalusuario({{$programa->id}},'{{$programa->paterno}} {{$programa->materno}} {{$programa->nombre}}','eliminar')" class="btn red"><i class="material-icons">delete</i></a></td>
                     </tr>
                 @empty
                     <tr id="filaempty">
                         <td colspan="6">No hay programas</td>
                     </tr>
                 @endforelse
               </tbody>
             </table>
           </div> 
        </div>
    </div>
    @include('include.footer')
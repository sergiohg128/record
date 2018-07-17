    @include('include.head')
    @include('include.menu')
    @include('include.menu-mobile')
    <!--Cuerpo-->
    <div class="row cuerpo">
      <div class="row titulo center">
        <h4>ESCUELAS DE {{$facultad->nombre}}</h4>
      </div>
        <div class="row">
            <a href="escuela-formulario?f={{$facultad->id}}" class="btn-floating btn-large waves-effect red"><i class="material-icons">add</i></a>
            <div class="col s10 offset-s1 tabla">
             <table class="centered striped responsive-table">
               <thead>
                 <th>N</th>
                 <th>Nombre</th>
                 <th>Programas</th>
                 <th>Editar</th>
                 <th>Eliminar</th>
               </thead>
               <tbody id="filas">
                 @forelse($escuelas as $escuela)
                    <tr id="fila{{$escuela->id}}">
                       <td>{{$w = $w + 1}}</td>
                       <td>{{$escuela->nombre}}</td>
                       <td><a href="programas?id={{$escuela->id}}" class="btn"><i class="material-icons">input</i></a></td>
                       <td><a href="escuela-formulario?id={{$escuela->id}}" class="btn green"><i class="material-icons">edit</i></a></td>
                       <td><a onclick="modalusuario({{$escuela->id}},'{{$escuela->paterno}} {{$escuela->materno}} {{$escuela->nombre}}','eliminar')" class="btn red"><i class="material-icons">delete</i></a></td>
                     </tr>
                 @empty
                     <tr id="filaempty">
                         <td colspan="6">No hay escuelas</td>
                     </tr>
                 @endforelse
               </tbody>
             </table>
           </div> 
        </div>
    </div>
    @include('include.footer')
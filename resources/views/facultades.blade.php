    @include('include.head')
    @include('include.menu')
    @include('include.menu-mobile')
    <!--Cuerpo-->
    <div class="row cuerpo">
      <div class="row titulo center">
        <h4>FACULTADES</h4>
      </div>
        <div class="row">
            <a href="facultad-formulario" class="btn-floating btn-large waves-effect red"><i class="material-icons">add</i></a>
            <div class="col s10 offset-s1 tabla">
             <table class="centered striped responsive-table">
               <thead>
                 <th>N</th>
                 <th>Nombre</th>
                 <th>Escuelas</th>
                 <th>Editar</th>
                 <th>Eliminar</th>
               </thead>
               <tbody id="filas">
                 @forelse($facultades as $facultad)
                    <tr id="fila{{$facultad->id}}">
                       <td>{{$w = $w + 1}}</td>
                       <td>{{$facultad->nombre}}</td>
                       <td><a href="escuelas?id={{$facultad->id}}" class="btn"><i class="material-icons">input</i></a></td>
                       <td><a href="facultad-formulario?id={{$facultad->id}}" class="btn green"><i class="material-icons">edit</i></a></td>
                       <td><a onclick="modalusuario({{$facultad->id}},'{{$facultad->paterno}} {{$facultad->materno}} {{$facultad->nombre}}','eliminar')" class="btn red"><i class="material-icons">delete</i></a></td>
                     </tr>
                 @empty
                     <tr id="filaempty">
                         <td colspan="6">No hay facultades</td>
                     </tr>
                 @endforelse
               </tbody>
             </table>
           </div> 
        </div>
    </div>
    @include('include.footer')
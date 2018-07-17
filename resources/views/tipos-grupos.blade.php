    @include('include.head')
    @include('include.menu')
    @include('include.menu-mobile')
    <!--Cuerpo-->
    <div class="row cuerpo">
      <div class="row titulo center">
        <h4>TIPOS DE GRUPOS</h4>
      </div>
        <div class="row">
            <a onclick="$('#modal-agregar').modal('open')" class="btn-floating btn-large waves-effect red"><i class="material-icons">add</i></a>
            <div class="col s10 offset-s1 tabla">
             <table class="centered striped responsive-table">
               <thead>
                 <th>N</th>
                 <th>Nombre</th>
                 <th>Editar</th>
                 <th>Eliminar</th>
               </thead>
               <tbody id="filas">
                 @forelse($tipos as $tipo)
                    <tr id="fila{{$tipo->id}}">
                       <td>{{$w = $w + 1}}</td>
                       <td>{{$tipo->nombre}}</td>
                       <td><a onclick="modalusuario({{$tipo->id}},'{{$tipo->paterno}} {{$tipo->materno}} {{$tipo->nombre}}','editar')" class="btn green"><i class="material-icons">edit</i></a></td>
                       <td><a onclick="modalusuario({{$tipo->id}},'{{$tipo->paterno}} {{$tipo->materno}} {{$tipo->nombre}}','eliminar')" class="btn red"><i class="material-icons">delete</i></a></td>
                     </tr>
                 @empty
                     <tr id="filaempty">
                         <td colspan="6">No hay tipos</td>
                     </tr>
                 @endforelse
               </tbody>
             </table>
           </div> 
        </div>
    </div>
    @include('include.footer')
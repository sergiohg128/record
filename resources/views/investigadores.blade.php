    @include('include.head')
    @include('include.menu')
    @include('include.menu-mobile')
    <!--Cuerpo-->
    <div class="row cuerpo">
      <div class="row titulo center">
        <h4>INVESTIGADORES</h4>
      </div>
        <div class="row">
            <a href="investigador-formulario" class="btn-floating btn-large waves-effect red"><i class="material-icons">add</i></a>
            <div class="col s10 offset-s1 tabla">
             <table class="centered striped responsive-table">
               <thead>
                 <th>N</th>
                 <th>Grado</th>
                 <th>Nombre</th>
                 <th>Escuela</th>
                 <th>Tipo</th>
                 <th>Proyectos</th>
                 <th>Editar</th>
                 <th>Eliminar</th>
               </thead>
               <tbody id="filas">
                 @forelse($investigadores as $investigador)
                    <tr id="fila{{$investigador->id}}">
                       <td>{{$w = $w + 1}}</td>
                       <td>{{$investigador->grado}}</td>
                       <td>{{$investigador->completo()}}</td>
                       <td>{{$investigador->escuela()->nombre}}</td>
                       <td>{{$investigador->tipo()->nombre}}</td>
                       <td><a href="proyectos?i={{$investigador->id}}" class="btn">{{$investigador->conteo()}}</a></td>
                       <td><a href="investigador-formulario?id={{$investigador->id}}" class="btn green"><i class="material-icons">edit</i></a></td>
                       <td><a onclick="modalusuario({{$investigador->id}},'{{$investigador->paterno}} {{$investigador->materno}} {{$investigador->nombre}}','eliminar')" class="btn red"><i class="material-icons">delete</i></a></td>
                     </tr>
                 @empty
                     <tr id="filaempty">
                         <td colspan="6">No hay investigadores</td>
                     </tr>
                 @endforelse
               </tbody>
             </table>
           </div> 
        </div>
    </div>
    @include('include.footer')
    @include('include.head')
    @include('include.menu')
    @include('include.menu-mobile')
    <!--Cuerpo-->
    <div class="row cuerpo">
      <div class="row titulo center">
        <h4>GRUPOS DE INVESTIGACIÓN</h4>
      </div>
        <div class="row">
            <a href="grupo-formulario" class="btn-floating btn-large waves-effect red"><i class="material-icons">add</i></a>
            <div class="col s10 offset-s1 tabla">
             <table class="centered striped responsive-table">
               <thead>
                 <th>N</th>
                 <th>Nombre</th>
                 <th>Tipo</th>
                 <th>Proyectos</th>
                 <th>Investigadores</th>
                 <th>Editar</th>
                 <th>Eliminar</th>
               </thead>
               <tbody id="filas">
                 @forelse($grupos as $grupo)
                    <tr id="fila{{$grupo->id}}">
                       <td>{{$w = $w + 1}}</td>
                       <td>{{$grupo->nombre}}</td>
                       <td>{{$grupo->tipo()->nombre}}</td>
                       <td><a href="proyectos?g={{$grupo->id}}" class="btn">{{$grupo->conteo()}}</a></td>
                       <td><a href="grupo-investigadores?id={{$grupo->id}}" class="btn brown"><i class="material-icons">input</i></a></td>
                       <td><a href="grupo-formulario?id={{$grupo->id}}" class="btn green"><i class="material-icons">edit</i></a></td>
                       <td><a onclick="modalusuario({{$grupo->id}},'{{$grupo->paterno}} {{$grupo->materno}} {{$grupo->nombre}}','eliminar')" class="btn red"><i class="material-icons">delete</i></a></td>
                     </tr>
                 @empty
                     <tr id="filaempty">
                         <td colspan="6">No hay grupos</td>
                     </tr>
                 @endforelse
               </tbody>
             </table>
           </div> 
        </div>
    </div>
    @include('include.footer')
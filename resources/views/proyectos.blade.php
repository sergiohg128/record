    @include('include.head')
    @include('include.menu')
    @include('include.menu-mobile')
    <!--Cuerpo-->
    <div class="row cuerpo">
      <div class="row titulo center">
        <h4>PROYECTOS</h4>
      </div>
      
        <div class="row">
            <div class="col s10 offset-s1 tabla" id="generales">
             <table class="centered striped responsive-table">
               <thead>
                 <th>N</th>
                 <th>Nombre</th>
                 <th>Responsable</th>
                 <th>Tipo</th>
                 <!-- <th>Linea</th> -->
                 <th>Ver</th>
                 <th>Editar</th>
                 <th>Eliminar</th>
               </thead>
               <tbody id="filas">
                 @forelse($proyectos as $proyecto)
                    <tr id="fila{{$proyecto->id}}">
                       <td>{{$w = $w + 1}}</td>
                       <td class="left">{{$proyecto->titulo}}</td>
                       <td>{{$proyecto->responsable()}}</td>
                       <td>{{$proyecto->tipo()->nombre}}</td>
                       <!-- <td>{{$proyecto->linea()->nombre}}</td> -->
                       <td><a href="proyecto?id={{$proyecto->id}}" class="btn"><i class="material-icons">input</i></a></td>
                       <td><a href="proyecto-formulario?id={{$proyecto->id}}" class="btn green"><i class="material-icons">edit</i></a></td>
                       <td><a onclick="modalproyecto({{$proyecto->id}},'eliminar')" class="btn red"><i class="material-icons">delete</i></a></td>
                     </tr>
                 @empty
                     <tr id="filaempty">
                         <td colspan="8">No hay proyectos</td>
                     </tr>
                 @endforelse
               </tbody>
             </table>
             <div class="row center">
              {{ $proyectos->links() }}
            </div>
           </div> 
        </div>
    </div>
    @include('include.footer')
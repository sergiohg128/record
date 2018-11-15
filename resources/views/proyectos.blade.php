    @include('include.head')
    @include('include.menu')
    @include('include.menu-mobile')
    <!--Cuerpo-->
    <div class="row cuerpo">
      <div class="row titulo center">
        <h4>PROYECTOS</h4>
      </div>
      <div class="row">
        <ul class="tabs">
          <li class="tab col s4"><a href="#generales">Generales</a></li>
          <li class="tab col s4"><a href="#estudiantes">Estudiantes</a></li>
          <li class="tab col s4"><a href="#docentes">Docentes</a></li>
        </ul>
      </div>
        <div class="row">
            <div class="col s10 offset-s1 tabla" id="generales">
             <table class="centered striped responsive-table">
               <thead>
                 <th>N</th>
                 <th>Nombre</th>
                 <th>Responsable</th>
                 <th>Tipo</th>
                 <th>Linea</th>
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
                       <td>{{$proyecto->linea()->nombre}}</td>
                       <td><a href="proyecto?id={{$proyecto->id}}" class="btn"><i class="material-icons">input</i></a></td>
                       <td><a href="proyecto-formulario?id={{$proyecto->id}}" class="btn green"><i class="material-icons">edit</i></a></td>
                       <td><a onclick="modalproyecto({{$proyecto->id}},'eliminar')" class="btn red"><i class="material-icons">delete</i></a></td>
                     </tr>
                 @empty
                     <tr id="filaempty">
                         <td colspan="6">No hay proyectos</td>
                     </tr>
                 @endforelse
               </tbody>
             </table>
           </div> 

           <div class="col s10 offset-s1 tabla" id="estudiantes">
             <table class="centered striped responsive-table">
               <thead>
                 <th>N</th>
                 <th>Titulo</th>
                 <th>Estudiante</th>
                 <th>Ver</th>
               </thead>
               <tbody id="filas">
                 @forelse($proyectosSelgestiunEstudiantes as $proyecto)
                    <tr id="fila{{$proyecto->id}}">
                       <td>{{$y = $y + 1}}</td>
                       <td class="left">{{$proyecto->tb_proyecto_titulo}}</td>
                       <td>{{$proyecto->tb_usuario_apellidopaterno}} {{$proyecto->tb_usuario_apellidomaterno}} {{$proyecto->tb_usuario_nombre}}</td>
                       <td><a href="proyecto-selgestiun?id={{$proyecto->tb_tramite_id}}"><button class="btn"><i class="material-icons">input</i></button></a></td>
                     </tr>
                 @empty
                     <tr id="filaempty">
                         <td colspan="6">No hay proyectos</td>
                     </tr>
                 @endforelse
               </tbody>
             </table>
           </div> 

           <div class="col s10 offset-s1 tabla" id="docentes">
             <table class="centered striped responsive-table">
               <thead>
                 <th>N</th>
                 <th>Titulo</th>
                 <th>Estudiante</th>
                 <th>Ver</th>
               </thead>
               <tbody id="filas">
                 @forelse($proyectosSelgestiunDocentes as $proyecto)
                    <tr id="fila{{$proyecto->id}}">
                       <td>{{$z = $z + 1}}</td>
                       <td class="left">{{$proyecto->tb_proyecto_titulo}}</td>
                       <td>{{$proyecto->tb_usuario_apellidopaterno}} {{$proyecto->tb_usuario_apellidomaterno}} {{$proyecto->tb_usuario_nombre}}</td>
                       <td><a href="proyecto-selgestiun?id={{$proyecto->tb_tramite_id}}"><button class="btn"><i class="material-icons">input</i></button></a></td>
                     </tr>
                 @empty
                     <tr id="filaempty">
                         <td colspan="6">No hay proyectos</td>
                     </tr>
                 @endforelse
               </tbody>
             </table>
           </div> 
        </div>
    </div>
    @include('include.footer')
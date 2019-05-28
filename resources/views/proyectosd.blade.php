    @include('include.head')
    @include('include.menu')
    @include('include.menu-mobile')
    <!--Cuerpo-->
    <div class="row cuerpo">
      <div class="row titulo center">
        <h4>PROYECTOS</h4>
      </div>

        <div class="row">

           <div class="col s10 offset-s1 tabla" id="docentes">
             <table class="centered striped responsive-table">
               <thead>
                 <th>N</th>
                 <th>Titulo</th>
                 <th>Docente</th>
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
             <div class="row center">
              {{ $proyectosSelgestiunDocentes->links() }}
            </div>
           </div> 
        </div>
    </div>
    @include('include.footer')
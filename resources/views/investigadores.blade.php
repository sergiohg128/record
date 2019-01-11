    @include('include.head')
    @include('include.menu')
    @include('include.menu-mobile')
    <!--Cuerpo-->
    <div class="row cuerpo">
      <div class="row titulo center">
        <h4>INVESTIGADORES</h4>
      </div>
        <div class="row">
            
            <div class="col s10 offset-s1 tabla">
             <table class="centered striped responsive-table">
               <thead>
                 <th>N</th>
                 <th>Grado</th>
                 <th>Nombre</th>
                 <th>Escuela</th>
                 <th>Tipo</th>
                 <th></th>
                 <th>Proyectos</th>
               </thead>
               <tbody id="filas">
                 @forelse($investigadores as $investigador)
                    <tr id="fila{{$investigador->id}}">
                       <td>{{$w = $w + 1}}</td>
                       <td>{{$investigador->tb_usuario_grado}}</td>
                       <td>{{$investigador->completo()}}</td>
                       <td>{{$investigador->tb_escuela_nombre}}</td>
                       <td>{{$investigador->tb_tipoinvestigador_nombre}}</td>
                       <td>{{$investigador->tb_permiso_cargo}}</td>
                       <td><a href="proyectos?i={{$investigador->tb_usuario_id}}" class="btn"><i class="material-icons">input</i></a></td>
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
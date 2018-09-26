    @include('include.head')
    @include('include.menu')
    @include('include.menu-mobile')
    <!--Cuerpo-->
    <div class="row cuerpo">
      <div class="row titulo center">
        <h4>{{$proyecto->titulo}}</h4>
      </div>
        <div class="row">
            <div class="col s10 offset-s1 tabla">
            <div class="row titulo center">
              <h4>RESPONSABLES</h4>
            </div>
            <div class="row center">
              <a href="investigador-proyecto-formulario?p={{$proyecto->id}}"><button class="btn red"><i class="material-icons">add</i></button></a>
            </div>
             <table class="centered striped responsive-table">
               <thead>
                 <th>N</th>
                 <th>Nombre</th>
                 <th>Tipo</th>
               </thead>
               <tbody id="filas">
                 @forelse($investigadoresP as $investigador)
                    <tr id="fila{{$investigador->id}}">
                       <td>{{$w = $w + 1}}</td>
                       <td>{{$investigador->completo()}}</td>
                       <td>
                         @if($investigador->rol=="1")
                            PRINCIPAL
                         @else
                            COLABORADOR
                         @endif
                       </td>
                     </tr>
                 @empty
                     <tr id="filaempty">
                         <td colspan="6">No hay responsables</td>
                     </tr>
                 @endforelse
               </tbody>
             </table>
           </div> 
        </div>

        <div class="row">
            <div class="col s10 offset-s1 tabla">
            <div class="row titulo center">
              <h4>ENTREGAS</h4>
            </div>
            <div class="row center">
              <a href="entrega-formulario?p={{$proyecto->id}}"><button class="btn red"><i class="material-icons">add</i></button></a>
            </div>
             <table class="centered striped responsive-table">
               <thead>
                 <th>N</th>
                 <th>Tipo</th>
                 <th>Fecha</th>
                 <th>Observación</th>
                 <th>Descargar</th>
               </thead>
               <tbody id="filas">
                 @forelse($entregas as $entrega)
                    <tr id="fila{{$entrega->id}}">
                       <td>{{$z = $z + 1}}</td>
                       <td>
                         @if($entrega->tipo==1)
                          Registro de proyecto
                         @elseif($entrega->tipo==2)
                          Avance
                         @elseif($entrega->tipo==3)
                          Entrega Final de proyecto
                        @elseif($entrega->tipo==4)
                          Acreditación
                         @endif
                       </td>
                       <td>{{date('d/m/Y',strtotime($entrega->fecha))}}</td>
                       <td>{{$entrega->observacion}}</td>
                       <td><a href="download/archivo?id={{$entrega->id}}" target="_blank"><button class="btn"><i class="material-icons">input</i></button></td>
                     </tr>
                 @empty
                     <tr id="filaempty">
                         <td colspan="6">No hay entregas</td>
                     </tr>
                 @endforelse
               </tbody>
             </table>
           </div> 
        </div>
    </div>
    @include('include.footer')
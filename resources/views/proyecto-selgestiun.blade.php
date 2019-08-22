    @include('include.head')
    @include('include.menu')
    @include('include.menu-mobile')
    <!--Cuerpo-->
    <div class="row cuerpo">
      <div class="row titulo center">
        <h4>{{$proyecto->tb_proyecto_titulo}}</h4>
      </div>
      <div class="row">
        <div class="col s10 offset-s1">
          <h5>Resumen: </h5><p>{{$proyecto->tb_proyecto_resumen}}</p>
          <h5>Objetivo general: </h5><p>{{$proyecto->tb_proyecto_objetivogeneral}}</p>
          <h5>Objetivos específicos: </h5><p>{{$proyecto->tb_proyecto_objetivoespecifico}}</p>
          <h5>Resumen: </h5><p>{{$proyecto->tb_proyecto_resumen}}</p>
          <h5>Área: </h5><p>{{$proyecto->tb_area_nombre}}</p>
          <h5>Linea: </h5><p>{{$proyecto->tb_linea_nombre}}</p>
          <h5>Sublinea: </h5><p>{{$proyecto->tb_sublinea_nombre}}</p>
        </div>
      </div>
      <div class="row titulo center">
        <h4>MIEMBROS</h4>
      </div>
      <div class="row">
        <div class="col s10 offset-s1">
          <table class="centered striped responsive-table">
               <thead>
                 <th>Nombre</th>
                 <th>Función</th>
               </thead>
               <tbody id="filas">
                 @foreach($miembros1 as $miembro)
                    <tr>
                       <td>{{$miembro->tb_usuario_apellidopaterno}} {{$miembro->tb_usuario_apellidomaterno}} {{$miembro->tb_usuario_nombre}}</td>
                       <td>{{$miembro->tb_funcion_nombre}}</td>
                     </tr>
                 @endforeach
                 @foreach($miembros2 as $miembro)
                    <tr>
                       <td>{{$miembro->tb_usuario_apellidopaterno}} {{$miembro->tb_usuario_apellidomaterno}} {{$miembro->tb_usuario_nombre}}</td>
                       <td>{{$miembro->tb_funcion_nombre}}</td>
                     </tr>
                 @endforeach
               </tbody>
             </table>
        </div>
      </div>

      <div class="row titulo center">
        <h4>FASES</h4>
      </div>
      <div class="row">
        <div class="col s10 offset-s1">
          <table class="centered striped responsive-table">
               <thead>
                 <th>Fase</th>
                 <th>Fecha</th>
               </thead>
               <tbody id="filas">
                 @foreach($fases as $fase)
                    <tr>
                       <td>{{$fase->tb_datosfase_nombre}}</td>
                       <td>{{$fase->tb_fase_fecha}}</td>
                     </tr>
                 @endforeach
               </tbody>
             </table>
        </div>
      </div>
    </div>
    @include('include.footer')
    @include('include.head')
    @include('include.menu')
    @include('include.menu-mobile')
    <!--Cuerpo-->
    <div class="row cuerpo">
      <div class="row titulo center">
        <h4>{{$fase->tb_datosfase_nombre}}</h4>
      </div>
      <div class="row">
        <div class="col s10 offset-s1">
          <h5>Descripcion: </h5><p>{{$fase->tb_datosfase_descripcion}}</p>
        </div>
      </div>
      <div class="row titulo center">
        <h4>ARCHIVOS</h4>
      </div>
      <div class="row">
        <div class="col s10 offset-s1">
          <table class="centered striped responsive-table">
               <thead>
                 <th>Archivo</th>
                 <th>Descargar</th>
               </thead>
               <tbody id="filas">
                 @foreach($archivos as $archivo)
                    <tr>
                       <td>{{$archivo->tb_archivo_nombre}}</td>
                       <td><a target="_blank" href="http://localhost:8084/Selgestiun/bajararchivo?ruta={{$archivo->tb_archivo_nombre}}"><button class="btn"><i class="material-icons">input</i></button></a></td>
                     </tr>
                 @endforeach
               </tbody>
             </table>
        </div>
      </div>
    </div>
    @include('include.footer')
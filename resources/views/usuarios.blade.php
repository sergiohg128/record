    @include('include.head')
    @include('include.menu')
    @include('include.menu-mobile')
    <!--Cuerpo-->
    <div class="row cuerpo">
      <div class="row titulo center">
        <h4>USUARIOS</h4>
      </div>
        <div class="row">
            <a href="usuario-formulario" class="btn-floating btn-large waves-effect red"><i class="material-icons">add</i></a>
            <div class="col s10 offset-s1 tabla">
             <table class="centered striped responsive-table">
               <thead>
                 <th>N</th>
                 <th>Nombre</th>
                 <th>Cuenta</th>
                 <th>Facultad</th>
                 <th>Editar</th>
                 <th>Restablecer Contraseña</th>
                 <!--<th>Desactivar</th>-->
                 <th>Eliminar</th>
               </thead>
               <tbody id="filas">
                 @forelse($usuarios as $usuariox)
                    <tr id="fila{{$usuariox->id}}">
                       <td>{{$w = $w + 1}}</td>
                       <td>{{$usuariox->completo()}}</td>
                       <td>{{$usuariox->cuenta}}</td>
                       <td>{{$usuariox->facultad()->nombre}}</td>
                       <td><a href="usuario-formulario?id={{$usuariox->id}}" class="btn green"><i class="material-icons">edit</i></a></td>
                       <td><a onclick="modalusuario({{$usuariox->id}},'restablecer')" class="btn"><i class="material-icons">replay</i></a></td>
                       <td><a onclick="modalusuario({{$usuariox->id}},'eliminar')" class="btn red"><i class="material-icons">delete</i></a></td>
                     </tr>
                 @empty
                     <tr id="filaempty">
                         <td colspan="6">No hay usuarios</td>
                     </tr>
                 @endforelse
               </tbody>
             </table>
           </div> 
        </div>
    </div>
    @include('include.footer')
    

    <!--MODAL AGREGAR-->
<div id="modal-agregar" class="modal">
  <div class="row">
    <div class="titulo blue darken-1">
        <h4 class="center">NUEVO USUARIO</h4>
    </div>
  </div>
  <div class="row">
        <form id="formagregar"  accept-charset="ISO-8859-1">
            <div class="col s12 input-field">
                {{ csrf_field() }}
                <input type="hidden" name="modo" value="agregar">
                <input type="text" name="nombre" required id="nombre-agregar">
                <label for="nombre-agregar">Nombre</label>
            </div>
            <div class="col s12 input-field">
                <input type="text" name="paterno" required id="paterno-agregar">
                <label for="paterno-agregar">Paterno</label>
            </div>
            <div class="col s12 input-field">
                <input type="text" name="materno" required id="materno-agregar">
                <label for="materno-agregar">Materno</label>
            </div>
            <div class="col s12 input-field">
                <input type="text" name="cuenta" required id="cuenta-agregar">
                <label for="cuenta-agregar">Cuenta</label>
            </div>
        </form>
  </div>
    <div class="row center botones">
        <div class="col s6 center" id="divbtnagregar">
            <button onclick="agregarusuario()" class="btn-large">Guardar</button>
        </div>
        <div class="col s6 center">
            <button class="modal-action modal-close btn-large red waves-effect">Cerrar</button>
        </div>
    </div>
</div>
    
    <!--MODAL EDITAR-->
<div id="modal-editar" class="modal">
  <div class="row">
    <div class="titulo blue darken-1">
        <h4 class="center">EDITAR</h4>
        <h5 class="center" id="subtitulo-editar"></h5>
    </div>
  </div>
  <div class="row">
        <form id="formeditar"  accept-charset="ISO-8859-1">
            <div class="col s12 input-field">
                {{ csrf_field() }}
                <input type="hidden" name="modo" value="editar">
                <input type="hidden" name="id" id="id-editar">
            </div>
        </form>
  </div>
    <div class="row center botones">
        <div class="col s6 center" id="divbtneditar">
            <button onclick="ajaxusuario('editar')" class="btn-large">Guardar</button>
        </div>
        <div class="col s6 center">
            <button class="modal-action modal-close btn-large red waves-effect">Cerrar</button>
        </div>
    </div>
</div>
    
    
    <!--MODAL ELIMINAR-->
<div id="modal-eliminar" class="modal">
  <div class="row">
    <div class="titulo blue darken-1">
        <h4 class="center">ELIMINAR</h4>
        <h5 class="center" id="subtitulo-eliminar"></h5>
    </div>
  </div>
  <div class="row">
        <form id="formeliminar"  accept-charset="ISO-8859-1">
            <div class="col s12 input-field">
                {{ csrf_field() }}
                <input type="hidden" name="modo" value="eliminar">
                <input type="hidden" name="id" id="id-eliminar">
            </div>
        </form>
  </div>
    <div class="row center botones">
        <div class="col s6 center" id="divbtneliminar">
            <button onclick="ajaxusuario('eliminar')" class="btn-large">Eliminar</button>
        </div>
        <div class="col s6 center">
            <button class="modal-action modal-close btn-large red waves-effect">Cerrar</button>
        </div>
    </div>
</div>
    
    <!--MODAL DESACTIVAR-->
<div id="modal-desactivar" class="modal">
  <div class="row">
    <div class="titulo blue darken-1">
        <h4 class="center">DESACTIVAR</h4>
        <h5 class="center" id="subtitulo-desactivar"></h5>
    </div>
  </div>
  <div class="row">
        <form id="formdesactivar"  accept-charset="ISO-8859-1">
            <div class="col s12 input-field">
                {{ csrf_field() }}
                <input type="hidden" name="modo" value="desactivar">
                <input type="hidden" name="id" id="id-desactivar">
            </div>
        </form>
  </div>
    <div class="row center botones">
        <div class="col s6 center" id="divbtndesactivar">
            <button onclick="ajaxusuario('desactivar')" class="btn-large">Desactivar</button>
        </div>
        <div class="col s6 center">
            <button class="modal-action modal-close btn-large red waves-effect">Cerrar</button>
        </div>
    </div>
</div>
    
        <!--MODAL ELIMINAR-->
<div id="modal-restablecer" class="modal">
  <div class="row">
    <div class="titulo blue darken-1">
        <h4 class="center">RESTABLECER CONTRASEÑA</h4>
        <h5 class="center" id="subtitulo-restablecer"></h5>
    </div>
  </div>
  <div class="row">
        <form id="formrestablecer"  accept-charset="ISO-8859-1">
            <div class="col s12 input-field">
                {{ csrf_field() }}
                <input type="hidden" name="modo" value="restablecer">
                <input type="hidden" name="id" id="id-restablecer">
            </div>
        </form>
  </div>
    <div class="row center botones">
        <div class="col s6 center" id="divbtnrestablecer">
            <button onclick="ajaxusuario('restablecer')" class="btn-large">Restablecer</button>
        </div>
        <div class="col s6 center">
            <button class="modal-action modal-close btn-large red waves-effect">Cerrar</button>
        </div>
    </div>
</div>
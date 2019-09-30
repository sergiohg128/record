<!--MENÚ MOBILE-->
<style>
  
  .side-nav a{
    height: auto !important;
  }
</style>
<ul id="mobile-menu" data-collapsible="accordion" class="collapsible side-nav">
  @if($usuario->id_facultad==null)
  <div class="divider"></div>
  <li>
      <a class="collapsible-header waves-effect blue darken-2 white-text">CONFIGURACIÓN</a>
      <div class="collapsible-body">
          <ul>
              <li><a href="usuarios" class="waves-effect">USUARIOS</a></li>
              <div class="divider"></div>
              <li><a href="tipos-proyectos" class="waves-effect">TIPOS DE PROYECTOS</a></li>
              <div class="divider"></div>
              <li><a href="tipos-grupos" class="waves-effect">TIPOS DE GRUPOS</a></li>
              <div class="divider"></div>
          </ul>
      </div>
  </li>
  @endif
  <div class="divider"></div>
  <li>
      <a class="collapsible-header waves-effect blue darken-2 white-text">INVESTIGACIÓN</a>
      <div class="collapsible-body">
          <ul>
              <li><a href="proyectose" class="waves-effect">ESTUDIANTES SELGESTIUN</a></li>
              <div class="divider"></div>
              <li><a href="proyectosd" class="waves-effect">DOCENTES SELGESTIUN</a></li>
              <div class="divider"></div>
              <li><a href="proyectos" class="waves-effect">OTROS</a></li>
              <div class="divider"></div>
              <li><a href="proyecto-formulario" class="waves-effect">NUEVO PROYECTO</a></li>
              <div class="divider"></div>
          </ul>
      </div>
  </li>
  <div class="divider"></div>
  <li>
      <a class="collapsible-header waves-effect blue darken-2 white-text">REPORTES</a>
      <div class="collapsible-body">
          <ul>              
              <li><a href="reportes#fechas" class="waves-effect">INVESTIGACIONES POR FECHA</a></li>
              <div class="divider"></div>
              <li><a href="reportes#facultad" class="waves-effect">INVESTIGACIONES POR FACULTAD</a></li>
              <div class="divider"></div>
              <li><a href="reportes#escuela" class="waves-effect">INVESTIGACIONES POR ESCUELA</a></li>
              <div class="divider"></div>
              <li><a href="reportes#investigador" class="waves-effect">INVESTIGACIONES POR INVESTIGADOR</a></li>
          </ul>
      </div>
  </li>
  <div class="divider"></div>
  <li>
      <a href="pass" class="collapsible-header waves-effect brown white-text">CAMBIAR CONTRASEÑA</a>
  </li>
  <div class="divider"></div>
  <li>
      <a href="logout" class="collapsible-header waves-effect red white-text">SALIR</a>
  </li>
</ul>
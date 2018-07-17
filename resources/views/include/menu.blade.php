<!--MENÚ WEB-->
<header class="navbar-fixed">
  <nav class="nav-wrapper"><a data-activates="mobile-menu" href="#" class="button-collapse left"><i class="material-icons">menu</i></a>
    <ul id="nav-mobile" class="right hide-on-med-and-down">
        <li>
            <a href="inicio" class="waves-effect">
                INICIO
            </a>
        </li>
        <li>
            <a data-activates="dropdown_configuracion" class="dropdown-button waves-effect">
                CONFIGURACIÓN
                <i class="material-icons right">arrow_drop_down</i>
            </a>
            <ul id="dropdown_configuracion" class="dropdown-content">
                <li><a href="usuarios" class="waves-effect">USUARIOS</a></li>
                <li><a href="facultades" class="waves-effect">FACULTADES</a></li>
                <li><a href="tipos-proyectos" class="waves-effect">TIPOS DE PROYECTOS</a></li>
                <li><a href="tipos-investigadores" class="waves-effect">TIPOS DE INVESTIGADORES</a></li>
                <li><a href="tipos-grupos" class="waves-effect">TIPOS DE GRUPOS</a></li>
            </ul>
        </li>
        <li>
            <a data-activates="dropdown_investigacion" class="dropdown-button waves-effect">
                INVESTIGACIÓN
                <i class="material-icons right">arrow_drop_down</i>
            </a>
            <ul id="dropdown_investigacion" class="dropdown-content">
                <li><a href="investigadores" class="waves-effect">INVESTIGADORES</a></li>
                <li><a href="grupos" class="waves-effect">GRUPOS</a></li>
                <li><a href="proyectos" class="waves-effect">PROYECTOS</a></li>
                <li><a href="proyecto-formulario" class="waves-effect">NUEVO PROYECTO</a></li>
            </ul>
        </li>
        <li>
            <a data-activates="dropdown_reportes" class="dropdown-button waves-effect">
                REPORTES
                <i class="material-icons right">arrow_drop_down</i>
            </a>
            <ul id="dropdown_reportes" class="dropdown-content">
                <li><a href="reportes#fechas" class="waves-effect">POR FECHA</a></li>
                <li><a href="reportes#facultad" class="waves-effect">POR FACULTAD</a></li>
                <li><a href="reportes#escuela" class="waves-effect">POR ESCUELA</a></li>
                <li><a href="reportes#investigador" class="waves-effect">POR INVESTIGADOR</a></li>
                <li><a href="reportes#grupo" class="waves-effect">POR GRUPO</a></li>
                <li><a href="reportes#programa" class="waves-effect">POR PROGRAMA</a></li>
                <li><a href="reportes#linea" class="waves-effect">POR LINEA</a></li>
            </ul>
        </li>
        <li>
            <a data-activates="dropdown_cuenta" class="dropdown-button waves-effect">
                CUENTA
                <i class="material-icons right">arrow_drop_down</i>
            </a>
            <ul id="dropdown_cuenta" class="dropdown-content">
                <li><a href="pass" class="waves-effect">CAMBIAR CONTRASEÑA</a></li>
                <li><a href="logout" class="waves-effect">SALIR</a></li>
            </ul>
        </li>
        @if($usuario->id_tipo=="1")
        <li><a href="pedido" class="waves-effect btn-large yellow darken-2 contadorcarrito">PEDIDO({{$usuario->carrito}})</a></li>
        @endif
    </ul>
  </nav>
</header>
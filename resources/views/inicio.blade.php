    @include('include.head')
    @include('include.menu')
    @include('include.menu-mobile')
    <!--Cuerpo-->
    <div class="row cuerpo">
      <div class="row titulo center">
        <h4>SISTEMA DE RECORD PARTICIPATIVO - UNPRG</h4>
      </div>
      <div class="col s10 offset-s1 tabla">

        <div class="col s12 m6 l3 card">
            <div class="row titulo center">
                <h5>CONFIGURACIÓN</h5>
            </div>
            <div class="row">
                <li><a href="usuarios" class="waves-effect">USUARIOS</a></li>
                <li><a href="tipos-proyectos" class="waves-effect">TIPOS DE PROYECTOS</a></li>
                <li><a href="tipos-grupos" class="waves-effect">TIPOS DE GRUPOS</a></li>
            </div>
        </div>

        <div class="col s12 m6 l3 offset-l1 card">
            <div class="row titulo center">
                <h5>INVESTIGACIÓN</h5>
            </div>
            <div class="row">
                <li><a href="investigadores" class="waves-effect">INVESTIGADORES</a></li>
                <li><a href="proyectos" class="waves-effect">PROYECTOS</a></li>
                <li><a href="proyecto-formulario" class="waves-effect">NUEVO PROYECTO</a></li>
            </div>
        </div>

        <div class="col s12 m6 l3 offset-l1 card">
            <div class="row titulo center">
                <h5>REPORTES</h5>
            </div>
            <div class="row">
                <li><a href="reportes#fechas" class="waves-effect">INVESTIGACIONES POR FECHA</a></li>
                <li><a href="reportes#facultad" class="waves-effect">INVESTIGACIONES POR FACULTAD</a></li>
                <li><a href="reportes#escuela" class="waves-effect">INVESTIGACIONES POR ESCUELA</a></li>
                <li><a href="reportes#investigador" class="waves-effect">INVESTIGACIONES POR INVESTIGADOR</a></li>
                <li><a href="reportes#grupo" class="waves-effect">INVESTIGACIONES POR GRUPO</a></li>
                <li><a href="reportes#programa" class="waves-effect">INVESTIGACIONES POR PROGRAMA</a></li>
                <li><a href="reportes#linea" class="waves-effect">INVESTIGACIONES POR LINEA</a></li>
            </div>
        </div>
        
      </div>
    </div>
    @include('include.footer')
    @include('include.head')
    @include('include.menu')
    @include('include.menu-mobile')
    <!--Cuerpo-->
    <div class="row cuerpo">
      <div class="row titulo center">
        <h4>REPORTES</h4>
      </div>
        <div class="row" id="fechas">
            <div class="col s10 offset-s1 center card">
                <div class="titulo row" >
                    <h5>INVESTIGACIONES POR FECHA</h5>
                </div>
                <form id="reportefechas" method="POST" action="reportefechas">
                    {{ csrf_field() }}
                    <div class="col s12 m6 l4 center input-field">
                        <div class="col s3">
                            <label>Desde</label>
                        </div>
                        <div class="col s9">
                            <input type="date" name="desde" value="{{$desde}}-01-01">
                        </div>
                    </div>
                    <div class="col s12 m6 l4 center input-field">
                        <div class="col s3">
                            <label>Hasta</label>
                        </div>
                        <div class="col s9">
                            <input type="date" name="hasta" value="{{$hoy}}">
                        </div>
                    </div>
                    <div class="col s12 m6 l1 offset-l1 input-field">
                        <a onclick="reporte(1)" class="btn"><i class="material-icons">input</i></a>
                    </div>
                </form>
            </div>
        </div>
        <div class="row">
            <div class="col s10 offset-s1 center card">
                <div class="titulo row" id="facultad">
                    <h5>INVESTIGACIONES POR FACULTAD</h5>
                </div>
                <form id="reportefacultad" method="POST" action="reportefacultad">
                    {{ csrf_field() }}
                    <div class="col s12 m6 l5 input-field">
                        FACULTAD
                        <select name="facultad" id="facultades" style="width: 100%;" class="browser-default">
                          <option value="0">Todos</option>
                          @forelse($facultades as $facultad)
                              <option value="{{$facultad->id}}">{{$facultad->nombre}}</option>
                          @empty
                              <option value="0">No hay facultades</option>
                          @endforelse
                        </select>
                    </div>
                    <div class="col s12 m6 l3 center input-field">
                        <div class="col s3">
                            <label>Desde</label>
                        </div>
                        <div class="col s9">
                            <input type="date" name="desde" value="{{$hoy}}">
                        </div>
                    </div>
                    <div class="col s12 m6 l3 center input-field">
                        <div class="col s3">
                            <label>Hasta</label>
                        </div>
                        <div class="col s9">
                            <input type="date" name="hasta" value="{{$hoy}}">
                        </div>
                    </div>
                    <div class="col s12 m6 l1 input-field">
                        <a onclick="reporte(2)" class="btn"><i class="material-icons">input</i></a>
                    </div>
                </form>
            </div>
        </div>
        
        <div class="row">
            <div class="col s10 offset-s1 center card">
                <div class="titulo row" id="escuela">
                    <h5>INVESTIGACIONES POR ESCUELA</h5>
                </div>
                <form id="reporteescuela" method="POST" action="reporteescuela">
                    {{ csrf_field() }}
                    <div class="col s12 m6 l5 input-field">
                        ESCUELA
                        <select name="escuela" id="escuelaes" style="width: 100%;" class="browser-default">
                          <option value="0">Todos</option>
                          @forelse($escuelas as $escuela)
                              <option value="{{$escuela->id}}">{{$escuela->nombre}}</option>
                          @empty
                              <option value="0">No hay escuelas</option>
                          @endforelse
                        </select>
                    </div>
                    <div class="col s12 m6 l3 center input-field">
                        <div class="col s3">
                            <label>Desde</label>
                        </div>
                        <div class="col s9">
                            <input type="date" name="desde" value="{{$desde}}-01-01">
                        </div>
                    </div>
                    <div class="col s12 m6 l3 center input-field">
                        <div class="col s3">
                            <label>Hasta</label>
                        </div>
                        <div class="col s9">
                            <input type="date" name="hasta" value="{{$hoy}}">
                        </div>
                    </div>
                    <div class="col s12 m6 l1 input-field">
                        <a onclick="reporte(3)" class="btn"><i class="material-icons">input</i></a>
                    </div>
                </form>
            </div>
        </div>
        
        <div class="row">
            <div class="col s10 offset-s1 center card">
                <div class="titulo row" id="investigador">
                    <h5>INVESTIGACIONES POR INVESTIGADOR</h5>
                </div>
                <form id="reporteinvestigador" method="POST" action="reporteinvestigador">
                    {{ csrf_field() }}
                    
                    <div class="col s12 m6 l5 input-field">
                        INVESTIGADOR
                        <select name="investigador" id="investigadores" style="width: 100%;" class="browser-default">
                          <option value="0">Todos</option>
                          @forelse($investigadores as $investigador)
                              <option value="{{$investigador->id}}">{{$investigador->nombre}}</option>
                          @empty
                              <option value="0">No hay investigadores</option>
                          @endforelse
                        </select>
                    </div>
                    <div class="col s12 m6 l3 center input-field">
                        <div class="col s3">
                            <label>Desde</label>
                        </div>
                        <div class="col s9">
                            <input type="date" name="desde" value="{{$desde}}-01-01">
                        </div>
                    </div>
                    <div class="col s12 m6 l3 center input-field">
                        <div class="col s3">
                            <label>Hasta</label>
                        </div>
                        <div class="col s9">
                            <input type="date" name="hasta" value="{{$hoy}}">
                        </div>
                    </div>
                    <div class="col s12 m6 l1 input-field">
                        <a onclick="reporte(4)" class="btn"><i class="material-icons">input</i></a>
                    </div>
                </form>
            </div>
        </div>
        
        <div class="row">
            <div class="col s10 offset-s1 center card">
                <div class="titulo row" id="grupo">
                    <h5>INVESTIGACIONES POR GRUPO</h5>
                </div>
                <form id="reportegrupo" method="POST" action="reportegrupo">
                    {{ csrf_field() }}
                    <div class="col s12 m6 l5 input-field">
                        GRUPO
                        <select name="grupo" id="grupos"  style="width:100%;" class="browser-default">
                          <option value="0">Elija una grupo</option>
                          @forelse($grupos as $grupo)
                              <option value="{{$grupo->id}}">{{$grupo->nombre}}</option>
                          @empty
                              <option value="0">No hay grupos</option>
                          @endforelse
                        </select>
                    </div>
                    <div class="col s12 m6 l3 center input-field">
                        <div class="col s3">
                            <label>Desde</label>
                        </div>
                        <div class="col s9">
                            <input type="date" name="desde" value="{{$desde}}-01-01">
                        </div>
                    </div>
                    <div class="col s12 m6 l3 center input-field">
                        <div class="col s3">
                            <label>Hasta</label>
                        </div>
                        <div class="col s9">
                            <input type="date" name="hasta" value="{{$hoy}}">
                        </div>
                    </div>
                    <div class="col s12 m6 l1 input-field">
                        <a onclick="reporte(5)" class="btn"><i class="material-icons">input</i></a>
                    </div>
                </form>
            </div>
        </div>

        <div class="row">
            <div class="col s10 offset-s1 center card">
                <div class="titulo row" id="programa">
                    <h5>INVESTIGACIONES POR PROGRAMAS</h5>
                </div>
                <form id="reporteprograma" method="POST" action="reporteprograma">
                    {{ csrf_field() }}
                    <div class="col s12 m6 l5 input-field">
                        PROGRAMA
                        <select name="programa" id="programas"  style="width:100%;" class="browser-default">
                          <option value="0">Elija una programa</option>
                          @forelse($programas as $programa)
                              <option value="{{$programa->id}}">{{$programa->nombre}}</option>
                          @empty
                              <option value="0">No hay programas</option>
                          @endforelse
                        </select>
                    </div>
                    <div class="col s12 m6 l3 center input-field">
                        <div class="col s3">
                            <label>Desde</label>
                        </div>
                        <div class="col s9">
                            <input type="date" name="desde" value="{{$desde}}-01-01">
                        </div>
                    </div>
                    <div class="col s12 m6 l3 center input-field">
                        <div class="col s3">
                            <label>Hasta</label>
                        </div>
                        <div class="col s9">
                            <input type="date" name="hasta" value="{{$hoy}}">
                        </div>
                    </div>
                    <div class="col s12 m6 l1 input-field">
                        <a onclick="reporte(6)" class="btn"><i class="material-icons">input</i></a>
                    </div>
                </form>
            </div>
        </div>

        <div class="row">
            <div class="col s10 offset-s1 center card">
                <div class="titulo row" id="linea">
                    <h5>INVESTIGACIONES POR LINEA</h5>
                </div>
                <form id="reportegrupo" method="POST" action="reportegrupo">
                    {{ csrf_field() }}
                    <div class="col s12 m6 l5 input-field">
                        LINEA
                        <select name="linea" id="lineas"  style="width:100%;" class="browser-default">
                          <option value="0">Elija una linea</option>
                          @forelse($lineas as $linea)
                              <option value="{{$linea->id}}">{{$linea->nombre}}</option>
                          @empty
                              <option value="0">No hay lineas</option>
                          @endforelse
                        </select>
                    </div>
                    <div class="col s12 m6 l3 center input-field">
                        <div class="col s3">
                            <label>Desde</label>
                        </div>
                        <div class="col s9">
                            <input type="date" name="desde" value="{{$desde}}-01-01">
                        </div>
                    </div>
                    <div class="col s12 m6 l3 center input-field">
                        <div class="col s3">
                            <label>Hasta</label>
                        </div>
                        <div class="col s9">
                            <input type="date" name="hasta" value="{{$hoy}}">
                        </div>
                    </div>
                    <div class="col s12 m6 l1 input-field">
                        <a onclick="reporte(7)" class="btn"><i class="material-icons">input</i></a>
                    </div>
                </form>
            </div>
        </div>
    </div>
    @include('include.footer')

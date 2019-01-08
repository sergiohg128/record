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
                <form method="POST" action="reporte" target="_blank">
                    {{ csrf_field() }}
                    <input type="hidden" name="tipo" value="1">
                    <div class="col s12 m6 l4 center input-field">
                        <div class="col s3">
                            <label>Desde</label>
                        </div>
                        <div class="col s9">
                            <input type="date" name="desde" value="">
                        </div>
                    </div>
                    <div class="col s12 m6 l4 center input-field">
                        <div class="col s3">
                            <label>Hasta</label>
                        </div>
                        <div class="col s9">
                            <input type="date" name="hasta" value="">
                        </div>
                    </div>
                    <div class="col s12 m6 l1 offset-l1 input-field">
                        <button type="submit" class="btn"><i class="material-icons">input</i></button>
                    </div>
                </form>
            </div>
        </div>
        <div class="row">
            <div class="col s10 offset-s1 center card">
                <div class="titulo row" id="facultad">
                    <h5>INVESTIGACIONES POR FACULTAD</h5>
                </div>
                <form method="POST" action="reporte" target="_blank">
                    {{ csrf_field() }}
                    <input type="hidden" name="tipo" value="2">
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
                            <input type="date" name="desde" value="">
                        </div>
                    </div>
                    <div class="col s12 m6 l3 center input-field">
                        <div class="col s3">
                            <label>Hasta</label>
                        </div>
                        <div class="col s9">
                            <input type="date" name="hasta" value="">
                        </div>
                    </div>
                    <div class="col s12 m6 l1 input-field">
                        <button type="submit" class="btn"><i class="material-icons">input</i></button>
                    </div>
                </form>
            </div>
        </div>
        
        <div class="row">
            <div class="col s10 offset-s1 center card">
                <div class="titulo row" id="escuela">
                    <h5>INVESTIGACIONES POR ESCUELA</h5>
                </div>
                <form method="POST" action="reporte" target="_blank">
                    {{ csrf_field() }}
                    <input type="hidden" name="tipo" value="3">
                    <div class="col s12 m6 l5 input-field">
                        ESCUELA
                        <select name="escuela" id="escuelas" style="width: 100%;" class="browser-default">
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
                            <input type="date" name="desde" value="">
                        </div>
                    </div>
                    <div class="col s12 m6 l3 center input-field">
                        <div class="col s3">
                            <label>Hasta</label>
                        </div>
                        <div class="col s9">
                            <input type="date" name="hasta" value="">
                        </div>
                    </div>
                    <div class="col s12 m6 l1 input-field">
                        <button type="submit" class="btn"><i class="material-icons">input</i></button>
                    </div>
                </form>
            </div>
        </div>
        
        <div class="row">
            <div class="col s10 offset-s1 center card">
                <div class="titulo row" id="investigador">
                    <h5>INVESTIGACIONES POR INVESTIGADOR</h5>
                </div>
                <form method="POST" action="reporte" target="_blank">
                    {{ csrf_field() }}
                    <input type="hidden" name="tipo" value="4">
                    
                    <div class="col s12 m6 l5 input-field">
                        INVESTIGADOR
                        <select name="investigador" id="investigadores" style="width: 100%;" class="browser-default">
                          <option value="0">Todos</option>
                          @forelse($investigadores as $investigador)
                              <option value="{{$investigador->tb_usuario_id}}">{{$investigador->completo()}}</option>
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
                            <input type="date" name="desde" value="">
                        </div>
                    </div>
                    <div class="col s12 m6 l3 center input-field">
                        <div class="col s3">
                            <label>Hasta</label>
                        </div>
                        <div class="col s9">
                            <input type="date" name="hasta" value="">
                        </div>
                    </div>
                    <div class="col s12 m6 l1 input-field">
                        <button type="submit" class="btn"><i class="material-icons">input</i></button>
                    </div>
                </form>
            </div>
        </div>
        
        <div class="row">
            <div class="col s10 offset-s1 center card">
                <div class="titulo row" id="programa">
                    <h5>INVESTIGACIONES POR PROGRAMAS</h5>
                </div>
                <form method="POST" action="reporte" target="_blank">
                    {{ csrf_field() }}
                    <input type="hidden" name="tipo" value="6">
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
                            <input type="date" name="desde" value="">
                        </div>
                    </div>
                    <div class="col s12 m6 l3 center input-field">
                        <div class="col s3">
                            <label>Hasta</label>
                        </div>
                        <div class="col s9">
                            <input type="date" name="hasta" value="">
                        </div>
                    </div>
                    <div class="col s12 m6 l1 input-field">
                        <button type="submit" class="btn"><i class="material-icons">input</i></button>
                    </div>
                </form>
            </div>
        </div>

        <div class="row">
            <div class="col s10 offset-s1 center card">
                <div class="titulo row" id="linea">
                    <h5>INVESTIGACIONES POR LINEA</h5>
                </div>
                <form method="POST" action="reporte" target="_blank">
                    {{ csrf_field() }}
                    <input type="hidden" name="tipo" value="7">
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
                            <input type="date" name="desde" value="">
                        </div>
                    </div>
                    <div class="col s12 m6 l3 center input-field">
                        <div class="col s3">
                            <label>Hasta</label>
                        </div>
                        <div class="col s9">
                            <input type="date" name="hasta" value="">
                        </div>
                    </div>
                    <div class="col s12 m6 l1 input-field">
                        <button type="submit" class="btn"><i class="material-icons">input</i></button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    @include('include.footer')

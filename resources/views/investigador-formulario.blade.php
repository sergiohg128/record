    @include('include.head')
    @include('include.menu')
    @include('include.menu-mobile')
    <!--Cuerpo-->
    <div class="row cuerpo">
      <div class="row titulo center">
        <h4>FORMULARIO DE INVESTIGADOR</h4>
      </div>
        <div class="row">
        	<form action="investigador-formulario" method="POST">
        		{{ csrf_field() }}
        		<input type="hidden" name="id" value="{{$investigador->id}}">
        		<input type="hidden" name="modo" value="{{$modo}}">
	        	<div class="col s10 offset-s1 m8 offset-m2 l6 offset-l3 card">
		            <div class="col s12 input-field">
		            	<input type="text" name="nombres" required id="nombres" value="{{$investigador->nombres}}">
		            	<label for="nombres">Nombres</label>
		            </div>
		            <div class="col s12 input-field">
		            	<input type="text" name="paterno" required id="paterno" value="{{$investigador->paterno}}">
		            	<label for="paterno">Paterno</label>
		            </div>
		            <div class="col s12 input-field">
		            	<input type="text" name="materno" required id="materno" value="{{$investigador->materno}}">
		            	<label for="materno">Materno</label>
		            </div>
		            <div class="col s12 input-field">
		            	<input type="text" name="grado" required id="grado" value="{{$investigador->grado}}">
		            	<label for="grado">Grado Académico</label>
		            </div>
		            <div class="col s12 input-field">
		            	<input type="email" name="correo" id="correo" value="{{$investigador->correo}}">
		            	<label for="correo">Correo</label>
		            </div>
		            <div class="col s12 input-field">
		            	<input type="text" name="telefono" id="telefono" value="{{$investigador->telefono}}">
		            	<label for="telefono">Telefono</label>
		            </div>
		            <div class="col s12">
			            <label for="tipo_proyecto">Escuela Profesional</label>
			            <div class="col s12 input-field">
			            	<select id="escuela" name="escuela" required class="browser-default" style="width:100%;">
			            		<option value="">Elija una escuela</option>
			            		@foreach($escuelas as $escuela)
			            			<option value="{{$escuela->id}}" @if($investigador->id_escuela==$escuela->id) selected @endif>{{$escuela->nombrefacultad.' - '.$escuela->nombre}}</option>
			            		@endforeach
			            	</select>
			            </div>
		            </div>
		            <div class="col s12">
			            <label for="tipo_proyecto">Tipo de Investigador</label>
			            <div class="col s12 input-field">
			            	<select id="tipo_investigador" name="tipo_investigador" required class="browser-default" style="width:100%;">
			            		<option value="">Elija un tipo</option>
			            		@foreach($tiposinvestigadores as $tipoinvestigador)
			            			<option value="{{$tipoinvestigador->id}}" @if($investigador->id_tipo_investigador==$tipoinvestigador->id) selected @endif>{{$tipoinvestigador->nombre}}</option>
			            		@endforeach
			            	</select>
			            </div>
		            </div>
	        	</div>
	            <div class="row center">
	            	<div class="col s12">
	            		<button type="submit" class="btn">GUARDAR</button>	
	            	</div>
	            </div>
        	</form>
        </div>
    </div>
    @include('include.footer')
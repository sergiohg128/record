    @include('include.head')
    @include('include.menu')
    @include('include.menu-mobile')
    <!--Cuerpo-->
    <div class="row cuerpo">
      <div class="row titulo center">
        <h4>FORMULARIO DE ENTREGA</h4>
      </div>
        <div class="row">
        	<form action="entrega-formulario" method="POST">
        		{{ csrf_field() }}
        		<input type="hidden" name="modo" value="nuevo">
        		<input type="hidden" name="proyecto" value="{{$entrega->id_proyecto}}">
	        	<div class="col s10 offset-s1 m8 offset-m2 l6 offset-l3 card">
		            <div class="col s12">
			            <label for="tipo">Tipo de entrega</label>
			            <div class="col s12 input-field">
			            	<select id="tipo" name="tipo" required class="browser-default" style="width:100%;">
			            		<option value="">Elija un tipo de entrega</option>
			            		<option value="1">Registro de proyecto</option>
			            		<option value="2">Avance</option>
			            		<option value="3">Entrega Final de proyecto</option>
			            	</select>
			            </div>
		            </div>
		            <div class="col s12">
			            <label for="fecha">Fecha de presentación</label>
			            <div class="col s12 input-field">
			            	<input type="date" name="fecha" required id="fecha" value="{{$entrega->fecha}}">
			            </div>        		
		            </div>
		            <div class="col s12">
			            <label for="fecha">Observacion</label>
			            <div class="col s12 input-field">
			            	<input type="text" name="observacion" id="observacion" value="{{$entrega->observacion}}">
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
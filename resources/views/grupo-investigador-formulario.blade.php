    @include('include.head')
    @include('include.menu')
    @include('include.menu-mobile')
    <!--Cuerpo-->
    <div class="row cuerpo">
      <div class="row titulo center">
        <h4>FORMULARIO DE INVESTIGADOR</h4>
      </div>
        <div class="row">
        	<form action="grupo-investigador-formulario" method="POST">
        		{{ csrf_field() }}
        		<input type="hidden" name="modo" value="nuevo">
        		<input type="hidden" name="grupo" value="{{$grupo}}">
	        	<div class="col s10 offset-s1 m8 offset-m2 l6 offset-l3 card">
		            <div class="col s12">
			            <label for="investigador">Investigador</label>
			            <div class="col s12 input-field">
			            	<select id="investigador" name="investigador" required class="browser-default" style="width:100%;">
			            		<option value="">Elija un investigador</option>
			            		@foreach($investigadores as $investigador)
			            			<option value="{{$investigador->id}}">{{$investigador->completo()}}</option>
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
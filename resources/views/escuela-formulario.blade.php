    @include('include.head')
    @include('include.menu')
    @include('include.menu-mobile')
    <!--Cuerpo-->
    <div class="row cuerpo">
      <div class="row titulo center">
        <h4>FORMULARIO DE ESCUELA PROFESIONAL</h4>
      </div>
        <div class="row">
        	<form action="escuela-formulario" method="POST">
        		{{ csrf_field() }}
        		<input type="hidden" name="id" value="{{$escuela->id}}">
        		<input type="hidden" name="facultad" value="{{$escuela->id_facultad}}">
        		<input type="hidden" name="modo" value="{{$modo}}">
	        	<div class="col s10 offset-s1 m8 offset-m2 l6 offset-l3 card">
		            <div class="col s12 input-field">
		            	<input type="text" name="nombre" required id="nombre" value="{{$escuela->nombre}}">
		            	<label for="nombre">Nombre</label>
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
    @include('include.head')
    @include('include.menu')
    @include('include.menu-mobile')
    <!--Cuerpo-->
    <div class="row cuerpo">
      <div class="row titulo center">
        <h4>FORMULARIO DE USUARIO</h4>
      </div>
        <div class="row">
        	<form action="usuario-formulario" method="POST">
        		{{ csrf_field() }}
        		<input type="hidden" name="id" value="{{$usuario->id}}">
        		<input type="hidden" name="modo" value="{{$modo}}">
	        	<div class="col s10 offset-s1 m8 offset-m2 l6 offset-l3 card">
		            <div class="col s12 input-field">
		            	<input type="text" name="nombres" required id="nombres" value="{{$usuario->nombres}}">
		            	<label for="nombres">Nombres</label>
		            </div>
		            <div class="col s12 input-field">
		            	<input type="text" name="paterno" required id="paterno" value="{{$usuario->paterno}}">
		            	<label for="paterno">Apellido Paterno</label>
		            </div>
		            <div class="col s12 input-field">
		            	<input type="text" name="materno" required id="materno" value="{{$usuario->materno}}">
		            	<label for="materno">Apellido Materno</label>
		            </div>
		            <div class="col s12 input-field">
		            	<input type="text" name="cuenta" required id="cuenta" value="{{$usuario->cuenta}}">
		            	<label for="cuenta">Cuenta</label>
		            </div>
		        	<div class="col s12">
			            <label for="facultad">Facultad</label>
			            <div class="col s12 input-field">
			            	<select id="facultad" name="facultad" class="browser-default" style="width:100%;">
			            		<option value="">Elija una facultad</option>
			            		@foreach($facultades as $facultad)
			            			<option value="{{$facultad->id}}" @if($usuario->id_facultad==$facultad->id) selected @endif>{{$facultad->nombre}}</option>
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
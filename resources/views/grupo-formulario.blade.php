    @include('include.head')
    @include('include.menu')
    @include('include.menu-mobile')
    <!--Cuerpo-->
    <div class="row cuerpo">
      <div class="row titulo center">
        <h4>FORMULARIO DE GRUPO</h4>
      </div>
        <div class="row">
        	<form action="grupo-formulario" method="POST">
        		{{ csrf_field() }}
        		<input type="hidden" name="id" value="{{$grupo->id}}">
        		<input type="hidden" name="modo" value="{{$modo}}">
	        	<div class="col s10 offset-s1 m8 offset-m2 l6 offset-l3 card">
		            <div class="col s12 input-field">
		            	<input type="text" name="nombre" required id="nombre" value="{{$grupo->nombre}}">
		            	<label for="nombre">Nombre</label>
		            </div>
		            
		            <div class="col s12">
			            <label for="tipo_proyecto">Tipo de grupo</label>
			            <div class="col s12 input-field">
			            	<select id="tipo_grupo" name="tipo_grupo" required class="browser-default" style="width:100%;">
			            		<option value="">Elija un tipo</option>
			            		@foreach($tiposgrupos as $tipogrupo)
			            			<option value="{{$tipogrupo->id}}" @if($grupo->id_tipo_grupo==$tipogrupo->id) selected @endif>{{$tipogrupo->nombre}}</option>
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
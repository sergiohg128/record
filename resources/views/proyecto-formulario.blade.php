    @include('include.head')
    @include('include.menu')
    @include('include.menu-mobile')
    <!--Cuerpo-->
    <div class="row cuerpo">
      <div class="row titulo center">
        <h4>FORMULARIO DE PROYECTO</h4>
      </div>
        <div class="row">
        	<form action="proyecto-formulario" method="POST">
        		{{ csrf_field() }}
        		<input type="hidden" name="id" value="{{$proyecto->id}}">
        		<input type="hidden" name="modo" value="{{$modo}}">
	        	<div class="col s10 offset-s1 m8 offset-m2 l6 offset-l3 card">
		            <div class="col s12 input-field">
		            	<input type="text" name="titulo" required id="titulo" value="{{$proyecto->titulo}}">
		            	<label for="titulo">Titulo</label>
		            </div>
		            
		            <!-- <div class="col s12">
			            <label for="modalidad">Modalidad</label>
			            <div class="col s12 input-field">
			            	<select id="modalidad" name="modalidad" required class="browser-default" style="width:100%;" onchange="cambiarmodalidad();">
			            		<option value="">Elija una modalidad</option>
			            		<option value="I" @if($proyecto->modalidad=="I") selected @endif>Individual</option>
			            		<option value="G" @if($proyecto->modalidad=="G") selected @endif>Grupal</option>
			            	</select>
			            </div>
		            </div>
		            
		            <div class="col s12" id="investigadores">
			            <label for="investigador">Investigador</label>
			            <div class="col s12 input-field">
			            	<select id="investigador" name="investigador" required class="browser-default" style="width:100%;">
			            		<option value="">Elija un investigador</option>
			            		@foreach($investigadores as $investigador)
			            			<option value="{{$investigador->id}}" @if($proyecto->id_investigador==$investigador->id) selected @endif>{{$investigador->completo()}}</option>
			            		@endforeach
			            	</select>
			            </div>
		            </div> -->

		            <div class="col s12" id="grupos">
			            <label for="grupo">Tipo de Grupo</label>
			            <div class="col s12 input-field">
			            	<select id="grupo" name="tipogrupo" required class="browser-default" style="width:100%;">
			            		<option value="">Elija un tipo</option>
			            		@foreach($tiposgrupos as $grupo)
			            			<option value="{{$grupo->id}}" @if($proyecto->id_grupo==$grupo->id) selected @endif>{{$grupo->nombre}}</option>
			            		@endforeach
			            	</select>
			            </div>
		            </div>
		            <div class="col s12">
			            <label for="tipo_proyecto">Tipo de Proyecto</label>
			            <div class="col s12 input-field">
			            	<select id="tipo_proyecto" name="tipo_proyecto" required class="browser-default" style="width:100%;">
			            		<option value="">Elija un tipo</option>
			            		@foreach($tiposproyectos as $tipoproyecto)
			            			<option value="{{$tipoproyecto->id}}" @if($proyecto->id_tipo_proyecto==$tipoproyecto->id) selected @endif>{{$tipoproyecto->nombre}}</option>
			            		@endforeach
			            	</select>
			            </div>
		            </div>
		            <div class="col s12">
			            <label for="programa">Programa</label>
			            <div class="col s12 input-field">
			            	<select id="programa" name="programa" class="browser-default" style="width:100%;" onchange="cambiarprograma();">
			            		<option value="">Sin programa</option>
			            		@foreach($programas as $programa)
			            			<option value="{{$programa->id}}" @if($programax->id==$programa->id) selected @endif>{{$programa->nombre}}</option>
			            		@endforeach
			            	</select>
			            </div>
		            </div>
		            <div class="col s12">
			            <label for="linea">Lineas</label>
			            <div class="col s12 input-field" id="divlineas">
			            	<select id="linea" name="linea" class="browser-default" style="width:100%;">
			            		<option value="">Sin linea</option>
			            	</select>
			            </div>
		            </div>
		            <div class="col s12">
			            <label for="fecha">Fecha de presentación</label>
			            <div class="col s12 input-field">
			            	<input type="date" name="fecha" required id="fecha" value="{{$proyecto->fecha}}">
			            </div>        		
		            </div>
		            <div class="col s12">
			            <label for="fecha">Fecha final</label>
			            <div class="col s12 input-field">
			            	<input type="date" name="fecha2" required id="fecha2" value="{{$proyecto->fecha2}}">
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


    <script>
    	cambiarmodalidad();

    	function cambiarmodalidad(){
    		$('#investigadores').hide();
    		$('#grupos').hide();
    		$('#investigador').prop('required',false);
    		$('#grupo').prop('required',false);
			var modalidad = $('#modalidad').val();

			if(modalidad=="I"){
				$('#investigadores').show();
				$('#investigador').prop('required',true);
			}else if(modalidad=="G"){
				$('#grupos').show();
				$('#grupo').prop('required',true);
			}
    	}

    	function cambiarprograma(){
    		
			var id = $('#programa').val();
			if(id>0){
				$.ajax({
		        type: "GET",
		        url: "lineas",
		        data: {"id":id,"ajax":true},
		        success: function(a) {
		            a = JSON.parse(a);
		            if(a.ok){
		                var lista = a.obj;
		                var html = '<label for="linea">Lineas</label>'+
		                            '<select id="linea" name="linea" style="width: 100%;">';
		                html += "<option value=''>Sin linea</option>"; 
		                $.each(lista,function (key,linea){
		                  html += "<option value='"+linea.id+"' id='linea"+linea.id+"'>"+linea.nombre+"</option>";  
		                });
		                html += '</select>';
		                $('#divlineas').html(html);
		                $('#linea').select2();
		                $('#linea').val('{{$proyecto->id_linea}}').trigger('change');
		            }else{
		                if(a.url==null){
		                    alerta(a.error);
		                }else{
		                    window.location = a.url;
		                }
		            }
		        }
		    });
			}
    	}

    	@if($programa->id>0)
    		cambiarprograma();
    	@endif
    </script>
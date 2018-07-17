$( document ).ready(function(){
    
    window.addEventListener("keypress", function(event){
        if (event.keyCode == 13){
            event.preventDefault();
        }
    }, false);
        
  $('.fixed-action-btn').openFAB();
  $('.fixed-action-btn').closeFAB();
  $('.collapsible').collapsible();
	$(".dropdown-button").dropdown({
    hover:true,
    belowOrigin: true
  });
  $('.slider').slider({
    full_width: true,
    indicators: false
  });
	$('select').material_select();
  	$('#textarea1').trigger('autoresize');
  	$('.datepicker').pickadate({
	    selectMonths: true, // Creates a dropdown to control month
	    selectYears: 15 // Creates a dropdown of 15 years to control year
	  });
  $('.button-collapse').sideNav({
  	menuWidth: 240
  });
  $('.modal').modal({
  		starting_top: '10%',
      	ending_top: '5%'
  	});
  $(".clickable-row").click(function() {
        window.document.location = $(this).data("href");
    });
    $('select').select2();
})

function alerta(mensaje){
    Materialize.toast(mensaje,5000);
}
function alerta2(mensaje,segundos){
    Materialize.toast(mensaje,segundos*1000);
}

function agregar(tabla){
    $('#tabla-agregar').val(tabla);
    $('#modal-agregar').modal('open');
}

function editar(tabla,id,nombre){
    $('#tabla-editar').val(tabla);
    $('#modal-editar').modal('open');
    $('#id-editar').val(id);
    $('#nombre-editar').val(nombre);
}

function eliminar(tabla,id){
    $('#tabla-eliminar').val(tabla);
    $('#id-eliminar').val(id);
    $('#modal-eliminar').modal('open');
}

function modalproducto(id,nombre,compra,venta,cantidad,idmarca,idcategoria,idunidad,idunidad2){
    if(id==0){
        $('#modo-producto').val('agregar');
        $('#divunidad').show();
        $('#nombre-producto').val(null);
        $('#compra-producto').val(null);
        $('#venta-producto').val(null);
        $('#cantidad-producto').val(null);
        $('#divcantidadproducto').show();
    }else{
        $('#id-producto').val(id);
        $('#nombre-producto').val(nombre);
        $('#compra-producto').val(compra);
        $('#venta-producto').val(venta);
        $('#cantidad-producto').val(cantidad);
        $('#modo-producto').val('editar');
        $('#unidad-producto').val(idunidad);
        $('#unidad2-producto').val(idunidad2);
        $('select').material_select('destroy');
        $('select').material_select();
        $('#lblnombre').addClass('active');
        $('#lblcompra').addClass('active');
        $('#lblventa').addClass('active');
        $('#lblcantidad').addClass('active');
        $('#divcantidadproducto').hide();
    }
    $('#modal-producto').modal('open');
}

function modaleditarproducto(id,nombre,compra,venta,seguridad){
    $('#id-producto-editar').val(id);
    $('#nombre-producto-editar').val(nombre);
    $('#compra-producto-editar').val(compra);
    $('#venta-producto-editar').val(venta);
    $('#seguridad-producto-editar').val(seguridad);
    $('#lblnombre-editar').addClass('active');
    $('#lblcompra-editar').addClass('active');
    $('#lblventa-editar').addClass('active');
    $('#lblseguridad-editar').addClass('active');
    $('#modal-editar-producto').modal('open');
}

function modaldetalle(id,nombre,obj,unidad,unidad2){
    objtmpdet = obj;
    $('#id-producto-detalle').val(id);
    $('#nombre-detalle').val(nombre);
    $('#cantidad-detalle').val(null);
    $('#lblnombredetalle').addClass("active");
    $('#lblcantidaddetalle').html("Cantidad de "+unidad);
    $('#lblcantidaddetalle2').html("Cantidad de "+unidad2);
    $('#modal-detalle').modal('open');
    $('#precio-detalle').focus();
}

function modaldescartar(id,tipo){
    $('#id-eliminar').val(id);
    $('#tipo').val(tipo);
    $('#modal-descartar').modal('open');
}

function modalpedido(){
    $('#totalmodal').html("TOTAL:  "+$('#total').html());
    $('#modal-pedido').modal('open');
}

function modaleditarproveedor(id,nombre,telefono,contacto,comentario){
    $('#id-editar').val(id);
    $('#nombre-editar').val(nombre);
    $('#telefono-editar').val(telefono);
    $('#contacto-editar').val(contacto);
    $('#comentario-editar').val(comentario);
    $('#lblnombre-editar').addClass('active');
    $('#lbltelefono-editar').addClass('active');
    $('#lblcontacto-editar').addClass('active');
    $('#lblcomentario-editar').addClass('active');
    $('#modal-editar').modal('open');
}

function agregarpost(){
    var cargando = '<div class="preloader-wrapper small active"><div class="spinner-layer spinner-green-only"><div class="circle-clipper left"><div class="circle"></div></div><div class="gap-patch"><div class="circle"></div></div><div class="circle-clipper right"><div class="circle"></div></div></div></div>';
    var btn = "<button onclick='agregarpost()' class='btn-large'>Guardar</button>";
    $("#divbtnagregar").html(cargando);
    var formData = $("#formagregar").serialize();
    $.ajax({
        type: "POST",
        url: "modelopost",
        data: formData,
        success: function(a) {
            a = JSON.parse(a);
            if(a.ok){
                alerta("GUARDADO CORRECTAMENTE");
                var fila = '';
                if(a.tabla=="categoria"){
                    var categoria = a.obj;
                    fila = '<tr id="fila'+categoria.id+'">'+
                           '<td></td>'+
                            '<td id="filanombre'+categoria.id+'">'+categoria.nombre+'</td>'+
                            '<td><a href="subcategorias?id_categoria='+categoria.id+'" class="btn"><i class="material-icons">input</i></a></td>'+
                            '<td><a href="productos?id_categoria='+categoria.id+'" class="btn  brown"><i class="material-icons">input</i></a></td>'+
                            '<td id="filaeditar'+categoria.id+'"><a onclick="editar(\'categoria\','+categoria.id+',\''+categoria.nombre+'\')" class="btn green"><i class="material-icons">edit</i></a></td>'+
                            '<td><a onclick="eliminar(\'categoria\','+categoria.id+')" class="btn red"><i class="material-icons">delete</i></a></td>'+
                            "</tr>";
                }
                else if(a.tabla=="subcategoria"){
                    var subcategoria = a.obj;
                    fila = '<tr id="fila'+subcategoria.id+'">'+
                                '<td></td>'+
                                '<td id="filanombre'+subcategoria.id+'">'+subcategoria.nombre+'</td>'+
                                '<td id="filaeditar'+subcategoria.id+'"><a onclick="editar(\'subcategoria\','+subcategoria.id+',\''+subcategoria.nombre+'\')" class="btn green"><i class="material-icons">edit</i></a></td>'+
                                '<td><a onclick="eliminar(\'subcategoria\','+subcategoria.id+')" class="btn red"><i class="material-icons">delete</i></a></td>'+
                              '</tr>';
                }
                else if(a.tabla=="proveedor"){
                    var proveedor = a.obj;
                    fila = '<tr id="fila'+proveedor.id+'">'+
                                '<td></td>'+
                                '<td id="filanombre'+proveedor.id+'">'+proveedor.nombre+'</td>'+
                                '<td id="filatelefono'+proveedor.id+'">'+proveedor.telefono+'</td>'+
                                '<td id="filacontacto'+proveedor.id+'">'+proveedor.contacto+'</td>'+
                                '<td id="filacomentario'+proveedor.id+'">'+proveedor.comentario+'</td>'+
                                '<td id="filaeditar'+proveedor.id+'"><a onclick="modaleditarproveedor('+proveedor.id+',\''+proveedor.nombre+'\',\''+proveedor.telefono+'\',\''+proveedor.contacto+'\',\''+proveedor.comentario+'\')" class="btn green"><i class="material-icons">edit</i></a></td>'+
                                '<td><a onclick="eliminar(\'proveedor\','+proveedor.id+')" class="btn red"><i class="material-icons">delete</i></a></td>'+
                              '</tr>';
                }else if(a.tabla=="linea"){
                    var linea = a.obj;
                    fila = '<tr id="fila'+linea.id+'">'+
                            '<td></td>'+
                            '<td id="filanombre'+linea.id+'">'+linea.nombre+'</td>'+
                            '<td id="filaeditar'+linea.id+'"><a onclick="editar(\'linea\','+linea.id+',\''+linea.nombre+'\')" class="btn green"><i class="material-icons">edit</i></a></td>'+
                            '<td><a onclick="eliminar(\'linea\','+linea.id+')" class="btn red"><i class="material-icons">delete</i></a></td>'+
                          '</tr>';
                }else if(a.tabla=="marca"){
                    var marca = a.obj;
                    fila = '<tr id="fila'+marca.id+'">'+
                            '<td></td>'+
                            '<td id="filanombre'+marca.id+'">'+marca.nombre+'</td>'+
                            '<td><a href="productos?marca='+marca.id+'" class="btn"><i class="material-icons">input</i></a></td>'+
                            '<td id="filaeditar'+marca.id+'"><a onclick="editar(\'marca\','+marca.id+',\''+marca.nombre+'\')" class="btn green"><i class="material-icons">edit</i></a></td>'+
                            '<td><a onclick="eliminar(\'marca\','+marca.id+')" class="btn red"><i class="material-icons">delete</i></a></td>'+
                          '</tr>';
                }else if(a.tabla=="unidad"){
                    var unidad = a.obj;
                    fila = '<tr id="fila'+unidad.id+'">'+
                            '<td></td>'+
                            '<td id="filanombre'+unidad.id+'">'+unidad.nombre+'</td>'+
                            '<td id="filaeditar'+unidad.id+'"><a onclick="editar(\'marca\','+unidad.id+',\''+unidad.nombre+'\')" class="btn green"><i class="material-icons">edit</i></a></td>'+
                            '<td><a onclick="eliminar(\'marca\','+unidad.id+')" class="btn red"><i class="material-icons">delete</i></a></td>'+
                          '</tr>';
                }else if(a.tabla=="tipo"){
                    var tipo = a.obj;
                    fila = '<tr id="fila'+tipo.id+'">'+
                            '<td></td>'+
                            '<td id="filanombre'+tipo.id+'">'+tipo.nombre+'</td>'+
                            '<td><a href="permisos?id='+tipo.id+'" class="btn"><i class="material-icons">input</i></a></td>'+
                            '<td><a href="usuarios?id='+tipo.id+'" class="btn brown"><i class="material-icons">input</i></a></td>'+
                            '<td id="filaeditar'+tipo.id+'"><a onclick="editar(\'tipo\','+tipo.id+',\''+tipo.nombre+'\')" class="btn green"><i class="material-icons">edit</i></a></td>'+
                            '<td><a onclick="eliminar(\'tipo\','+tipo.id+')" class="btn red"><i class="material-icons">delete</i></a></td>'+
                          '</tr>';
                }
                $('#filas').prepend(fila);
                $('#filaempty').hide();
                $("#modal-agregar").modal('close');
                $("#nombre-agregar").val("");
                $("#divbtnagregar").html(btn);
            }else{
                if(a.url==null){
                    alerta(a.error);
                    $("#divbtnagregar").html(btn);
                }else{
                    window.location = a.url;
                }
            }
        }
    });
}

function editarpost(){
    var cargando = '<div class="preloader-wrapper small active"><div class="spinner-layer spinner-green-only"><div class="circle-clipper left"><div class="circle"></div></div><div class="gap-patch"><div class="circle"></div></div><div class="circle-clipper right"><div class="circle"></div></div></div></div>';
    var btn = "<button onclick='editarpost()' class='btn-large'>Guardar</button>";
    $("#divbtneditar").html(cargando);
    var formData = $("#formeditar").serialize();
    $.ajax({
        type: "POST",
        url: "modelopost",
        data: formData,
        success: function(a) {
            a = JSON.parse(a);
            if(a.ok){
                alerta("EDITADO CORRECTAMENTE");
                var objeto = a.obj;
                $('#filanombre'+objeto.id).html(objeto.nombre);
                $('#filaeditar'+objeto.id).html('<a onclick="editar(\''+a.tabla+'\','+objeto.id+',\''+objeto.nombre+'\')" class="btn green"><i class="material-icons">edit</i></a>');
                $("#modal-editar").modal('close');
                $("#nombre-editar").val("");
                $("#divbtneditar").html(btn);
            }else{
                if(a.url==null){
                    alerta(a.error);
                    $("#divbtneditar").html(btn);
                }else{
                    window.location = a.url;
                }
            }
        }
    });
}

function eliminarpost(){
    var cargando = '<div class="preloader-wrapper small active"><div class="spinner-layer spinner-green-only"><div class="circle-clipper left"><div class="circle"></div></div><div class="gap-patch"><div class="circle"></div></div><div class="circle-clipper right"><div class="circle"></div></div></div></div>';
    var btn = "<button onclick='eliminarpost()' class='btn-large'>Guardar</button>";
    $("#divbtneliminar").html(cargando);
    var formData = $("#formeliminar").serialize();
    $.ajax({
        type: "POST",
        url: "modelopost",
        data: formData,
        success: function(a) {
            a = JSON.parse(a);
            if(a.ok){
                alerta("ELIMINADO CORRECTAMENTE");
                var categoria = a.obj;
                $('#fila'+categoria.id).remove();
                $("#modal-eliminar").modal('close');
                $("#divbtneliminar").html(btn);
                if(a.tabla=="producto"){
                    $('table').remove(".small-only");
                    $("#tabla-productos").removeClass("stacktable");
                    $("#tabla-productos").removeClass("large-only");
                    $("#tabla-productos").stacktable2();
                }
            }else{
                if(a.url==null){
                    alerta(a.error);
                    $("#divbtneliminar").html(btn);
                }else{
                    window.location = a.url;
                }
            }
        }
    });
}

function modalproductopost(){
    var valido = true;
    if(!$('#nombre-producto').val().length>0){
       valido = false;
       alerta("Complete el nombre");
    }
    if(!($('#unidad2-producto').val()>0)){
        valido = false;
        alerta("Elija una subunidad");
    }
    
    if(valido){
        var cargando = '<div class="preloader-wrapper small active"><div class="spinner-layer spinner-green-only"><div class="circle-clipper left"><div class="circle"></div></div><div class="gap-patch"><div class="circle"></div></div><div class="circle-clipper right"><div class="circle"></div></div></div></div>';
        var btn = "<button onclick='modalproductopost()' class='btn-large'>Guardar</button>";
        $("#divbtnproducto").html(cargando);
        var formData = $("#formproducto").serialize();
        var modo = $("#modo-producto").val();
        $.ajax({
            type: "POST",
            url: "modelopost",
            data: formData,
            success: function(a) {
                a = JSON.parse(a);
                if(a.ok){
                    alerta("GUARDADO CORRECTAMENTE");
                    var fila = '';
                    var producto = a.obj;
                    if(modo=="agregar"){
                        fila = '<tr id="fila'+producto.id+'">';
                        if(c1){fila += '<td></td>';}
                        if(c2){fila += '<td id="filanombre'+producto.id+'">'+producto.nombre+'</td>';}
                        if(c3){fila += '<td id="filacompra'+producto.id+'">'+producto.compra+'</td>';}
                        if(c4){fila += '<td id="filaventa'+producto.id+'">'+producto.venta+'</td>';}
                        if(c5){fila += '<td id="filacantidad'+producto.id+'">'+producto.cantidad+' '+producto.unidad2.nombre+'</td>';}
                        if(c6){fila += '<td id="filacompraunidad'+producto.id+'">'+(producto.compra/producto.cantidad).toFixed(2)+'</td>';}
                        if(c7){fila += '<td id="filaventatotal'+producto.id+'">'+(producto.venta/producto.cantidad).toFixed(2)+'</td>';}
                        if(c9){fila += '<td id="filagananciatotal'+producto.id+'">'+(producto.venta-producto.compra).toFixed(2)+'</td>';}
                        if(c8){fila += '<td id="filagananciaunidad'+producto.id+'">'+((producto.venta-producto.compra)/producto.cantidad).toFixed(2)+'</td>';}
                        if(c10){fila += '<td id="filamarca'+producto.id+'">'+producto.marca.nombre+'</td>';}
                        if(c11){fila += '<td id="filacategoria'+producto.id+'">'+producto.categoria.nombre+'</td>';}
                        if(c12){fila += '<td id="filaunidad'+producto.id+'">'+producto.unidad.nombre+'</td>';}
                        fila += 
//                                '<td><a href="historial?id='+producto.id+'" class="btn"><i class="material-icons">input</i></a></td>'+
//                                '<td id="filaeditar'+producto.id+'"><a onclick="modalproducto('+producto.id+',\''+producto.nombre+'\','+producto.compra+','+producto.venta+','+producto.cantidad+','+producto.marca.id+','+producto.categoria.id+','+producto.unidad.id+','+producto.unidad2.id+')" class="btn green"><i class="material-icons">edit</i></a></td>'+
                                '<td id="filaeditar'+producto.id+'"><a onclick="modaleditarproducto('+producto.id+',\''+producto.nombre+'\','+producto.compra+','+producto.venta+','+producto.seguridad+')" class="btn green"><i class="material-icons">edit</i></a></td>';
//                                '<td><a onclick="eliminar(\'producto\','+producto.id+')" class="btn red"><i class="material-icons">delete</i></a></td>';
                        fila += '<td id="filacarrito'+producto.id+'"><a onclick="modaldetalle('+producto.id+',\''+producto.nombre+'\',this,\''+producto.unidad.nombre+'\',\''+producto.unidad2.nombre+'\')" class="btn grey"><i class="material-icons">shopping_cart</i></a></td>';                     
                        fila +='</tr>';
                        $('#filas').prepend(fila);
                        if(tbpro=="V"){
                            $('table').remove(".small-only");
                            $("#tabla-productos").removeClass("stacktable");
                            $("#tabla-productos").removeClass("large-only");
                            $("#tabla-productos").stacktable2();
                        }
                        $('#filaempty').hide();
                    }
                    else if(modo=="editar"){
                        $('#filanombre'+producto.id).html(producto.nombre);
                        $('#filacompra'+producto.id).html(producto.compra);
                        $('#filaventa'+producto.id).html(producto.venta);
                        $('#filacantidad'+producto.id).html(producto.cantidad+' '+producto.unidad2.nombre);
                        $('#filacompraunidad'+producto.id).html((producto.compra/producto.cantidad).toFixed(2));
                        $('#filaporcentaje'+producto.id).html(((producto.compra/producto.cantidad)*(1+(porcentaje/100))).toFixed(2));
                        $('#filaventatotal'+producto.id).html((producto.venta/producto.cantidad).toFixed(2));
                        $('#filagananciatotal'+producto.id).html((producto.venta-producto.compra).toFixed(2));
                        $('#filagananciaunidad'+producto.id).html(((producto.venta-producto.compra)/producto.cantidad).toFixed(2));
                        //$('#filaeditar'+producto.id).html('<a onclick="modalproducto('+producto.id+',\''+producto.nombre+'\','+producto.compra+','+producto.venta+','+producto.cantidad+','+producto.id_marca+','+producto.id_categoria+','+producto.id_unidad+','+producto.id_unidad2+')" class="btn green"><i class="material-icons">edit</i></a>');    
                        $('#filaeditar'+producto.id).html('<a onclick="modaleditarproducto('+producto.id+',\''+producto.nombre+'\','+producto.compra+','+producto.venta+','+producto.seguridad+')" class="btn green"><i class="material-icons">edit</i></a>');    
//                        $('#filamarca'+producto.id).html(producto.marca.nombre);
//                        $('#filacategoria'+producto.id).html(producto.categoria.nombre);
//                        $('#filaunidad'+producto.id).html(producto.unidad.nombre);
                        if(tbpro=="V"){
                            $('table').remove(".small-only");
                            $("#tabla-productos").removeClass("stacktable");
                            $("#tabla-productos").removeClass("large-only");
                            $("#tabla-productos").stacktable();
                        }
                    }
                    $("#modal-producto").modal('close');
                    $("#nombre-producto").val("");
                    $("#divbtnproducto").html(btn);
                }else{
                    if(a.url==null){
                        alerta(a.error);
                        $("#divbtnproducto").html(btn);
                    }else{
                        window.location = a.url;
                    }
                }
            }
        });
    }
}


function modalproductoeditarpost(){
    var valido = true;
    if(!$('#nombre-producto-editar').val().length>0){
       valido = false;
       alerta("Complete el nombre");
    }
    if(valido){
        var cargando = '<div class="preloader-wrapper small active"><div class="spinner-layer spinner-green-only"><div class="circle-clipper left"><div class="circle"></div></div><div class="gap-patch"><div class="circle"></div></div><div class="circle-clipper right"><div class="circle"></div></div></div></div>';
        var btn = "<button onclick='modalproductoeditarpost()' class='btn-large'>Guardar</button>";
        $("#divbtnproducto-editar").html(cargando);
        var formData = $("#formproductoeditar").serialize();
        var modo = "editar";
        $.ajax({
            type: "POST",
            url: "modelopost",
            data: formData,
            success: function(a) {
                a = JSON.parse(a);
                if(a.ok){
                    alerta("GUARDADO CORRECTAMENTE");
                    var producto = a.obj;
                    $('#filanombre'+producto.id).html(producto.nombre);
                    $('#filacompra'+producto.id).html(producto.compra);
                    $('#filaventa'+producto.id).html(producto.venta);
                    $('#filacantidad'+producto.id).html(producto.cantidad+' '+producto.unidad2.nombre);
                    $('#filacompraunidad'+producto.id).html((producto.compra/producto.cantidad).toFixed(2));
                    $('#filaporcentaje'+producto.id).html(((producto.compra/producto.cantidad)*(1+(porcentaje/100))).toFixed(2));
                    $('#filaventatotal'+producto.id).html((producto.venta/producto.cantidad).toFixed(2));
                    $('#filagananciatotal'+producto.id).html((producto.venta-producto.compra).toFixed(2));
                    $('#filagananciaunidad'+producto.id).html(((producto.venta-producto.compra)/producto.cantidad).toFixed(2));
                    $('#filaeditar'+producto.id).html('<a onclick="modaleditarproducto('+producto.id+',\''+producto.nombre+'\','+producto.compra+','+producto.venta+','+producto.seguridad+')" class="btn green"><i class="material-icons">edit</i></a>');    
                    if(tbpro=="V"){
                        $('table').remove(".small-only");
                        $("#tabla-productos").removeClass("stacktable");
                        $("#tabla-productos").removeClass("large-only");
                        $("#tabla-productos").stacktable();
                    }
                    $("#modal-editar-producto").modal('close');
                    $("#nombre-producto-editar").val("");
                    $("#divbtnproducto-editar").html(btn);
                }else{
                    if(a.url==null){
                        alerta(a.error);
                        $("#divbtnproducto-editar").html(btn);
                    }else{
                        window.location = a.url;
                    }
                }
            }
        });
    }
}
//
function listarproductos(){
    var cargando = '<div class="preloader-wrapper small active"><div class="spinner-layer spinner-green-only"><div class="circle-clipper left"><div class="circle"></div></div><div class="gap-patch"><div class="circle"></div></div><div class="circle-clipper right"><div class="circle"></div></div></div></div>';
    var formData = $("#formlistarproductos").serialize();
    $('#filas').html(cargando);
    $.ajax({
        type: "POST",
        url: "listarproductos",
        data: formData,
        success: function(a) {
            a = JSON.parse(a);
            if(a.ok){
                var productos = a.productos;
                $('#divtabla').html("");
                var tipotabla = "";
                if(tbpro=="H"){
                    tipotabla = "responsive-table";
                }else if(tbpro=="V"){
                    tipotabla = "resp";
                }
                var tabla = '<table id="tabla-productos" class="centered striped '+tipotabla+'">'+
                                '<thead>';
                if(c1){tabla += '<th>N</th>';}
                if(c2){tabla += '<th>Nombre</th>';}
                if(c3){tabla += '<th>Compra</th>';}
                if(c4){tabla += '<th>Venta</th>';}
                if(c5){tabla += '<th>Subunidades</th>';}
                if(c6){tabla += '<th>Compra Sub</th>';}
                if(c7){tabla += '<th>Venta Sub</th>';}
                if(c9){tabla += '<th>Ganancia</th>';}
                if(c8){tabla += '<th>Ganancia Subunidad</th>';}
                if(c10){tabla += '<th>Marca</th>';}
                if(c11){tabla += '<th>Categoria</th>';}
                if(c12){tabla += '<th>Unidad</th>';}
                tabla +=        
//                                '<th>Historial</th>'+
                                  '<th>Editar</th>'+
//                                  '<th>Eliminar</th>'+
                                  '<th>Pedido</th>'+
                                '</thead>'+
                                '<tbody id="filas">'+
                                '</tbody>'+
                              '</table>';
                $('#divtabla').html(tabla);
                var filas = "";
                var w = 1;
                $.each(productos,function (key,producto){
                    filas = filas + '<tr id="fila'+producto.id+'">';
                    if(c1){filas += '<td>'+w+'</td>';}
                    if(c2){filas += '<td id="filanombre'+producto.id+'">'+producto.nombre+'</td>';}
                    if(c3){filas += '<td id="filacompra'+producto.id+'">'+producto.compra+'</td>';}
                    if(c4){filas += '<td id="filaventa'+producto.id+'">'+producto.venta+'</td>';}
                    if(c5){filas += '<td id="filacantidad'+producto.id+'">'+producto.cantidad+' '+producto.nombre_unidad2+'</td>';}
                    if(c6){filas += '<td id="filacompraunidad'+producto.id+'">'+(producto.compra/producto.cantidad).toFixed(2)+'</td>';}
                    if(c7){filas += '<td id="filaventatotal'+producto.id+'">'+(producto.venta/producto.cantidad).toFixed(2)+'</td>';}
                    if(c9){filas += '<td id="filagananciatotal'+producto.id+'">'+(producto.venta-producto.compra).toFixed(2)+'</td>';}
                    if(c8){filas += '<td id="filagananciaunidad'+producto.id+'">'+((producto.venta-producto.compra)/producto.cantidad).toFixed(2)+'</td>';}
                    if(c10){filas += '<td id="filamarca'+producto.id+'">'+producto.nombre_marca+'</td>';}
                    if(c11){filas += '<td id="filacategoria'+producto.id+'">'+producto.nombre_categoria+'</td>';}
                    if(c12){filas += '<td id="filaunidad'+producto.id+'">'+producto.nombre_unidad+'</td>';}
                    filas += 
                            //'<td><a href="historial?id='+producto.id+'" class="btn"><i class="material-icons">input</i></a></td>'+
                            //'<td id="filaeditar'+producto.id+'"><a onclick="modalproducto('+producto.id+',\''+producto.nombre+'\','+producto.compra+','+producto.venta+','+producto.cantidad+','+producto.id_marca+','+producto.id_categoria+','+producto.id_unidad+','+producto.id_unidad2+')" class="btn green"><i class="material-icons">edit</i></a></td>'+
                            '<td id="filaeditar'+producto.id+'"><a onclick="modaleditarproducto('+producto.id+',\''+producto.nombre+'\','+producto.compra+','+producto.venta+','+producto.seguridad+')" class="btn green"><i class="material-icons">edit</i></a></td>';
                            //'<td><a onclick="eliminar(\'producto\','+producto.id+')" class="btn red"><i class="material-icons">delete</i></a></td>';
                    if($.inArray(producto.id,detalles)>=0){
                        filas += '<td><a onclick="modaldetalle('+producto.id+',\''+producto.nombre+'\',this,\''+producto.nombre_unidad+'\',\''+producto.nombre_unidad2+'\')" class="btn yellow darken-1"><i class="material-icons">shopping_cart</i></a></td>';
                    }else{
                        filas += '<td id="filacarrito'+producto.id+'"><a onclick="modaldetalle('+producto.id+',\''+producto.nombre+'\',this,\''+producto.nombre_unidad+'\',\''+producto.nombre_unidad2+'\')" class="btn grey"><i class="material-icons">shopping_cart</i></a></td>';
                    }    
                    filas += '</tr>';
                    w = w + 1;
                });
                $("#filas").html(filas);
                if(tbpro=="V"){
                    $("#tabla-productos").stacktable();
                }
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

function cambiarc(){
    var formData = $("#formempresa").serialize();
    $.ajax({
        type: "POST",
        url: "empresa",
        data: formData,
        success: function(a) {
            a = JSON.parse(a);
            if(a.ok){
                alerta("VALOR CAMBIADO");
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

function cambiarporcentaje(){
    var formData = $("#formdatosempresa").serialize();
    var cargando = '<div class="preloader-wrapper small active"><div class="spinner-layer spinner-green-only"><div class="circle-clipper left"><div class="circle"></div></div><div class="gap-patch"><div class="circle"></div></div><div class="circle-clipper right"><div class="circle"></div></div></div></div>';
    $('#btnguardar').html(cargando);
    $('#btnguardar').prop("disabled",true);
    $.ajax({
        type: "POST",
        url: "empresa",
        data: formData,
        success: function(a) {
            a = JSON.parse(a);
            if(a.ok){
                alerta("VALOR CAMBIADO");
                $('#btnguardar').html("Guardar");
                $('#btnguardar').prop("disabled",false);
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

function modaldetallepost(){
    var cargando = '<div class="preloader-wrapper small active"><div class="spinner-layer spinner-green-only"><div class="circle-clipper left"><div class="circle"></div></div><div class="gap-patch"><div class="circle"></div></div><div class="circle-clipper right"><div class="circle"></div></div></div></div>';
    var cantidad = $('#cantidad-detalle').val();
    var decimal = cantidad.toString();
    
    var cantidad2 = 0;
    var decimal2 = cantidad2.toString();
    
    var precio = $('#precio-detalle').val();
    if(cantidad.length>0 && cantidad>0){
        if(precio.length>0 && precio>=0){
            if(decimal.indexOf('.')<0 && decimal2.indexOf('.')<0){
                var formData = $("#formdetalle").serialize();
                $('#btndetalleagregar').html(cargando);
                $('#btndetalleagregar').prop("disabled",true);
                $.ajax({
                    type: "POST",
                    url: "detalle",
                    data: formData,
                    success: function(a) {
                        a = JSON.parse(a);
                        if(a.ok){
                            alerta("PRODUCTO AGREGADO");
                            detalles.push(a.detalle.producto.id);
                            $('#filacarrito'+a.detalle.producto.id).html('<a onclick="modaldetalle('+a.detalle.producto.id+',\''+a.detalle.producto.nombre+'\',this,\''+a.detalle.producto.nombre_unidad+'\',\''+a.detalle.producto.nombre_unidad2+'\')" class="btn yellow darken-1"><i class="material-icons">shopping_cart</i></a>');
                            $('#modal-detalle').modal("close");
                            $('#cantidad-detalle').val(null);
                            $('#cantidad2-detalle').val(null);
                            $('#precio-detalle').val(null);
                            $('.contadorcarrito').html("PEDIDO("+a.carrito+")");
                            $('#btndetalleagregar').html("Agregar");
                            $('#btndetalleagregar').prop("disabled",false);
                            if(tbpro=="V"){
                                $(objtmpdet).removeClass("grey");
                                $(objtmpdet).addClass("yellow");
                                $(objtmpdet).addClass("darken-1");
                            }
                            $('#nombre').focus();
                        }else{
                            if(a.url==null){
                                alerta(a.error);
                            }else{
                                window.location = a.url;
                            }
                        }
                    }
                });
            }else{
                alerta("Ingrese una cantidad entera");
            }
        }else{
            alerta("Ingrese un precio");
        }
    }else{
        alerta("Ingrese una cantidad");
    }
}

function eliminardetalle(){
    var id = $('#id-eliminar').val();
    var token = $('#token').val();
    var tipo = $('#tipo').val();
    $.ajax({
        type: "POST",
        url: "detalle",
        data: {"id":id,"modo":"eliminar","_token":token,"tipo":tipo},
        success: function(a) {
            a = JSON.parse(a);
            if(a.ok){
                alerta("PRODUCTO DESCARTADO");
                $('#fila'+id).remove();
                totalpedido();
                $('#modal-descartar').modal('close');
                $('.contadorcarrito').html("PEDIDO("+a.carrito+")");
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

function totalpedido(){
    var cargando = '<div class="preloader-wrapper small active"><div class="spinner-layer spinner-green-only"><div class="circle-clipper left"><div class="circle"></div></div><div class="gap-patch"><div class="circle"></div></div><div class="circle-clipper right"><div class="circle"></div></div></div></div>';
    $('#total').html(cargando);
    var subtotales = document.getElementsByClassName("subtotal");
    var costostotales = document.getElementsByClassName("costo");
    var gananciastotales = document.getElementsByClassName("ganancia");
    var total = parseFloat(0);
    for(var i=0;i<subtotales.length;i++){
        var subtotal = subtotales[i].value;
        total += parseFloat(subtotal);
    }
    total = total.toFixed(2);
    $('#total').html("S/"+total);

    var costototal = parseFloat(0);
    for(var i=0;i<costostotales.length;i++){
        var subtotal = costostotales[i].value;
        costototal += parseFloat(subtotal);
    }
    costototal = costototal.toFixed(2);
    $('#costototal').html("S/"+costototal);

    var gananciatotal = parseFloat(0);
    for(var i=0;i<gananciastotales.length;i++){
        var subtotal = gananciastotales[i].value;
        gananciatotal += parseFloat(subtotal);
    }
    gananciatotal = gananciatotal.toFixed(2);
    $('#gananciatotal').html("S/"+gananciatotal);
}

function totalverpedido(){
    var cargando = '<div class="preloader-wrapper small active"><div class="spinner-layer spinner-green-only"><div class="circle-clipper left"><div class="circle"></div></div><div class="gap-patch"><div class="circle"></div></div><div class="circle-clipper right"><div class="circle"></div></div></div></div>';
    $('#total').html(cargando);
    $('#totalrecibido').html(cargando);
    var subtotales = document.getElementsByClassName("subtotal");
    var subtotalesrecibido = document.getElementsByClassName("subtotalrecibido");
    
    var total = parseFloat(0);
    for(var i=0;i<subtotales.length;i++){
        var subtotal = subtotales[i].value;
        total += parseFloat(subtotal);
    }
    total = total.toFixed(2);
    
    var totalrecibido = parseFloat(0);
    for(var i=0;i<subtotalesrecibido.length;i++){
        var subtotalrecibido = subtotalesrecibido[i].value;
        totalrecibido += parseFloat(subtotalrecibido);
    }
    totalrecibido = totalrecibido.toFixed(2);
    
    $('#total').html("S/"+total);
    $('#totalrecibido').html("S/"+totalrecibido);
}

function editardetalle(id,nombre,cantidad,tipo,detalle,unidad,unidad2,cantidad2,precio){
    $('#id-producto').val(id);
    $('#lblnombre').addClass("active");
    $('#nombre-producto').val(nombre);
    $('#cantidad-detalle').val(cantidad);
    $('#cantidad2-detalle').val(cantidad2);
    $('#precio-detalle').val(precio);
    $('#tipoeditar').val(tipo);
    $('#iddetalle').val(detalle);
    $('#lblcantidaddetalle').addClass("active");
    $('#lblcantidaddetalle2').addClass("active");
    $('#lblpreciodetalle').addClass("active");
    $('#lblcantidaddetalle').html("Cantidad de "+unidad);
    $('#lblcantidaddetalle2').html("Cantidad de "+unidad2);
    $('#editar-producto').hide();
    $('#chk-editar').prop("checked",false);
    $('#modal-detalle-editar').modal("open");
    $('#precio-detalle').focus();
}

function editarproductodetalle(){
    var sel = document.getElementById("chk-editar").checked;
    if(sel){
        cargareditarproducto();
    }else{
        $('#editar-producto').hide();
        $('#btneditardetalle').prop("disabled",false);
    }
}

function cargareditarproducto(){
    var id = $('#id-producto').val();
    var token = $('#token').val();
    $.ajax({
        type: "POST",
        url: "verproducto",
        data: {"id":id,"_token":token},
        success: function(a) {
            a = JSON.parse(a);
            if(a.ok){
                var producto = a.obj;
                $('#compra-producto').val(producto.compra);
                $('#venta-producto').val(producto.venta);
                $('#cantidad-producto').val(producto.cantidad);
                $('#lblcompra').addClass("active");
                $('#lblventa').addClass("active");
                $('#editarcargando').hide();
                $('#editar-producto').show();
                $('#btneditardetalle').prop("disabled",false);
            }else{
                if(a.url==null){
                    alerta(a.error);
                }else{
                    window.location = a.url;
                }
            }
        },
        beforeSend:function(){
            $('#editarcargando').show();
            $('#btneditardetalle').prop("disabled",true);
        }
    });
}

function editardetallepost(){
    var cargando = '<div class="preloader-wrapper small active"><div class="spinner-layer spinner-green-only"><div class="circle-clipper left"><div class="circle"></div></div><div class="gap-patch"><div class="circle"></div></div><div class="circle-clipper right"><div class="circle"></div></div></div></div>';
    var formData = $("#formdetalleeditar").serialize();
    var cantidad = $('#cantidad-detalle').val();
    var decimal = cantidad.toString();
    if(cantidad.length>0 && cantidad>0){
        if(decimal.indexOf('.')<0){
            $.ajax({
                type: "POST",
                url: "editardetalle",
                data: formData,
                success: function(a) {
                    a = JSON.parse(a);
                    if(a.ok){
                        var detalle = a.obj;
                        var producto = detalle.producto;
                        var idfila = 0;
                        var tipo = 0;
                        if(detalle.id>0){
                            idfila = detalle.id;
                            tipo = 2;
                        }else{
                            idfila = producto.id;
                            detalle.id = 0;
                            tipo = 1;
                        }
                        $('#filanombre'+idfila).html(producto.nombre);
                        var textocantidad = "";
                        if(detalle.cantidad>0){
                            textocantidad += " "+detalle.cantidad+" "+producto.nombre_unidad;
                        }
                        if(detalle.cantidad2>0){
                            textocantidad += " "+detalle.cantidad2+" "+producto.nombre_unidad2;
                        }
                        $('#filacantidad'+idfila).html(textocantidad);
                        $('#filasubtotal'+idfila).html("S/"+(detalle.precio));
                        $('#inputsubtotal'+idfila).val(detalle.precio);
                        $('#filaeditar'+idfila).html('<a onclick="editardetalle('+producto.id+',\''+producto.nombre+'\','+detalle.cantidad+','+tipo+','+detalle.id+',\''+producto.nombre_unidad+'\',\''+producto.nombre_unidad2+'\','+detalle.cantidad2+')" class="btn green"><i class="material-icons">edit</i></a>');
                        totalpedido();
                        alerta("Detalle editado");
                        $('#btneditardetalle').html("Editar");
                        $('#modal-detalle-editar').modal('close');
                    }else{
                        if(a.url==null){
                            alerta(a.error);
                        }else{
                            window.location = a.url;
                        }
                    }
                },
                beforeSend:function(){
                    $('#btneditardetalle').html(cargando);
                }
            });
        }else{
            alerta("Ingrese una cantidad entera");
        }
    }else{
        alerta("Ingrese una cantidad");
    }
}

function modalpedidopost(){
    var cargando = '<div class="preloader-wrapper small active"><div class="spinner-layer spinner-green-only"><div class="circle-clipper left"><div class="circle"></div></div><div class="gap-patch"><div class="circle"></div></div><div class="circle-clipper right"><div class="circle"></div></div></div></div>';
    var formData = $("#formpedido").serialize();
    $.ajax({
        type: "POST",
        url: "pedido",
        data: formData,
        success: function(a) {
            a = JSON.parse(a);
            if(a.ok){
                window.location = "verpedido?id="+a.obj.id;
            }else{
                if(a.url==null){
                    alerta(a.error);
                    $('#btnguardar').prop("disabled",false);
                    $('#btnguardar').html("Guardar");
                }else{
                    window.location = a.url;
                }
            }
        },
        beforeSend:function(){
            $('#btnguardar').prop("disabled",true);
            $('#btnguardar').html(cargando);
        }
    });
}

function modalpedidonuevopost(){
    var cargando = '<div class="preloader-wrapper small active"><div class="spinner-layer spinner-green-only"><div class="circle-clipper left"><div class="circle"></div></div><div class="gap-patch"><div class="circle"></div></div><div class="circle-clipper right"><div class="circle"></div></div></div></div>';
    var formData = $("#formpedido").serialize();
    $.ajax({
        type: "POST",
        url: "pedido-nuevo",
        data: formData,
        success: function(a) {
            a = JSON.parse(a);
            if(a.ok){
                window.location = "guia?id="+a.guia;
            }else{
                if(a.url==null){
                    alerta(a.error);
                    $('#btnguardar').prop("disabled",false);
                    $('#btnguardar').html("Guardar");
                }else{
                    window.location = a.url;
                }
            }
        },
        beforeSend:function(){
            $('#btnguardar').prop("disabled",true);
            $('#btnguardar').html(cargando);
        }
    });
}

function listarpedidos(){
    $('#formlistarpedidos').submit();
}

function agregarcliente(tipo){
    var cargando = '<div class="preloader-wrapper small active"><div class="spinner-layer spinner-green-only"><div class="circle-clipper left"><div class="circle"></div></div><div class="gap-patch"><div class="circle"></div></div><div class="circle-clipper right"><div class="circle"></div></div></div></div>';
    var btn = '<button onclick="agregarcliente(\''+tipo+'\')" class="btn-large">Guardar</button>';
    $("#divbtnagregar").html(cargando);
    var formData = $("#formagregar").serialize();
    $.ajax({
        type: "POST",
        url: "cliente",
        data: formData,
        success: function(a) {
            a = JSON.parse(a);
            if(a.ok){
                alerta("GUARDADO CORRECTAMENTE");
                var fila = '';
                var cliente = a.obj;
                if(tipo=="N"){
                    fila = '<tr id="fila'+cliente.id+'">'+
                           '<td></td>'+
                            '<td id="filanombre'+cliente.id+'">'+cliente.nombre+'</td>'+
                            '<td id="filaapellidos'+cliente.id+'">'+cliente.apellidos+'</td>'+
                            '<td id="filadni'+cliente.id+'">'+cliente.dni+'</td>'+
                            '<td id="filaeditar'+cliente.id+'"><a onclick="editarclientemodal('+cliente.id+',\'N\',\''+cliente.nombre+'\',\''+cliente.apellidos+'\',\''+cliente.dni+'\')" class="btn green"><i class="material-icons">edit</i></a></td>'+
                            '<td><a onclick="eliminar(\'cliente\','+cliente.id+')" class="btn red"><i class="material-icons">delete</i></a></td>'+
                            "</tr>";
                }else{
                    fila = '<tr id="fila'+cliente.id+'">'+
                           '<td></td>'+
                            '<td id="filarazon'+cliente.id+'">'+cliente.razon+'</td>'+
                            '<td id="filaruc'+cliente.id+'">'+cliente.ruc+'</td>'+
                            '<td id="filaeditar'+cliente.id+'"><a onclick="editarclientemodal('+cliente.id+',\'J\',\''+cliente.razon+'\',\''+cliente.ruc+'\',\'\')" class="btn green"><i class="material-icons">edit</i></a></td>'+
                            '<td><a onclick="eliminar(\'cliente\','+cliente.id+')" class="btn red"><i class="material-icons">delete</i></a></td>'+
                            "</tr>";
                }
                    
                
                $('#filas').prepend(fila);
                $('#filaempty').hide();
                $("#modal-agregar").modal('close');
                if(tipo=="N"){
                    $("#nombre-agregar").val("");
                    $("#apellidos-agregar").val("");
                    $("#dni-agregar").val("");
                }else{
                    $("#razon-agregar").val("");
                    $("#ruc-agregar").val("");
                }
                $("#divbtnagregar").html(btn);
            }else{
                if(a.url==null){
                    alerta(a.error);
                    $("#divbtnagregar").html(btn);
                }else{
                    window.location = a.url;
                }
            }
        }
    });
}

function editarclientemodal(id,tipo,a,b,c){
    $('#id-editar').val(id);
    if(tipo=="N"){
        $('#nombre-editar').val(a);
        $('#apellidos-editar').val(b);
        $('#dni-editar').val(c);
        $('#lblaeditar').addClass('active');
        $('#lblbeditar').addClass('active');
        $('#lblceditar').addClass('active');
    }else{
        $('#razon-editar').val(a);
        $('#ruc-editar').val(b);
        $('#lblaeditar').addClass('active');
        $('#lblbeditar').addClass('active');
    }
    $('#modal-editar').modal('open');
        
}

function editarcliente(){
    var cargando = '<div class="preloader-wrapper small active"><div class="spinner-layer spinner-green-only"><div class="circle-clipper left"><div class="circle"></div></div><div class="gap-patch"><div class="circle"></div></div><div class="circle-clipper right"><div class="circle"></div></div></div></div>';
    var btn = "<button onclick='editarcliente()' class='btn-large'>Guardar</button>";
    $("#divbtneditar").html(cargando);
    var formData = $("#formeditar").serialize();
    $.ajax({
        type: "POST",
        url: "cliente",
        data: formData,
        success: function(a) {
            a = JSON.parse(a);
            if(a.ok){
                alerta("EDITADO CORRECTAMENTE");
                var cliente = a.obj;
                if(cliente.tipo=="N"){
                    $('#filanombre'+cliente.id).html(cliente.nombre);
                    $('#filaapellidos'+cliente.id).html(cliente.apellidos);
                    $('#filadni'+cliente.id).html(cliente.dni);
                    $('#filaeditar'+cliente.id).html('<a onclick="editarclientemodal('+cliente.id+',\'N\',\''+cliente.nombre+'\',\''+cliente.apellidos+'\',\''+cliente.dni+'\')" class="btn green"><i class="material-icons">edit</i></a>');
                }else{
                    $('#filarazon'+cliente.id).html(cliente.razon);
                    $('#filaruc'+cliente.id).html(cliente.ruc);
                    $('#filaeditar'+cliente.id).html('<a onclick="editarclientemodal('+cliente.id+',\'N\',\''+cliente.razon+'\',\''+cliente.ruc+'\',\'\')" class="btn green"><i class="material-icons">edit</i></a>');
                }
                $("#modal-editar").modal('close');
                $("#nombre-editar").val("");
                $("#apellidos-editar").val("");
                $("#dni-editar").val("");
                $("#divbtneditar").html(btn);
            }else{
                if(a.url==null){
                    alerta(a.error);
                    $("#divbtneditar").html(btn);
                }else{
                    window.location = a.url;
                }
            }
        }
    });
}

function eliminarcliente(){
    var cargando = '<div class="preloader-wrapper small active"><div class="spinner-layer spinner-green-only"><div class="circle-clipper left"><div class="circle"></div></div><div class="gap-patch"><div class="circle"></div></div><div class="circle-clipper right"><div class="circle"></div></div></div></div>';
    var btn = "<button onclick='eliminarcliente()' class='btn-large'>Guardar</button>";
    $("#divbtneliminar").html(cargando);
    var formData = $("#formeliminar").serialize();
    $.ajax({
        type: "POST",
        url: "cliente",
        data: formData,
        success: function(a) {
            a = JSON.parse(a);
            if(a.ok){
                alerta("ELIMINADO CORRECTAMENTE");
                var cliente = a.obj;
                $('#fila'+cliente.id).remove();
                $("#modal-eliminar").modal('close');
                $("#divbtneliminar").html(btn);
            }else{
                if(a.url==null){
                    alerta(a.error);
                    $("#divbtneliminar").html(btn);
                }else{
                    window.location = a.url;
                }
            }
        }
    });
}

function agregaralmacen(){
    var cargando = '<div class="preloader-wrapper small active"><div class="spinner-layer spinner-green-only"><div class="circle-clipper left"><div class="circle"></div></div><div class="gap-patch"><div class="circle"></div></div><div class="circle-clipper right"><div class="circle"></div></div></div></div>';
    var btn = '<button onclick="agregaralmacen()" class="btn-large">Guardar</button>';
    $("#divbtnagregar").html(cargando);
    var formData = $("#formagregar").serialize();
    $.ajax({
        type: "POST",
        url: "almacen",
        data: formData,
        success: function(a) {
            a = JSON.parse(a);
            if(a.ok){
                alerta("GUARDADO CORRECTAMENTE");
                var fila = '';
                var almacen = a.obj;
                fila = '<tr id="fila'+almacen.id+'">'+
                       '<td></td>'+
                        '<td id="filanombre'+almacen.id+'">'+almacen.nombre+'</td>'+
                        '<td id="filadireccion'+almacen.id+'">'+almacen.direccion+'</td>'+
                        '<td id="filatipo'+almacen.id+'">'+almacen.tipo+'</td>'+
                        '<td><a href="traslados?almacen='+almacen.id+'" class="btn grey"><i class="material-icons">input</i></a></td>'+
                        '<td><a href="almacen?id='+almacen.id+'" class="btn"><i class="material-icons">input</i></a></td>'+
                        '<td id="filaeditar'+almacen.id+'"><a onclick="editaralmacenmodal('+almacen.id+',\''+almacen.nombre+'\',\''+almacen.direccion+'\',\''+almacen.tipo+'\')" class="btn green"><i class="material-icons">edit</i></a></td>'+
                        '<td><a onclick="eliminar(\'almacen\','+almacen.id+')" class="btn red"><i class="material-icons">delete</i></a></td>'+
                        "</tr>";
                $('#filas').prepend(fila);
                $('#filaempty').hide();
                $("#modal-agregar").modal('close');
                $("#nombre-agregar").val("");
                $("#direccion-agregar").val("");
                $("#divbtnagregar").html(btn);
            }else{
                if(a.url==null){
                    alerta(a.error);
                    $("#divbtnagregar").html(btn);
                }else{
                    window.location = a.url;
                }
            }
        }
    });
}

function editaralmacenmodal(id,a,b,c){
    $('#id-editar').val(id);
    $('#nombre-editar').val(a);
    $('#direccion-editar').val(b);
    $('#tipo-editar').val(c);
    $('#tipo-editar').material_select('destroy');
    $('#tipo-editar').material_select();
    $('#lblaeditar').addClass('active');
    $('#lblbeditar').addClass('active');
    $('#modal-editar').modal('open');
        
}

function editaralmacen(){
    var cargando = '<div class="preloader-wrapper small active"><div class="spinner-layer spinner-green-only"><div class="circle-clipper left"><div class="circle"></div></div><div class="gap-patch"><div class="circle"></div></div><div class="circle-clipper right"><div class="circle"></div></div></div></div>';
    var btn = "<button onclick='editaralmacen()' class='btn-large'>Guardar</button>";
    $("#divbtneditar").html(cargando);
    var formData = $("#formeditar").serialize();
    $.ajax({
        type: "POST",
        url: "almacen",
        data: formData,
        success: function(a) {
            a = JSON.parse(a);
            if(a.ok){
                alerta("EDITADO CORRECTAMENTE");
                var almacen = a.obj;
                $('#filanombre'+almacen.id).html(almacen.nombre);
                $('#filadireccion'+almacen.id).html(almacen.direccion);
                $('#filatipo'+almacen.id).html(almacen.tipo);
                $('#filaeditar'+almacen.id).html('<a onclick="editaralmacenmodal('+almacen.id+',\''+almacen.nombre+'\',\''+almacen.direccion+'\',\''+almacen.tipo+'\')" class="btn green"><i class="material-icons">edit</i></a>');

                $("#modal-editar").modal('close');
                $("#nombre-editar").val("");
                $("#direccion-editar").val("");
                $("#divbtneditar").html(btn);
            }else{
                if(a.url==null){
                    alerta(a.error);
                    $("#divbtneditar").html(btn);
                }else{
                    window.location = a.url;
                }
            }
        }
    });
}

function eliminaralmacen(){
    var cargando = '<div class="preloader-wrapper small active"><div class="spinner-layer spinner-green-only"><div class="circle-clipper left"><div class="circle"></div></div><div class="gap-patch"><div class="circle"></div></div><div class="circle-clipper right"><div class="circle"></div></div></div></div>';
    var btn = "<button onclick='eliminaralmacen()' class='btn-large'>Guardar</button>";
    $("#divbtneliminar").html(cargando);
    var formData = $("#formeliminar").serialize();
    $.ajax({
        type: "POST",
        url: "almacen",
        data: formData,
        success: function(a) {
            a = JSON.parse(a);
            if(a.ok){
                alerta("ELIMINADO CORRECTAMENTE");
                var almacen = a.obj;
                $('#fila'+almacen.id).remove();
                $("#modal-eliminar").modal('close');
                $("#divbtneliminar").html(btn);
            }else{
                if(a.url==null){
                    alerta(a.error);
                    $("#divbtneliminar").html(btn);
                }else{
                    window.location = a.url;
                }
            }
        }
    });
}

function editardetalleguia(id,costo){
    var cantidad = $('#inputcantidad'+id).val();
    if(cantidad<0){
        alerta("Ingrese una cantidad mayor a 0");
        $('#btnregistrar').prop("disabled",true);
        if(!cantidades.includes(id)){
            cantidades.push(id);
        }
    }else{
        var subtotal = (costo*cantidad).toFixed(2);
        $('#filasubtotal'+id).html("S/"+subtotal);
        $('#inputsubtotal'+id).val(subtotal);
        totalpedido();
        if(cantidades.includes(id)){
            cantidades.pop(id);
            if(cantidades.length==0){
                $('#btnregistrar').prop("disabled",false);
            }
        }
            
    }        
}

function registrarguia(){
    var numero = $('#numero').val();
    if(numero.length>0){
        var almacen = $('#almacen').val();
        if(almacen>0){
            var cargando = '<div class="preloader-wrapper small active"><div class="spinner-layer spinner-green-only"><div class="circle-clipper left"><div class="circle"></div></div><div class="gap-patch"><div class="circle"></div></div><div class="circle-clipper right"><div class="circle"></div></div></div></div>';
            var btn = "REGISTRAR";
            $("#btnregistrar").prop("disabled",true);
            $("#btnregistrar").html(cargando);
            var formData = $("#guia").serialize();
            $.ajax({
                type: "POST",
                url: "guia",
                data: formData,
                success: function(a) {
                    a = JSON.parse(a);
                    if(a.ok){
                       window.location = "guia?id="+a.guia;
                    }else{
                        if(a.url==null){
                            alerta(a.error);
                            $("#btnregistrar").html(btn);
                        }else{
                            window.location = a.url;
                        }
                    }
                }
            });
        }else{
            alerta("Seleccione un almacén");
        }    
    }else{
        alerta("Registre el número de guia");
    }
}

function limpiarcamposventa(){
    $('#cantidad').val(null);
    $('#cantidad2').val(null);
    $('#lblcantidad').html("Elija un producto");
    $('#lblcantidad2').html("Elija un producto");
    $('#textocosto').val(null);
    $('#lblventa').html("Precio de venta");
    $('#costo').val(null);
    $('#venta').val(null);
    $('#subtotal').val(null);
    $('#textocosto').val(null);
    $('#textostock').val(null);
    $('#lblstock').removeClass("active");
    $('#lblcosto').removeClass("active");
    $('#lblventa').removeClass("active");
}

function cargarproductoventa(){
    var id = $('#selectproducto').val();
    if(id>0){
        $('#divbtnagregar').html("<div class='row center'><div class='preloader-wrapper small active'><div class='spinner-layer spinner-blue'><div class='circle-clipper left'><div class='circle'></div></div><div class='gap-patch'><div class='circle'></div></div><div class='circle-clipper right'><div class='circle'></div></div></div><div class='spinner-layer spinner-red'><div class='circle-clipper left'><div class='circle'></div></div><div class='gap-patch'><div class='circle'></div></div><div class='circle-clipper right'><div class='circle'></div></div></div><div class='spinner-layer spinner-yellow'><div class='circle-clipper left'><div class='circle'></div></div><div class='gap-patch'><div class='circle'></div></div><div class='circle-clipper right'><div class='circle'></div></div></div><div class='spinner-layer spinner-green'><div class='circle-clipper left'><div class='circle'></div></div><div class='gap-patch'><div class='circle'></div></div><div class='circle-clipper right'><div class='circle'></div></div></div></div></div>");
        var producto = productos[id];
        var hijo = producto[4]%producto[3];
        var padre = (producto[4]-hijo)/producto[3];
        var stock = "";
        if(padre>0){
            stock = padre.toString()+" "+producto[5];
        }
        if(hijo>0){
            if(padre>0){
                stock = stock + " - ";
            }
            stock = stock+hijo.toString()+" "+producto[6];
        }
        $('#cantidad').val(null);
        $('#cantidad2').val(null);
        $('#cantidad').prop("disabled",false);
        
        $('#cantidad2').prop("disabled",false);
        $('#lblcantidad').html("Cantidad de "+producto[5]);
        $('#lblcantidad2').html("Cantidad de "+producto[6]);
        $('#lblventa').html("Precio de venta ("+producto[5]+")");
        $('#costo').val(producto[1]);
        $('#venta').val(producto[2]);
        $('#textocosto').val("S/"+producto[1].toFixed(2)+" "+producto[5]);
//        $('#textocosto').val("S/"+producto[1].toFixed(2)+" "+producto[5]+" - S/"+(producto[1]/producto[3]).toFixed(2)+" "+producto[6]);
        $('#lblstock').addClass("active");
        $('#lblcosto').addClass("active");
        $('#lblventa').addClass("active");
        
        if(producto[4]>0){
            $('#stock').val(producto[4]);
            $('#textostock').val(stock);
            $('#divbtnagregar').html('<a onclick="agregardetalleventa()" class="btn"><i class="material-icons">add</i></a>');
            setTimeout(function(){
                $('#cantidad').focus();   
            }, 0);
        }else{
            $('#cantidad').prop("disabled",true);
            $('#cantidad2').prop("disabled",true);
            $('#stock').val(0);
            $('#textostock').val("No hay stock");
            $('#divbtnagregar').html('<a class="btn disabled"><i class="material-icons">add</i></a>');
        }
    }else{
        limpiarcamposventa();
    }


}


function cantidaddetalleventa(e){
    var idproducto = $('#selectproducto').val();
    $('#divbtnagregar').html('<a class="btn disabled"><i class="material-icons">add</i></a>');
    if(idproducto>0){
        var cantidad = $('#cantidad').val();
        var cantidad2 = 0;
        if(cantidad===''){
            cantidad = 0;
        }
        $('#lblsubtotal').addClass("active");
        $('#subtotal').val(0);
        if((cantidad!=null && cantidad!="") || (cantidad2!=null && cantidad2!="")){
            cantidad = parseFloat(cantidad);
            cantidad2 = parseFloat(cantidad2);
            
            var ok = false;
            if(cantidad>=0){
                var decimal = cantidad.toString();
                if(decimal.indexOf('.')<0){
                    ok = true;
                }else{
                    alerta("Ingrese una cantidad entera",3000);
                    ok = false;
                }
            }else{
                ok = false;
            }
            
            if(ok){
                var max = parseFloat($('#stock').val());
                var producto = productos[idproducto];
                var cnt = producto[3];
                var total = (cantidad*cnt) + cantidad2;
                if(total>max){
                    alerta("Debe ingresar una cantidad menor o igual al stock del almacen");
                }else{
                    var venta = $('#venta').val();
                    if(venta!=null && venta!="" && venta>0){
                        $('#divbtnagregar').html('<a onclick="agregardetalleventa()" class="btn"><i class="material-icons">add</i></a>');
                    }
                }
                var venta = $('#venta').val();
                var subtotal = total*parseFloat(venta)/cnt;
                $('#subtotal').val(subtotal.toFixed(2));
            }
        }
    }else{
        alerta("Elija un producto",3000);
    }
    
    if (window.event)
      {
               if (window.event.keyCode==13)
        {agregardetalleventa();}// Aqui escribe el nombre tu funcion que hace la busqueda...
      }
      else
                    //Esto es para Firefox y creo otros navegadores
        if (e)
        {
          if(e.which==13)
            {agregardetalleventa();}//Igual que arriba
        }
    
}

function preciodetalleventa(){
    var idproducto = $('#selectproducto').val();
    $('#divbtnagregar').html('<a class="btn disabled"><i class="material-icons">add</i></a>');
    if(idproducto>0){
        var venta = $('#venta').val();
        if(venta!=null && venta!=""){
            if(venta>=0){
                var cantidad = $('#cantidad').val();
                var cantidad2 = $('#cantidad2').val();
                cantidad = parseFloat(cantidad);
                cantidad2 = parseFloat(cantidad2);
                var producto = productos[idproducto];
                var cnt = producto[3];
                var total = (cantidad*cnt) + cantidad2;
                var subtotal = total*parseFloat(venta)/cnt;
                $('#subtotal').val(subtotal.toFixed(2));
                $('#lblsubtotal').addClass("active");
                cantidaddetalleventa();
            }else{
                alerta("Ingrese una cantidad mayor o igual a 0",3000);
            }
        }else{
            $('#subtotal').val(null);
            $('#lblsubtotal').removeClass("active");
        }
    }else{
        alerta("Elija un producto",3000);
    }
}

function agregardetalleventa(){
    var idproducto = $('#selectproducto').val();
    if(idproducto>0){
        var max = parseFloat($('#stock').val());
        var cantidad = parseFloat($('#cantidad').val());
        if(cantidad>0){
            var cantidad2 = 0;
            var producto = productos[idproducto];
            var cnt = producto[3];
            var total = (cantidad*cnt) + cantidad2;
            if(total>max){
                alerta("Debe ingresar una cantidad menor o igual al stock del almacen");
            }else{
                var ok = false;
                if(cantidad>=0){
                    var decimal = cantidad.toString();
                    if(decimal.indexOf('.')<0){
                        ok = true;
                    }else{
                        alerta("Ingrese una cantidad entera",3000);
                        ok = false;
                    }
                }else{
                    ok = false;
                    alerta("Ingrese una cantidad mayor a 0",3000);
                }
                
                if(ok){
                    var venta = $('#venta').val();
                    if(venta!=null && venta!=""){
                        if(venta>=0){
                            ok = true;
                        }else{
                            ok = false;
                            alerta("Ingrese un precio de venta mayor o igual a 0",3000);
                        }
                    }else{
                        ok = false;
                        alerta("Ingrese un precio de venta",3000);
                    }


                    if(ok){
                        var almacen = $('#almacen').val();
                        var producto = productos[idproducto];
                        var productonombre = producto[0];
                        var unidad = producto[5];
                        var unidad2 = producto[6];
                        var productocantidad = producto[3];
                        if(ok){
                            $.ajax({
                                type: "GET",
                                url: "productoventa",
                                data: {"almacen":almacen,"productoid":idproducto,"productonombre":productonombre,"unidad":unidad,"unidad2":unidad2,"productocantidad":productocantidad,"cantidad":cantidad,"cantidad2":cantidad2,"venta":venta},
                                success: function(a) {
                                    a = JSON.parse(a);
                                    $('#divbtnagregar').html('<a class="btn disabled"><i class="material-icons">add</i></a>');
                                    if(a.ok){
                                        detalles = a.detalles;
                                        recargarfilasventa(detalles);
                                        limpiarcamposventa();
                                        $('#selectproducto').val('0').trigger('change');
                                        $('#selectproducto').select2('open');
                                    }else{
                                        if(a.url==null){
                                            alerta(a.error);
                                        }else{
                                            window.location = a.url;
                                        }
                                    }
                                },beforeSend:function(){
                                    $('#divbtnagregar').html("<div class='row center'><div class='preloader-wrapper small active'><div class='spinner-layer spinner-blue'><div class='circle-clipper left'><div class='circle'></div></div><div class='gap-patch'><div class='circle'></div></div><div class='circle-clipper right'><div class='circle'></div></div></div><div class='spinner-layer spinner-red'><div class='circle-clipper left'><div class='circle'></div></div><div class='gap-patch'><div class='circle'></div></div><div class='circle-clipper right'><div class='circle'></div></div></div><div class='spinner-layer spinner-yellow'><div class='circle-clipper left'><div class='circle'></div></div><div class='gap-patch'><div class='circle'></div></div><div class='circle-clipper right'><div class='circle'></div></div></div><div class='spinner-layer spinner-green'><div class='circle-clipper left'><div class='circle'></div></div><div class='gap-patch'><div class='circle'></div></div><div class='circle-clipper right'><div class='circle'></div></div></div></div></div>");
                                }
                            });
                        }
                    }
                        
                }
                    
            }
        }
        
    }else{
        alerta("Elija un producto",3000);
    } 
}

function recargarfilasventa(lista){
    console.log(lista);
    var html = "";
        $.each(lista,function (key,obj){
            html += "<tr id='fila"+obj[0]+"'>\n\
                        <td>"+obj[1]+"</td>\n\
                        <td>S/"+obj[4]+"</td>\n\
                        <td>"+obj[2]+"</td>\n\
                        <td>S/"+obj[3].toFixed(2)+"</td>\n\
                        <input class='subtotal' type='hidden' value='"+obj[3]+"'>\n\
                        <td><a class='btn red' onclick='eliminarfilaventa("+obj[0]+")'><i class='material-icons'>delete</i></a></td>\n\
    \n\                 </tr>";
        });
        
    $('#filas').html(html);
    alerta("Se actualizó la tabla");
    totalventa();
    console.log(lista);
}

function eliminarfilaventa(idproducto){
    
    $.ajax({
                            type: "GET",
                            url: "venta-producto-eliminar",
                            data: {"id":idproducto},
                            success: function(a) {
                                console.log(a);
                                detalles = a.detalles;
                                $('#fila'+idproducto).remove();
                                totalventa();
                            }
                        });
    
}

function registrarventa(){
    //var idvendedor = $('#vendedores').val();
    //if(idvendedor>0){
        var idcliente = $('#clientes').val();
        if(idcliente>0){
            var iddocumento = $('#documentos').val();
            if(iddocumento>0){
                var numero = $('#numero').val();
                if(numero!=null && numero.trim().length>0 && numero>0){
                    var cantidad = 0;
                    for(var key in detalles){
                        cantidad++;
                    }        
                    if(cantidad>0){
                        var formData = $("#ventaform").serialize();
                        $.ajax({
                            type: "POST",
                            url: "venta",
                            data: formData,
                            success: function(a) {
                                a = JSON.parse(a);
                                if(a.ok){
                                    window.location = "venta?id="+a.venta;
                                }else{
                                    if(a.url==null){
                                        alerta(a.error);
                                        $('#divbtnregistrar').html("<a onclick='registrarventa()' class='btn-large'>GUARDAR<i class='material-icons right'>save</i></a>");
                                    }else{
                                        window.location = a.url;
                                    }
                                }
                            },beforeSend:function(){
                                $('#divbtnregistrar').html("<div class='row center'><div class='preloader-wrapper small active'><div class='spinner-layer spinner-blue'><div class='circle-clipper left'><div class='circle'></div></div><div class='gap-patch'><div class='circle'></div></div><div class='circle-clipper right'><div class='circle'></div></div></div><div class='spinner-layer spinner-red'><div class='circle-clipper left'><div class='circle'></div></div><div class='gap-patch'><div class='circle'></div></div><div class='circle-clipper right'><div class='circle'></div></div></div><div class='spinner-layer spinner-yellow'><div class='circle-clipper left'><div class='circle'></div></div><div class='gap-patch'><div class='circle'></div></div><div class='circle-clipper right'><div class='circle'></div></div></div><div class='spinner-layer spinner-green'><div class='circle-clipper left'><div class='circle'></div></div><div class='gap-patch'><div class='circle'></div></div><div class='circle-clipper right'><div class='circle'></div></div></div></div></div>");
                            }
                        });
                    }else{
                        alerta("Agregue al menos un producto a la venta");
                    }
                }else{
                    alerta("Ingrese un número de documento");
                }
            }else{
                alerta("Elija un documento");
            }

        }else{
            alerta("Elija un cliente");
        }
    //}else{
    //    alerta("Elija un vendedor")
    //}
        
}

function totalventa(){
    var cargando = '<div class="preloader-wrapper small active"><div class="spinner-layer spinner-green-only"><div class="circle-clipper left"><div class="circle"></div></div><div class="gap-patch"><div class="circle"></div></div><div class="circle-clipper right"><div class="circle"></div></div></div></div>';
    $('#total').html(cargando);
    var subtotales = document.getElementsByClassName("subtotal");
    var total = parseFloat(0);
    for(var i=0;i<subtotales.length;i++){
        var subtotal = subtotales[i].value;
        total += parseFloat(subtotal);
    }
    total = total.toFixed(2);
    $('#total').html("S/"+total);
}

function elegirproductotranslado(){
    var cargando = '<div class="preloader-wrapper small active"><div class="spinner-layer spinner-green-only"><div class="circle-clipper left"><div class="circle"></div></div><div class="gap-patch"><div class="circle"></div></div><div class="circle-clipper right"><div class="circle"></div></div></div></div>';
    var boton = "<a onclick='agregardetalletranslado()' class='btn'><i class='material-icons'>add</i></a>";
    $('#divbtnagregar').html(cargando);
    var idproducto = $('#productos').val();
    $('#stock').val(null);
    $('#costo').val(null);
    $('#cantidad').val(null);
    if(idproducto>0){
        var total = $('#producto'+idproducto).attr("data-total");
        var costo = $('#producto'+idproducto).attr("data-compra");
        $('#stock').val(total);
        $('#costo').val(costo);
        $('#lblstock').addClass("active");
        $('#lblcosto').addClass("active");
    }
    $('#divbtnagregar').html(boton);
}

function cantidaddetalletranslado(){
    var idproducto = $('#productos').val();
    if(idproducto>0){
        var cantidad = $('#cantidad').val();
        if(cantidad!=null && cantidad!=""){
            cantidad = parseFloat(cantidad);
            if(cantidad>0){
                var decimal = cantidad.toString();
                if(decimal.indexOf('.')<0){
                    var max = parseFloat($('#stock').val());
                    if(cantidad>max){
                        alerta("Debe ingresar una cantidad menor o igual al stock del almacen");
                    }
                }else{
                    alerta("Ingrese una cantidad entera");
                }
            }else{
                alerta("Ingrese una cantidad mayor a 0")
            }
        }
    }else{
        alerta("Elija un producto");
    }
}

function agregardetalletranslado(){
    var idproducto = $('#productos').val();
    if(idproducto>0){
        var max = parseFloat($('#stock').val());
        var cantidad = parseFloat($('#cantidad').val());
        if(cantidad>max){
            alerta("Debe ingresar una cantidad menor o igual al stock del almacen");
        }else{
            if(cantidad>0){
                var decimal = cantidad.toString();
                if(decimal.indexOf('.')<0){
                    var nombreproducto = $('#producto'+idproducto).html();
                    var costo = $('#costo').val();
                    var obj = [idproducto,nombreproducto,costo,cantidad];
                    agregarfilatranslado(obj);
                }else{
                    alerta("Ingrese una cantidad entera");
                }
            }else{
                alerta("Ingrese una cantidad mayor a 0");
            }
        }
    }else{
        alerta("Elija un producto");
    } 
}

function agregarfilatranslado(obj){
    eliminarfilatranslado(obj[0]);
    detalles[obj[0]] = (obj);
    var html = "<tr id='fila-"+obj[0]+"'>\n\
                <td>"+obj[1]+"</td>\n\
                <td>S/"+obj[2]+"</td>\n\
                <td>"+obj[3]+"</td>\n\
                <td><a class='btn red' onclick='eliminarfilatranslado("+obj[0]+")'><i class='material-icons'>delete</i></a></td>\n\
                ";
    $('#filas').append(html);
    $('#cantidad').val(null);
}

function eliminarfilatranslado(idproducto){
    delete detalles[idproducto];
    $("#fila-"+idproducto).remove();
}


function reporte(id){
    if(id==1){
        var cantidad = $('#cantidad').val();
        if(cantidad!=null && cantidad!=""){
            cantidad = parseFloat(cantidad);
            if(cantidad>0){
                var decimal = cantidad.toString();
                if(decimal.indexOf('.')<0){
                    var almacen = $('#almacenes').val();
                    if(almacen<0){
                        alerta("No hay almacenes");
                    }else{
                        var formData = $("#reportemasvendidos").serialize();
                        window.open("reportemasvendidos?"+formData);
                    }
                }else{
                    alerta("Ingrese un número entero entera");
                }
            }else{
                alerta("Ingrese una cantidad mayor a 0");
            }
        }else{
            alerta("Ingrese una cantidad");
        }
    }
    else if(id==2){
        var formData = $("#reporteventas").serialize();
        window.open("reporteventas?"+formData);
    }else if(id==3){
        var idproducto = $('#productos').val();
        if(idproducto>0){
            var formData = $("#reporteproducto").serialize();
            window.open("reporteproducto?"+formData);
        }else{
            alerta("Elija un producto");
        }
    }else if(id==4){
        var idmarca = $('#marcas').val();
        if(idmarca>0){
            var formData = $("#reportemarca").serialize();
            window.open("reportemarca?"+formData);
        }else{
            alerta("Elija una marca");
        }
    }
    else if(id==5){
        var idcategoria = $('#categorias').val();
        if(idcategoria>0){
            var formData = $("#reportecategoria").serialize();
            window.open("reportecategoria?"+formData);
        }else{
            alerta("Elija una categoria");
        }
    }
    else if(id==6){
        var idproveedor = $('#proveedores').val();
        if(idproveedor>0){
            var formData = $("#reporteproveedor").serialize();
            window.open("reporteproveedor?"+formData);
        }else{
            alerta("Elija un proveedor");
        }
    }else if(id==7){
        var idproducto = $('#productos2').val();
        if(idproducto>0){
            var idproveedor = $('#proveedores2').val();
            if(idproveedor<0){
                alerta("Elija un proveedor")
            }else{
                var formData = $("#reporteproductoproveedor").serialize();
                window.open("reporteproductoproveedor?"+formData);
            }
        }else{
            alerta("Elija un producto")
        }
    }else if(id==8){
        var formData = $("#reportecompras").serialize();
        window.open("reportecompras?"+formData);
    }else if(id==9){
        var formData = $("#reportemovimientos").serialize();
        window.open("reportemovimientos?"+formData);
    }else if(id==10){
        window.open("reportestockseguridad");
    }
}

function agregarusuario(){
    var nombre = $('#nombre-agregar').val();
    if(nombre!=null && nombre.trim().length>0 && nombre.length!=" "){
        var paterno = $('#paterno-agregar').val();
        if(paterno!=null && paterno.trim().length>0 && paterno.length!=" "){
            var materno = $('#materno-agregar').val();
            if(materno!=null && materno.trim().length>0 && materno.length!=" "){
                var cuenta = $('#cuenta-agregar').val();
                if(cuenta!=null && cuenta.trim().length>0 && cuenta.length!=" "){
                    var cargando = '<div class="preloader-wrapper small active"><div class="spinner-layer spinner-green-only"><div class="circle-clipper left"><div class="circle"></div></div><div class="gap-patch"><div class="circle"></div></div><div class="circle-clipper right"><div class="circle"></div></div></div></div>';
                    var btn = '<button onclick="agregarusuario()" class="btn-large">Guardar</button>';
                    $("#divbtnagregar").html(cargando);
                    var formData = $("#formagregar").serialize();
                    $.ajax({
                        type: "POST",
                        url: "usuario",
                        data: formData,
                        success: function(a) {
                            a = JSON.parse(a);
                            if(a.ok){
                                alerta("GUARDADO CORRECTAMENTE");
                                var fila = '';
                                var usuario = a.obj;
                                fila = '<tr id="fila'+usuario.id+'">'+
                                       '<td></td>'+
                                        '<td>'+usuario.paterno+' '+usuario.materno+' '+usuario.nombre+'</td>'+
                                        '<td>'+usuario.cuenta+'</td>'+
                                        '<td><a onclick="modalusuario('+usuario.id+',\''+usuario.paterno+' '+usuario.materno+' '+usuario.nombre+'\',\'editar\')" class="btn green"><i class="material-icons">edit</i></a></td>'+
                                        '<td><a onclick="modalusuario('+usuario.id+',\''+usuario.paterno+' '+usuario.materno+' '+usuario.nombre+'\',\'restablecer\')" class="btn"><i class="material-icons">replay</i></a></td>'+
                                        '<td><a onclick="modalusuario('+usuario.id+',\''+usuario.paterno+' '+usuario.materno+' '+usuario.nombre+'\',\'eliminar\')" class="btn red"><i class="material-icons">delete</i></a></td>'+
                                        "</tr>";
                                $('#filas').prepend(fila);
                                $('#filaempty').hide();
                                $("#modal-agregar").modal('close');
                                $("#nombre-agregar").val(null);
                                $("#paterno-agregar").val(null);
                                $("#materno-agregar").val(null);
                                $("#divbtnagregar").html(btn);
                            }else{
                                if(a.url==null){
                                    alerta(a.error);
                                    $("#divbtnagregar").html(btn);
                                }else{
                                    window.location = a.url;
                                }
                            }
                        }
                    });
                }else{
                    alerta("Escriba una cuenta");
                }
            }else{
                alerta("Escriba el apellido materno");
            }
        }else{
            alerta("Escriba el apellido paterno");
        }
    }else{
        alerta("Escriba el nombre");
    }
}

function modalusuario(id,nombre,modo){
    $('#subtitulo-'+modo).html(nombre);
    $('#id-'+modo).val(id);
    $('#modal-'+modo).modal("open");
}

function ajaxusuario(modo){
    var cargando = '<div class="preloader-wrapper small active"><div class="spinner-layer spinner-green-only"><div class="circle-clipper left"><div class="circle"></div></div><div class="gap-patch"><div class="circle"></div></div><div class="circle-clipper right"><div class="circle"></div></div></div></div>';
    var btn = '<button onclick="'+modo+'usuario()" class="btn-large">Guardar</button>';
    $("#divbtn"+modo).html(cargando);
    var formData = $("#form"+modo).serialize();
    $.ajax({
        type: "POST",
        url: "usuario",
        data: formData,
        success: function(a) {
            a = JSON.parse(a);
            if(a.ok){
                if(modo=="editar"){
                    alerta("EDITADO CORRECTAMENTE");
                    $('#fila'+a.obj.id).remove();
                }else if(modo=="eliminar"){
                    alerta("ELIMINADO CORRECTAMENTE");
                    $('#fila'+a.obj.id).remove();
                }else if(modo=="restablecer"){
                    alerta("CONTRASEÑA RESTABLECIDA");
                }
                $('#modal-'+modo).modal("close");
            }else{
                if(a.url==null){
                    alerta(a.error);
                    $("#divbtn"+modo).html(btn);
                }else{
                    window.location = a.url;
                }
            }
        }
    });
}

function cancelarventa(){
    var cargando = '<div class="preloader-wrapper small active"><div class="spinner-layer spinner-green-only"><div class="circle-clipper left"><div class="circle"></div></div><div class="gap-patch"><div class="circle"></div></div><div class="circle-clipper right"><div class="circle"></div></div></div></div>';
    var btn = '<button onclick="cancelarventa()" class="btn-large">Cancelar Venta</button>';
    $("#divbtncancelar").html(cargando);
    var formData = $("#formcancelar").serialize();
    $.ajax({
        type: "POST",
        url: "cancelarventa",
        data: formData,
        success: function(a) {
            a = JSON.parse(a);
            if(a.ok){
                $('#modal-cancelar').modal("close");
                window.location.reload();
            }else{
                if(a.url==null){
                    alerta(a.error);
                    $("#divbtncancelar").html(btn);
                }else{
                    window.location = a.url;
                }
            }
        }
    });
}

function hacerproforma(){
    var cantidad = 0;
    var html = "";
    $('#otroscampos').html("");
    for(var key in detalles){
        var detalle = detalles[key];
        html += "<input type='hidden' name='idproductos[]' value='"+detalle[0]+"'>"+
                "<input type='hidden' name='precios[]' value='"+detalle[5]+"'>"+
                "<input type='hidden' name='cantidades[]' value='"+detalle[6]+"'>";
        cantidad++;
    }        
    if(cantidad>0){
        $('#otroscampos').append(html);
        var formData = $("#ventaform").serialize();
        window.open("proforma?"+formData);
    }else{
        alerta("Agregue al menos un producto a la proforma");
    }
}

function modaleditardocumento(id,nombre,codigo,numero){
    $('#id-editar').val(id);
    $('#nombre-editar').val(nombre);
    $('#codigo-editar').val(codigo);
    $('#numero-editar').val(numero);
    $('#modal-editar').modal("open");
    $('#lblaeditar').addClass("active");
    $('#lblbeditar').addClass("active");
    $('#lblceditar').addClass("active");
}

function editardocumento(){
    var codigo = $('#codigo-editar').val();
    if(codigo!=null && codigo.trim().length>0){
        var numero = $('#numero-editar').val();
        if(numero!=null && numero.trim().length>0){
            $('#formeditar').submit();
        }else{
            alerta("Ingrese el número siguiente");
        }
    }else{
        alerta("Ingrese un código");
    }
}

function elegirdocumento(){
    var iddocumento = $('#documentos').val();
    if(iddocumento>0){
        var formData = $("#ventaform").serialize();
        $.ajax({
            type: "POST",
            url: "numerodocumento",
            data: formData,
            success: function(a) {
                a = JSON.parse(a);
                if(a.ok){
                    $('#numero').val(a.obj.numero+1);
                    $('#codigo').val(a.obj.codigo);
                    $('#lblnumero').addClass("active");
                    $('#lblcodigo').addClass("active");
                }else{
                    alerta("Ha ocurrido un error al elegir el documento, intente nuevamente.");
                }
                $('#divbtnregistrar').html("<a onclick='registrarventa()' class='btn-large'>GUARDAR<i class='material-icons right'>save</i></a>");
            },beforeSend:function(){
                $('#divbtnregistrar').html("<div class='row center'><div class='preloader-wrapper small active'><div class='spinner-layer spinner-blue'><div class='circle-clipper left'><div class='circle'></div></div><div class='gap-patch'><div class='circle'></div></div><div class='circle-clipper right'><div class='circle'></div></div></div><div class='spinner-layer spinner-red'><div class='circle-clipper left'><div class='circle'></div></div><div class='gap-patch'><div class='circle'></div></div><div class='circle-clipper right'><div class='circle'></div></div></div><div class='spinner-layer spinner-yellow'><div class='circle-clipper left'><div class='circle'></div></div><div class='gap-patch'><div class='circle'></div></div><div class='circle-clipper right'><div class='circle'></div></div></div><div class='spinner-layer spinner-green'><div class='circle-clipper left'><div class='circle'></div></div><div class='gap-patch'><div class='circle'></div></div><div class='circle-clipper right'><div class='circle'></div></div></div></div></div>");
            }
        });
    }
}

function cargarproductorequerimiento(){
    var id = $('#selectproducto').val();
    if(id>0){
        $('#divbtnagregar').html("<div class='row center'><div class='preloader-wrapper small active'><div class='spinner-layer spinner-blue'><div class='circle-clipper left'><div class='circle'></div></div><div class='gap-patch'><div class='circle'></div></div><div class='circle-clipper right'><div class='circle'></div></div></div><div class='spinner-layer spinner-red'><div class='circle-clipper left'><div class='circle'></div></div><div class='gap-patch'><div class='circle'></div></div><div class='circle-clipper right'><div class='circle'></div></div></div><div class='spinner-layer spinner-yellow'><div class='circle-clipper left'><div class='circle'></div></div><div class='gap-patch'><div class='circle'></div></div><div class='circle-clipper right'><div class='circle'></div></div></div><div class='spinner-layer spinner-green'><div class='circle-clipper left'><div class='circle'></div></div><div class='gap-patch'><div class='circle'></div></div><div class='circle-clipper right'><div class='circle'></div></div></div></div></div>");
        var producto = productos[id];
        $('#cantidad').val(null);
        $('#cantidad2').val(null);
        $('#cantidad').prop("disabled",false);
        $('#cantidad2').prop("disabled",false);
        $('#lblcantidad').html("Cantidad de "+producto[5]);
        $('#lblcantidad2').html("Cantidad de "+producto[6]);
        $('#divbtnagregar').html('<a onclick="agregardetallerequerimiento()" class="btn"><i class="material-icons">add</i></a>');
    }else{
        limpiarcamposrequerimiento();
    }
}

function limpiarcamposrequerimiento(){
    $('#cantidad').val(null);
    $('#cantidad2').val(null);
    $('#lblcantidad').html("Elija un producto");
    $('#lblcantidad2').html("Elija un producto");
}


function agregardetallerequerimiento(){
    var idproducto = $('#selectproducto').val();
    if(idproducto>0){
        var cantidad = parseFloat($('#cantidad').val());
        var cantidad2 = parseFloat($('#cantidad2').val());
        if(cantidad>0){
            
        }else{
            cantidad = 0;
        }
        if(cantidad2>0){
            
        }else{
            cantidad2 = 0;
        }
        var producto = productos[idproducto];
        var cnt = producto[3];
        var total = (cantidad*cnt) + cantidad2;
        var ok = false;
        if(total>=0){
            var decimal = total.toString();
            if(decimal.indexOf('.')<0){
                ok = true;
            }else{
                alerta("Ingrese una cantidad entera");
                ok = false;
            }
        }else{
            ok = false;
            alerta("Ingrese una cantidad mayor a 0");
        }

        var producto = productos[idproducto];
        var productonombre = producto[0];
        var unidad = producto[5];
        var unidad2 = producto[6];
        var productocantidad = producto[3];
        if(ok){
            $.ajax({
                type: "GET",
                url: "productorequerimiento",
                data: {"productoid":idproducto,"productonombre":productonombre,"unidad":unidad,"unidad2":unidad2,"productocantidad":productocantidad,"cantidad":cantidad,"cantidad2":cantidad2},
                success: function(a) {
                    a = JSON.parse(a);
                    $('#divbtnagregar').html('<a class="btn disabled"><i class="material-icons">add</i></a>');
                    if(a.ok){
                        detalles = a.detalles;
                        recargarfilasrequerimiento(detalles);
                        limpiarcamposrequerimiento();
                        $('#selectproducto').val('0').trigger('change');
                    }else{
                        if(a.url==null){
                            alerta(a.error);
                        }else{
                            window.location = a.url;
                        }
                    }
                },beforeSend:function(){
                    $('#divbtnagregar').html("<div class='row center'><div class='preloader-wrapper small active'><div class='spinner-layer spinner-blue'><div class='circle-clipper left'><div class='circle'></div></div><div class='gap-patch'><div class='circle'></div></div><div class='circle-clipper right'><div class='circle'></div></div></div><div class='spinner-layer spinner-red'><div class='circle-clipper left'><div class='circle'></div></div><div class='gap-patch'><div class='circle'></div></div><div class='circle-clipper right'><div class='circle'></div></div></div><div class='spinner-layer spinner-yellow'><div class='circle-clipper left'><div class='circle'></div></div><div class='gap-patch'><div class='circle'></div></div><div class='circle-clipper right'><div class='circle'></div></div></div><div class='spinner-layer spinner-green'><div class='circle-clipper left'><div class='circle'></div></div><div class='gap-patch'><div class='circle'></div></div><div class='circle-clipper right'><div class='circle'></div></div></div></div></div>");
                }
            });
        }else{
            alerta("Ingrese una cantidad entera");
        }
    }else{
        alerta("Elija un producto");
    } 
}


function recargarfilasrequerimiento(lista){ 
    var html = "";
    $.each(lista,function (key,obj){
        html += "<tr id='fila"+obj[0]+"'>\n\
                    <td>"+obj[1]+"</td>\n\
                    <td>"+obj[2]+"</td>\n\
                    <td><a class='btn red' onclick='eliminarfilarequerimiento("+obj[0]+")'><i class='material-icons'>delete</i></a></td>\n\
\n\                 </tr>";
    });
    $('#filas').html(html);
    alerta("Se actualizó la tabla");
}

function eliminarfilarequerimiento(idproducto){
    
    $.ajax({
        type: "GET",
        url: "traslado-producto-eliminar",
        data: {"id":idproducto},
        success: function(a) {
            $("#fila"+idproducto).remove();
        }
    });
    
}

function cargarsubcategorias(){
    var categoria = $('#categoria-producto').val();
    $.ajax({
        type: "GET",
        url: "subcategorias",
        data: {"id_categoria":categoria,"modo":"ajax"},
        success: function(a) {
            a = JSON.parse(a);
            if(a.ok){
                var lista = a.obj;
                var html = '<label for="subcategoria-producto">SUBCATEGORIA</label>'+
                            '<select id="subcategoria-producto" name="id_subcategoria" style="width: 100%;">';
                $.each(lista,function (key,subcategoria){
                  html += "<option value='"+subcategoria.id+"'>"+subcategoria.nombre+"</option>";  
                });
                html += '</select>';
                $('#divsubcategoria').html(html);
                $('#subcategoria-producto').select2();
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

function cargarrequerimientostraslado(){
    $.ajax({
        type: "GET",
        url: "requerimientos-traslado",
        success: function(a) {
            a = JSON.parse(a);
            if(a.ok){
                detalles = a.detalles;
                recargarfilasrequerimiento(detalles);
                limpiarcamposrequerimiento();
                $('#selectproducto').val('0').trigger('change');
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

function registrartraslado(){
    var formData = $("#trasladoform").serialize();
    $.ajax({
        type: "POST",
        url: "traslado",
        data: formData,
        success: function(a) {
            a = JSON.parse(a);
            if(a.ok){
                window.location = "traslado?id="+a.traslado;
            }else{
                if(a.error!=null){
                    alerta2(a.error,8);
                    $('#divbtnregistrar').html("<a onclick='registrartraslado()' class='btn-large'>GUARDAR<i class='material-icons right'>save</i></a>");
                }else{
                    window.location = a.url;
                }
            }
        },beforeSend:function(){
            $('#divbtnregistrar').html("<div class='row center'><div class='preloader-wrapper small active'><div class='spinner-layer spinner-blue'><div class='circle-clipper left'><div class='circle'></div></div><div class='gap-patch'><div class='circle'></div></div><div class='circle-clipper right'><div class='circle'></div></div></div><div class='spinner-layer spinner-red'><div class='circle-clipper left'><div class='circle'></div></div><div class='gap-patch'><div class='circle'></div></div><div class='circle-clipper right'><div class='circle'></div></div></div><div class='spinner-layer spinner-yellow'><div class='circle-clipper left'><div class='circle'></div></div><div class='gap-patch'><div class='circle'></div></div><div class='circle-clipper right'><div class='circle'></div></div></div><div class='spinner-layer spinner-green'><div class='circle-clipper left'><div class='circle'></div></div><div class='gap-patch'><div class='circle'></div></div><div class='circle-clipper right'><div class='circle'></div></div></div></div></div>");
        }
    });
}


function agregardetalletraslado(){
    var idproducto = $('#selectproducto').val();
    if(idproducto>0){
        var cantidad = parseFloat($('#cantidad').val());
        var cantidad2 = 0;
        if(cantidad>0){
            
        }else{
            cantidad = 0;
        }
        var producto = productos[idproducto];
        var cnt = producto[3];
        var total = (cantidad*cnt) + cantidad2;
        var ok = false;
        if(total!=0){
            if(total>0){
                var decimal = total.toString();
                if(decimal.indexOf('.')<0){
                    ok = true;
                }else{
                    alerta("Ingrese una cantidad entera");
                    ok = false;
                }
            }else{
                ok = false;
                alerta("Ingrese una cantidad mayor a 0");
            }
        }
            

        var producto = productos[idproducto];
        var productonombre = producto[0];
        var unidad = producto[5];
        var unidad2 = producto[6];
        var productocantidad = producto[3];
        if(ok){
            $.ajax({
                type: "GET",
                url: "productotraslado",
                data: {"productoid":idproducto,"productonombre":productonombre,"unidad":unidad,"unidad2":unidad2,"productocantidad":productocantidad,"cantidad":cantidad,"cantidad2":cantidad2},
                success: function(a) {
                    a = JSON.parse(a);
                    $('#divbtnagregar').html('<a class="btn disabled"><i class="material-icons">add</i></a>');
                    if(a.ok){
                        detalles = a.detalles;
                        recargarfilasrequerimiento(detalles);
                        limpiarcamposrequerimiento();
                        $('#selectproducto').val('0').trigger('change');
                        $('#selectproducto').select2('open');
                    }else{
                        if(a.url==null){
                            alerta(a.error);
                        }else{
                            window.location = a.url;
                        }
                    }
                },beforeSend:function(){
                    $('#divbtnagregar').html("<div class='row center'><div class='preloader-wrapper small active'><div class='spinner-layer spinner-blue'><div class='circle-clipper left'><div class='circle'></div></div><div class='gap-patch'><div class='circle'></div></div><div class='circle-clipper right'><div class='circle'></div></div></div><div class='spinner-layer spinner-red'><div class='circle-clipper left'><div class='circle'></div></div><div class='gap-patch'><div class='circle'></div></div><div class='circle-clipper right'><div class='circle'></div></div></div><div class='spinner-layer spinner-yellow'><div class='circle-clipper left'><div class='circle'></div></div><div class='gap-patch'><div class='circle'></div></div><div class='circle-clipper right'><div class='circle'></div></div></div><div class='spinner-layer spinner-green'><div class='circle-clipper left'><div class='circle'></div></div><div class='gap-patch'><div class='circle'></div></div><div class='circle-clipper right'><div class='circle'></div></div></div></div></div>");
                }
            });
        }
    }else{
        alerta("Elija un producto");
    } 
}

function cargarproductotraslado(){
    var id = $('#selectproducto').val();
    if(id>0){
        $('#divbtnagregar').html("<div class='row center'><div class='preloader-wrapper small active'><div class='spinner-layer spinner-blue'><div class='circle-clipper left'><div class='circle'></div></div><div class='gap-patch'><div class='circle'></div></div><div class='circle-clipper right'><div class='circle'></div></div></div><div class='spinner-layer spinner-red'><div class='circle-clipper left'><div class='circle'></div></div><div class='gap-patch'><div class='circle'></div></div><div class='circle-clipper right'><div class='circle'></div></div></div><div class='spinner-layer spinner-yellow'><div class='circle-clipper left'><div class='circle'></div></div><div class='gap-patch'><div class='circle'></div></div><div class='circle-clipper right'><div class='circle'></div></div></div><div class='spinner-layer spinner-green'><div class='circle-clipper left'><div class='circle'></div></div><div class='gap-patch'><div class='circle'></div></div><div class='circle-clipper right'><div class='circle'></div></div></div></div></div>");
        var producto = productos[id];
        $('#cantidad').val(null);
        $('#cantidad2').val(null);
        $('#cantidad').prop("disabled",false);
        $('#cantidad2').prop("disabled",false);
        $('#lblcantidad').html("Cantidad de "+producto[5]);
        $('#lblcantidad2').html("Cantidad de "+producto[6]);
        $('#divbtnagregar').html('<a onclick="agregardetalletraslado()" class="btn"><i class="material-icons">add</i></a>');
        
        setTimeout(function(){
            $('#cantidad').focus();   
        }, 0);
    }else{
        limpiarcamposrequerimiento();
    }
}

function pedidoprecioenter(){
    var precio = $('#precio-detalle').val();
    
    if (window.event){
        if (window.event.keyCode==13){
            if(precio.length>0 && precio>=0){
                $('#cantidad-detalle').focus();
            }else{
                alerta("Ingresa un precio mayor o igual a 0");
            }
        }
      }
    else{
        if (e){
          if(e.which==13){
                if(precio.length>0 && precio>=0){
                    $('#cantidad-detalle').focus();
                }else{
                    alerta("Ingresa un precio mayor o igual a 0");
                }
            }
        }   
    }
}

function pedidocantidadenter(){
    if (window.event)
      {
               if (window.event.keyCode==13)
        {modaldetallepost();}// Aqui escribe el nombre tu funcion que hace la busqueda...
      }
      else
                    //Esto es para Firefox y creo otros navegadores
        if (e)
        {
          if(e.which==13)
            {modaldetallepost();}//Igual que arriba
        }
}

function pedidocantidadenter2(){
    if (window.event)
      {
               if (window.event.keyCode==13)
        {editardetallepost();}// Aqui escribe el nombre tu funcion que hace la busqueda...
      }
      else
                    //Esto es para Firefox y creo otros navegadores
        if (e)
        {
          if(e.which==13)
            {editardetallepost();}//Igual que arriba
        }
}



function trasladocantidadenter(){
    if (window.event)
      {
               if (window.event.keyCode==13)
        {agregardetalletraslado();}// Aqui escribe el nombre tu funcion que hace la busqueda...
      }
      else
                    //Esto es para Firefox y creo otros navegadores
        if (e)
        {
          if(e.which==13)
            {agregardetalletraslado();}//Igual que arriba
        }
}


function cargarregistro(tabla,id){
    var cargando = '<div class="preloader-wrapper small active"><div class="spinner-layer spinner-green-only"><div class="circle-clipper left"><div class="circle"></div></div><div class="gap-patch"><div class="circle"></div></div><div class="circle-clipper right"><div class="circle"></div></div></div></div>';
    var btn = "<button onclick='cargarregistro("+tabla+","+id+")' class='btn-large'>Guardar</button>";
    $("#divbtneliminar").html(cargando);
    var formData = $("#formeliminar").serialize();
    $.ajax({
        type: "POST",
        url: "modelopost",
        data: formData,
        success: function(a) {
            a = JSON.parse(a);
            if(a.ok){
                alerta("ELIMINADO CORRECTAMENTE");
                var categoria = a.obj;
                $('#fila'+categoria.id).remove();
                $("#modal-eliminar").modal('close');
                $("#divbtneliminar").html(btn);
                if(a.tabla=="producto"){
                    $('table').remove(".small-only");
                    $("#tabla-productos").removeClass("stacktable");
                    $("#tabla-productos").removeClass("large-only");
                    $("#tabla-productos").stacktable2();
                }
            }else{
                if(a.url==null){
                    alerta(a.error);
                    $("#divbtneliminar").html(btn);
                }else{
                    window.location = a.url;
                }
            }
        }
    });
}
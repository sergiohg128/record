<?php

Route::get('/clear-cache', function() {
    $exitCode = Artisan::call('cache:clear');
    $exitCode = Artisan::call('route:clear');
    $exitCode = Artisan::call('view:clear');
});


Route::get('/', function (){
    return redirect("/index");
});
Route::get('/index','Controlador@index');
Route::get('/inicio','Controlador@inicio');

//CONTROLADOR
Route::post('/login','Controlador@login');
Route::get('/logout','Controlador@logout');

//CONFIGURACION
Route::get('/usuarios','ControladorConfiguracion@usuarios');
Route::get('/facultades','ControladorConfiguracion@facultades');
Route::get('/facultad-formulario','ControladorConfiguracion@facultadFormulario');
Route::post('/facultad-formulario','ControladorConfiguracion@facultadFormularioPost');

Route::get('/escuelas','ControladorConfiguracion@escuelas');
Route::get('/escuela-formulario','ControladorConfiguracion@escuelaFormulario');
Route::post('/escuela-formulario','ControladorConfiguracion@escuelaFormularioPost');

Route::get('/programas','ControladorConfiguracion@programas');
Route::get('/programa-formulario','ControladorConfiguracion@programaFormulario');
Route::post('/programa-formulario','ControladorConfiguracion@programaFormularioPost');

Route::get('/lineas','ControladorConfiguracion@lineas');
Route::get('/linea-formulario','ControladorConfiguracion@lineaFormulario');
Route::post('/linea-formulario','ControladorConfiguracion@lineaFormularioPost');

Route::get('/tipos-proyectos','ControladorConfiguracion@tiposProyectos');
Route::get('/tipo-proyecto-formulario','ControladorConfiguracion@tipoProyectoFormulario');
Route::post('/tipo-proyecto-formulario','ControladorConfiguracion@tipoProyectoFormularioPost');

Route::get('/tipos-investigadores','ControladorConfiguracion@tiposInvestigadores');
Route::get('/tipo-investigador-formulario','ControladorConfiguracion@tipoInvestigadorFormulario');
Route::post('/tipo-investigador-formulario','ControladorConfiguracion@tipoInvestigadorFormularioPost');

Route::get('/tipos-grupos','ControladorConfiguracion@tiposGrupos');
Route::post('/tipo-grupo-formulario','ControladorConfiguracion@tipoGrupoFormularioPost');
Route::post('/tipo-grupo-formulario','ControladorConfiguracion@tipoGrupoFormularioPost');

//INVESTIGACION
Route::get('/investigadores','ControladorInvestigacion@investigadores');
Route::get('/investigador-formulario','ControladorInvestigacion@investigadorFormulario');
Route::post('/investigador-formulario','ControladorInvestigacion@investigadorFormularioPost');

Route::get('/grupos','ControladorInvestigacion@grupos');
Route::get('/grupo-formulario','ControladorInvestigacion@grupoFormulario');
Route::post('/grupo-formulario','ControladorInvestigacion@grupoFormularioPost');

Route::get('/proyectos','ControladorInvestigacion@proyectos');
Route::get('/proyecto-formulario','ControladorInvestigacion@proyectoFormulario');
Route::post('/proyecto-formulario','ControladorInvestigacion@proyectoFormularioPost');


//REPORTES
Route::get('/reportes','ControladorReportes@reportes');
Route::get('/reporte','ControladorReportes@reporte');
Route::get('/reporte1','ControladorReportes@reporte1');
Route::get('/reporte2','ControladorReportes@reporte2');
Route::get('/reporte3','ControladorReportes@reporte3');
Route::get('/reporte4','ControladorReportes@reporte4');
Route::get('/reporte5','ControladorReportes@reporte5');
Route::get('/reporte6','ControladorReportes@reporte6');
Route::get('/reporte7','ControladorReportes@reporte7');
Route::get('/reporte8','ControladorReportes@reporte8');
Route::get('/reporte9','ControladorReportes@reporte9');
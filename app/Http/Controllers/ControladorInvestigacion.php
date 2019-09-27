<?php

namespace App\Http\Controllers;

use Datetime;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Storage;
use App\Entrega;
use App\EscuelaSelgestiun;
use App\FacultadSelgestiun;
use App\Investigador;
use App\InvestigadorProyecto;
use App\Linea;
use App\Programa;
use App\Proyecto;
use App\TipoArticulo;
use App\TipoGrupo;
use App\TipoInvestigador;
use App\TipoLibro;
use App\TipoProyecto;
use App\Usuario;
use App\UsuarioSelgestiun;
use App\ProyectoSelgestiun;
use App\TramiteSelgestiun;
use App\FaseSelgestiun;
use App\FuncionSelgestiun;
use App\ArchivoSelgestiun;

class ControladorInvestigacion extends Controller
{
    
    private function ComprobarUsuario($usuario){
        if(empty($usuario)){
            return FALSE;
        }
        if(empty($usuario->id)){
            return FALSE;
        }
        if($usuario->id==null){
            return FALSE;
        }
        if($usuario->id==0){
            return FALSE;
        }
        return TRUE;
    }
    
    public function investigadores(Request $request,  Response $response) {
        $usuario = $request->session()->get('usuario');
        if($this->ComprobarUsuario($usuario)){
            if(true){
                $mensaje = $request->session()->get('mensaje');
                $request->session()->forget('mensaje');
                //$investigadores = Investigador::where("estado","N")->orderBy("paterno")->orderBy("materno")->orderBy("nombres")->get();

                $investigadores = UsuarioSelgestiun::select("tb_usuario.*","te.tb_escuela_nombre","tti.tb_tipoinvestigador_nombre","tb_permiso_cargo")
                                                    ->join("tb_permiso as tp","tp.tb_usuario_id","tb_usuario.tb_usuario_id")
                                                    ->join("tb_escuela as te","te.tb_escuela_id","tp.tb_escuela_id")
                                                    ->join("tb_tipoinvestigador as tti","tti.tb_tipoinvestigador_id","tb_usuario.tb_tipoinvestigador_id")
                                                    ->whereIn("tb_permiso_cargo",["DOCENTE","ALUMNO"])
                                                    ->where("tb_permiso_estado","ACTIVO")
                                                    ->orderBy("tb_usuario_apellidopaterno")
                                                    ->orderBy("tb_usuario_apellidomaterno")
                                                    ->orderBy("tb_usuario_nombre")
                                                    ->get();
                return view('/investigadores',[
                    'usuario'=>$usuario,
                    'mensaje'=>$mensaje,
                    'investigadores'=>$investigadores,
                    'w'=>0
                ]);
            }else{
                $request->session()->put("mensaje","NO TIENE ACCESO AL MENÚ");
                return redirect ("/inicio");
            }
        }else{
            return redirect("/index");
        }
    }

    public function investigadorProyectoFormulario(Request $request,  Response $response) {
        $usuario = $request->session()->get('usuario');
        if($this->ComprobarUsuario($usuario)){
            if(true){
                $mensaje = $request->session()->get('mensaje');
                $request->session()->forget('mensaje');
                $proyecto = $request->input("p");
                $investigadorP = new InvestigadorProyecto();
                $modo = "nuevo";
                //$investigadores = Investigador::
                //                select("investigador.*")
                //                ->join("escuela","investigador.id_escuela","escuela.id")
                //                ->where("investigador.estado","N");

                //if($usuario->id_facultad>0){
                //    $investigadores = $investigadores->where("escuela.id_facultad",$usuario->id_facultad);
                //}
                //$investigadores = $investigadores->orderBy("paterno")->orderBy("materno")->orderBy("nombres")->get();
                $investigadores = UsuarioSelgestiun::select("tb_usuario.*","tb_permiso_cargo")
                                                    ->join("tb_permiso as tp","tp.tb_usuario_id","tb_usuario.tb_usuario_id")
                                                    ->join("tb_escuela as te","tp.tb_escuela_id","te.tb_escuela_id")
                                                    ->whereIn("tb_permiso_cargo",["DOCENTE","ALUMNO"])
                                                    ->where("tb_permiso_estado","ACTIVO");
                                                    
                if($usuario->id_facultad>0){
                    $investigadores = $investigadores->where("te.tb_facultad_id",$usuario->id_facultad);
                }

                $investigadores = $investigadores->orderBy("tb_usuario_apellidopaterno")
                                                    ->orderBy("tb_usuario_apellidomaterno")
                                                    ->orderBy("tb_usuario_nombre")
                                                    ->get();

                return view('/investigador-proyecto-formulario',[
                    'usuario'=>$usuario,
                    'mensaje'=>$mensaje,
                    'investigadorP'=>$investigadorP,
                    'w'=>0,
                    'modo'=>$modo,
                    'proyecto'=>$proyecto,
                    'investigadores'=>$investigadores
                ]);
            }else{
                $request->session()->put("mensaje","NO TIENE ACCESO AL MENÚ");
                return redirect ("/inicio");
            }
        }else{
            return redirect("/index");
        }
    }
    
    public function investigadorProyectoFormularioPost(Request $request,  Response $response) {
        $usuario = $request->session()->get('usuario');
        if($this->ComprobarUsuario($usuario)){
            $modo = $request->input("modo");
            $rol = $request->input("rol");
            DB::beginTransaction();
            try{
                

                $id_investigador = $request->input("investigador");
                $id_proyecto = $request->input("proyecto");
                if($modo=="nuevo"){
                    $investigadorP = new InvestigadorProyecto();
                    $investigadorx = InvestigadorProyecto::where("id_investigador",$id_investigador)->where("id_proyecto",$id_proyecto)->where("estado","N")->first();
                    if($investigadorx!=null){
                        $investigadorx->rol = $rol;
                        $investigadorx->save();
                        DB::commit();
                        return redirect("/proyecto?id=".$investigadorx->id_proyecto);
                    }
                }else{
                    $investigadorP = InvestigadorProyecto::find($id);
                }
                $investigadorP->id_investigador = $id_investigador;
                $investigadorP->id_proyecto = $id_proyecto;
                $investigadorP->rol = $rol;


                $usuarioselgestiun = UsuarioSelgestiun::join("tb_permiso","tb_usuario.tb_usuario_id","tb_permiso.tb_usuario_id")
                                        ->leftJoin("tb_escuela","tb_escuela.tb_escuela_id","tb_permiso.tb_escuela_id")
                                        ->where("tb_usuario.tb_usuario_id",$id_investigador)->first();
                $investigadorP->id_facultad = $usuarioselgestiun->tb_facultad_id;
                $investigadorP->id_escuela = $usuarioselgestiun->tb_escuela_id;

                $investigadorP->save();
                $request->session()->put("mensaje","Investigador Guardado");
                DB::commit();
                return redirect("/proyecto?id=".$investigadorP->id_proyecto);
            } 
            catch (Exception $ex) {
                return redirect("/index");
            }
        }
        else{
            return redirect("/index");
        }
    }


    public function proyectos(Request $request,  Response $response) {
        $usuario = $request->session()->get('usuario');
        if($this->ComprobarUsuario($usuario)){
            if(true){
                $mensaje = $request->session()->get('mensaje');
                $request->session()->forget('mensaje');
                
                //$tiposproyectos = TipoProyecto::where("estado","N")->orderBy("nombre")->get();
                
                $proyectos = Proyecto::
                            select("proyecto.*")
                            ->leftJoin("investigador_proyecto as ip","proyecto.id","ip.id_proyecto")
                            ->where("proyecto.estado","N");
                if($usuario->id_facultad>0){
                    $proyectos = $proyectos->where("proyecto.id_facultad",$usuario->id_facultad)->orWhere("ip.id_facultad",$usuario->id_facultad);
                }
                $proyectos = $proyectos->orderBy("proyecto.fecha","desc")->paginate(20);

                return view('/proyectos',[
                    'usuario'=>$usuario,
                    'mensaje'=>$mensaje,
                    
                    'proyectos'=>$proyectos,
                    'w'=>0,
                    'y'=>0,
                    'z'=>0
                ]);
            }else{
                $request->session()->put("mensaje","NO TIENE ACCESO AL MENÚ");
                return redirect ("/inicio");
            }
        }else{
            return redirect("/index");
        }
    }

    public function proyectose(Request $request,  Response $response) {
        $usuario = $request->session()->get('usuario');
        if($this->ComprobarUsuario($usuario)){
            if(true){
                $mensaje = $request->session()->get('mensaje');
                $request->session()->forget('mensaje');
                

                $proyectosSelgestiunEstudiantes = TramiteSelgestiun::join("tb_proyecto as p","p.tb_tramite_id","tb_tramite.tb_tramite_id")
                                                    ->join("tb_funcion as f","f.tb_tramite_id","tb_tramite.tb_tramite_id")
                                                    ->join("tb_usuario as u","u.tb_usuario_id","f.tb_usuario_id")
                                                    ->where("f.tb_funcion_nombre","AUTOR")
                                                    ->whereIn("p.tb_tipoproyecto_id",[7,19,20,21,22,23])
                                                    ->orderBy("p.tb_proyecto_id")
                                                    ->paginate(20);


                return view('/proyectose',[
                    'usuario'=>$usuario,
                    'mensaje'=>$mensaje,
                    
                    'proyectosSelgestiunEstudiantes'=>$proyectosSelgestiunEstudiantes,
                    'w'=>0,
                    'y'=>0,
                    'z'=>0
                ]);
            }else{
                $request->session()->put("mensaje","NO TIENE ACCESO AL MENÚ");
                return redirect ("/inicio");
            }
        }else{
            return redirect("/index");
        }
    }

    public function proyectosd(Request $request,  Response $response) {
        $usuario = $request->session()->get('usuario');
        if($this->ComprobarUsuario($usuario)){
            if(true){
                $mensaje = $request->session()->get('mensaje');
                $request->session()->forget('mensaje');
                
                //$tiposproyectos = TipoProyecto::where("estado","N")->orderBy("nombre")->get();
            

                $proyectosSelgestiunDocentes = TramiteSelgestiun::join("tb_proyecto as p","p.tb_tramite_id","tb_tramite.tb_tramite_id")
                                                    ->join("tb_funcion as f","f.tb_tramite_id","tb_tramite.tb_tramite_id")
                                                    ->join("tb_usuario as u","u.tb_usuario_id","f.tb_usuario_id")
                                                    ->where("f.tb_funcion_nombre","AUTOR")
                                                    ->where("p.tb_tipoproyecto_id",8)
                                                    ->orderBy("p.tb_proyecto_id")
                                                    ->paginate(20);
                return view('/proyectosd',[
                    'usuario'=>$usuario,
                    'mensaje'=>$mensaje,
                    'proyectosSelgestiunDocentes'=>$proyectosSelgestiunDocentes,
                    'w'=>0,
                    'y'=>0,
                    'z'=>0
                ]);
            }else{
                $request->session()->put("mensaje","NO TIENE ACCESO AL MENÚ");
                return redirect ("/inicio");
            }
        }else{
            return redirect("/index");
        }
    }

    

    public function proyecto(Request $request,  Response $response) {
        $usuario = $request->session()->get('usuario');
        if($this->ComprobarUsuario($usuario)){
            if(true){
                $mensaje = $request->session()->get('mensaje');
                $request->session()->forget('mensaje');
                $id = $request->input("id");
                $proyecto = Proyecto::find($id);
                $investigadoresP = InvestigadorProyecto::
                                    where("id_proyecto",$id)
                                    ->where("estado","N")
                                    ->orderBy("rol")
                                    ->orderBy("id")->get();
                $entregas = Entrega::where("id_proyecto",$id)->orderBy("id")->get();
                
                return view('/proyecto',[
                    'usuario'=>$usuario,
                    'mensaje'=>$mensaje,
                    'investigadoresP'=>$investigadoresP,
                    'proyecto'=>$proyecto,
                    'entregas'=>$entregas,
                    'w'=>0,
                    'z'=>0
                ]);
            }else{
                $request->session()->put("mensaje","NO TIENE ACCESO AL MENÚ");
                return redirect ("/inicio");
            }
        }else{
            return redirect("/index");
        }
    }

    public function proyectoFormulario(Request $request,  Response $response) {
        $usuario = $request->session()->get('usuario');
        if($this->ComprobarUsuario($usuario)){
            if(true){
                $mensaje = $request->session()->get('mensaje');
                $request->session()->forget('mensaje');
                //$investigadores = Investigador::where("estado","N")->orderBy("paterno")->orderBy("materno")->orderBy("nombres")->get();
                $tiposproyectos = TipoProyecto::where("estado","N")->orderBy("nombre")->get();
                $tiposgrupos = TipoGrupo::where("estado","N")->orderBy("nombre")->get();
                $programas = Programa::where("estado","N")->orderBy("nombre")->get();
                $id = $request->input("id");
                $proyecto = new Proyecto();
                $modo = "nuevo";
                $programa = new Programa();
                if(!empty($id)){
                    $proyecto = Proyecto::find($id);
                    $modo = "editar";
                    if($proyecto->id_linea>0){
                        $linea = Linea::find($proyecto->id_linea);
                        $programa = Programa::find($linea->id_programa);
                    }
                }
                return view('/proyecto-formulario',[
                    'usuario'=>$usuario,
                    'mensaje'=>$mensaje,
                    //'investigadores'=>$investigadores,
                    'tiposproyectos'=>$tiposproyectos,
                    'tiposgrupos'=>$tiposgrupos,
                    'proyecto'=>$proyecto,
                    'programas'=>$programas,
                    'programax'=>$programa,
                    'w'=>0,
                    'modo'=>$modo
                ]);
            }else{
                $request->session()->put("mensaje","NO TIENE ACCESO AL MENÚ");
                return redirect ("/inicio");
            }
        }else{
            return redirect("/index");
        }
    }

    public function ProyectoFormularioPost(Request $request,  Response $response) {
        $usuario = $request->session()->get('usuario');
        if($this->ComprobarUsuario($usuario)){
            $id = $request->input("id");
            $modo = $request->input("modo");
            $titulo = $request->input("titulo");
            //$modalidad = $request->input("modalidad");
            $tipo_proyecto = $request->input("tipo_proyecto");
            $tipo_grupo = $request->input("tipogrupo");
            //$investigador = $request->input("investigador");
            $fecha = $request->input("fecha");
            $fecha2 = $request->input("fecha2");
            //$linea = $request->input("linea");
            $informacion = $request->input("informacion");
            DB::beginTransaction();
            try{
                if($modo=="nuevo"){
                    $proyecto = new Proyecto();
                }else{
                    $proyecto = Proyecto::find($id);
                }
                $proyecto->titulo = $titulo;
                // $proyecto->modalidad = $modalidad;
                $proyecto->id_tipo_proyecto = $tipo_proyecto;
                // if($modalidad=="I"){
                //     $proyecto->id_investigador = $investigador;
                // }else if($modalidad=="G"){
                $proyecto->id_tipo_grupo = $tipo_grupo;
                // }
                // if($linea>0){
                //     $proyecto->id_linea = $linea;
                // }else{
                //     $proyecto->id_linea = null;
                // }
                $proyecto->fecha = $fecha;
                $proyecto->fecha2 = $fecha2;
                $proyecto->informacion= $informacion;
                $proyecto->id_facultad = $usuario->id_facultad;
                $proyecto->save();
                $request->session()->put("mensaje","Proyecto Guardado");
                DB::commit();
                return redirect("/proyecto?id=".$proyecto->id);
            } 
            catch (Exception $ex) {
                return redirect("/index");
            }
        }
        else{
            return redirect("/index");
        }
    }

    public function entregaFormulario(Request $request,  Response $response) {
        $usuario = $request->session()->get('usuario');
        if($this->ComprobarUsuario($usuario)){
            if(true){
                $mensaje = $request->session()->get('mensaje');
                $request->session()->forget('mensaje');

                $id = $request->input("id");
                $proyecto = $request->input("p");
                $entrega = new Entrega();
                $entrega->id_proyecto = $proyecto;
                $modo = "nuevo";
                if(!empty($id)){
                    $entrega = Entrega::find($id);
                    $modo = "editar";
                }
                return view('/entrega-formulario',[
                    'usuario'=>$usuario,
                    'mensaje'=>$mensaje,
                    'entrega'=>$entrega,
                    'w'=>0,
                    'modo'=>$modo
                ]);
            }else{
                $request->session()->put("mensaje","NO TIENE ACCESO AL MENÚ");
                return redirect ("/inicio");
            }
        }else{
            return redirect("/index");
        }
    }

    public function entregaFormularioPost(Request $request,  Response $response) {
        $usuario = $request->session()->get('usuario');
        if($this->ComprobarUsuario($usuario)){
            $id = $request->input("id");
            $proyecto = $request->input("proyecto");
            $fecha = $request->input("fecha");
            $observacion = $request->input("observacion");
            $tipo = $request->input("tipo");
            $modo = $request->input("modo");
            $archivo = $request->file("cert");
            DB::beginTransaction();
            try{
                if($modo=="nuevo"){
                    $entrega = new Entrega();
                    $entrega->id_proyecto = $proyecto;
                }else{
                    $entrega = Entrega::find($id);
                }
                $entrega->fecha = $fecha;
                $entrega->observacion = $observacion;
                $entrega->tipo = $tipo;

                $ext = $archivo->getClientOriginalExtension();
                $entrega->extension = $ext;
                $entrega->save();
                \Storage::disk('entrega')->put($entrega->id.".".$ext,  \File::get($archivo));
                $request->session()->put("mensaje","Entrega Guardada");
                DB::commit();
                return redirect("/proyecto?id=".$entrega->id_proyecto);
            } 
            catch (Exception $ex) {
                return redirect("/index");
            }
        }
        else{
            return redirect("/index");
        }
    }


    public function investigadorFormulario(Request $request,  Response $response) {
        $usuario = $request->session()->get('usuario');
        if($this->ComprobarUsuario($usuario)){
            if(true){
                $mensaje = $request->session()->get('mensaje');
                $request->session()->forget('mensaje');
                $tiposinvestigadores = TipoInvestigador::where("estado","N")->orderBy("nombre")->get();
                $escuelas = Escuela::join("facultad","facultad.id","=","escuela.id_facultad")
                                    ->select("escuela.*","facultad.nombre as nombrefacultad")
                                    ->orderBy("facultad.nombre")->orderBy("escuela.nombre")->get();
                $id = $request->input("id");
                $investigador = new Investigador();
                $modo = "nuevo";
                if(!empty($id)){
                    $investigador = Investigador::find($id);
                    $modo = "editar";
                }
                return view('/investigador-formulario',[
                    'usuario'=>$usuario,
                    'mensaje'=>$mensaje,
                    'tiposinvestigadores'=>$tiposinvestigadores,
                    'investigador'=>$investigador,
                    'escuelas'=>$escuelas,
                    'w'=>0,
                    'modo'=>$modo
                ]);
            }else{
                $request->session()->put("mensaje","NO TIENE ACCESO AL MENÚ");
                return redirect ("/inicio");
            }
        }else{
            return redirect("/index");
        }
    }
    
    public function investigadorFormularioPost(Request $request,  Response $response) {
        $usuario = $request->session()->get('usuario');
        if($this->ComprobarUsuario($usuario)){
            $id = $request->input("id");
            $modo = $request->input("modo");
            $nombres = $request->input("nombres");
            $paterno = $request->input("paterno");
            $materno = $request->input("materno");
            $grado = $request->input("grado");
            $correo = $request->input("correo");
            $telefono = $request->input("telefono");
            $tipo_investigador = $request->input("tipo_investigador");
            $escuela = $request->input("escuela");
            DB::beginTransaction();
            try{
                if($modo=="nuevo"){
                    $investigador = new Investigador();
                }else{
                    $investigador = Investigador::find($id);
                }
                $investigador->nombres = $nombres;
                $investigador->paterno = $paterno;
                $investigador->materno = $materno;
                $investigador->grado = $grado;
                $investigador->correo = $correo;
                $investigador->telefono = $telefono;
                $investigador->id_tipo_investigador = $tipo_investigador;
                $investigador->id_escuela = $escuela;
                $investigador->save();
                $request->session()->put("mensaje","Investigador Guardado");
                DB::commit();
                return redirect("/investigadores");
            } 
            catch (Exception $ex) {
                return redirect("/index");
            }
        }
        else{
            return redirect("/index");
        }
    }

    public function DescargarArchivo(Request $request,  Response $response) {
        $usuario = $request->session()->get('usuario');
        if($this->ComprobarUsuario($usuario)){
            $entrega = Entrega::find($request->input("id"));
            
            $storage_path = storage_path();
            $url = $storage_path.'/app/entrega/'.$entrega->id.'.'.$entrega->extension;
            //verificamos si el archivo existe y lo retornamos
            if (Storage::disk('entrega')->exists($entrega->id.'.'.$entrega->extension))
            {
              $nombre = 'acreditacion.'.$entrega->extension;
              return response()->download($url,$nombre);
            }
            //si no se encuentra lanzamos un error 404.
            abort(404);
        }else{
            return redirect("/index");
        }
    }

    public function proyectoSelgestiun(Request $request,  Response $response) {
        $usuario = $request->session()->get('usuario');
        if($this->ComprobarUsuario($usuario)){
            if(true){
                $mensaje = $request->session()->get('mensaje');
                $request->session()->forget('mensaje');
                
                $id = $request->input("id");
                $tramite = TramiteSelgestiun::find($id);
                $proyecto = ProyectoSelgestiun::join("tb_area as ta","tb_proyecto.tb_area_id","ta.tb_area_id")
                                            ->join("tb_linea as tl","tb_proyecto.tb_linea_id","tl.tb_linea_id")
                                            ->leftJoin("tb_sublinea as ts","tb_proyecto.tb_sublinea_id","ts.tb_sublinea_id")
                                            ->where("tb_tramite_id",$id)->first();
                $fases = FaseSelgestiun::join("tb_datosfase as df","df.tb_datosfase_numero","tb_fase.tb_fase_numero")
                            ->where("tb_tramite_id",$id)->get();

                $miembros1 = FuncionSelgestiun::
                join("tb_usuario as tu","tb_funcion.tb_usuario_id","tu.tb_usuario_id")
                ->where("tb_tramite_id",$id)->where("tb_funcion_nombre","AUTOR")->orderBy("tb_funcion_nombre")->get();
                $miembros2 = FuncionSelgestiun::
                join("tb_usuario as tu","tb_funcion.tb_usuario_id","tu.tb_usuario_id")
                ->where("tb_tramite_id",$id)->whereNotIn("tb_funcion_nombre",["AUTOR","JEFE DE CI","SECRETARIO DE CI"])->orderBy("tb_funcion_nombre")->get();


                return view('/proyecto-selgestiun',[
                    'usuario'=>$usuario,
                    'mensaje'=>$mensaje,
                    'tramite'=>$tramite,
                    'proyecto'=>$proyecto,
                    'fases'=>$fases,
                    'miembros1'=>$miembros1,
                    'miembros2'=>$miembros2
                ]);
            }else{
                $request->session()->put("mensaje","NO TIENE ACCESO AL MENÚ");
                return redirect ("/inicio");
            }
        }else{
            return redirect("/index");
        }
    }

    public function faseSelgestiun(Request $request,  Response $response) {
        $usuario = $request->session()->get('usuario');
        if($this->ComprobarUsuario($usuario)){
            if(true){
                $mensaje = $request->session()->get('mensaje');
                $request->session()->forget('mensaje');
                
                $id = $request->input("id");
                
                $fase = FaseSelgestiun::join("tb_datosfase as df","df.tb_datosfase_numero","tb_fase.tb_fase_numero")
                            ->where("tb_fase_id",$id)->first();

                $archivos = ArchivoSelgestiun::
                join("tb_fase_archivo as tfa","tfa.tb_archivo_id","tb_archivo.tb_archivo_id")
                ->where("tb_fase_id",$id)->get();

                return view('/fase-selgestiun',[
                    'usuario'=>$usuario,
                    'mensaje'=>$mensaje,
                    'fase'=>$fase,
                    'archivos'=>$archivos
                ]);
            }else{
                $request->session()->put("mensaje","NO TIENE ACCESO AL MENÚ");
                return redirect ("/inicio");
            }
        }else{
            return redirect("/index");
        }
    }
}
    
<?php

namespace App\Http\Controllers;

use Datetime;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Storage;
use App\Entrega;
use App\Escuela;
use App\Facultad;
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
                $investigadores = Investigador::where("estado","N")->orderBy("paterno")->orderBy("materno")->orderBy("nombres")->get();
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

    public function proyectoInvestigadores(Request $request,  Response $response) {
        $usuario = $request->session()->get('usuario');
        if($this->ComprobarUsuario($usuario)){
            if(true){
                $mensaje = $request->session()->get('mensaje');
                $request->session()->forget('mensaje');
                $id = $request->input("id");
                $investigadores = InvestigadorProyecto::
                                    select("investigador.*")
                                    ->where("investigador_proyecto.estado","N")->where("id_proyecto",$id)->orderBy("paterno")->orderBy("materno")->orderBy("nombres")->get();

                $proyecto = Proyecto::find($id);
                return view('/proyecto-investigadores',[
                    'usuario'=>$usuario,
                    'mensaje'=>$mensaje,
                    'proyecto'=>$proyecto,
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
                $investigadores = Investigador::
                                select("investigador.*")
                                ->join("escuela","investigador.id_escuela","escuela.id")
                                ->where("investigador.estado","N");
                if($usuario->id_facultad>0){
                    $investigadores = $investigadores->where("escuela.id_facultad",$usuario->id_facultad);
                }
                $investigadores = $investigadores->orderBy("paterno")->orderBy("materno")->orderBy("nombres")->get();

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
                $investigadores = Investigador::where("estado","N")->orderBy("paterno")->orderBy("materno")->orderBy("nombres")->get();
                $tiposproyectos = TipoProyecto::where("estado","N")->orderBy("nombre")->get();
                
                $proyectos = Proyecto::where("estado","N");
                $proyectos = $proyectos->orderBy("fecha","desc")->get();
                return view('/proyectos',[
                    'usuario'=>$usuario,
                    'mensaje'=>$mensaje,
                    'investigadores'=>$investigadores,
                    'tiposproyectos'=>$tiposproyectos,
                    'proyectos'=>$proyectos,
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
                $investigadores = Investigador::where("estado","N")->orderBy("paterno")->orderBy("materno")->orderBy("nombres")->get();
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
                    'investigadores'=>$investigadores,
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
            $tipo_grupo = $request->input("tipo_grupo");
            //$investigador = $request->input("investigador");
            $fecha = $request->input("fecha");
            $fecha2 = $request->input("fecha2");
            $linea = $request->input("linea");
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
                //     $proyecto->id_tipo_grupo = $tipo_grupo;
                // }
                if($linea>0){
                    $proyecto->id_linea = $linea;
                }else{
                    $proyecto->id_linea = null;
                }
                $proyecto->fecha = $fecha;
                $proyecto->fecha2 = $fecha2;
                $proyecto->save();
                $request->session()->put("mensaje","Proyecto Guardado");
                DB::commit();
                return redirect("/proyectos");
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
                $entrega->save();
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
}
    
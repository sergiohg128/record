<?php

namespace App\Http\Controllers;

use Datetime;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Storage;
use App\Escuela;
use App\Facultad;
use App\Grupo;
use App\Investigador;
use App\InvestigadorGrupo;
use App\InvestigadorGrupoProyecto;
use App\Linea;
use App\Programa;
use App\Proyecto;
use App\TipoGrupo;
use App\TipoInvestigador;
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

    public function grupos(Request $request,  Response $response) {
        $usuario = $request->session()->get('usuario');
        if($this->ComprobarUsuario($usuario)){
            if(true){
                $mensaje = $request->session()->get('mensaje');
                $request->session()->forget('mensaje');
                $grupos = Grupo::where("estado","N")->orderBy("nombre")->get();
                return view('/grupos',[
                    'usuario'=>$usuario,
                    'mensaje'=>$mensaje,
                    'grupos'=>$grupos,
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


    public function proyectos(Request $request,  Response $response) {
        $usuario = $request->session()->get('usuario');
        if($this->ComprobarUsuario($usuario)){
            if(true){
                $mensaje = $request->session()->get('mensaje');
                $request->session()->forget('mensaje');
                $grupos = Grupo::where("estado","N")->orderBy("nombre")->get();
                $investigadores = Investigador::where("estado","N")->orderBy("paterno")->orderBy("materno")->orderBy("nombres")->get();
                $tiposproyectos = TipoProyecto::where("estado","N")->orderBy("nombre")->get();
                
                $proyectos = Proyecto::where("estado","N");
                if(!empty($request->input("i"))){
                    $proyectos = $proyectos->where("id_investigador",$request->input("i"));
                }else if(!empty($request->input("g"))){
                    $proyectos = $proyectos->where("id_grupo",$request->input("g"));
                }
                $proyectos = $proyectos->orderBy("fecha","desc")->get();
                return view('/proyectos',[
                    'usuario'=>$usuario,
                    'mensaje'=>$mensaje,
                    'grupos'=>$grupos,
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

    public function proyectoFormulario(Request $request,  Response $response) {
        $usuario = $request->session()->get('usuario');
        if($this->ComprobarUsuario($usuario)){
            if(true){
                $mensaje = $request->session()->get('mensaje');
                $request->session()->forget('mensaje');
                $grupos = Grupo::where("estado","N")->orderBy("nombre")->get();
                $investigadores = Investigador::where("estado","N")->orderBy("paterno")->orderBy("materno")->orderBy("nombres")->get();
                $tiposproyectos = TipoProyecto::where("estado","N")->orderBy("nombre")->get();
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
                    'grupos'=>$grupos,
                    'investigadores'=>$investigadores,
                    'tiposproyectos'=>$tiposproyectos,
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
            $modalidad = $request->input("modalidad");
            $tipo_proyecto = $request->input("tipo_proyecto");
            $investigador = $request->input("investigador");
            $grupo = $request->input("grupo");
            $fecha = $request->input("fecha");
            $linea = $request->input("linea");
            DB::beginTransaction();
            try{
                if($modo=="nuevo"){
                    $proyecto = new Proyecto();
                }else{
                    $proyecto = Proyecto::find($id);
                }
                $proyecto->titulo = $titulo;
                $proyecto->modalidad = $modalidad;
                $proyecto->id_tipo_proyecto = $tipo_proyecto;
                if($modalidad=="I"){
                    $proyecto->id_investigador = $investigador;
                }else if($modalidad=="G"){
                    $proyecto->id_grupo = $grupo;
                }
                if($linea>0){
                    $proyecto->id_linea = $linea;
                }else{
                    $proyecto->id_linea = null;
                }
                $proyecto->fecha = $fecha;
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

    public function grupoFormulario(Request $request,  Response $response) {
        $usuario = $request->session()->get('usuario');
        if($this->ComprobarUsuario($usuario)){
            if(true){
                $mensaje = $request->session()->get('mensaje');
                $request->session()->forget('mensaje');
                $tiposgrupos = TipoGrupo::where("estado","N")->orderBy("nombre")->get();
                $id = $request->input("id");
                $grupo = new Grupo();
                $modo = "nuevo";
                if(!empty($id)){
                    $grupo = Grupo::find($id);
                    $modo = "editar";
                }
                return view('/grupo-formulario',[
                    'usuario'=>$usuario,
                    'mensaje'=>$mensaje,
                    'tiposgrupos'=>$tiposgrupos,
                    'grupo'=>$grupo,
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
    
    public function grupoFormularioPost(Request $request,  Response $response) {
        $usuario = $request->session()->get('usuario');
        if($this->ComprobarUsuario($usuario)){
            $id = $request->input("id");
            $modo = $request->input("modo");
            $nombre = $request->input("nombre");
            $tipo_grupo = $request->input("tipo_grupo");

            DB::beginTransaction();
            try{
                if($modo=="nuevo"){
                    $grupo = new Grupo();
                }else{
                    $grupo = Grupo::find($id);
                }
                $grupo->nombre = $nombre;
                $grupo->id_tipo_grupo = $tipo_grupo;
                $grupo->save();
                $request->session()->put("mensaje","Grupo Guardado");
                DB::commit();
                return redirect("/grupos");
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
    
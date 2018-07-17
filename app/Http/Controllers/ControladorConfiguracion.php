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
class ControladorConfiguracion extends Controller
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
    
    
    public function Usuarios(Request $request,  Response $response) {
        $usuario = $request->session()->get('usuario');
        if($this->ComprobarUsuario($usuario)){
            if(true){
                $mensaje = $request->session()->get('mensaje');
                $request->session()->forget('mensaje');
                $usuarios = Usuario::where("estado","N")->orderBy("paterno")->orderBy("materno")->orderBy("nombres")->get();
                return view('/usuarios',[
                    'usuario'=>$usuario,
                    'mensaje'=>$mensaje,
                    'usuarios'=>$usuarios,
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

    public function facultades(Request $request,  Response $response) {
        $usuario = $request->session()->get('usuario');
        if($this->ComprobarUsuario($usuario)){
            if(true){
                $mensaje = $request->session()->get('mensaje');
                $request->session()->forget('mensaje');
                $facultades = Facultad::where("estado","N")->orderBy("nombre")->get();
                return view('/facultades',[
                    'usuario'=>$usuario,
                    'mensaje'=>$mensaje,
                    'facultades'=>$facultades,
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

    public function facultadFormulario(Request $request,  Response $response) {
        $usuario = $request->session()->get('usuario');
        if($this->ComprobarUsuario($usuario)){
            if(true){
                $mensaje = $request->session()->get('mensaje');
                $request->session()->forget('mensaje');
                $id = $request->input("id");
                $facultad = new Facultad();
                $modo = "nuevo";
                if(!empty($id)){
                    $facultad = Facultad::find($id);
                    $modo = "editar";
                }
                return view('/facultad-formulario',[
                    'usuario'=>$usuario,
                    'mensaje'=>$mensaje,
                    'facultad'=>$facultad,
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
    
    public function facultadFormularioPost(Request $request,  Response $response) {
        $usuario = $request->session()->get('usuario');
        if($this->ComprobarUsuario($usuario)){
            $id = $request->input("id");
            $modo = $request->input("modo");
            $nombre = $request->input("nombre");

            DB::beginTransaction();
            try{
                if($modo=="nuevo"){
                    $facultad = new Facultad();
                }else{
                    $facultad = Facultad::find($id);
                }
                $facultad->nombre = $nombre;
                $facultad->save();
                $request->session()->put("mensaje","Facultad Guardado");
                DB::commit();
                return redirect("/facultades");
            } 
            catch (Exception $ex) {
                return redirect("/index");
            }
        }
        else{
            return redirect("/index");
        }
    }

    public function escuelas(Request $request,  Response $response) {
        $usuario = $request->session()->get('usuario');
        if($this->ComprobarUsuario($usuario)){
            if(true){
                $mensaje = $request->session()->get('mensaje');
                $request->session()->forget('mensaje');
                $facultad = Facultad::find($request->input("id"));
                $escuelas = Escuela::where("id_facultad",$facultad->id)->where("estado","N")->orderBy("nombre")->get();
                return view('/escuelas',[
                    'usuario'=>$usuario,
                    'mensaje'=>$mensaje,
                    'escuelas'=>$escuelas,
                    'facultad'=>$facultad,
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

    public function escuelaFormulario(Request $request,  Response $response) {
        $usuario = $request->session()->get('usuario');
        if($this->ComprobarUsuario($usuario)){
            if(true){
                $mensaje = $request->session()->get('mensaje');
                $request->session()->forget('mensaje');
                $id = $request->input("id");
                $facultad = $request->input("f");
                $escuela = new Escuela();
                if(!empty($id)){
                    $escuela = Escuela::find($id);
                    $modo = "editar";
                }else{
                    $escuela->id_facultad = $facultad;
                    $modo = "nuevo";
                }
                return view('/escuela-formulario',[
                    'usuario'=>$usuario,
                    'mensaje'=>$mensaje,
                    'escuela'=>$escuela,
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
    
    public function escuelaFormularioPost(Request $request,  Response $response) {
        $usuario = $request->session()->get('usuario');
        if($this->ComprobarUsuario($usuario)){
            $id = $request->input("id");
            $modo = $request->input("modo");
            $nombre = $request->input("nombre");
            $facultad = $request->input("facultad");
            DB::beginTransaction();
            try{
                if($modo=="nuevo"){
                    $escuela = new Escuela();
                    $escuela->id_facultad = $facultad;
                }else{
                    $escuela = Escuela::find($id);
                }
                $escuela->nombre = $nombre;
                $escuela->save();
                $request->session()->put("mensaje","Escuela Guardado");
                DB::commit();
                return redirect("/escuelas?id=".$escuela->id_facultad);
            } 
            catch (Exception $ex) {
                return redirect("/index");
            }
        }
        else{
            return redirect("/index");
        }
    }

    public function programas(Request $request,  Response $response) {
        $usuario = $request->session()->get('usuario');
        if($this->ComprobarUsuario($usuario)){
            if(true){
                $mensaje = $request->session()->get('mensaje');
                $request->session()->forget('mensaje');
                $escuela = Escuela::find($request->input("id"));
                $programas = Programa::where("id_escuela",$escuela->id)->where("estado","N")->orderBy("nombre")->get();
                return view('/programas',[
                    'usuario'=>$usuario,
                    'mensaje'=>$mensaje,
                    'programas'=>$programas,
                    'escuela'=>$escuela,
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

    public function programaFormulario(Request $request,  Response $response) {
        $usuario = $request->session()->get('usuario');
        if($this->ComprobarUsuario($usuario)){
            if(true){
                $mensaje = $request->session()->get('mensaje');
                $request->session()->forget('mensaje');
                $id = $request->input("id");
                $escuela = $request->input("e");
                $programa = new Programa();
                if(!empty($id)){
                    $programa = Programa::find($id);
                    $modo = "editar";
                }else{
                    $programa->id_escuela = $escuela;
                    $modo = "nuevo";
                }
                return view('/programa-formulario',[
                    'usuario'=>$usuario,
                    'mensaje'=>$mensaje,
                    'programa'=>$programa,
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
    
    public function programaFormularioPost(Request $request,  Response $response) {
        $usuario = $request->session()->get('usuario');
        if($this->ComprobarUsuario($usuario)){
            $id = $request->input("id");
            $modo = $request->input("modo");
            $nombre = $request->input("nombre");
            $escuela = $request->input("escuela");
            DB::beginTransaction();
            try{
                if($modo=="nuevo"){
                    $programa = new Programa();
                    $programa->id_escuela = $escuela;
                }else{
                    $programa = Programa::find($id);
                }
                $programa->nombre = $nombre;
                $programa->save();
                $request->session()->put("mensaje","Programa Guardado");
                DB::commit();
                return redirect("/programas?id=".$programa->id_escuela);
            } 
            catch (Exception $ex) {
                return redirect("/index");
            }
        }
        else{
            return redirect("/index");
        }
    }

    public function lineas(Request $request,  Response $response) {
        $usuario = $request->session()->get('usuario');
        if($this->ComprobarUsuario($usuario)){
            if(true){
                $programa = Programa::find($request->input("id"));
                $lineas = Linea::where("id_programa",$programa->id)->where("estado","N")->orderBy("nombre")->get();
                if($request->input("ajax")){
                    return json_encode(["ok"=>true,"obj"=>$lineas]);
                }else{
                    $mensaje = $request->session()->get('mensaje');
                    $request->session()->forget('mensaje');
                    return view('/lineas',[
                        'usuario'=>$usuario,
                        'mensaje'=>$mensaje,
                        'lineas'=>$lineas,
                        'programa'=>$programa,
                        'w'=>0
                    ]);
                }
            }else{
                $request->session()->put("mensaje","NO TIENE ACCESO AL MENÚ");
                return redirect ("/inicio");
            }
        }else{
            return redirect("/index");
        }
    }

    public function lineaFormulario(Request $request,  Response $response) {
        $usuario = $request->session()->get('usuario');
        if($this->ComprobarUsuario($usuario)){
            if(true){
                $mensaje = $request->session()->get('mensaje');
                $request->session()->forget('mensaje');
                $id = $request->input("id");
                $programa = $request->input("p");
                $linea = new Linea();
                if(!empty($id)){
                    $linea = Linea::find($id);
                    $modo = "editar";
                }else{
                    $linea->id_programa = $programa;
                    $modo = "nuevo";
                }
                return view('/linea-formulario',[
                    'usuario'=>$usuario,
                    'mensaje'=>$mensaje,
                    'linea'=>$linea,
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
    
    public function lineaFormularioPost(Request $request,  Response $response) {
        $usuario = $request->session()->get('usuario');
        if($this->ComprobarUsuario($usuario)){
            $id = $request->input("id");
            $modo = $request->input("modo");
            $nombre = $request->input("nombre");
            $programa = $request->input("programa");
            DB::beginTransaction();
            try{
                if($modo=="nuevo"){
                    $linea = new Linea();
                    $linea->id_programa = $programa;
                }else{
                    $linea = Linea::find($id);
                }
                $linea->nombre = $nombre;
                $linea->save();
                $request->session()->put("mensaje","linea Guardado");
                DB::commit();
                return redirect("/lineas?id=".$linea->id_programa);
            } 
            catch (Exception $ex) {
                return redirect("/index");
            }
        }
        else{
            return redirect("/index");
        }
    }

    public function tiposProyectos(Request $request,  Response $response) {
        $usuario = $request->session()->get('usuario');
        if($this->ComprobarUsuario($usuario)){
            if(true){
                $mensaje = $request->session()->get('mensaje');
                $request->session()->forget('mensaje');
                $tipos = TipoProyecto::where("estado","N")->orderBy("nombre")->get();
                return view('/tipos-proyectos',[
                    'usuario'=>$usuario,
                    'mensaje'=>$mensaje,
                    'tipos'=>$tipos,
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

    public function tiposInvestigadores(Request $request,  Response $response) {
        $usuario = $request->session()->get('usuario');
        if($this->ComprobarUsuario($usuario)){
            if(true){
                $mensaje = $request->session()->get('mensaje');
                $request->session()->forget('mensaje');
                $tipos = TipoInvestigador::where("estado","N")->orderBy("nombre")->get();
                return view('/tipos-investigadores',[
                    'usuario'=>$usuario,
                    'mensaje'=>$mensaje,
                    'tipos'=>$tipos,
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

    public function tiposGrupos(Request $request,  Response $response) {
        $usuario = $request->session()->get('usuario');
        if($this->ComprobarUsuario($usuario)){
            if(true){
                $mensaje = $request->session()->get('mensaje');
                $request->session()->forget('mensaje');
                $tipos = TipoGrupo::where("estado","N")->orderBy("nombre")->get();
                return view('/tipos-grupos',[
                    'usuario'=>$usuario,
                    'mensaje'=>$mensaje,
                    'tipos'=>$tipos,
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
    
    public function UsuarioPost(Request $request,  Response $response) {
        $usuario = $request->session()->get('usuario');
        if($this->ComprobarUsuario($usuario)){
            $modo = $request->input("modo");
            DB::beginTransaction();
            try{
                if($modo=="agregar"){
                    $cuenta = $request->input("cuenta");
                    $anterior = Usuario::where("cuenta",$cuenta)->first();
                    if(empty($anterior)){
                        $obj = new Usuario();
                        $obj->id_tipo = $request->input("tipo");
                        $nombre = $request->input("nombre");
                        $obj->nombre = $nombre;
                        $paterno =$request->input("paterno");
                        $obj->paterno = $paterno;
                        $materno =$request->input("materno");
                        $obj->materno = $materno;
                        $obj->cuenta = $cuenta;
                        $obj->id_empresa = $usuario->id_empresa;
                        $obj->pass = "123";
                        $obj->save();
                    }else{
                        DB::rollback();
                        return json_encode(["ok"=>false,"error"=>"La cuenta ya existe, ingrese otra"]);
                    }
                }else if($modo=="pass"){
                    $pass = $request->input("pass");
                    $pass2 = $request->input("pass2");
                    $pass3 = $request->input("pass3");
                    if($usuario->pass==$pass){
                        if($pass2==$pass3){
                            $obj = Usuario::find($usuario->id);
                            $obj->pass = $pass2;
                            $usuario->pass = $pass2;
                            $obj->save();
                            DB::commit();
                            $request->session()->put("usuario",$usuario);
                            $request->session()->put("mensaje","CONTRASEÑA CAMBIADA");
                        }else{
                            $request->session()->put("mensaje","LAS CONTRASEÑAS NUEVAS NO COINCIDEN");
                        }
                    }else{
                        $request->session()->put("mensaje","CONTRASEÑA ACTUAL INCORRECTA");
                    }
                    return redirect("/pass");
                }else{
                    $id = $request->input("id");
                    $obj = Usuario::find($id);
                    if($modo=="editar"){
                        $obj->id_tipo = $request->input("tipo");
                    }else if($modo=="eliminar"){
                        $obj->estado = "A";
                    }else if($modo=="restablecer"){
                        $obj->pass = "123";
                    }
                    $obj->save();
                }
                DB::commit();
                return json_encode(["ok"=>true,"obj"=>$obj]);
            } 
            catch (Exception $ex) {
                DB::rollback();
                $error=$exc->getMessage();
                return json_encode(["ok"=>false,"error"=>$error]);
            }
        }
        else{
            return json_encode(["ok"=>false,"url"=>"index"]);
        }
    }
    
    public function Pass(Request $request,  Response $response) {
        $usuario = $request->session()->get('usuario');
        if($this->ComprobarUsuario($usuario)){
            $mensaje = $request->session()->get('mensaje');
            $request->session()->forget('mensaje');
            return view('/pass',[
                'usuario'=>$usuario,
                'mensaje'=>$mensaje,
                'w'=>0
            ]);
        }else{
            return redirect("/index");
        }
    }
}
    
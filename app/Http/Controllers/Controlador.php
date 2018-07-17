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

class Controlador extends Controller
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
    
    
    public function Index(Request $request,  Response $response) {
        $usuario = $request->session()->get('usuario');
        $mensaje = $request->session()->get('mensaje');
        $request->session()->forget('mensaje');
        if(!empty($usuario)){
            return redirect("/inicio");
        }else{
            return view('index',[
                'empresa'=>null,
                'mensaje'=>$mensaje
            ]);
        }
    }
    
    public function Login(Request $request,  Response $response) {
        $user = $request->input('user');
        $pass = $request->input('pass');
        $usuario = Usuario::where('cuenta',$user)->first();
        if(!empty($usuario)){
            if($usuario->estado=="N"){
                if($usuario->password==$pass){
                    $request->session()->put('usuario', $usuario);
                    return redirect("/inicio");
                }else{
                    $request->session()->put('mensaje', "CONTRASEÑA INCORRECTA");
                    return redirect("/index");
                }
            }else{
                $request->session()->put('mensaje', "EL USUARIO HA SIDO ELIMINADO");
                return redirect("/index");
            }
        }else{
            $request->session()->put('mensaje', "EL USUARIO NO EXISTE");
            return redirect("/index");
        }   
    }
    
    public function Logout(Request $request,  Response $response) {
        $request->session()->invalidate();
        return redirect("/index");
    }
    
    
    public function Inicio(Request $request,  Response $response) {
        $usuario = $request->session()->get('usuario');
        if($this->ComprobarUsuario($usuario)){
            $empresa = $request->session()->get("empresa");
            $mensaje = $request->session()->get('mensaje');
            $request->session()->forget('mensaje');
            return view('/inicio',[
                'mensaje'=>$mensaje,
                'usuario'=>$usuario,
                'empresa'=>$empresa
            ]);
        }else{
            return redirect("/index");
            
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
    
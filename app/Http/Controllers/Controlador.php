<?php

namespace App\Http\Controllers;

use Datetime;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Storage;
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

    public function PassPost(Request $request,  Response $response) {
        
        $pass = $request->input('pass');
        $pass2 = $request->input('pass2');
        $pass3 = $request->input('pass3');

        $usuario = $request->session()->get('usuario');
        if($pass==$usuario->password){
            if($pass2==$pass3){
                $usuario2 = Usuario::where('cuenta',$usuario->cuenta)->first();
                $usuario2->password = $pass2;
                $usuario2->save();
                $request->session()->put('mensaje', "CONTASEÑA CAMBIADA CORRECTAMENTE");
                $usuario = $request->session()->put('usuario',$usuario2);
                return redirect("/index");
            }else{
                $request->session()->put('mensaje', "LA NUEVA CONTASEÑA NO ES IGUAL A LA CONFIRMACIÓN");
                return redirect("/pass");
            }
        }else{
            $request->session()->put('mensaje', "LA CONTRASEÑA ACTUAL ES INCORRECTA");
            return redirect("/pass");
        }
    }

    public function RestablecerUsuario(Request $request,  Response $response) {
        
        $id = $request->input('id');
        $usuario = Usuario::find($id);
        $usuario->password = "123";
        $usuario->save();
        $request->session()->put('mensaje', "LA CONTRASEÑA HA SIDO RESTABLECIDA");
        return redirect("/usuarios");
    }
    
}
    
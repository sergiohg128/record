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
use App\UsuarioSelgestiun;
use App\ProyectoSelgestiun;
use App\TramiteSelgestiun;
use App\FaseSelgestiun;
use App\FuncionSelgestiun;
use App\ArchivoSelgestiun;


use PDF;
use Dompdf\Dompdf;
use Dompdf\Options;

class ControladorReportes extends Controller
{
    
    public function __construct(){

      $this->estiloshtml = '<style>
            
                *{
                    margin: 0;
                    padding: 0;
                    font-height: 10px;
                    margin-top: 5px;
                }
                
                body {
                    display: block;
                    width: 90%;
                    margin: auto;
                    margin-top: 40px;
                    margin-bottom: 40px;
                    position: relative;
                }

                table {
                    width: 100%;
                  border-collapse: collapse;
                }

                table,tr,td,th{
                    border: 1px solid black;
                    text-align: center;
                }

                th{
                    font-weight: bold;
                    text-transform: uppercase;
                }

                .centro{
                        text-align: center;
                }

                .izquierda{
                        text-align: left !important;
                }

                .derecha{
                        text-align: right;
                }

                .metas{
                    font-size : 0.9em;
                }

                ul{
                    margin-left: 15px;
                }

                </style>';
        
        $this->cabecerahtml = '
                     <div class="centro"><h2>REPORTE DE PROYECTOS</h2></div>
                     <br>';


        $this->head = '<!DOCTYPE html><html>'.$this->estiloshtml.'<body>'.$this->cabecerahtml;
    }

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
    
    
    public function reportes(Request $request,  Response $response) {
        $usuario = $request->session()->get('usuario');
        if($this->ComprobarUsuario($usuario)){
            if(true){
                $mensaje = $request->session()->get('mensaje');
                $request->session()->forget('mensaje');
                $facultades = FacultadSelgestiun::orderBy("tb_facultad_nombre")->get();
                $escuelas = EscuelaSelgestiun::orderBy("tb_escuela_nombre")->get();            //$investigadores = Investigador::where("estado","N")->orderBy("paterno")->orderBy("materno")->orderBy("nombres")->get();
                //$grupos = Grupo::where("estado","N")->orderBy("nombre")->get();
                $investigadores = UsuarioSelgestiun::select("tb_usuario.*")
                                                    ->join("tb_permiso as tp","tp.tb_usuario_id","tb_usuario.tb_usuario_id")
                                                    ->whereIn("tb_permiso_cargo",["ALUMNO","DOCENTE"])
                                                    ->where("tb_permiso_estado","ACTIVO")
                                                    ->orderBy("tb_usuario_apellidopaterno")
                                                    ->orderBy("tb_usuario_apellidomaterno")
                                                    ->orderBy("tb_usuario_nombre")
                                                    ->get();
                $hoy = date('Y-m-d');
                $desde = date('Y');
                return view('/reportes',[
                    'usuario'=>$usuario,
                    'mensaje'=>$mensaje,
                    'facultades'=>$facultades,
                    'escuelas'=>$escuelas,
                    'investigadores'=>$investigadores,
                    //'grupos'=>$grupos,
                    'desde'=>$desde,
                    'hoy'=>$hoy,
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

    public function reporte(Request $request){
        $tipo = $request->input("tipo");
        $valor = $request->input("valor");
        $desde = $request->input("desde");
        $hasta = $request->input("hasta");

        $proyectos = Proyecto::
                        select("proyecto.id","proyecto.titulo","proyecto.id_tipo_proyecto","proyecto.id_linea","proyecto.fecha")
                        ->distinct()
                        ->leftjoin("investigador_proyecto","proyecto.id","investigador_proyecto.id_proyecto")
                        ->where("proyecto.estado","N");
        if(!empty($desde)){
            $proyectos = $proyectos->where("fecha",">=",$desde);
        }
        if(!empty($hasta)){
            $proyectos = $proyectos->where("fecha","<=",$hasta);
        }
        switch ($tipo) {
            case 1:
                
                break;
            case 2:
                $proyectos = $proyectos->where("investigador_proyecto.id_facultad",$request->input("facultad"));
                break;
            case 3:
                $proyectos = $proyectos->where("investigador_proyecto.id_escuela",$request->input("escuela"));
                break;
            case 4:
                $proyectos = $proyectos->where("investigador_proyecto.id_investigador",$request->input("investigador"));
                break;
            case 5:
                $proyectos = $proyectos->where("proyecto.id_grupo",$request->input("grupo"));
                break;
            case 6:
                $proyectos = $proyectos->where("linea.id_programa",$request->input("programa"));
                break;
            case 7:
                $proyectos = $proyectos->where("linea.id",$request->input("linea"));
                break;
        }
        $proyectos = $proyectos->orderBy("fecha")->get();

        

        $dompdf = new Dompdf();
        $dompdf->setPaper('A4','landscape');
        $html = $this->head;

        $html = $html.
                    '<table class="tablacuerpo">
                        <tr>
                            <th>N°</th>
                            <th>Titulo</th>
                            <th>Responsable</th>
                            <th>Tipo</th>
                            <th>Fecha</th>
                        </tr>';
        $cont = 0;

        foreach($proyectos as $proyecto){
            $cont++;
            $html = $html.
                        '<tr>
                            <td>'.$cont.'</td>
                            <td>'.$proyecto->titulo.'</td>
                            <td>'.$proyecto->responsable().'</td>
                            <td>'.$proyecto->tipo()->nombre.'</td>
                            <td>'.date('d/m/Y',strtotime($proyecto->fecha)).'</td>
                        </tr>';
        }

        $html = $html . '</table>';


        //SELGESTIUN
        if($tipo>0){
            $proyectos2 = ProyectoSelgestiun::
                select("tb_proyecto.*")->distinct()->
                join("tb_escuela","tb_proyecto.tb_escuela_id","tb_escuela.tb_escuela_id")
                ->join("tb_tramite","tb_proyecto.tb_tramite_id","tb_tramite.tb_tramite_id");
            if($tipo==4){
                $proyectos2 = $proyectos2->join("tb_funcion as tf","tf.tb_tramite_id","tb_tramite.tb_tramite_id");
            }
            $proyectos2 = $proyectos2->join("tb_fase","tb_tramite.tb_tramite_id","tb_fase.tb_tramite_id");


            if(!empty($desde)){
                $proyectos2 = $proyectos2->where("tb_fase_numero",1)->where("tb_fase_fecha",">=",$desde);
            }
            if(!empty($hasta)){
                $proyectos2 = $proyectos2->where("tb_fase_numero",1)->where("tb_fase_fecha","<=",$hasta);
            }
            if($tipo==1){
                
            }
            if($tipo==2){
                $proyectos2 = $proyectos2->where("tb_escuela.tb_facultad_id",$request->input("facultad"));
            }
            if($tipo==3){
                $proyectos2 = $proyectos2->where("tb_escuela.tb_escuela_id",$request->input("escuela"));
            }
            if($tipo==4){
                $proyectos2 = $proyectos2->where("tf.tb_usuario_id",$request->input("investigador"));
            }
                                            //->where("tf.tb_tramite_id","tb_tramite.tb_tramite_id")
            $proyectos2 = $proyectos2->where("tb_tramite_estado","<>",14)
                                            ->get();


            $html = $html . '<div class="centro"><h2>SELGESTIUN</h2></div>
                     <br>';

            $html = $html.
                    '<table class="tablacuerpo">
                        <tr>
                            <th>N°</th>
                            <th>Titulo</th>';
            if($tipo==1){
                $html = $html . '<th>Facultad</th>';
            }
            if($tipo==4){
                $html = $html . '<th>Cargo</th>';
            }
            $html = $html.
                    '<th>Estado</th>
                        </tr>';

            foreach($proyectos2 as $proyecto){
                $estado = "PENDIENTE";
                if($proyecto->tb_tramite_estado == 13 || $proyecto->tb_tramite_estado == 24){
                    $estado = "FINALIZADO";
                }
                $cont++;
                $html = $html.
                            '<tr>
                                <td>'.$cont.'</td>
                                <td>'.$proyecto->tb_proyecto_titulo.'</td>';
                if($tipo==1){
                    $html = $html . '<td>'.$proyecto->tb_escuela_nombre.'</td>';
                }
                if($tipo==4){
                    $html = $html . '<td>'.$proyecto->tb_funcion_nombre.'</td>';
                }
                $html = $html.'<td>'.$estado.'</td>
                            </tr>';
            }
            $html = $html . '</table>';
        }


        $html = $html .'</body></html>';


        $dompdf->loadHtml($html, 'UTF-8');
        $dompdf->render();
        $dompdf->stream('reporte.pdf',array('Attachment'=>0));
    }
}
    
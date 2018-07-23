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
                $facultades = Facultad::where("estado","N")->orderBy("nombre")->get();
                $escuelas = Escuela::where("estado","N")->orderBy("nombre")->get();
                $programas = Programa::where("estado","N")->orderBy("nombre")->get();
                $lineas = Linea::where("estado","N")->orderBy("nombre")->get();
                $investigadores = Investigador::where("estado","N")->orderBy("paterno")->orderBy("materno")->orderBy("nombres")->get();
                $grupos = Grupo::where("estado","N")->orderBy("nombre")->get();

                $hoy = date('Y-m-d');
                $desde = date('Y');
                return view('/reportes',[
                    'usuario'=>$usuario,
                    'mensaje'=>$mensaje,
                    'facultades'=>$facultades,
                    'escuelas'=>$escuelas,
                    'programas'=>$programas,
                    'lineas'=>$lineas,
                    'investigadores'=>$investigadores,
                    'grupos'=>$grupos,
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
                        leftjoin("investigador","proyecto.id_investigador","investigador.id")
                        ->leftjoin("escuela","investigador.id_escuela","escuela.id")
                        ->join("linea","proyecto.id_linea","linea.id")
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
                $proyectos = $proyectos->where("escuela.id_facultad",$request->input("facultad"));
                break;
            case 3:
                $proyectos = $proyectos->where("escuela.id",$request->input("escuela"));
                break;
            case 4:
                $proyectos = $proyectos->where("investigador.id",$request->input("investigador"));
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
        // switch($tipo){
        //     case 1:
        //         $html = $html .'<div class="centro"><h4>REPORTE POR FECHAS ENTRE</h4></div>
        //                      <br>';
        //         break;
        // }
        $html = $html.
                    '<table class="tablacuerpo">
                        <tr>
                            <th>N°</th>
                            <th>Titulo</th>
                            <th>Responsable</th>
                            <th>Tipo</th>
                            <th>Linea</th>
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
                            <td>'.$proyecto->linea()->nombre.'</td>
                            <td>'.date('d/m/Y',strtotime($proyecto->fecha)).'</td>
                        </tr>';
        }

        $html = $html . '</table></body></html>';

        $dompdf->loadHtml($html, 'UTF-8');
        $dompdf->render();
        $dompdf->stream('reporte.pdf',array('Attachment'=>0));
    }
}
    
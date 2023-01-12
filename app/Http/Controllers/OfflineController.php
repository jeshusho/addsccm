<?php

namespace App\Http\Controllers;

use App\Models\utpOfflineDevice;
use Illuminate\Http\Request;

class OfflineController extends Controller
{
    protected $apikey;

    public function __construct()
    {
        $this->apikey = env('APIKEY');
    }

    public function incoming(Request $request, $rqapikey)
    {
        if($rqapikey === $this->apikey){
            $registros =  json_decode(json_encode($request->all()));
            //$registros =  $request->all();
            //return $registros;
            foreach($registros as $r){
                if($r->Inventario !== 'NO APLICA' &&  $r->Inventario !== 'SIN ETIQUETA' && $r->Inventario !=='' && !is_null($r->Inventario))
                {
                    $data = [
                        'Equipo' => $r->Equipo,
                        'TipoEquipo' => $r->TipoEquipo,
                        'SistemaOperativo' => $r->SistemaOperativo,
                        'Marca' => $r->Marca,
                        'Modelo' => $r->Modelo,
                        'Inventario' => $r->Inventario,
                        'Serie' => $r->Serie,
                        'Unidad' => $r->Unidad,
                        'Obsolescencia' => $r->Obsolescencia,
                        'Procesador' => $r->Procesador,
                        'Generacion' => $r->Generacion,
                        'Memoria' => $r->Memoria,
                        'Discos' => $r->Discos,
                        'Usuario' => $r->Usuario,
                        'Provincia' => $r->Provincia,
                        'Zona' => $r->Zona,
                        'TipoAmbiente' => $r->TipoAmbiente,
                        'NombreAmbiente' => $r->NombreAmbiente,
                        'Pabellon' => $r->Pabellon,
                        'DireccionSede' => $r->DireccionSede,
                        'NroPiso' => $r->NroPiso,
                        'Propietario' => $r->Propietario,
                        'Estado' => $r->Estado,
                        'Anexo' => $r->Anexo,
                        'Responsable' => $r->Responsable,
                        'FechaRobo' => $r->FechaRobo,
                        'FechaInicioLeasing' => $r->FechaInicioLeasing,
                        'FechaFinLeasing' => $r->FechaFinLeasing,
                    ];
        
                    $reg = utpOfflineDevice::where('inventario',$r->Inventario)->first();
                    if(!$reg){
                        utpOfflineDevice::create($data);
                        return [
                            'result' => 'Datos creados de activo ' . $r->Inventario,
                        ];
                    }
                    else{
                        utpOfflineDevice::where('id',$reg->id)->update($data);
                        return [
                            'result' => 'Datos actualizados de activo ' . $r->Inventario,
                        ];
                    }
                }
                else{
                    return [
                        'result' => 'Activo con inventario \'' . $r->Inventario . '\' no se puede guardar',
                    ];
                }
            }
        }
        else{
            return [
                "error" => 'api_key incorrecto o no enviado'
            ];
        }
    }

    public function deleting(Request $request, $rqapikey)
    {
        if($rqapikey === $this->apikey){
            $registros =  json_decode(json_encode($request->all()));
            foreach($registros as $r){
                $reg = utpOfflineDevice::where('inventario',$r->Inventario)->first();
                if(!is_null($reg)){
                    utpOfflineDevice::where('inventario',$r->Inventario)->delete();
                    return [
                        'result' => 'Datos eliminados de activo ' . $r->Inventario,
                    ];
                }
                else{
                    return [
                        'result' => 'Datos no encontrados del activo ' . $r->Inventario,
                    ];
                }
            }
        }
        else{
            return [
                "error" => 'api_key incorrecto o no enviado'
            ];
        }
    }
}

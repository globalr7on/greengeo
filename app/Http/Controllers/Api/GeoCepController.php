<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use App\Events\SendPosition;

class GeoCepController extends Controller
{
  /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $cep = $request->get("cep");
        $numero = $request->get("numero");
        $api = "https://cep.awesomeapi.com.br/json/{$cep}";
        $http = Http::get($api);
        $json = $http->object();

        if (!$http->ok()) {
            return response([
                'data' => $json->message,
                'status' => false
            ], 400);
        }

        $address = urlencode($json->address);
        $district = urlencode($json->district);
        $state = urlencode($json->state);
        $api = "https://maps.google.com/maps/api/geocode/json?address={$address}+{$numero}+{$district}+{$state}&key=AIzaSyBft2z2KNOr72oPM4SUnRHyLSH_d_HrOek";
        $http = Http::get($api);
        $json = $http->object();

        if (!$http->ok()) {
            return response([
                'data' => $json->error_message,
                'status' => false
            ], 400);
        }

        if (count($json->results) < 1) {
            return response([
                'data' => 'Sem resultados',
                'status' => false
            ], 400);
        }

        $endereco = $bairro = $cidade = $estado = null;

        foreach ($json->results[0]->address_components as $addressComponent) {
            if (in_array("route", $addressComponent->types)) {
                $endereco = $addressComponent->long_name;
            }
            if (in_array("sublocality", $addressComponent->types) || in_array("sublocality_level_1", $addressComponent->types)) {
                $bairro = $addressComponent->long_name;
            }
            
            if (in_array("administrative_area_level_2", $addressComponent->types)) {
                $cidade = $addressComponent->long_name;
            }
            
            if (in_array("administrative_area_level_1", $addressComponent->types)) {
                $estado = $addressComponent->short_name;
            }
        }

        $response = array(
            "endereco" => $endereco,
            "bairro" => $bairro,
            "cidade" => $cidade,
            "estado" => $estado,
            "coord" => array(
                "lat" => substr($json->results[0]->geometry->location->lat, 0, 10),
                "lng" => substr($json->results[0]->geometry->location->lng, 0, 10),
            )
        );

        return response([
            'data' => $response,
            'status' => true
        ], 200);
    }  

    // public function criarGeo(Request $request){
    //     $lat = $request->input('lat');
    //     $long = $request->input('long');
    //     $location = ["lat" => $lat, "long" => $long];
    //     event(new SendPosition($location));
    //     // $rastreamento = ::create($lat);
        
    //     return response()->json(['status' => 'success', 'data' => $location]);
    // }  

    // public function ReceiveGeo($location){
    //     dd($location);
    // }
}
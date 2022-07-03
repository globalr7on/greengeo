<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

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
        $json = null;

        $curl = curl_init();
        curl_setopt($curl, CURLOPT_URL, $api);
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, True);
        $json = json_decode(curl_exec($curl));

        if (isset($json->status) && $json->status >= 400) {
            return response([
                'data' => $json->message,
                'status' => false
            ], 400);
        }

        $address = urlencode($json->address);
        $district = urlencode($json->district);
        $state = urlencode($json->state);
        $api = "https://maps.google.com/maps/api/geocode/json?address={$address}+{$numero}+{$district}+{$state}&key=AIzaSyBft2z2KNOr72oPM4SUnRHyLSH_d_HrOek";
        curl_setopt($curl, CURLOPT_URL, $api);
        $json = json_decode(curl_exec($curl));
        curl_close($curl);

        if ($json->status != 'OK') {
            return response([
                'data' => $json->error_message,
                'status' => false
            ], 400);
        }

        if (count($json->results) < 1) {
            return response([
                'data' => $json,
                'status' => false
            ], 400);
        }

        $endereco = null;
        $bairro = null;
        $cidade = null;
        $estado = null;

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
                "lat" => $json->results[0]->geometry->location->lat,
                "lng" => $json->results[0]->geometry->location->lng,
            )
        );

        return response([
            'data' => $response,
            'status' => true
        ], 200);
    }  
}
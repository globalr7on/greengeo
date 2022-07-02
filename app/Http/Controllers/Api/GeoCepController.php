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

        $address_type = urlencode($json->address_type);
        $address_name = urlencode($json->address_name);
        $district = urlencode($json->district);
        $state = urlencode($json->state);
        $api = "https://maps.google.com/maps/api/geocode/json?address={$address_type}+{$address_name}+{$numero}+{$district}+{$state}&key=AIzaSyBft2z2KNOr72oPM4SUnRHyLSH_d_HrOek";
        curl_setopt($curl, CURLOPT_URL, $api);
        $json = json_decode(curl_exec($curl));
        curl_close($curl);

        if ($json->status != 'OK') {
            $json->error_message;
            return response([
                'data' => $json->error_message,
                'status' => false
            ], 400);
        }

        $response = array(
            "address" => $json->results[0]->formatted_address,
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
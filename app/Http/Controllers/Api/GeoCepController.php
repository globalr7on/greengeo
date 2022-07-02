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
        $curl = curl_init($api);
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, True);
        $return = curl_exec($curl);
        curl_close($curl);

        $json = json_decode($return); 
        $address_type = urlencode($json->address_type);
        $address_name = urlencode($json->address_name);
        $district = urlencode($json->district);
        $state = urlencode($json->state);

        $api = "https://maps.google.com/maps/api/geocode/json?address={$address_type}+{$address_name}+{$numero}+{$district}+{$state}&key=AIzaSyBft2z2KNOr72oPM4SUnRHyLSH_d_HrOek";
        
        $curl = curl_init($api);
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, True);
        $return = curl_exec($curl);
        curl_close($curl);
        $json = json_decode($return);

        
        return $json;
    }

   
}

    

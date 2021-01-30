<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class FlightsController extends Controller
{
    function getFlights($number=null){
        $ch = curl_init();

        $key = config('services.access_key');
        $headers = array(
            'Content-Type: application/json',
        );
        // set url
        if(!$number){
            curl_setopt($ch, CURLOPT_URL, "http://api.aviationstack.com/v1/flights?access_key=" . $key);
        } else {
            curl_setopt($ch, CURLOPT_URL, "http://api.aviationstack.com/v1/flights?access_key=" . $key . "&flight_number=" . $number);
        }

        curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);

        //return the transfer as a string
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);

        // $output contains the output string
        $output = curl_exec($ch);

        // close curl resource to free up system resources
        curl_close($ch);

        return $output = json_decode($output);
    }

    public function flights(Request $request){
        $flights = $this->getflights($request->flight_number);

        return response(['status' => true, 'data' => $flights], 200);
    }
}

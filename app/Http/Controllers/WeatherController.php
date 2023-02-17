<?php

namespace App\Http\Controllers;

use SimpleXMLElement;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Response;

class WeatherController extends Controller
{
    /**
     * Get weather from the Openmapweather API.
     */
    public function getWeather(string $city)
    {
        $response = Http::get('api.openweathermap.org/data/2.5/weather?q=' . $city . '&APPID=' . env('ONEWEATHERWAPP_API_KEY'));

        $xml = new SimpleXMLElement('<?xml version="1.0" encoding="UTF-8"?><root></root>');

        function arraytoXML($data, &$xml)
        {
            foreach ($data as $key => $value) {
                if (is_int($key)) {
                    $key = 'element' . $key;
                }
                if (is_array($value)) {
                    $label = $xml->addChild($key);
                    arrayToXml($value, $label);
                } else {
                    $xml->addChild($key, $value);
                }
            }
        }

        if ($response->status() == 200) {
            $data = $response->json();
            arraytoXML($data, $xml);

            return Response::make($xml->asXML(), 200, ['Content-Type' => 'application/xml']);
            
        } else {
            $data = $response->json();
            arraytoXML($data, $xml);

            return Response::make($xml->asXML(), 200, ['Content-Type' => 'application/xml']);
        }
    }
}

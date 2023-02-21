<?php

namespace App\Http\Controllers;

use Exception;
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
    public function getWeather($city)
    {
        try {
            $response = Http::post('api.openweathermap.org/data/2.5/weather?q=' . $city . '&APPID=' . env('ONEWEATHERWAPP_API_KEY') . '&units=metric');

            $data = $response->json();

            $xml = new SimpleXMLElement('<?xml version="1.0" encoding="UTF-8"?><root></root>');

            $xml = $this->arrayToXML($data, $xml);

            return Response::make($xml->asXML(), 200, ['Content-Type' => 'application/xml']);
        } catch (Exception $e) {
            return ('Error connecting to API.');
        }
    }
    /**
     * Converts an Array to XML
     */
    public function arrayToXML($data, $xml)
    {
        foreach ($data as $key => $value) {
            if (is_int($key)) {
                $key = 'element' . $key;
            }
            if (is_array($value)) {
                $label = $xml->addChild($key);
                $this->arrayToXml($value, $label);
            } else {
                $xml->addChild($key, $value);
            }
        }
        return $xml;
    }
}

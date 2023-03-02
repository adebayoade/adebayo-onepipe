<?php

namespace App\Http\Controllers;

use Exception;
use SimpleXMLElement;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Response;

class WeatherController extends Controller
{
    /**
     * Returns the home view file.
     */
    public function index(Request $request)
    {
        $data = $this->getWeather($request);
        return view('home')->with('data', $data);
    }
    /**
     * handles the city input form
     */
    public function submitCity(Request $request)
    {
        $data = $this->getWeather($request);
        return view('home')->with('data', $data);
    }
    /**
     * Get weather from the Openmapweather API.
     * using the route parameter
     * returns an XML
     */
    public function getWeatherAPI($city)
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
    public function arrayToXML($data, SimpleXMLElement $xml)
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
    /**
     * Get weather from the Openmapweather API
     * returns weather details array
     */
    public function getWeather(Request $request)
    {
        $city = $request->query('city', 'lagos');

        try {
            $response = Http::withHeaders([
                'method' => 'GET',
                'parameter' => [
                    'units' => 'metrics',
                ]
            ])->post('http://api.openweathermap.org/data/2.5/weather?q=' . $city . '&APPID=' . env('ONEWEATHERWAPP_API_KEY') . '&units=metric');

            $data = $response->json();
            // dd($data);
            return $data;
        } catch (Exception $e) {
            return "Error connecting to API";
        }
    }
}

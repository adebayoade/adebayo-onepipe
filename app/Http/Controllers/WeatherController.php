<?php

namespace App\Http\Controllers;

use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Http;

class WeatherController extends Controller
{
    /**
     * Get weather from the Openmapweather API.
     */
    public function getWeather(string $city)
    {
        $response = Http::get('api.openweathermap.org/data/2.5/weather?q=' . $city . '&APPID=' .env('ONEWEATHERWAPP_API_KEY') . '&mode=xml');

        if ($response->ok()) {
            $data = $response;

            return response($data, 200)->header('Content-Type', 'application/xml');
        }

        $data = response()->json(['status' => false, 'message' => 'Unable to find city.']);

        return $data;
    }
}

<?php

namespace App\Http\Controllers;

use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Http;

class WeatherController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(): Response
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(): Response
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request): RedirectResponse
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id): Response
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id): Response
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id): RedirectResponse
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id): RedirectResponse
    {
        //
    }

    /**
     * Get weather from the Openmapweather API.
     */
    public function getWeather(string $city)
    {
        $response = Http::get('api.openweathermap.org/data/2.5/weather?q=' . $city . '&APPID=bda20696d0f44e254b0965bb453f5cd7' . '&mode=xml');

        if ($response->ok()) {
            $data = $response;

            return response($data, 200)->header('Content-Type', 'application/xml');
        }

        $data = response()->json(['status' => false, 'message' => 'Unable to find city.']);

        return $data;
    }
}

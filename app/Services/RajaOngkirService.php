<?php

namespace App\Services;

use Illuminate\Support\Facades\Http;

class RajaOngkirService
{
    protected $apiKey;
    protected $baseUrl;

    public function __construct()
    {
        $this->apiKey = env('RAJAONGKIR_API_KEY');
        $this->baseUrl = env('RAJAONGKIR_BASE_URL');
    }

    public function getProvinces()
    {
        $response = Http::withHeaders([
            'key' => $this->apiKey
        ])->get("{$this->baseUrl}/province");

        return $response->json();
    }

    public function getCities($provinceId)
    {
        $response = Http::withHeaders([
            'key' => $this->apiKey
        ])->get("{$this->baseUrl}/city", [
            'province' => $provinceId
        ]);

        return $response->json();
    }

    public function getSubdistricts($cityId)
    {
        // Note: This functionality may require higher tier subscription
        $response = Http::withHeaders([
            'key' => $this->apiKey
        ])->get("{$this->baseUrl}/subdistrict", [
            'city' => $cityId
        ]);

        return $response->json();
    }

    public function calculateShipping($destination, $courier, $weight)
    {
        $url = "https://api.rajaongkir.com/starter/cost";
        $response = Http::withHeaders([
            'key' => $this->apiKey,
        ])->post($url, [
            'origin' => '169', // Ganti dengan ID kota asal pengiriman Anda
            'destination' => $destination,
            'weight' => $weight,
            'courier' => $courier,
        ]);

        return $response->json();
    }
}

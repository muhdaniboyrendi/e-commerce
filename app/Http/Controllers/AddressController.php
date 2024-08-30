<?php

namespace App\Http\Controllers;

use App\Services\RajaOngkirService;

class AddressController extends Controller
{
    protected $rajaOngkirService;

    public function __construct(RajaOngkirService $rajaOngkirService)
    {
        $this->rajaOngkirService = $rajaOngkirService;
    }

    public function getProvinces()
    {
        $provinces = $this->rajaOngkirService->getProvinces();
        return response()->json($provinces['rajaongkir']['results']);
    }

    public function getCities($provinceId)
    {
        $cities = $this->rajaOngkirService->getCities($provinceId);
        return response()->json($cities['rajaongkir']['results']);
    }

    public function getSubdistricts($cityId)
    {
        $subdistricts = $this->rajaOngkirService->getSubdistricts($cityId);
        return response()->json($subdistricts['rajaongkir']['results']);
    }

    public function calculateShipping($cityId, $courier, $weight)
    {
        $shippingCost = $this->rajaOngkirService->calculateShipping($cityId, $courier, $weight);
        return response()->json([
            'cost' => $shippingCost['rajaongkir']['results'][0]['costs'][0]['cost'][0]['value']
        ]);
    }
}

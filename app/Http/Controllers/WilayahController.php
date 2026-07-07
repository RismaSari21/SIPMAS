<?php

namespace App\Http\Controllers;

use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Http;

class WilayahController extends Controller
{
    private string $baseUrl = 'https://www.emsifa.com/api-wilayah-indonesia/api';

    public function provinces(): JsonResponse
    {
        return response()->json($this->fetch('provinces', '/provinces.json'));
    }

    public function regencies(string $province): JsonResponse
    {
        return response()->json($this->fetch("regencies-{$province}", "/regencies/{$province}.json"));
    }

    public function districts(string $regency): JsonResponse
    {
        return response()->json($this->fetch("districts-{$regency}", "/districts/{$regency}.json"));
    }

    public function villages(string $district): JsonResponse
    {
        return response()->json($this->fetch("villages-{$district}", "/villages/{$district}.json"));
    }

    private function fetch(string $key, string $path): array
    {
        return Cache::remember("wilayah.{$key}", now()->addDay(), function () use ($path): array {
            $response = Http::timeout(15)->get($this->baseUrl.$path);

            if (! $response->successful()) {
                return [];
            }

            return $response->json() ?? [];
        });
    }
}

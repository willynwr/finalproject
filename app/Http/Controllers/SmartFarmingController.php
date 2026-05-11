<?php

namespace App\Http\Controllers;

use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Http;

class SmartFarmingController extends Controller
{
    public function rekomendasiPupuk()
    {
        return view('firebase', [
            'pageTitle' => 'Dashboard Rekomendasi Pupuk',
            'pageSubtitle' => 'Real-time Soil Nutrition & Fertilizer Recommendations',
            'apiEndpoint' => '/api/rekomendasi-data',
            'metricSectionTitle' => 'Predictive Soil Parameters (NPK & pH)',
            'doseSectionTitle' => 'Recommended Fertilizer Doses',
            'showDoseSection' => true,
            'showFertilityClass' => false,
        ]);
    }

    public function kesuburanTanah()
    {
        return view('firebase', [
            'pageTitle' => 'Dashboard Kesuburan Tanah',
            'pageSubtitle' => 'Monitoring Kesuburan Tanah Secara Real-time',
            'apiEndpoint' => '/api/kesuburan-data',
            'metricSectionTitle' => 'Parameter Kesuburan Tanah (NPK & pH)',
            'doseSectionTitle' => 'Indikator Kesuburan Tanah',
            'showDoseSection' => false,
            'showFertilityClass' => true,
        ]);
    }

    public function rekomendasiData(): JsonResponse
    {
        return $this->fetchFirebaseData('https://final-project-5fbba-default-rtdb.asia-southeast1.firebasedatabase.app/.json');
    }

    public function kesuburanData(): JsonResponse
    {
        return $this->fetchFirebaseData('https://rizki-project-a46c6-default-rtdb.asia-southeast1.firebasedatabase.app/kesuburan.json');
    }

    private function fetchFirebaseData(string $url): JsonResponse
    {
        $response = Http::get($url);

        if ($response->successful()) {
            $data = $response->json();

            if (isset($data['smart_soil']['latest'])) {
                return response()->json($data['smart_soil']['latest']);
            }

            if (isset($data['latest'])) {
                return response()->json($data['latest']);
            }

            if (isset($data['smart_soil']['history']) && is_array($data['smart_soil']['history'])) {
                $latestData = end($data['smart_soil']['history']);
                return response()->json($latestData);
            }

            return response()->json($data);
        }

        return response()->json([
            'error' => 'Gagal mengambil data dari Firebase',
            'details' => $response->status(),
        ], 500);
    }
}
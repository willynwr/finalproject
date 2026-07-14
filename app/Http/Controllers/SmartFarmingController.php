<?php

namespace App\Http\Controllers;

use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Http;

class SmartFarmingController extends Controller
{
    private const FIREBASE_BASE_URL = 'https://rizki-project-a46c6-default-rtdb.asia-southeast1.firebasedatabase.app';
    private const SHAP_BASE_URL     = 'http://203.194.115.209:8016';

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
        return $this->fetchFirebaseData(self::FIREBASE_BASE_URL . '/willy.json');
    }

    public function kesuburanData(): JsonResponse
    {
        return $this->fetchFirebaseData(self::FIREBASE_BASE_URL . '/kesuburan/latest.json');
    }

    public function shapData(): JsonResponse
    {
        $response = Http::timeout(10)->get(self::SHAP_BASE_URL . '/shap/firebase-latest');

        if ($response->successful()) {
            return response()->json($response->json());
        }

        return response()->json([
            'error'   => 'Gagal mengambil data SHAP',
            'details' => $response->status(),
        ], 500);
    }

    private function fetchFirebaseData(string $url): JsonResponse
    {
        $response = Http::get($url);

        if ($response->successful()) {
            return response()->json($response->json());
        }

        return response()->json([
            'error' => 'Gagal mengambil data dari Firebase',
            'details' => $response->status(),
        ], 500);
    }
}
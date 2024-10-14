<?php

namespace App\Http\Controllers;

use App\Models\Master\Asset;

class HomeController extends Controller
{
    public function index()
    {
        // Ambil data dari database menggunakan model Asset
        $totalAssets = Asset::totalAssets();
        $assetsInMaintenance = Asset::assetsInMaintenance();
        $assetsUnderRepair = Asset::assetsUnderRepair();
        $brokenAssets = Asset::brokenAssets();
        $recentAssets = Asset::orderBy('updated_at', 'desc')->take(5)->get(); // 5 aktivitas terbaru

        // Kirim data ke view
        return view('home', compact('totalAssets', 'assetsInMaintenance', 'assetsUnderRepair', 'brokenAssets', 'recentAssets'));
    }
}

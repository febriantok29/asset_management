<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Master\Asset;
use App\Models\Master\Vendor;
use App\Models\Transaction\AssetPurchase;
use App\Models\Master\Category;
use Carbon\Carbon;

class HomeController extends Controller
{
    public function index()
    {
        $totalAssets = Asset::count();
        $totalVendors = Vendor::count();
        $totalPurchases = AssetPurchase::count();

        $assetsByCategory = Category::withCount('assets')->get();
        $assetsByCategoryLabels = $assetsByCategory->pluck('name')->toArray();
        $assetsByCategoryData = $assetsByCategory->pluck('assets_count')->toArray();

        $purchasesByMonth = AssetPurchase::selectRaw('MONTH(purchase_date) as month, COUNT(*) as count')
            ->groupBy('month')
            ->orderBy('month')
            ->get();
        $purchasesByMonthLabels = $purchasesByMonth->pluck('month')->map(function($month) {
            return Carbon::create()->month($month)->translatedFormat('F');
        })->toArray();
        $purchasesByMonthData = $purchasesByMonth->pluck('count')->toArray();

        return view('home', compact(
            'totalAssets', 
            'totalVendors', 
            'totalPurchases', 
            'assetsByCategoryLabels', 
            'assetsByCategoryData', 
            'purchasesByMonthLabels', 
            'purchasesByMonthData'
        ));
    }
}

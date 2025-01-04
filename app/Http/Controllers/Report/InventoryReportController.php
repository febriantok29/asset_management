<?php

namespace App\Http\Controllers\Report;

use App\Exports\AssetsSummaryExport;
use App\Exports\VendorPurchasesExport;
use App\Exports\LocationTransfersExport;
use App\Exports\MaintenanceRepairsExport;
use App\Http\Controllers\Controller;
use App\Models\Master\Asset;
use App\Models\Master\Vendor;
use App\Models\Transaction\AssetTransfer;
use App\Models\Transaction\AssetMaintenance;
use Barryvdh\DomPDF\Facade\Pdf;
use Maatwebsite\Excel\Facades\Excel;

class InventoryReportController extends Controller
{
    public function index()
    {
        return view('reports.index');
    }

    public function assetsSummary()
    {
        $data = $this->getAssetsSummaryData();
        return view('reports.assets_summary', compact('data'));
    }

    public function assetsSummaryPdf()
    {
        $data = $this->getAssetsSummaryData();
        $pdf = PDF::loadView('reports.assets_summary_pdf', compact('data'));
        return $pdf->download('ringkasan_aset_' . $this->getDateTimeNowFileNaming() . '.pdf');
    }

    public function assetsSummaryExcel()
    {
        $data = $this->getAssetsSummaryData();
        return Excel::download(new AssetsSummaryExport($data), 'ringkasan_aset_' . $this->getDateTimeNowFileNaming() . '.xlsx');
    }

    public function vendorPurchases()
    {
        $data = $this->getVendorPurchasesData();
        return view('reports.vendor_purchases', compact('data'));
    }

    public function vendorPurchasesPdf()
    {
        $data = $this->getVendorPurchasesData();
        $pdf = PDF::loadView('reports.vendor_purchases_pdf', compact('data'));
        return $pdf->download('pembelian_vendor_' . $this->getDateTimeNowFileNaming() . '.pdf');
    }

    public function vendorPurchasesExcel()
    {
        $data = $this->getVendorPurchasesData();
        return Excel::download(new VendorPurchasesExport($data), 'pembelian_vendor_' . $this->getDateTimeNowFileNaming() . '.xlsx');
    }

    public function locationTransfers()
    {
        $data = $this->getLocationTransfersData();
        return view('reports.location_transfers', compact('data'));
    }

    public function locationTransfersPdf()
    {
        $data = $this->getLocationTransfersData();
        $pdf = PDF::loadView('reports.location_transfers_pdf', compact('data'));
        return $pdf->download('transfer_lokasi_' . $this->getDateTimeNowFileNaming() . '.pdf');
    }

    public function locationTransfersExcel()
    {
        $data = $this->getLocationTransfersData();
        return Excel::download(new LocationTransfersExport($data), 'transfer_lokasi_' . $this->getDateTimeNowFileNaming() . '.xlsx');
    }

    public function maintenanceRepairs()
    {
        $data = $this->getMaintenanceRepairsData();
        return view('reports.maintenance_repairs', compact('data'));
    }

    public function maintenanceRepairsPdf()
    {
        $data = $this->getMaintenanceRepairsData();
        $pdf = PDF::loadView('reports.maintenance_repairs_pdf', compact('data'));
        return $pdf->download('perbaikan_pemeliharaan_' . $this->getDateTimeNowFileNaming() . '.pdf');
    }

    public function maintenanceRepairsExcel()
    {
        $data = $this->getMaintenanceRepairsData();
        return Excel::download(new MaintenanceRepairsExport($data), 'perbaikan_pemeliharaan_' . $this->getDateTimeNowFileNaming() . '.xlsx');
    }

    private function getAssetsSummaryData()
    {
        return Asset::all();
    }

    private function getVendorPurchasesData()
    {
        return Vendor::with('purchases')->get();
    }

    private function getLocationTransfersData()
    {
        return AssetTransfer::with('asset', 'location')->get();
    }

    private function getMaintenanceRepairsData()
    {
        return AssetMaintenance::with('asset')->get();
    }

    private function getDateTimeNowFileNaming()
    {
        return now()->translatedFormat('Y-m-d_H-i-s');
    }
}

<?php

namespace App\Models\Transaction;

use App\Models\Master\Asset;
use App\Models\Master\Vendor;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class AssetPurchase extends Model
{
    use SoftDeletes, HasFactory;

    protected $table = 't_asset_purchases';

    protected $fillable = [
        'purchase_code',
        'asset_id',
        'vendor_id',
        'quantity',
        'purchase_date',
        'total_cost',
        'description',
    ];

    protected $dates = [
        'purchase_date',
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    public function asset()
    {
        return $this->belongsTo(Asset::class, 'asset_id');
    }

    public function vendor()
    {
        return $this->belongsTo(Vendor::class, 'vendor_id');
    }

    public function getFormattedPurchaseDateAttribute()
    {
        if (isset($this->purchase_date)) {
            return Carbon::parse($this->purchase_date)->translatedFormat('l, d F Y');
        }

        return '-';
    }

    public function getFormattedTotalCostAttribute()
    {
        return 'Rp ' . number_format($this->total_cost, 0, ',', '.');
    }
}

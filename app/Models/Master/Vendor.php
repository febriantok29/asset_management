<?php

namespace App\Models\Master;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Carbon\Carbon;
use App\Models\Transaction\AssetPurchase;

class Vendor extends Model
{
    use HasFactory, SoftDeletes;

    protected $table = 'm_vendors';

    protected $fillable = ['code', 'name', 'phone', 'email', 'address'];
    protected $dates = ['created_at', 'updated_at', 'deleted_at'];

    protected $casts = [
        'created_at' => 'datetime:Y-m-d H:i:s',
        'updated_at' => 'datetime:Y-m-d H:i:s',
        'deleted_at' => 'datetime:Y-m-d H:i:s',
    ];

    public function assets()
    {
        return $this->hasMany(Asset::class, 'vendor_id');
    }

    public function assetPurchases()
    {
        return $this->hasMany(AssetPurchase::class, 'vendor_id');
    }

    public function getPurchasesCountAttribute()
    {
        $purchasesCount = $this->assetPurchases->count();

        if ($purchasesCount > 0) {
            return $purchasesCount;
        }

        return 'Belum ada pembelian';
    }

    public function getLastPurchaseDateAttribute()
    {
        $lastPurchase = $this->assetPurchases->sortByDesc('purchase_date')->first();

        if ($lastPurchase) {
            return $lastPurchase->formatted_purchase_date;
        }

        return '-';
    }
}

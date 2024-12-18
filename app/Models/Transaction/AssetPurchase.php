<?php

namespace App\Models\Transaction;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

use App\Models\Master\Asset;
use App\Models\Master\Vendor;

class AssetPurchase extends Model
{
    use SoftDeletes;
    use HasFactory;

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
}

<?php

namespace App\Models\Master;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

use App\Models\Transaction\AssetPurchase;
use App\Models\Transaction\AssetTransfer;
use App\Models\Transaction\AssetMaintenance;
use App\Models\Transaction\AssetRepair;

class Asset extends Model
{
    use SoftDeletes;
    use HasFactory;

    protected $table = 'm_assets';

    protected $fillable = ['code', 'name', 'stock', 'category_id', 'vendor_id', 'description'];

    protected $dates = ['created_at', 'updated_at', 'deleted_at'];

    protected $casts = [
        'created_at' => 'datetime:Y-m-d H:i:s',
        'updated_at' => 'datetime:Y-m-d H:i:s',
        'deleted_at' => 'datetime:Y-m-d H:i:s',
    ];

    public function category()
    {
        return $this->belongsTo(Category::class, 'category_id');
    }

    public function vendor()
    {
        return $this->belongsTo(Vendor::class, 'vendor_id');
    }

    public function assetPurchases()
    {
        return $this->hasMany(AssetPurchase::class, 'asset_id');
    }

    public function assetTransfers()
    {
        return $this->hasMany(AssetTransfer::class, 'asset_id');
    }

    public function assetMaintenances()
    {
        return $this->hasMany(AssetMaintenance::class, 'asset_id');
    }

    public function assetRepairs()
    {
        return $this->hasMany(AssetRepair::class, 'asset_id');
    }
}

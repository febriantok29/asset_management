<?php

namespace App\Models\Master;

use App\Models\Transaction\AssetMaintenance;
use App\Models\Transaction\AssetPurchase;
use App\Models\Transaction\AssetRepair;
use App\Models\Transaction\AssetTransfer;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Asset extends Model
{
    use SoftDeletes, HasFactory;

    protected $table = 'm_assets';

    protected $fillable = ['code', 'name', 'stock', 'category_id', 'location_id', 'description'];

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

    public function location()
    {
        return $this->belongsTo(AssetLocation::class, 'location_id');
    }

    public function assetPurchases()
    {
        return $this->hasMany(AssetPurchase::class, 'asset_id');
    }

    public function latestPurchase()
    {
        return $this->hasOne(AssetPurchase::class, 'asset_id')->latestOfMany();
    }

    public function assetTransfers()
    {
        return $this->hasMany(AssetTransfer::class, 'asset_id');
    }

    public function latestTransfer()
    {
        return $this->hasOne(AssetTransfer::class, 'asset_id')->latestOfMany();
    }

    public function getLatestTransferLocationNameAttribute()
    {
        return $this->latestTransfer ? $this->latestTransfer->toLocation->name : '-';
    }

    public function assetMaintenances()
    {
        return $this->hasMany(AssetMaintenance::class, 'asset_id');
    }

    public function assetRepairs()
    {
        return $this->hasMany(AssetRepair::class, 'asset_id');
    }

    public function vendor()
{
    return $this->belongsTo(Vendor::class, 'vendor_id');
}

}

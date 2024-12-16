<?php

namespace App\Models\Master;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\Models\Transaction\AssetPurchase;

class Asset extends Model
{
    use SoftDeletes;

    protected $table = 'm_assets';

    protected $fillable = ['code', 'name', 'stock', 'category_id', 'vendor_id', 'description'];

    protected $dates = ['created_at', 'updated_at', 'deleted_at'];

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
}

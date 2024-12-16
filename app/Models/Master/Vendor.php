<?php

namespace App\Models\Master;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

use App\Models\Transaction\AssetPurchase;

class Vendor extends Model
{
    use SoftDeletes;

    protected $table = 'm_vendors';

    protected $fillable = ['code', 'name', 'phone', 'email', 'address'];
    protected $dates = ['created_at', 'updated_at', 'deleted_at'];

    public function assets()
    {
        return $this->hasMany(Asset::class, 'vendor_id');
    }

    public function assetPurchases()
    {
        return $this->hasMany(AssetPurchase::class, 'vendor_id');
    }
}

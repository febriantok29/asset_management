<?php

namespace App\Models\Master;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use App\Models\Transaction\AssetTransfer;

class AssetLocation extends Model
{
    use SoftDeletes, HasFactory;

    protected $table = 'm_locations';

    protected $fillable = ['code', 'name', 'address'];
    protected $dates = ['created_at', 'updated_at', 'deleted_at'];

    protected $casts = [
        'created_at' => 'datetime:Y-m-d H:i:s',
        'updated_at' => 'datetime:Y-m-d H:i:s',
        'deleted_at' => 'datetime:Y-m-d H:i:s',
    ];

    public function assetTransfersFrom()
    {
        return $this->hasMany(AssetTransfer::class, 'from_location_id');
    }

    public function assetTransfersTo()
    {
        return $this->hasMany(AssetTransfer::class, 'to_location_id');
    }
}

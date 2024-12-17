<?php

namespace App\Models\Transaction;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

use App\Models\Master\Asset;
use App\Models\Master\AssetLocation;

class AssetTransfer extends Model
{
    use SoftDeletes;

    protected $table = 't_asset_transfers';

    protected $fillable = ['transfer_code', 'asset_id', 'from_location_id', 'to_location_id', 'quantity', 'transfer_date', 'description'];

    protected $dates = ['transfer_date', 'created_at', 'updated_at', 'deleted_at'];

    protected $casts = [
        'quantity' => 'integer'
    ];

    public function asset()
    {
        return $this->belongsTo(Asset::class, 'asset_id');
    }

    public function fromLocation()
    {
        return $this->belongsTo(AssetLocation::class, 'from_location_id');
    }

    public function toLocation()
    {
        return $this->belongsTo(AssetLocation::class, 'to_location_id');
    }
}

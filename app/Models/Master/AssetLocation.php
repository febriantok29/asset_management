<?php

namespace App\Models\Master;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\Models\Master\Asset;

class AssetLocation extends Model
{
    use SoftDeletes;

    protected $table = 'm_asset_locations';

    protected $fillable = [
        'name',
        'code',
        'description'
    ];

    // Relasi ke model lain jika diperlukan
    public function assets()
    {
        return $this->hasMany(Asset::class, 'location_id');
    }
}

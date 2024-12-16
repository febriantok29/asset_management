<?php

namespace App\Models\Master;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\Models\Master\Asset;

class AssetLocation extends Model
{
    use SoftDeletes;

    protected $table = 'm_locations';

    protected $fillable = ['code', 'name', 'address'];
    protected $dates = ['created_at', 'updated_at', 'deleted_at'];
}

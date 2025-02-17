<?php

namespace App\Models\Transaction;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use App\Models\Master\Asset;

class AssetMaintenance extends Model
{
    use HasFactory, SoftDeletes;

    protected $table = 't_asset_maintenance';

    protected $fillable = [
        'maintenance_code',
        'asset_id',
        'maintenance_date',
        'issue',
        'technician',
        'cost',
    ];

    protected $dates = ['maintenance_date', 'created_at', 'updated_at', 'deleted_at'];

    protected $casts = [
        'maintenance_date' => 'date:Y-m-d',
        'created_at' => 'datetime:Y-m-d H:i:s',
        'updated_at' => 'datetime:Y-m-d H:i:s',
        'deleted_at' => 'datetime:Y-m-d H:i:s',
    ];

    public function asset()
    {
        return $this->belongsTo(Asset::class, 'asset_id');
    }

    public function getFormattedCostAttribute()
    {
        return 'Rp ' . number_format($this->cost, 2, ',', '.');
    }

    public function getFormattedMaintenanceDateAttribute()
    {
        return $this->maintenance_date->translatedFormat('l, d F Y');
    }
}

<?php

namespace App\Models\Transaction;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use App\Models\Master\Asset;

class AssetRepair extends Model
{
    use HasFactory, SoftDeletes;

    protected $table = 't_asset_repairs';

    protected $fillable = [
        'repair_code',
        'asset_id',
        'technician_name',
        'repair_date',
        'cost',
        'issue_description',
        'status',
    ];

    protected $dates = ['repair_date', 'created_at', 'updated_at', 'deleted_at'];

    protected $casts = [
        'repair_date' => 'date:Y-m-d',
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
        return 'Rp ' . number_format($this->cost, 0, ',', '.');
    }
}

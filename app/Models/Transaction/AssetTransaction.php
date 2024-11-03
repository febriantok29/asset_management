<?php

namespace App\Models\Transaction;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class AssetTransaction extends Model
{
    use SoftDeletes;

    protected $table = 't_asset_transactions';

    protected $fillable = ['code', 'asset_id', 'transaction_type', 'quantity', 'transaction_date', 'notes'];
    protected $dates = ['deleted_at', 'transaction_date'];

    public function asset()
    {
        return $this->belongsTo(\App\Models\Master\Asset::class, 'asset_id');
    }
}

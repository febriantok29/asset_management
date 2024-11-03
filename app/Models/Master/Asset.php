<?php

namespace App\Models\Master;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Asset extends Model
{
    use SoftDeletes;

    protected $table = 'm_assets';

    protected $fillable = [
        'name', 'code', 'category_id', 'supplier_id', 'purchase_price', 'purchase_date', 'description'
    ];

    // Relasi ke kategori
    public function category()
    {
        return $this->belongsTo(Category::class, 'category_id');
    }

    // Relasi ke pemasok
    public function supplier()
    {
        return $this->belongsTo(Supplier::class, 'supplier_id');
    }
}

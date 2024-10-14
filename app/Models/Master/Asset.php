<?php

namespace App\Models\Master;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Asset extends Model
{
    use SoftDeletes;

    protected $table = 'm_assets';

    protected $fillable = ['name', 'status', 'description', 'last_maintenance_at', 'category_id', 'supplier_id', 'purchase_price', 'purchase_date'];

    // Relasi dengan Kategori
    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    // Relasi dengan Supplier
    public function supplier()
    {
        return $this->belongsTo(Supplier::class);
    }

    // Method untuk menghitung total assets, assets in maintenance, dll.
    public static function totalAssets()
    {
        return self::count();
    }

    public static function assetsInMaintenance()
    {
        return self::where('status', 'maintenance')->count();
    }

    public static function assetsUnderRepair()
    {
        return self::where('status', 'repair')->count();
    }

    public static function brokenAssets()
    {
        return self::where('status', 'broken')->count();
    }
}

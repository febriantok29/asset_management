<?php

namespace App\Models\Master;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Category extends Model
{
    use SoftDeletes;

    protected $table = 'm_categories';

    protected $fillable = ['code', 'name', 'description'];
    protected $dates = ['deleted_at'];

    // Pastikan code adalah unik
    public static function boot()
    {
        parent::boot();
        static::creating(function ($category) {
            if (Category::where('code', $category->code)->exists()) {
                throw new \Exception('Kode katagori sudah digunakan.');
            }
        });
    }
}

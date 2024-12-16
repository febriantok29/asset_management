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

    // `Asset` model has a relationship with `Category` model
    public function assets()
    {
        return $this->hasMany(Asset::class, 'category_id');
    }
}

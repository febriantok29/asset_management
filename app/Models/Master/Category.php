<?php

namespace App\Models\Master;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Category extends Model
{
    use SoftDeletes;

    protected $table = 'm_categories';

    protected $fillable = ['name', 'description'];
    protected $dates = ['deleted_at'];
}

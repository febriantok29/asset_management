<?php

namespace App\Models\Models\Master;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Supplier extends Model
{
    use SoftDeletes;

    protected $table = 'm_suppliers';

    // Kolom-kolom yang boleh diisi secara massal
    protected $fillable = ['name', 'email', 'phone', 'address'];
}

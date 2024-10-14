<?php

namespace App\Models\Master;

use Illuminate\Database\Eloquent\Model;

use Illuminate\Database\Eloquent\SoftDeletes;

class Supplier extends Model
{
    use SoftDeletes;

    // Tentukan nama tabel
    protected $table = 'm_suppliers'; // Nama tabel adalah m_suppliers

    // Kolom-kolom yang bisa diisi secara massal
    protected $fillable = ['name', 'email', 'phone', 'address'];
}

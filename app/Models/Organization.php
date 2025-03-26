<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Organization extends Model
{
    use HasFactory;

    protected $connection = 'mysql2'; // Menggunakan koneksi mysql2

    protected $table = 'organization'; // Nama tabel
    
    public function scopeOrderByDefault($q)
    {
        $q->orderBy('name');
    }

}

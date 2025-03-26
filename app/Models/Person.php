<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Person extends Model
{
    use HasFactory;

    protected $connection = 'mysql2'; // Menggunakan koneksi mysql2

    protected $table = 'person'; // Nama tabel

    public function getFirstName(): string
    {
        return $this->first_name;
    }

    public function request()
    {
        return $this->hasOne(TicketRequest::class, 'id', 'id');
    }
}

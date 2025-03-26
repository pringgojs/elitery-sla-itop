<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TicketRequest extends Model
{
    use HasFactory;

    protected $connection = 'mysql2'; // Menggunakan koneksi mysql2

    protected $table = 'ticket_request'; // Nama tabel
}

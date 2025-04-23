<?php

namespace App\Models;

use App\Traits\HasPublicLog;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class TicketIncident extends Model
{
    use HasFactory, HasPublicLog;

    protected $connection = 'mysql2'; // Menggunakan koneksi mysql2

    protected $table = 'ticket_incident'; // Nama tabel
}

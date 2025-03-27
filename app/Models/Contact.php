<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Contact extends Model
{
    use HasFactory;

    protected $connection = 'mysql2'; // Menggunakan koneksi mysql2

    protected $table = 'contact'; // Nama tabel

    /**
     * Relasi ke model Organization dengan foreign key org_id.
     */
    public function organization()
    {
        return $this->belongsTo(Organization::class, 'org_id');
    }

    /**
     * Mengambil data dari model Person di mana kolom id pada contact sama dengan id di person.
     */
    public function person()
    {
        return $this->hasOne(Person::class, 'id', 'id');
    }

    public function scopeOrderByDefault($q)
    {
        $q->orderBy('name');
    }

    public function scopeClassTeam($q)
    {
        $q->where('finalClass', 'Team');
    }

    public function scopeClassPerson($q)
    {
        $q->where('finalClass', 'Person');
    }

    public function getFullName()
    {
        return $this->person->first_name . ' '. $this->name;
    }
}

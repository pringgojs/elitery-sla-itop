<?php

namespace App\Models;

use App\Traits\GenerateUuid;
use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Option extends Model
{
    use GenerateUuid, HasFactory, HasUuids, SoftDeletes;

    protected $dates = ['deleted_at'];

    protected $keyType = 'string';

    public $incrementing = false;

    protected $fillable = [
        'name',
        'type',
        'key',
        'extra',
    ];

    // Relasi ke tabel villages (jika diperlukan)
    public function departmentDetail()
    {
        return $this->hasOne(DepartmentDetail::class, 'department_id');
    }

    public function seedSourcePlantingActivities()
    {
        return $this->hasMany(PlantingActivity::class, 'seed_source_id');
    }

    public function budgetSourcePlantingActivities()
    {
        return $this->hasMany(PlantingActivity::class, 'budget_source_id');
    }

    public function activityTypePlantingActivities()
    {
        return $this->hasMany(PlantingActivity::class, 'activity_type_id');
    }

    /* --- */
    public function scopeBudgetSources($q)
    {
        $q->where('type', 'budget_source')->orderBy('name');
    }

    public function scopeSeedSources($q)
    {
        $q->where('type', 'seed_source')->orderBy('name');
    }

    public function scopeActivityTypes($q)
    {
        $q->where('type', 'activity_type')->orderBy('name');
    }
    
    public function scopeRegencies($q)
    {
        $q->where('type', 'regency')->orderBy('name');
    }
    
    public function scopeSeedTypes($q)
    {
        $q->where('type', 'seed_type')->orderBy('name');
    }
    
    /* --- */
    public function scopeDepartments($q)
    {
        $q->where('type', 'department')->orderBy('name');
    }

    public function scopeStatusData($q)
    {
        $q->where('type', 'status')->orderBy('name');
    }

    public function scopeUnits($q)
    {
        $q->where('type', 'unit')->orderBy('name');
    }

    public function scopeOrderByDefault($q)
    {
        $q->orderBy('name');
    }

    public function scopeSearch($q, $search = null)
    {
        if (! $search) {
            return;
        }

        $q->where('name', 'like', '%'.$search.'%');
    }

    public function getColor()
    {
        if (!$this->extra) return null;
        
        $unserialize = unserialize($this->extra);
        return isset($unserialize['color']) ? $unserialize['color'] : null; 
    }
}

<?php

namespace App\Traits;

use Carbon\Carbon;
use App\Models\User;
use App\Models\Option;


trait TransactionTrait
{
    public function scopeOrderByDefault($q)
    {
        $q->orderBy('created_at', 'desc');
    }

    public function scopeSearch($q, $search = null)
    {
        if (!$search) return;

        $q->where('code', 'like', '%'.$search.'%');
    }

    public function scopeStatus($q, $status = [])
    {
        if (!$status) return;

        if (count($status) == 2)  return;

        if (in_array('done', $status)) {
            $q->whereNotNull('approved_by');
        }

        if (in_array('pending', $status)) {
            $q->whereNull('approved_by');
        }
    }

    public function scopeDate($q, $type = null, $data = [])
    {
        if (!$type) return;

        if ($type == 'today') {
            $q->whereDate('created_at', Carbon::today());
            return;
        }

        if ($type == 'this-month') {
            $q->whereYear('created_at', Carbon::now()->year)
                ->whereMonth('created_at', Carbon::now()->month);
            return;
        }

        if ($type == 'other-month') {
            if (!isset($data['year']) || !isset($data['month'])) return;
            
            $q->whereYear('created_at', $data['year'])
                ->whereMonth('created_at', $data['month']);
            return;
        }

        if ($type == 'date-range') {
            info('date range belum ready');
        }
    }

    public function getCreatedAtAttribute($value)
    {
        // Set locale ke bahasa Indonesia
        Carbon::setLocale('id');

        // Buat instance Carbon dari created_at yang diberikan
        $carbonDate = Carbon::parse($value);

        // Format datetime menjadi 'd F Y H:i' (contoh: 24 Januari 2024 25:56)
        return $carbonDate->translatedFormat('d F Y H:i');
    }

    public function getApprovedAtAttribute($value)
    {
        // Set locale ke bahasa Indonesia
        Carbon::setLocale('id');

        // Buat instance Carbon dari created_at yang diberikan
        $carbonDate = Carbon::parse($value);

        // Format datetime menjadi 'd F Y H:i' (contoh: 24 Januari 2024 25:56)
        return $carbonDate->translatedFormat('d F Y H:i');
    }

    public function labelStatus()
    {
        return $this->approved_by ? '<span class="inline-flex items-center gap-x-1.5 py-1.5 px-3 rounded-full text-xs font-medium bg-teal-100 text-teal-800 dark:bg-teal-800/30 dark:text-teal-500">Done</span>':'<span class="inline-flex items-center gap-x-1.5 py-1.5 px-3 rounded-full text-xs font-medium bg-white/10 text-white">Pending</span>';
    }

    // Relasi ke table users
    public function creator()
    {
        return $this->belongsTo(User::class, 'created_by');
    }

    public function approver()
    {
        return $this->belongsTo(User::class, 'approved_by');
    }
    
    // Relasi ke table options
    public function department()
    {
        return $this->belongsTo(Option::class, 'department_id');
    }

}
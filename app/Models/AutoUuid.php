<?php

namespace App\Models;

use Illuminate\Support\Str;

trait AutoUuid
{
    protected static function boot()
    {
        parent::boot();

        static::creating(function ($model) {
            if (empty($model->uuid)) {
                $model->id = (string) Str::uuid();
            }
        });
    }
}

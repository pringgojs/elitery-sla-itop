<?php

namespace App\Traits;

use Illuminate\Support\Str;

trait GenerateUuid
{
    /**
     * Boot the trait.
     *
     * @return void
     */
    protected static function bootGeneratesUuid()
    {
        static::creating(function ($model) {
            // Generate UUID for the model
            if (empty($model->id)) {
                $model->id = (string) Str::uuid();
            }
        });
    }
}

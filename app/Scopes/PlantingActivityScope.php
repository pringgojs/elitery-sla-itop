<?php

namespace App\Scopes;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Scope;

class PlantingActivityScope implements Scope
{
    public function apply(Builder $builder, Model $model)
    {
        $user = auth()->user();

        if (!$user) return;
        if ($user->hasRole('Super Admin')) {

        } else {
            $builder->where('created_by', $user->id);
        }
    }
}

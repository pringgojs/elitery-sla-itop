<?php

namespace App\Http\Controllers;

class CheckRoleController extends Controller
{
    public function index()
    {
        $user = auth()->user();

        if ($user->hasRole('operator')) {
            if ($user->staff()->position_type_id != key_option('sekretaris_desa')) {
                return redirect('/profile');

            }
        }

        return redirect('/dashboard');
    }
}

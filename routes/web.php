<?php

use App\Livewire\Pages\User\Form;
use App\Livewire\Pages\User\Index;
use Illuminate\Support\Facades\Route;
use App\Livewire\Pages\Role\RolePermission;
use App\Http\Controllers\CheckRoleController;
use App\Livewire\Pages\Role\Index as RoleIndex;
use App\Livewire\Pages\Ticket\Index as TicketIndex;
use App\Livewire\Pages\Frontend\Index as FrontendIndex;
use App\Livewire\Pages\Dashboard\Index as DashboardIndex;
use App\Livewire\Pages\Permission\Index as PermissionIndex;


Route::get('/', function () {
    return redirect('dashboard');
});

Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified',
])->group(function () {

    /* ticket */
    Route::get('ticket', TicketIndex::class)->name('ticket.index');

    /* user management role */
    Route::get('permission', PermissionIndex::class)->name('permission.index');
    Route::get('check-role', [CheckRoleController::class, 'index'])->name('check-role');
    Route::get('role/{id}/permission', RolePermission::class)->name('role.permission');
    Route::get('role', RoleIndex::class)->name('role.index');
    Route::get('user', Index::class)->name('user.index');
    Route::get('dashboard', DashboardIndex::class)->name('dashboard.index');
});

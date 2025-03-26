<?php

use App\Models\Option;
use Illuminate\Support\Carbon;

/** initials */
function initials($name)
{
    $nameParts = explode(' ', trim($name));
    $firstName = array_shift($nameParts);
    $lastName = array_pop($nameParts);

    return
        mb_substr($firstName, 0, 1).
        mb_substr($lastName, 0, 1);
}

function key_option($key)
{
    $option = Option::where('key', $key)->first();

    return $option ? $option->id : null;
}

function option_get_name($key)
{
    $option = Option::where('key', $key)->first();

    return $option ? $option->name : null;
}

/* cek  */
function option_is_match($key, $id)
{
    return key_option($key) === $id;
}

/* user */
function is_administrator()
{
    $user = auth()->user();

    return $user->hasRole('administrator');
}

function is_sekdes()
{
    $user = auth()->user();
    if ($user->hasRole('operator')) {
        if ($user->staff()->position_type_id == key_option('sekretaris_desa')) {
            return true;
        }

    }

    return false;
}

function months()
{
    $months = [
        ['name' => 'januari', 'value' => 1],
        ['name' => 'februari', 'value' => 2],
        ['name' => 'maret', 'value' => 3],
        ['name' => 'april', 'value' => 4],
        ['name' => 'mei', 'value' => 5],
        ['name' => 'juni', 'value' => 6],
        ['name' => 'juli', 'value' => 7],
        ['name' => 'agustus', 'value' => 8],
        ['name' => 'september', 'value' => 9],
        ['name' => 'oktober', 'value' => 10],
        ['name' => 'november', 'value' => 11],
        ['name' => 'desember', 'value' => 12],
    ];

    return $months;
}

/* date formating */
function date_format_human($value)
{
    // Set locale ke bahasa Indonesia
    Carbon::setLocale('id');

    // Buat instance Carbon dari created_at yang diberikan
    $carbonDate = Carbon::parse($value);

    // Format datetime menjadi 'd F Y H:i' (contoh: 24 Januari 2024 25:56)
    return $carbonDate->translatedFormat('d F Y');
}

function format_price($string = null)
{
    if (!$string) return 0;
    return str_replace('.', '', $string);
}

function format_rupiah($number) {
    return 'Rp. ' . number_format($number, 0, ',', '.');
}

function schedule_is_open() {
    $startDate = option_get_name('jadwal_semester_buka');
    $endDate = option_get_name('jadwal_semester_tutup');
    
    // Mengubah string tanggal menjadi format DateTime
    $start = new DateTime($startDate);
    $end = new DateTime($endDate);
    $today = new DateTime(); // Tanggal hari ini
    
    // Mengecek apakah hari ini termasuk dalam rentang tanggal
    return ($today >= $start && $today <= $end);
}

/* sisegar */
function generate_hex_color()
{
    // Generate a random number between 0 and 16777215 (decimal representation of #FFFFFF)
    $randomColor = rand(0, 16777215);

    // Convert the number to a hexadecimal value and pad it to 6 characters
    return sprintf("#%06X", $randomColor);
}
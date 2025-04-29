<?php

use App\Models\Change;
use App\Models\Option;
use App\Models\TicketProblem;
use App\Models\TicketRequest;
use App\Models\TicketIncident;
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
    if (!$value) return '-';
    // Set locale ke bahasa Indonesia
    Carbon::setLocale('id');

    // Buat instance Carbon dari created_at yang diberikan
    $carbonDate = Carbon::parse($value);

    // Format datetime menjadi 'd F Y H:i' (contoh: 24 Januari 2024 25:56)
    return $carbonDate->translatedFormat('d F Y H:i');
}

function format_price($string = null)
{
    if (!$string) return 0;
    return str_replace('.', '', $string);
}

function format_rupiah($number) {
    return 'Rp. ' . number_format($number, 0, ',', '.');
}

function generate_hex_color()
{
    // Generate a random number between 0 and 16777215 (decimal representation of #FFFFFF)
    $randomColor = rand(0, 16777215);

    // Convert the number to a hexadecimal value and pad it to 6 characters
    return sprintf("#%06X", $randomColor);
}

/* menghitung selisih detik antara dua tanggal */
function get_time_diff_inseconds($date1, $date2) {
    $timestamp1 = strtotime($date1);
    $timestamp2 = strtotime($date2);

    return abs($timestamp2 - $timestamp1); // Returns absolute difference in seconds
}

function convert_seconds($seconds = 0)
{
    if ($seconds < 0) {
        return 0 ."s";
    }
    
    $hours = floor($seconds / 3600);
    $minutes = floor(($seconds / 60) % 60);
    $seconds = $seconds % 60;

    if ($hours) {
        return $hours . "h" . $minutes . "m" . $seconds % 60 . "s";
    }

    if ($minutes) {
        return $minutes . "m" . $seconds % 60 . "s";
    }

    return $seconds % 60 . "s";
}

function status_ticket_incident()
{
    $model = TicketIncident::select('status')
        ->distinct()
        ->orderBy('status', 'asc')
        ->pluck('status');

    return $model->map(function ($status) {
        return [
            'id' => $status,
            'name' => ucwords(str_replace('_', ' ', $status)),
        ];
    });
    

}

function status_ticket_problem()
{
    $model = TicketProblem::select('status')
        ->distinct()
        ->orderBy('status', 'asc')
        ->pluck('status');

    return $model->map(function ($status) {
        return [
            'id' => $status,
            'name' => ucwords(str_replace('_', ' ', $status)),
        ];
    });
}

function status_ticket_request()
{
    $model = TicketRequest::select('status')
        ->distinct()
        ->orderBy('status', 'asc')
        ->pluck('status');

    return $model->map(function ($status) {
        return [
            'id' => $status,
            'name' => ucwords(str_replace('_', ' ', $status)),
        ];
    });
}

function status_ticket_change()
{
    $model = Change::select('status')
        ->distinct()
        ->orderBy('status', 'asc')
        ->pluck('status');

    return $model->map(function ($status) {
        return [
            'id' => $status,
            'name' => ucwords(str_replace('_', ' ', $status)),
        ];
    });
}

function status_by_type($type)
{
    switch ($type) {
        case 'Incident':
            return status_ticket_incident();
        case 'Problem':
            return status_ticket_problem();
        case 'UserRequest':
            return status_ticket_request();
        case 'NormalChange':
            return status_ticket_change();
        case 'RoutineChange':
            return status_ticket_change();
        case 'EmergencyChange':
            return status_ticket_change();
        default:
            return [];
    }
}
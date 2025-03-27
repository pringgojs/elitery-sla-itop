<?php

namespace App\Services;

use Carbon\Carbon;
use App\Models\User;
use App\Models\Ticket;
use App\Models\UserCpanel;
use Illuminate\Support\Facades\Http;

class SlaService
{
    public $ticket;
    public $ticketRequest;
    public function __construct($ticket)
    {
        $this->ticket = $ticket;
        $this->ticketRequest = $this->ticket->ticketRequest ?? null;
    }

    public function getAgentL1()
    {
        /* Agent L1 diambil dari siapa yg pertama kali meresponse baik itu di public log atau private log */
        $publicLog = $this->ticketRequest->getPublicLogIndex();
        $privateLog = $this->ticket->getPrivateLogIndex();

        if (!$publicLog && !$privateLog) return [];
        
        $date = null;
        /* agent pertama berapa di index pertama. */
        if (!$publicLog && $privateLog) {
            $item = $privateLog[0];
            
            $date = $this->formatDateToTimezone($item['date']);
            $agent = $item['user_name'];
        } else if ($publicLog && !$privateLog) {
            $item = $publicLog[0];
            
            $date = $this->formatDateToTimezone($item['date']);
            $agent = $item['user_name'];
        } else if ($publicLog && $privateLog) {
            $itemPublic = $publicLog[0];
            $itemPrivate = $privateLog[0];

            if ($itemPublic['date'] < $itemPrivate['date']) {
                $date = $this->formatDateToTimezone($itemPublic['date']);
                $agent = $itemPublic['user_name'];
            } else {
                $date = $this->formatDateToTimezone($itemPrivate['date']);
                $agent = $itemPrivate['user_name'];
            }
        }

        if (!$date) return [];

        return [
            'ref' => $this->ticket->ref,
            'agent' => $agent,
            'response_time' => get_time_diff_inseconds($this->ticket->start_date, $date),
            'response_time_formated' => convert_seconds(get_time_diff_inseconds($this->ticket->start_date, $date)),
            'date_start' => $this->ticket->start_date,
            'date_end' => $date
        ];
    }

    public function getAgentL2()
    {
        /**
         * Catatan:
         * Jika statusnya sudah close maka diambil dari kolom agent yg ada di tiket
         * Atau agent L2 bisa diambil dari siapa yg terakhir kali meresponse baik itu di public log atau private log
         * 
         * Untuk L2 Response Time mohon bantuannya untuk dibuat 2 Kondisi, yaitu
         * Kondisi pertama waktu L2 Response Time dihitung dari L1 Response Public Log sampai status Ticket Dispatched.
         * Atau kondisi kedua yaitu L2 Response Time dihitung dari L1 Response Public Log sampai status Ticket Assigned.
         * 
         * Resolution time dihitung dari assignment date sampai resolution date.
         * Jika ada pending, maka dikurangi dengan pending time yg ada di kolom cumulatedpending_timespent.
         */

        $firstAgentResponse = $this->getAgentL1();

        if (!$firstAgentResponse) return [];
        
        $firstAgentResponseDate = $firstAgentResponse['date_end'];
        
        $assignmentDate = $this->ticketRequest->assignment_date ?? null;
        
        if (!$assignmentDate) return [];

        /* response time */
        $responseTime = get_time_diff_inseconds($firstAgentResponseDate, $assignmentDate);

        /* resolution time */
        $totalPendingTime = $this->ticketRequest->cumulatedpending_timespent ?? 0;
        $resolutionDate = $this->ticketRequest->resolution_date ?? null;
        $resolutionTime = 0;
        if ($resolutionDate) {
            $resolutionTime = get_time_diff_inseconds($assignmentDate, $resolutionDate) - $totalPendingTime;
        }

        return [
            'ref' => $this->ticket->ref,
            'agent' => $this->ticket->agent->getFullName(), // agent bisa diambil dari kolom agent di tiket karena itu adalah agen yg aktif
            'response_time' => $responseTime,
            'response_time_formated' => convert_seconds($responseTime),
            'resolution_time' => $resolutionTime,
            'resolution_time_formated' => convert_seconds($resolutionTime),
        ];
    }

    /* mengubah timestamp Unix ke UTC + 7  */
    private function formatDateToTimezone($date)
    {
        return Carbon::createFromTimestamp($date, 'UTC') // Ambil sebagai UTC
        ->setTimezone('Asia/Jakarta') // Ubah ke UTC+7
        ->format('Y-m-d H:i:s');
    }
}
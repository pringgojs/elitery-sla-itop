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
        $publicLog = $this->ticketRequest->getPublicLogIndex();
        $privateLog = $this->ticket->getPrivateLogIndex();

        if (!$publicLog && !$privateLog) return [];

        $firstLog = $this->getFirstLog($publicLog, $privateLog);
        if (!$firstLog) return [];

        $date = $this->formatDateToTimezone($firstLog['date']);
        $agent = $firstLog['user_name'];

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

        $responseTime = get_time_diff_inseconds($firstAgentResponseDate, $assignmentDate);

        $totalPendingTime = $this->ticketRequest->cumulatedpending_timespent ?? 0;
        $resolutionDate = $this->ticketRequest->resolution_date ?? null;
        $resolutionTime = $resolutionDate
            ? get_time_diff_inseconds($assignmentDate, $resolutionDate) - $totalPendingTime
            : 0;

        return [
            'ref' => $this->ticket->ref,
            'agent' => $this->ticket->agent->getFullName(),
            'response_time' => $responseTime,
            'response_time_formated' => convert_seconds($responseTime),
            'resolution_time' => $resolutionTime,
            'resolution_time_formated' => convert_seconds($resolutionTime),
        ];
    }

    private function getFirstLog($publicLog, $privateLog)
    {
        if (!$publicLog) return $privateLog[0] ?? null;
        if (!$privateLog) return $publicLog[0] ?? null;

        return $publicLog[0]['date'] < $privateLog[0]['date'] ? $publicLog[0] : $privateLog[0];
    }

    private function formatDateToTimezone($date)
    {
        return Carbon::createFromTimestamp($date, 'UTC')
            ->setTimezone('Asia/Jakarta')
            ->format('Y-m-d H:i:s');
    }
}
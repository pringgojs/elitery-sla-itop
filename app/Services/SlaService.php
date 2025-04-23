<?php

namespace App\Services;

use Carbon\Carbon;
use App\Models\User;
use App\Models\Ticket;
use App\Models\UserCpanel;
use Illuminate\Support\Facades\Http;

/**
 * Class ini hanya digunakan untuk jenis tiket Incident dan tiket Request.
 */
class SlaService
{
    public $ticket;
    public $ticketRequest;
    public $ticketIncident;
    public function __construct($ticket)
    {
        $this->ticket = $ticket;
        $this->ticketRequest = $this->ticket->ticketRequest ?? null;
        $this->ticketIncident = $this->ticket->ticketIncident ?? null;

        if (!$this->ticketRequest && !$this->ticketIncident) return []; // Jika tidak ada ticket request dan ticket incident, return array kosong
    }

    public function getAgentL1()
    {
        if (!$this->ticketRequest && !$this->ticketIncident) return [];

        $publicLog = $this->ticketRequest->getPublicLogIndex() ?? $this->ticketIncident->getPublicLogIndex();
        $privateLog = $this->ticket->getPrivateLogIndex();

        if (!$publicLog && !$privateLog) return [];

        $firstLog = $this->getFirstLog($publicLog, $privateLog);

        if (!$firstLog) return [];

        $date = $this->formatDateToTimezone($firstLog['date']);
        $agent = $firstLog['user_name'];
        $agent_id = $firstLog['user_id'];

        return [
            'ref' => $this->ticket->ref,
            'agent' => $agent,
            'agent_id' => $agent_id,
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
         * Response Time L2 dihitung ketika Engineer dilakukan Assign, dan Engineer L2 memberikan pesan "Response" pada Private Log. Mbk kalau misal pesannya bebas aja gimana ? jadi gak perlu keyword2.. yg penting l2 nulis di private log, yaudah itu yg diambil sebagai response time
         *
         * Resolution time dihitung dari assignment date sampai resolution date.
         * Jika ada pending, maka dikurangi dengan pending time yg ada di kolom cumulatedpending_timespent.
         */

        $assignmentDate = $this->ticketRequest->assignment_date ?? $this->ticketIncident->assignment_date ?? null;
        if (!$assignmentDate) return [];

        /* agent l2 wajib kirim komentar ke private log setelah mendapat assign */
        $privateLog = $this->ticket->getPrivateLog(); // Ambil private log dari ticket yang mana timestampnya lebih besar dari assignment date

        if ($privateLog) {
            $privateLog = collect($privateLog)->filter(function ($log) use ($assignmentDate) {
                return $log["timestamp"] > $assignmentDate;
            })->sortBy('timestamp')->first();
        }
        if (!$privateLog) return [];


        $responseTime = get_time_diff_inseconds($assignmentDate, $privateLog['timestamp']);
        $responseTime = $responseTime > 0 ? $responseTime : 0;

        $totalPendingTime = $this->ticketRequest->cumulatedpending_timespent ?? $this->ticketIncident->cumulatedpending_timespent ?? 0;
        $resolutionDate = $this->ticketRequest->resolution_date ?? $this->ticketIncident->resolution_date ?? null;
        $resolutionTime = $resolutionDate
            ? get_time_diff_inseconds($assignmentDate, $resolutionDate) - $totalPendingTime
            : 0;

        return [
            'ref' => $this->ticket->ref,
            'agent_id' => $this->ticket->agent_id,
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
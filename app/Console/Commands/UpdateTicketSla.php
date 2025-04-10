<?php

namespace App\Console\Commands;

use App\Models\Ticket;
use App\Services\SlaService;
use Illuminate\Console\Command;

class UpdateTicketSla extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:update-sla {all?}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'mengupdate ticket sla';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $all = $this->argument('all');
        if ($all) {
            $this->ticketAll();
            return;
        }

        // Jika tidak ada argumen all, maka hanya memproses tiket yang statusnya open
        // Cari Tiket yang statusnya close tapi belum pernah di update SLA nya
        $this->info('Processing closed tickets...');
        self::ticketClosed();
        $this->info('Closed tickets processed.');
        self::ticketOngoing();
        $this->info('Done.');
    }

    private function ticketAll()
    {
        $all = $this->argument('all');
        if (!$all) return;
        
        $this->info('Processing all tickets...');
        $tickets = Ticket::all();
        self::updateDB($tickets);
        $this->info('All tickets processed.');
    }

    private function ticketClosed()
    {
        $tickets = Ticket::closed()->where('sla_last_check', null)->get();
        self::updateDB($tickets);
    }

    private function ticketOngoing()
    {
        $tickets = Ticket::open()->where(function ($query) {
            $query->where('sla_last_check', null)
                  ->orWhere('sla_last_check', '<', now()->subMinutes(10)); // default pengecekan tiket on-going 10 menit
        })->get();

        self::updateDB($tickets);
    }

    private function updateDB($tickets = [])
    {
        foreach ($tickets as $ticket) {
            $slaService = new SlaService($ticket);
            $agentL1 = $slaService->getAgentL1();
            $agentL2 = $slaService->getAgentL2();

            if (!$agentL1 || !$agentL2) {
                continue;
            }            
            
            $ticket->update([
                'agent_l1_id' => $agentL1['agent_id'] ?? 0,
                'agent_l1_name' => $agentL1['agent'] ?? null,
                'agent_l1_response_time' => $agentL1['response_time'] ?? 0,
                'agent_l2_id' => $agentL2['agent_id'] ?? 0,
                'agent_l2_name' => $agentL2['agent'] ?? null,
                'agent_l2_response_time' => $agentL2['response_time'] ?? 0,
                'agent_l2_resolution_time' => $agentL2['resolution_time'] ?? 0,
                'sla_last_check' => now(),
            ]);
            
        }
    }
}

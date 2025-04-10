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
            $ticket->recalculate();
        }
    }
}

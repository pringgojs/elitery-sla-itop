<?php

namespace App\Console\Commands;

use App\Models\Ticket;
use App\Constants\Constants;
use App\Services\SlaService;
use Illuminate\Console\Command;

class Test extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:test';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        self::sla();
    }

    public function sla()
    {
        $ticket = Ticket::find(2221);
        $service = new SlaService($ticket);
        // $logs = $ticket->getPrivateLog();
        $l2 = $service->getAgentL2();
        dd($l2);
    }
}

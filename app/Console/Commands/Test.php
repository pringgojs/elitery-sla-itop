<?php

namespace App\Console\Commands;

use App\Models\Ticket;
use App\Models\Contact;
use App\Constants\Constants;
use App\Services\SlaService;
use Illuminate\Support\Carbon;
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
        self::recalculate();
        // self::sla();
        // self::carbon();
        // self::chartCarousel();
    }

    public function recalculate()
    {
        $ticket = Ticket::ref('R-002259')->first();
        $ticket->recalculate();

        dd($ticket);        
    }

    public function carbon()
    {
        $utc = Carbon::now()->setTimezone('UTC');
        // dd($utc);
        
        $value = '2025-05-14 02:57:49';
        $carbon = Carbon::parse($value)->setTimezone('Asia/Jakarta'); 
        dd($carbon);
    }

    public function chartCarousel()
    {

        $agents = Contact::classPerson()
            ->selectFullName()
            ->where('org_id', 1)
            ->get()
            ->chunk(30);

        $charts = [];
        foreach ($agents as $chunkIndex => $chunk) {
            $data['title'] = 'SLA by Agent (Group ' . ($chunkIndex + 1) . ')';

            $data['legend'] = $chunk->pluck('name')->toArray(); // agent name

            $seriesL1ResponseTime = [];
            $seriesL2ResponseTime = [];
            $seriesL2ResolutionTime = [];
            foreach ($chunk as $agent) {
                $seriesL1ResponseTime[] = Ticket::where('agent_l1_id', $agent->id)->sum('agent_l1_response_time');
                $seriesL2ResponseTime[] = Ticket::where('agent_l2_id', $agent->id)->sum('agent_l2_response_time');
                $seriesL2ResolutionTime[] = Ticket::where('agent_l2_id', $agent->id)->sum('agent_l2_resolution_time');
            }


            $data['series'] = [
                [
                    'label' => 'Response Time L1',
                    'data' => $seriesL1ResponseTime,
                    'backgroundColor' => ['#10B981'],
                    'borderColor' => ['#10B981'],
                    'borderWidth' => 1,
                ],
                [
                    'label' => 'Response Time L2',
                    'data' => $seriesL2ResponseTime,
                    'backgroundColor' => ['#3B82F6'],
                    'borderColor' => ['#3B82F6'],
                    'borderWidth' => 1,
                ],
                [
                    'label' => 'Resolution Time L2',
                    'data' => $seriesL2ResolutionTime,
                    'backgroundColor' => ['#FBBF24'],
                    'borderColor' => ['#FBBF24'],
                    'borderWidth' => 1,
                ]   
            ];

            $charts[] = $data;
        }

        return $charts;
    }

    public function sla()
    {
        $ticket = Ticket::ref('I-000331')->first();
        $service = new SlaService($ticket);
        // dd($service);
        // $logs = $ticket->getPrivateLog();
        $l1 = $service->getAgentL1();
        $l2 = $service->getAgentL2();
        dd($l2);
    }
}

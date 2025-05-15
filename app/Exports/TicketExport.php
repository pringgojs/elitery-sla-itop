<?php

namespace App\Exports;

use App\Models\Ticket;
use Maatwebsite\Excel\Concerns\WithMapping;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\FromCollection;

class TicketExport implements FromCollection, WithHeadings, WithMapping
{
    public $i = 0;

    public $params;

    public function __construct($params = [])
    {
        $this->params = $params;
    }

    /**
     * @return \Illuminate\Support\Collection
     */
    public function collection()
    {
        return Ticket::filter($this->params)
            ->with([
                'organization',
                'agent',
                'team',
                'caller' => function ($query) {
                    $query->selectFullName();
                }
            ])
            ->orderByDefault()
            ->get();
    }

    public function headings(): array
    {
        return [
            '#',
            'Created At',
            'Organization',
            'Number',
            'Title',
            'Caller',
            'Team',
            'Agent L1',
            'Agent L2',
            'Response Time L1',
            'Response Time L2',
            'Resolution Time',
            'Ticket Type',
            'Ticket Status',
        ];
    }

    public function map($item): array
    {
        return [
            ++$this->i,
            date_format_human($item->start_date),
            $item->organization->name ?? '-',
            $item->ref,
            $item->title,
            $item->caller->name ?? '-',
            $item->team->name ?? '-',
            $item->agent_l1_name,
            $item->agent_l2_name,
            $item->agent_l1_response_time ? convert_seconds($item->agent_l1_response_time) : 0,
            $item->agent_l2_response_time ? convert_seconds($item->agent_l2_response_time) : 0,
            $item->agent_l2_resolution_time ? convert_seconds($item->agent_l2_resolution_time) : 0,
            $item->finalclass,
            $item->operational_status,
        ];
    }
}

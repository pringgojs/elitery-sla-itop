<?php

namespace App\Models;

use Carbon\Carbon;
use App\Constants\Constants;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Ticket extends Model
{
    use HasFactory;

    protected $connection = 'mysql2'; // Menggunakan koneksi mysql2

    protected $table = 'ticket'; // Nama tabel

    public $timestamps = false;
    
    protected $fillable = [
        'agent_l1_id',
        'agent_l1_name',
        'agent_l1_response_time',
        'agent_l2_id',
        'agent_l2_name',
        'agent_l2_response_time',
        'agent_l2_resolution_time',
        'sla_last_check',
    ];

    /**
     * Relasi ke model Organization dengan foreign key org_id.
     */
    public function organization()
    {
        return $this->belongsTo(Organization::class, 'org_id');
    }

    public function ticketRequest()
    {
        return $this->hasOne(TicketRequest::class, 'id', 'id');
    }

    public function agent()
    {
        return $this->belongsTo(Contact::class, 'agent_id');
    }

    public function team()
    {
        return $this->belongsTo(Contact::class, 'team_id');
    }

    public function caller()
    {
        return $this->belongsTo(Contact::class, 'caller_id');
    }

    public function scopeRef($q, $ref)
    {
        if (! $ref) {
            return;
        }

        $q->where('ref', $ref);
    }

    public function scopeSearch($q, $search = null)
    {
        if (! $search) {
            return;
        }

        $q->where('ref', 'like', '%'.trim($search).'%')
            ->orWhere('title', 'like', '%'.trim($search).'%');
    }

    public function scopeOrderByDefault($q)
    {
        $q->orderBy('start_date', 'desc');
    }

    public function scopeFilter($q, $params = [])
    {
        if (!$params) return;
        
        if ($params['search']) {
            $q->search($params['search']);
        }

        if ($params['selectedOrg']) {
            $q->whereIn('org_id', $params['selectedOrg']);
        }

        if ($params['selectedCaller']) {
            $q->whereIn('caller_id', $params['selectedCaller']);
        }

        if ($params['selectedAgent']) {
            $q->whereIn('agent_id', $params['selectedAgent']);
        }
        
        if ($params['selectedTeam']) {
            $q->whereIn('team_id', $params['selectedTeam']);
        }

        $q->date($params);
    }

    public function scopeDate($q, $data = [])
    {
        $type = $data['dateType'];

        if (!$type) return;

        if ($type == 'today') {
            $q->whereDate('start_date', Carbon::today());
            return;
        }

        if ($type == 'this-month') {
            $q->whereYear('start_date', Carbon::now()->year)
                ->whereMonth('start_date', Carbon::now()->month);
            return;
        }

        if ($type == 'this-year') {
            $q->whereYear('start_date', Carbon::now()->year);
            return;
        }

        if ($type == 'other-month') {
            if (!isset($data['year']) || !isset($data['month'])) return;
            
            $q->whereYear('start_date', $data['year'])
                ->whereMonth('start_date', $data['month']);
            return;
        }

        if ($type == 'date-range') {
            $q->whereBetween('start_date', [$data['dateStart'], $data['dateEnd']]);
        }
    }

    public function scopeOpen($q)
    {
        $q->where('operational_status', Constants::TICKET_ONGOING);
    }

    public function scopeClosed($q)
    {
        $q->where('operational_status', Constants::TICKET_CLOSED);
    }

    public function status()
    {
        if ($this->operational_status == 'closed') {
            return '<span class="inline-flex items-center gap-x-1.5 py-1.5 px-3 rounded-full text-xs font-medium bg-teal-500 text-white">Closed</span>';
        }

        return '<span class="inline-flex items-center gap-x-1.5 py-1.5 px-3 rounded-full text-xs font-medium bg-yellow-500 text-white">'.$this->operational_status.'</span>';
    }
    
    public function getPrivateLog() {
        $text = $this->private_log;

        $pattern = '/========== ([\d-]+\s[\d:]+) : (.*?) \((\d+)\) ============\n\n(.+?)(?=\n==========|\z)/s';
        preg_match_all($pattern, $text, $matches, PREG_SET_ORDER);
    
        $result = [];
        foreach ($matches as $match) {
            $result[] = [
                'timestamp' => $match[1],  // Waktu pesan
                'name' => $match[2],       // Nama pengirim
                'agent_id' => (int) $match[3],  // ID agen
                'message' => trim($match[4]),   // Isi pesan (bisa mengandung HTML)
            ];
        }
    
        return $result;
    }

    public function getPrivateLogIndex() {
        $serializedString = $this->private_log_index;
        // Unserialize data
        $data = unserialize($serializedString);
    
        // Pastikan data hasil unserialize berupa array
        if (!is_array($data)) {
            return [];
        }
    
        return $data;
    }

}

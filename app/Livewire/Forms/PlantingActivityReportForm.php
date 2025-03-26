<?php

namespace App\Livewire\Forms;

use Carbon\Carbon;
use Livewire\Form;
use App\Models\Seed;
use App\Models\Report;
use App\Models\ReportDetail;
use Livewire\Attributes\Validate;

class PlantingActivityReportForm extends Form
{
    public $id;

    public $plantingActivityId;

    #[Validate('nullable|max:250')]
    public $note = '';
    
    #[Validate('required')]
    public $date = '';

    #[Validate('required')]
    public $deadAmount = [];

    #[Validate('required')]
    public $aliveAmount = [];
    
    public function messages()
    {
        return [
            'date.required' => 'Tanggal laporan wajib diisi.',
            'deadAmount.required' => 'Jumlah bibit mati wajib diisi.',
            'aliveAmount.required' => 'Jumlah bibit hidup wajib diisi.',
        ];
    }

    public function store()
    {
        $this->validate();
        

        $payload = [
            'planting_activity_id' => $this->plantingActivityId,
            'date_of_reporting' => $this->date,
            'note' => $this->note,
            'created_by' => auth()->id(),
        ];

        if (!$this->id) {
            $payload['number'] = $this->numberGenerator();
        } else {
            ReportDetail::where('report_id', $this->id)->delete();
        }

        /* proses simpan */
        $model = Report::updateOrCreate([
            'id' => $this->id,
        ], $payload);

        try {
            foreach ($this->deadAmount as $key => $value) {
                $payload = [
                    'report_id' => $model->id,
                    'seed_id' => $key,
                    'dead_amount' => $value,
                    'alive_amount' => $this->aliveAmount[$key],
                ];
    
                ReportDetail::create($payload);
            }
        } catch (\Exception $e) {
            info($e->getMessage());
            return;
        }
    }

    public function setPlantingActivityId($id)
    {
        $this->plantingActivityId = $id;
    }

    private function numberGenerator()
    {
        $date = $this->date;

         // Extract year and month from the date
        $year = date('y', strtotime($date));
        $month = date('m', strtotime($date));

        // Get the last index for the given year and month
        $lastReport = Report::whereYear('date_of_reporting', date('Y', strtotime($date)))
            ->whereMonth('date_of_reporting', date('m', strtotime($date)))
            ->orderBy('id', 'desc')
            ->first();

        $lastIndex = $lastReport ? intval(substr($lastReport->number, -3)) : 0;
        $newIndex = str_pad($lastIndex + 1, 3, '0', STR_PAD_LEFT);

        // Generate the new number
        $number = 'R-' . $year . $month . $newIndex;

        return $number;
    }

    public function setModel(Report $report)
    {
        $date = $report->date_of_reporting;
        $this->id = $report->id;
        $this->date =  Carbon::parse($date)->format('Y-m-d');
        $this->note = $report->note;

        $dead = [];
        $alive = [];
        foreach ($report->details as $item) {
            $dead[$item->seed_id] = $item->dead_amount;
            $alive[$item->seed_id] = $item->alive_amount;
        }
        $this->deadAmount = $dead;
        $this->aliveAmount = $alive;
    }
}

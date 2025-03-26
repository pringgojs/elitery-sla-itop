<?php

namespace App\Livewire\Modals;

use App\Models\Option;
use Livewire\Component;
use Livewire\Attributes\On;
use Barryvdh\DomPDF\Facade\Pdf;
use App\Models\PlantingActivity;

class Report extends Component
{
    public $modalReporting;
    public function render()
    {
        return view('livewire.modals.report');
    }

    /* laporan penanaman pohon PDF */
    #[On('report')]
    public function report($year)
    {

        if (!$year) return;

        $items = PlantingActivity::whereYear('date_of_activity', $year)->get();
        $pdf = Pdf::loadView('pdf.report-planting-activity', ['items' => $items, 'year' => $year])->setPaper('folio','landscape');
        
        return response()->streamDownload(function () use ($pdf) {
            echo $pdf->stream();
        }, 'laporan-penanaman-pohon-'.$year.'.pdf');
        
    }

    #[On('report-by-activity-type')]
    public function reportByActivityType($year)
    {
        if (!$year) return;

        $items = Option::activityTypes()->with('activityTypePlantingActivities')->orderByDefault()->get();
        $pdf = Pdf::loadView('pdf.report-by-activity-type', ['items' => $items, 'year' => $year]);
        
        return response()->streamDownload(function () use ($pdf) {
            echo $pdf->stream();
        }, 'laporan-per-kegiatan-'.$year.'.pdf');
        
    }

    #[On('report-rehabilitation-land')]
    public function reportByLandArea($year)
    {
        if (!$year) return;

        $items = PlantingActivity::whereYear('date_of_activity', $year)->get();
        $pdf = Pdf::loadView('pdf.report-rehabilitation-land', ['items' => $items, 'year' => $year])->setPaper('folio','landscape');
        
        return response()->streamDownload(function () use ($pdf) {
            echo $pdf->stream();
        }, 'laporan-rehabilitasi-hutan-lahan-'.$year.'.pdf');
    }
}

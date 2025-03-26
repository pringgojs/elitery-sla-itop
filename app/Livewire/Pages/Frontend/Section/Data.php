<?php

namespace App\Livewire\Pages\Frontend\Section;

use App\Models\Seed;
use App\Models\User;
use App\Models\Option;
use Livewire\Component;
use Livewire\Attributes\On;
use App\Models\PlantingActivity;
use Livewire\Attributes\Computed;
use App\Models\PlantingActivitySeed;
use App\Scopes\PlantingActivityScope;

class Data extends Component
{
    public $params;

    
    #[Computed]
    public function dataPerActivity()
    {
        return Option::activityTypes()->with('activityTypePlantingActivities')->orderByDefault()->get();
    }

    #[Computed]
    public function counter()
    {
        $params = $this->params;
        $data['total_activity'] = PlantingActivity::withoutGlobalScope(PlantingActivityScope::class)->filter($this->params)->count();
        $data['total_land_area'] = PlantingActivity::withoutGlobalScope(PlantingActivityScope::class)->filter($this->params)->sum('land_area');
        $data['total_seed'] = PlantingActivitySeed::whereHas('plantingActivity', function ($query) use ($params) {
            $query->filter($params);
        })->sum('amount');

        return $data;
    }

    #[Computed]
    public function markers()
    {
        $markers = [];
        $items = PlantingActivity::withoutGlobalScope(PlantingActivityScope::class)->filter($this->params)->select(['id', 'latitude', 'longitude'])->get();
        foreach ($items as $item) {
            $markers[] = [
                'id' => $item->id,
                'lat' => $item->latitude,
                'lng' => $item->longitude,
            ];
        }

        return $markers;
    }

    #[Computed]
    public function barChartPlantingActivityByType()
    {
        $data['title'] = 'Grafik Penanaman Pohon Perkegiatan ';

        $data['legend'] = Option::activityTypes()->orderByDefault()->pluck('name')->toArray();

        $counter = [];
        foreach (Option::activityTypes()->orderByDefault()->get() as $item) {
            $count = PlantingActivity::withoutGlobalScope(PlantingActivityScope::class)->filter($this->params)->where('activity_type_id', $item->id)->count();
            $counter[] = $count;
        }

        $data['series'] = [
            [
                'label' => 'Jumlah',
                'data' => $counter,
                'backgroundColor' => ['#10B981'],
                'borderColor' => ['#10B981'],
                'borderWidth' => 1,
            ]
        ];

        return $data;
    }

    #[Computed]
    public function barChartPlantingActivityByUser()
    {
        $data['title'] = 'Grafik Penanaman Pohon Perpetugas ';

        $data['legend'] = User::pluck('name')->toArray();

        $counter = [];
        foreach (User::all() as $item) {
            $count = PlantingActivity::withoutGlobalScope(PlantingActivityScope::class)->filter($this->params)->where('created_by', $item->id)->count();
            $counter[] = $count;
        }

        $data['series'] = [
            [
                'label' => 'Jumlah',
                'data' => $counter,
                'backgroundColor' => ['#10B981'],
                'borderColor' => ['#10B981'],
                'borderWidth' => 1,
            ]
        ];

        return $data;
    }

    #[Computed]
    public function pieChartPlantingActivityBySeed()
    {
        $data['title'] = 'Grafik Jumlah Bibit yang Sudah Ditanaman Berdasarkan Jenis Bibit ';

        $data['legend'] = Seed::orderByDefault()->pluck('name')->toArray();

        $counter = [];
        $colors = [];
        $params = $this->params;
        foreach (Seed::orderByDefault()->get() as $item) {
            $count = PlantingActivitySeed::whereHas('plantingActivity', function ($query) use ($params) {
                $query->filter($params);
            })->where('seed_id', $item->id)->sum('amount');
            $counter[] = $count;
            $colors[] = self::generateRandomColor();
        }

        $data['series'] = [
            [
                'label' => 'Jumlah',
                'data' => $counter,
                'backgroundColor' => $colors,
                'borderColor' => $colors,
                'borderWidth' => 1,
            ]
        ];

        return $data;
    }

    #[Computed]
    public function pieChartPlantingActivityByRegency()
    {
        $data['title'] = 'Grafik Jumlah Bibit yang Sudah Ditanaman Per Kabupaten ';

        $data['legend'] = Option::regencies()->orderByDefault()->pluck('name')->toArray();

        $counter = [];
        $colors = [];
        $params = $this->params;
        foreach (Option::regencies()->orderByDefault()->get() as $item) {
            $count = PlantingActivitySeed::whereHas('plantingActivity', function ($query) use ($params, $item) {
                $query->filter($params)->where('regency_id', $item->id);
            })->sum('amount');
            $counter[] = $count;
            $colors[] = self::generateRandomColor();
        }

        $data['series'] = [
            [
                'label' => 'Jumlah',
                'data' => $counter,
                'backgroundColor' => $colors,
                'borderColor' => $colors,
                'borderWidth' => 1,
            ]
        ];

        return $data;
    }

    #[On('filter')]
    public function filter($area = null, $search = null, $selectedDistrict = null, $selectedVillage = null, $selectedRegency = null, $selectedActivityType = null, $selectedSeedType = null, $selectedBudgetSource = null, $selectedSeedSource = null, $dateType = null, $month = null, $year = null, $dateStart = null, $dateEnd = null)
    {
        $params = [
            'area' => $area,
            'search' => $search,
            'selectedRegency' => $selectedRegency,
            'selectedDistrict' => $selectedDistrict,
            'selectedVillage' => $selectedVillage,
            'selectedActivityType' => $selectedActivityType,
            'selectedSeedType' => $selectedSeedType,
            'selectedBudgetSource' => $selectedBudgetSource,
            'selectedSeedSource' => $selectedSeedSource,
            'dateType' => $dateType,
            'month' => $month,
            'year' => $year,
            'dateStart' => $dateStart,
            'dateEnd' => $dateEnd,
        ];

        $this->params = $params;
        info($this->params);

        $barChartActivity = $this->barChartPlantingActivityByType;
        $barChartUser = $this->barChartPlantingActivityByUser;
        $pieChartPlantingActivityBySeed = $this->pieChartPlantingActivityBySeed;
        $pieChartPlantingActivityByRegency = $this->pieChartPlantingActivityByRegency;

        $this->dispatch('on-update-marker', $this->markers);
        $this->dispatch('on-update-activity-by-type', legend: $barChartActivity['legend'], series: $barChartActivity['series']);
        $this->dispatch('on-update-activity-by-user', legend: $barChartUser['legend'], series: $barChartUser['series']);
        $this->dispatch('on-update-activity-by-seed', legend: $pieChartPlantingActivityBySeed['legend'], series: $pieChartPlantingActivityBySeed['series']);
        $this->dispatch('on-update-activity-by-regency', legend: $pieChartPlantingActivityByRegency['legend'], series: $pieChartPlantingActivityByRegency['series']);
    }
    
    public function generateRandomColor()
    {
        return sprintf('#%06X', mt_rand(0, 0xFFFFFF));
    }

    public function render()
    {
        return view('livewire.pages.frontend.section.data');
    }
}

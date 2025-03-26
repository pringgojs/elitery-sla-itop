<?php

namespace App\View\Components\Staff;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class Detail extends Component
{
    public $staff;

    /**
     * Create a new component instance.
     */
    public function __construct($staff = null)
    {
        if ($staff) {
            $this->staff = $staff;
        }
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.staff.detail');
    }
}

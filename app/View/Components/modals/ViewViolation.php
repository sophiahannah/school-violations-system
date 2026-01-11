<?php

namespace App\View\Components\modal;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class ViewViolation extends Component
{
    public $record;
    public $id;
    /**
     * Create a new component instance.
     */
    public function __construct($record, $id)
    {
        $this->record = $record;
        $this->id = $id;
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.modals.view-violation');
    }
}

<?php

namespace App\View\Components\modals;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class EditViolation extends Component
{
    public $record;
    public $violations;
    public $id;
    /**
     * Create a new component instance.
     */
    public function __construct($record, $violations, $id)
    {
        $this->record = $record;
        $this->violations = $violations;
        $this->id = $id;
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.modals.edit-violation');
    }
}

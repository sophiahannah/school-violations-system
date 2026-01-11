<?php

namespace App\View\Components;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class LogViolationModal extends Component
{
    public $violations;
    /**
     * Create a new component instance.
     */
    public function __construct($violations)
    {
        $this->violations = $violations;
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.log-violation-modal');
    }
}

<?php

namespace App\View\Components;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class InputCheckbox extends Component
{
    public $text;
    public $model;

    /**
     * Create a new component instance.
     */
    public function __construct($text, $model)
    {
        $this->text = $text;
        $this->model = $model;
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.input-checkbox');
    }
}

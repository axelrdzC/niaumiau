<?php

namespace App\View\Components;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class SelectInput extends Component
{
    public $name;
    public $id;
    public $options;
    public $selected;
    
    public function __construct($name, $id = null, $options = [], $selected = null)
    {
        $this->name = $name;
        $this->id = $id ?? $name; // Si no se define el ID, usa el nombre como ID.
        $this->options = $options;
        $this->selected = $selected;
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.select-input');
    }
}

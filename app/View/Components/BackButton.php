<?php

namespace App\View\Components;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class BackButton extends Component
{
    public $url;
    public $label;

    public function __construct($url = null, $label = '← Back')
    {
        $this->url = $url ?? url()->previous(); // Fallback to previous URL
        $this->label = $label;
    }

    public function render()
    {
        return view('components.back-button');
    }
}

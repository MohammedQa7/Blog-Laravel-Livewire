<?php

namespace App\View\Components\category_tabs;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class C_Badge extends Component
{
    /**
     * Create a new component instance.
     */
    public function __construct()
    {
        //
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.category_tabs.c_-badge');
    }
}

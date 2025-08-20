<?php

namespace App\View\Components;

use Illuminate\View\Component;
use Illuminate\View\View;

class AppLayout extends Component
{
    public $categories;
    public $showSearchBar;

    public function __construct($categories = null, $showSearchBar = false)
    {
        $this->categories = $categories;
        $this->showSearchBar = $showSearchBar;
    }

    /**
     * Get the view / contents that represents the component.
     */
    public function render(): View
    {
        return view('layouts.app');
    }
}

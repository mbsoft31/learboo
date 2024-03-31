<?php

namespace App\View\Components;

use Core\Frontend\DTO\Navigation;
use Illuminate\View\Component;
use Illuminate\View\View;

class MainLayout extends Component
{
    /**
     * Get the view / contents that represents the component.
     */
    public function render(): View
    {
        $navigation = Navigation::loadFromFile(resource_path('data/navigations.php'), 'main');
        return view('layouts.frontend.main', [
            'navigation' => $navigation,
        ]);
    }
}

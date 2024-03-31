<?php

namespace Core\Frontend\View\Components;

use Closure;
use Illuminate\Contracts\Support\Htmlable;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class NavigationLink extends Component
{

    public function __construct(
        public \Core\Frontend\DTO\NavigationLink $navigationLink,
        public bool $active = false,
    ){
        $this->active = request()->routeIs($this->navigationLink->route);
    }
    /**
     * @inheritDoc
     */
    public function render(): View|Htmlable|Closure|string
    {
        // $url = route($this->navigationLink->route);

        /*$classes = 'group flex items-center px-2 py-1 rounded-lg text-sm font-semibold leading-6 text-base-content hover:bg-base-content hover:text-white';
        $classes .= $this->active ? ' text-white bg-gray-900' : ' text-gray-300 hover:text-white hover:bg-gray-700';*/

        return view('components.frontend.navigation-link', []);
    }
}

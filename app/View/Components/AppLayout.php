<?php

namespace App\View\Components;

use App\Enums\UserRoleEnum;
use Illuminate\View\Component;

class AppLayout extends Component
{
    public function compose($view)
    {
        $routes = request()->route()->getName();
        $titles = explode('.', $routes);
        $title = ucfirst(array_pop($titles));
        // change title to singular
        $view->with(['needed_roles' => UserRoleEnum::getAdminRoles(), 'title' => $title]);
    }
    /**
     * Get the view / contents that represents the component.
     *
     * @return \Illuminate\View\View
     */
    public function render()
    {
        return view('layouts.app');
    }
}

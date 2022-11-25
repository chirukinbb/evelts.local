<?php

namespace App\View\Components;

use Illuminate\View\Component;

class AdminMenu extends Component
{
    public array $items = [
        'dashboard' => 'Dashboard',
        'events' => 'Events',
        'categories' => 'Categories',
        'users' => 'Users',
    ];

    public function render()
    {
        return view('components.admin-menu');
    }
}

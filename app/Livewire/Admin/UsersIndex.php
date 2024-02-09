<?php

namespace App\Livewire\Admin;

use Livewire\Component;

class UsersIndex extends Component
{
    public $title = "Permisos de usuarios";

    public function render()
    {
        return view('livewire.admin.users-index');
    }
}

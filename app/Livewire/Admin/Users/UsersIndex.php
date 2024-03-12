<?php

namespace App\Livewire\Admin\Users;

use App\Models\User;
use Livewire\Component;

class UsersIndex extends Component
{
    public $title;

    public function mount(){
        $this->title= "Usuarios";
    }

    public function render()
    {
        return view('livewire.admin.users.users-index');
    }
}

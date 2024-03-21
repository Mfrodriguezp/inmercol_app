<?php

namespace App\Livewire\Admin\Users;

use LivewireUI\Modal\ModalComponent;
use App\Models\User;

class DestroyModal extends ModalComponent
{
    public User $user;
    public function render()
    {
        return view('livewire.admin.users.destroy-modal');
    }
}

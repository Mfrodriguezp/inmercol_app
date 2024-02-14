<?php

namespace App\Livewire\Admin;

use App\Models\User;
use LivewireUI\Modal\ModalComponent;

class CreateEditUserModal extends ModalComponent
{


    public function render()
    {
        return view('livewire.admin.create-edit-user-modal');
    }
}

<?php

namespace App\Livewire\Admin\Users;

use LivewireUI\Modal\ModalComponent;
use Spatie\Permission\Models\Role;
use App\Models\User;
use Spatie\Permission\Traits\HasRoles;

class CreateEditUserModal extends ModalComponent
{

    public $roles;
    public $password;
    public $password_confirmation;
    public $message;
    public $email, $username;
    public User $user; //Carga de objeto usuario para editar
    public $role;
    public $role_id;
    public $all_users_with_all_their_roles;
    public function mount()
    {
        $this->roles = Role::all();
        if (isset($this->user)) {
            $this->role = $this->user->roles->first()->id;
            $this->email = $this->user->email;
            $this->username = $this->user->name;
        }
    }

    public function render()
    {
        return view('livewire.admin.users.create-edit-user-modal');
    }
}

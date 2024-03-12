<?php

namespace App\Livewire\Admin\Users;

use Livewire\Attributes\Validate;
use Livewire\Component;
use LivewireUI\Modal\ModalComponent;
use App\Models\User;


class ResetPasswordModal extends ModalComponent
{
    public User $user; //Parameters update user

    #[Validate('required', message: 'Este campo es obligatorio')]
    #[Validate('min:8', message: 'La contraseña ingresada tiene menos de 8 caracteres')]
    public $newPassword;


    public function resetPassword()
    {
        //validación de formulario
        $this->validate();
        //Password encryptation
        $password = bcrypt($this->newPassword);
        //Update user password
        $this->user->update(['password'=>$password]);

        return redirect()->route('admin.users.index')
            ->with('success', 'Se ha reseteado la contraseña exitosamente.');
    }

    public function render()
    {
        return view('livewire.admin.users.reset-password-modal');
    }
}

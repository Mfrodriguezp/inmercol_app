<div>
    <div class="p-4">
        <div class="text-lg font-medium text-gray-900 mb-4">
            @if (isset($user) && is_object($user))
                Editar Usuario
            @else
                Crear Usuario
            @endif
        </div>
        <div class="message mb-4">
            @if ($password != $password_confirmation)
                <div class="flex items-center p-4 mb-4 text-sm text-red-800 rounded-lg bg-red-50 dark:bg-gray-800 dark:text-red-400"
                    role="alert">
                    <svg class="flex-shrink-0 inline w-4 h-4 me-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg"
                        fill="currentColor" viewBox="0 0 20 20">
                        <path
                            d="M10 .5a9.5 9.5 0 1 0 9.5 9.5A9.51 9.51 0 0 0 10 .5ZM9.5 4a1.5 1.5 0 1 1 0 3 1.5 1.5 0 0 1 0-3ZM12 15H8a1 1 0 0 1 0-2h1v-3H8a1 1 0 0 1 0-2h2a1 1 0 0 1 1 1v4h1a1 1 0 0 1 0 2Z" />
                    </svg>
                    <span class="sr-only">Info</span>
                    <div>
                        <span class="font-medium"></span>Las contraseñas deben ser iguales
                    </div>
                </div>
            @endif
        </div>
        <div class="text-lg font-medium text-gray-900 mb-4">
            @if (isset($user) && is_object($user))
                <form method="POST" action="{{ route('admin.users.update', $user) }}">
                    @method('PUT')
                @else
                    <form method="POST" action="{{ route('admin.users.store') }}">
            @endif

            @csrf

            <div>
                <x-label for="name" value="{{ __('Nombre Usuario') }}" />
                <x-input id="name" wire:model='username' class="block mt-1 w-full" type="text" name="name"
                    :value="old('name')" required autofocus autocomplete="name" />
            </div>

            <div class="mt-4">
                <x-label for="email" value="{{ __('Correo') }}" />
                <x-input wire:model="email" wire:keydown.shift.enter="validateEmail" id="email"
                    class="block mt-1 w-full" type="email" name="email" :value="old('email')" required
                    autocomplete="username" />
            </div>
            @if (!(isset($user) && is_object($user)))
                <div class="mt-4">
                    <x-label for="password" value="{{ __('Contraseña') }}" />
                    <x-input wire:model.live="password" id="password" class="block mt-1 w-full" type="password"
                        name="password" required autocomplete="new-password" />
                </div>

                <div class="mt-4">
                    <x-label for="password_confirmation" value="{{ __('Confirmar contraseña') }}" />
                    <x-input wire:model.live="password_confirmation" id="password_confirmation"
                        class="block mt-1 w-full" type="password" name="password_confirmation" required
                        autocomplete="new-password" />
                </div>
            @endif
            <div class="my-2">
                <div class="text-sm text-gray-900 mb-2">
                    Asignación de roles
                </div>
                <div class="checkbox flex gap-2">
                    @if (isset($user) && is_object($user))
                        <div class="option-role flex gap-1">
                            @foreach ($roles as $role)
                                <x-radio-button name="role" wire:model.live='role' value="{{ $role->id }}"
                                    required />
                                <x-label value='{{ $role->name }}' />
                            @endforeach
                        </div>
                    @else
                        <div class="option-role flex gap-1">
                            @foreach ($roles as $role)
                                <x-radio-button name="role" value="{{ $role->name }}" required />
                                <x-label value='{{ $role->name }}' />
                            @endforeach
                        </div>
                    @endif
                </div>
            </div>
            <div class="flex items-center justify-end mt-4">
                <x-secondary-button wire:click="$dispatch('closeModal')" wire:loading.attr="disabled">
                    Cancelar
                </x-secondary-button>
                @if (isset($user) && is_object($user))
                    @if ($password != $password_confirmation)
                        <x-button class="ms-4" disabled>
                            {{ __('Editar Usuario') }}
                        </x-button>
                    @else
                        <x-button class="ms-4">
                            {{ __('Editar Usuario') }}
                        </x-button>
                    @endif
                @else
                    @if ($password != $password_confirmation)
                        <x-button class="ms-4" disabled>
                            {{ __('Crear Usuario') }}
                        </x-button>
                    @else
                        <x-button class="ms-4">
                            {{ __('Crear Usuario') }}
                        </x-button>
                    @endif
                @endif

            </div>
            </form>
        </div>
    </div>

<div>
    <div class="">
        <div class="px-6 py-4">
            <div class="text-lg font-medium text-gray-900">
                @if(isset($user) && is_object($user))
                Editar usuario
                @else
                Crear usuario
                @endif
            </div>
    
            <div class="mt-4 text-sm text-gray-600">
                <form action="">
                    <div class="mb-4">
                        <x-label>
                            Nombre:
                        </x-label>
                        <x-input type="text" placeholder="Nombre Usuario"/>
                    </div>
                    <div class="mb-4">
                        <x-label>
                            Correo:
                        </x-label>
                        <x-input type="text" placeholder="Nombre Usuario"/>
                    </div>
                </form>
            </div>
        </div>
    
        <div class="flex flex-row justify-end px-6 py-4 bg-gray-100 text-end">
            Footer
        </div>
    </div>
</div>

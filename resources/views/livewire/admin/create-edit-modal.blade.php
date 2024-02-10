<div>
    <div class="px-6 py-4">
        <div class="text-lg font-medium text-gray-900">
            @if (isset($project) && is_object($project))
                Editar usuario
            @else
                Crear usuario
            @endif
        </div>

        <div class="mt-4 text-sm text-gray-600">
            <form action="{{action('App\Http\Controllers\Admin\ProjectController@store')}}" method="POST">
                {{ csrf_field() }}
                <div class="mb-4">
                    <x-label>
                        ID análisis
                    </x-label>
                    <x-input class="w-full" name="id_analisys"/>
                </div>
                <div class="mb-4">
                    <x-label>
                        Nombre Proyecto
                    </x-label>
                    <x-input class="w-full" name="project_name" required />
                </div>
                <div class="mb-4">
                    <x-label>
                        Cliente Nuevo
                        <x-input type="checkbox" wire:click="$toggle('checked')" />
                    </x-label>
                </div>

                <div class="mb-4">
                    @if (!$checked)
                        <x-label>
                            Clientes
                        </x-label>

                        <x-select name="id_client" class="w-full" required>
                            <option value="" disabled>
                                Seleccione una opción
                            </option>
                            @foreach ($clients as $client)
                                <option value="{{ $client->id_client }}">{{ $client->client_name }}</option>
                            @endforeach
                        </x-select>
                    @else
                        <x-input type="text" placeholder="Cliente Nuevo" name="client_name" required />
                    @endif
                </div>
                <div class="mb-4">
                    <x-secondary-button wire:click="$dispatch('closeModal')" wire:loading.attr="disabled">
                        Cancelar
                    </x-secondary-button>

                    <x-button type="submit" class="ml-2" wire:loading.attr="disabled">
                        Crear Proyecto
                    </x-button>
                </div>
            </form>
        </div>
    </div>
    <div class="flex flex-row justify-end px-6 py-4 bg-gray-100 text-end">
        <div wire:loading> 
            Creando Cliente
        </div>
    </div>
</div>

<div>
    <div class="px-6 py-4">
        <div class="text-lg font-medium text-gray-900">
            @if (isset($project) && is_object($project))
                Editar Proyecto
            @else
                Crear Proyecto
            @endif
        </div>

        <div class="mt-4 text-sm text-gray-600">
            <form
                action="{{ isset($project) ? action('App\Http\Controllers\Admin\ProjectController@update') : action('App\Http\Controllers\Admin\ProjectController@store') }}"
                method="POST">
                @csrf

                @if (isset($project) && is_object($project))
                    <input type="hidden" name="id" value="{{ $project->id_project }}">
                @endif
                <div class="mb-4">
                    <x-label>
                        ID análisis
                    </x-label>
                    <x-input class="w-full" name="id_analisys"
                        value="{{ $project->id_analisys ?? '' }}" />
                </div>
                <div class="mb-4">
                    <x-label>
                        Nombre Proyecto
                    </x-label>
                    <x-input class="w-full" name="project_name"
                        value="{{ $project->project_name ?? '' }}" required />
                </div>
                {{-- Comprobación para crear o editar --}}
                @if (isset($project) && is_object($project))
                    <div class="mb-4">
                        <x-label>
                            Clientes
                        </x-label>
                        <x-select name="id_client" wire:model.live="id_client" class="w-full" required>
                            <option value="" selected disabled>
                                Seleccione una opción
                            </option>
                            @foreach ($clients as $client)
                                <option value="{{ $client->id_client }}">{{ $client->client_name }}</option>
                            @endforeach
                        </x-select>
                    </div>
                @else
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
                                <option value="" selected disabled>
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
                @endif
                <div class="mb-4">
                    <x-secondary-button wire:click="$dispatch('closeModal')" wire:loading.attr="disabled">
                        Cancelar
                    </x-secondary-button>
                    @if (isset($project) && is_object($project))
                        <x-button type="submit" class="ml-2" wire:loading.attr="disabled">
                            Editar Proyecto
                        </x-button>
                    @else
                        <x-button type="submit" class="ml-2" wire:loading.attr="disabled">
                            Crear Proyecto
                        </x-button>
                    @endif
                </div>
            </form>
        </div>
    </div>
    <div class="flex flex-row justify-end px-6 py-4 bg-gray-100 text-end">
        <div wire:loading>
            Creando ...
        </div>
    </div>
</div>

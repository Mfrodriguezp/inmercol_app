<div>
    <div class="px-6 py-4">
        <div class="text-lg font-medium text-gray-900">
            @if (isset($judge) && is_object($judge))
                Editar Juez
            @else
                Crear Juez
            @endif
        </div>

        <div class="mt-4 text-sm text-gray-600">
            <form
                action="{{ isset($judge) ? action('App\Http\Controllers\Admin\JudgeController@update') : action('App\Http\Controllers\Admin\JudgeController@store') }}"
                method="POST">
                @csrf
                @if (isset($judge) && is_object($judge))
                    <input type="hidden" name="id" value="{{ $judge->id_judge }}">
                @endif
                <div class="mb-4">
                    <x-label>
                        Nombre Juez
                    </x-label>
                    <x-input type="text" class="w-full" name="judge_name" value="{{ $judge->judge_name ?? '' }}"
                        required />
                </div>
                <div class="mb-4">
                    <x-label>
                        Número de Juez
                    </x-label>
                    <x-input type="number" class="w-full" name="judge_number" value="{{ $judge->judge_number ?? '' }}"
                        required />
                </div>
                <div class="mb-4">
                    <x-secondary-button wire:click="$dispatch('closeModal')" wire:loading.attr="disabled">
                        Cancelar
                    </x-secondary-button>
                    @if (isset($judge) && is_object($judge))
                        <x-button type="submit" class="ml-2" wire:loading.attr="disabled">
                            Editar Juez
                        </x-button>
                    @else
                        <x-button type="submit" class="ml-2" wire:loading.attr="disabled">
                            Crear Juez
                        </x-button>
                    @endif
                </div>
            </form>
        </div>
        <div class="flex flex-row justify-end px-6 py-4 bg-gray-100 text-end">
        </div>
    </div>
</div>

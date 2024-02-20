<div>
    <div class="data min-w-7xl">
        <div class="px-6 py-4">
            <div class="text-lg font-medium text-gray-900">
               Titulo
            </div>
    
            <div class="mt-4 text-sm text-gray-600">
                <livewire:time-line-table id_project="{{$id_project}}" />
            </div>
        </div>
        <div class="flex flex-row justify-end px-6 py-4 bg-gray-100 text-end">
            <x-secondary-button wire:click="$dispatch('closeModal')" wire:loading.attr="disabled">
                Cerrar
            </x-secondary-button>
        </div>
    </div>
</div>

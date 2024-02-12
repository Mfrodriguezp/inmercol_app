<div>
    <div class="px-6 py-4">
        <div class="text-lg text-center font-medium text-gray-900">
            ¿Estas seguro de eliminar <strong>{{ $project->project_name }}</strong>?
        </div>

        <div class="mt-4 text-sm text-gray-600">
            <strong class="text-lg text-red-600">Advertencia: </strong> Al elimininar este registro, se borrará este y
            todos los registros vinculados <strong>(evaluaciones, juicios, etc.)</strong>, <span class="text-red-600">y
                no será posible realizar su posterior recuperacion!!</span>
        </div>

    </div>
    <div class="flex flex-row justify-end gap-2 px-6 py-4 bg-gray-100 text-end">
        <x-secondary-button wire:click="$dispatch('closeModal')" wire:loading.attr="disabled">
            Cancelar
        </x-secondary-button>
        <x-danger-button wire:click="deleteProject" class="ml-2" wire:loading.attr="disabled">
            Eliminar Proyecto
        </x-danger-button>
    </div>
</div>

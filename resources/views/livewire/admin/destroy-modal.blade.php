<div>
    <div class="px-6 py-4">
        <div class="text-lg text-center font-medium text-gray-900">
            ¿Estas seguro de eliminar el proyecto <strong>{{ $project->project_name }}</strong>?
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
        <a class="ml-2 inline-flex items-center justify-center px-4 py-2 bg-red-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-red-500 active:bg-red-700 focus:outline-none focus:ring-2 focus:ring-red-500 focus:ring-offset-2 transition ease-in-out duration-150"
            href="{{ action('App\Http\Controllers\Admin\ProjectController@destroy', ['project' => $project->id_project]) }}">
            Eliminar Proyecto
        </a>
    </div>
</div>

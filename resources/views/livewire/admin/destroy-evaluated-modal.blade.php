<div>
    <x-delete-modal>
        <x-slot name="title">
            ¿Estas seguro de eliminar este registro?
        </x-slot>
        <x-slot name="content">
            <strong class="text-lg text-red-600">Advertencia: </strong> Al elimininar este registro, se borrará este y
            todos los registros vinculados, <span class="text-red-600">y
                no será posible realizar su posterior recuperacion!!</span>
        </x-slot>
        <x-slot name="footer">
            <x-secondary-button wire:click="$dispatch('closeModal')" wire:loading.attr="disabled">
                Cancelar
            </x-secondary-button>
            <a class="ml-2 inline-flex items-center justify-center px-4 py-2 bg-red-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-red-500 active:bg-red-700 focus:outline-none focus:ring-2 focus:ring-red-500 focus:ring-offset-2 transition ease-in-out duration-150"
                href="{{ action('App\Http\Controllers\Admin\EvaluatedController@destroy', ['evaluated' => $evaluatedFragance->id_evaluated_fragance]) }}">
                Eliminar Evaluación
            </a>
        </x-slot>
    </x-delete-modal>
</div>

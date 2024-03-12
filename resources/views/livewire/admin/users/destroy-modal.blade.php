<div>
    <div class="px-6 py-4">
        <div class="text-lg text-center font-medium text-gray-900">
            ¿Estas seguro de eliminar el usuario <strong>{{ $user->name }}</strong>?
        </div>

        <div class="mt-4 text-sm text-gray-600">
            <strong class="text-lg text-red-600">Advertencia: </strong> Una vez que se elimine su cuenta, <span
                class="text-red-600">todos sus recursos y datos se eliminarán permanentemente.</span>
            Antes de eliminar su cuenta, descargue cualquier dato o información que desee conservar.
        </div>

    </div>
    <div class="flex flex-row justify-end gap-2 px-6 py-4 bg-gray-100 text-end">
        <x-secondary-button wire:click="$dispatch('closeModal')" wire:loading.attr="disabled">
            Cancelar
        </x-secondary-button>
        <form action="{{ route('admin.users.destroy', $user) }}" method="POST">
            @method('DELETE')
            @csrf
            <x-button class="ms-4">
                {{ __('Eliminar Usuario') }}
            </x-button>
        </form>
    </div>
</div>

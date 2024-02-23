<div>
    <div class="px-6 py-4">
        <div class="text-lg font-medium text-gray-900">
            <span class="text-teal-500 capitalize">Aplicación de fragancias para portadores.</span>
        </div>

        <div class="mt-4 text-sm text-gray-600">
            <div class="mt-2 mb-4 text-sm">
                    <div class="mb-4">
                        <h3 class="text-lg font-medium mb-2">Fragancias Portador {{$rotationCarriers->name_carrier_a}}</h3>
                        <ul>
                            <li>
                                <strong>Brazo Derecho:
                                </strong>{{ $rotationCarriers->fragance_carrier_a_arm_right }}
                            </li>
                            <li>
                                <strong>Brazo Izquierdo:
                                </strong>{{ $rotationCarriers->fragance_carrier_a_arm_left }}
                            </li>
                        </ul>
                    </div>
                    <div class="mb-4">
                        <h3 class="text-lg font-medium mb-2">Fragancias Portador {{$rotationCarriers->name_carrier_b}}</h3>
                        <ul>
                            <li>
                                <strong>Brazo Derecho:
                                </strong>{{ $rotationCarriers->fragance_carrier_b_arm_right }}
                            </li>
                            <li>
                                <strong>Brazo Izquierdo:
                                </strong>{{ $rotationCarriers->fragance_carrier_b_arm_left }}
                            </li>
                        </ul>
                    </div>
            </div>
        </div>
        <div class="flex flex-row justify-end px-6 py-4 bg-gray-100 text-end">
            <x-secondary-button wire:click="$dispatch('closeModal')" wire:loading.attr="disabled">
                Cerrar
            </x-secondary-button>
        </div>
    </div>
</div>

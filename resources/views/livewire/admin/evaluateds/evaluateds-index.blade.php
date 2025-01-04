<div>
    <div class="header flex items-center mb-10">
        <div class="title basis-3/5">
            <span class="title">{{ $title }}</span>
        </div>
        <div class="search flex justify-end gap-12 items-end basis-3/5">
            <div class="">
                <button wire:click="$dispatch('openModal', { component: 'admin.evaluateds.create-edit-evaluated-modal'})"
                    class="btn-primary inline-flex items-center px-4 py-2 bg-gray-800 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 transition ease-in-out duration-150">
                    Crear Evaluación
                </button>
            </div>
        </div>
    </div>
    {{-- info Evaluated --}}
    @if (session('info'))
        <div id="alert-additional-content-1"
            class="p-4 mb-4 text-blue-800 border border-blue-300 rounded-lg bg-blue-50 dark:bg-gray-800 dark:text-blue-400 dark:border-blue-800"
            role="alert">
            <div class="flex items-center">
                <svg class="flex-shrink-0 w-4 h-4 me-2" aria-hidden="true" xmlns="http://www.w3.org/2000/svg"
                    fill="currentColor" viewBox="0 0 20 20">
                    <path
                        d="M10 .5a9.5 9.5 0 1 0 9.5 9.5A9.51 9.51 0 0 0 10 .5ZM9.5 4a1.5 1.5 0 1 1 0 3 1.5 1.5 0 0 1 0-3ZM12 15H8a1 1 0 0 1 0-2h1v-3H8a1 1 0 0 1 0-2h2a1 1 0 0 1 1 1v4h1a1 1 0 0 1 0 2Z" />
                </svg>
                <span class="sr-only">Info</span>
                <h3 class="text-lg font-medium">{{ session('info') }}</h3>
            </div>
            <div class="mt-2 mb-4 text-sm">
                @if (isset($rotationCarriers) && is_object($rotationCarriers))
                    <div class="mb-4">
                        <h3 class="text-lg font-medium">Aplicación Fragancias Portador (a)
                            {{ $rotationCarriers->name_carrier_a }}</h3>
                        <ul>
                            <li>
                                <strong>Brazo Izquierdo:
                                </strong>{{ $rotationCarriers->fragance_carrier_a_arm_left }}
                            </li>
                            <li>
                                <strong>Brazo Derecho:
                                </strong>{{ $rotationCarriers->fragance_carrier_a_arm_right }}
                            </li>
                        </ul>
                    </div>
                    @if ($rotationCarriers->fragance_carrier_b_arm_right != '')
                        <div class="mb-4">
                            <h3 class="text-lg font-medium">Aplicación Fragancias Portador (a)
                                {{ $rotationCarriers->name_carrier_b }}</h3>
                            <ul>
                                <li>
                                    <strong>Brazo Izquierdo:
                                    </strong>{{ $rotationCarriers->fragance_carrier_b_arm_left }}

                                </li>
                                <li>
                                    <strong>Brazo Derecho:
                                    </strong>{{ $rotationCarriers->fragance_carrier_b_arm_right }}
                                </li>
                            </ul>
                        </div>
                    @else
                    @endif
                @endif
            </div>
            <div class="flex">
                <button type="button"
                    class="text-blue-800 bg-transparent border border-blue-800 hover:bg-blue-900 hover:text-white focus:ring-4 focus:outline-none focus:ring-blue-200 font-medium rounded-lg text-xs px-3 py-1.5 text-center dark:hover:bg-blue-600 dark:border-blue-600 dark:text-blue-400 dark:hover:text-white dark:focus:ring-blue-800"
                    data-dismiss-target="#alert-additional-content-1" aria-label="Close">
                    Cerrar
                </button>
            </div>
        </div>
    @endif
    <div class="data">
        <livewire:admin.evaluateds.evaluated-table />
    </div>
    {{-- Modals --}}

    @livewire('wire-elements-modal')

    {{-- Alert message --}}
    @if (session('ok'))
        @push('scripts')
            <script>
                window.addEventListener("load", (event) => {
                    const Toast = Swal.mixin({
                        toast: true,
                        position: "top-end",
                        showConfirmButton: false,
                        timer: 3000,
                        timerProgressBar: true
                    });
                    Toast.fire({
                        icon: "success",
                        title: "{{ session('ok') }}"
                    });
                });
            </script>
        @endpush
    @elseif (session('error'))
        @push('scripts')
            <script>
                window.addEventListener("load", (event) => {
                    const Toast = Swal.mixin({
                        toast: true,
                        position: "top-end",
                        showConfirmButton: false,
                        timer: 3000,
                        timerProgressBar: true
                    });
                    Toast.fire({
                        icon: "error",
                        title: "{{ session('error') }}"
                    });
                });
            </script>
        @endpush
    @endif
</div>

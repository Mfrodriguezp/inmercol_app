<div>
    <div class="bg-white mt-10 m-auto overflow-hidden shadow-xl sm:rounded-lg p-8">
        <!--Header Section-->
        <div class="header flex items-center mb-10">
            <div class="title">
                <span class="title">{{ $title }}</span>
            </div>
            <div class="search flex justify-end gap-12 items-end basis-3/5">
                <div class="">
                    <button wire:click="$toggle('openModal')"
                        class="btn-primary inline-flex items-center px-4 py-2 bg-gray-800 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 transition ease-in-out duration-150">
                        Nueva Evaluación
                    </button>
                </div>
            </div>
        </div>
        <!--Data Section-->
        <div class="data">
            <livewire:evaluated-table />
        </div>
        <!--Data Section-->
        {{-- Form create/edit project --}}
        <x-dialog-modal wire:model="openModal">
            <x-slot name="title">
                Agregar Evaluacion
            </x-slot>

            <x-slot name="content">
                <form wire:submit="addEvaluated" action="" method="POST">
                    <div class="mb-4">
                        <x-label>
                            TB
                        </x-label>
                        <x-input class="w-full" wire:model="tb" required />
                    </div>
                    <div class="mb-4">
                        <x-label>
                            Proyecto
                        </x-label>

                        <x-select wire:model="id_project" class="w-full" required>
                            <option value="" disabled>
                                Seleccione una opción
                            </option>
                            @foreach ($projects as $project)
                                <option value="{{ $project->id_project }}">{{ $project->project_name }}</option>
                            @endforeach
                        </x-select>
                    </div>
                    <div class="mb-4">
                        <div class="mb-4">
                            <strong>Fragancia 1</strong>
                        </div>
                        <div class="grid grid-cols-2 m-auto">
                            <div class="mb-4 m-auto">
                                <x-label>
                                    Nombre:
                                </x-label>
                                <x-input wire:model="fragance_name_1" required />
                            </div>
                            <div class="mb-4 m-auto">
                                <x-label>
                                    Counter:
                                </x-label>
                                <x-input wire:model="fragance_counter_1" required />
                            </div>
                            <div class="mb-4 m-auto">
                                <x-label>
                                    Ms:
                                </x-label>
                                <x-input wire:model="fragance_ms_1" required />
                            </div>
                            <div class="mb-4 m-auto">
                                <x-label>
                                    Código Fragancia
                                </x-label>
                                <x-input wire:model="fragance_test_code_1" required />
                            </div>
                        </div>
                    </div>
                    <div class="mb-4">
                        <div class="mb-4">
                            <strong>Fragancia 2</strong>
                        </div>
                        <div class="grid grid-cols-2 m-auto">
                            <div class="mb-4 m-auto">
                                <x-label>
                                    Nombre:
                                </x-label>
                                <x-input wire:model="fragance_name_2" required />
                            </div>
                            <div class="mb-4 m-auto">
                                <x-label>
                                    Counter:
                                </x-label>
                                <x-input wire:model="fragance_counter_2" required />
                            </div>
                            <div class="mb-4 m-auto">
                                <x-label>
                                    Ms:
                                </x-label>
                                <x-input wire:model="fragance_ms_2" required />
                            </div>
                            <div class="mb-4 m-auto">
                                <x-label>
                                    Código Fragancia
                                </x-label>
                                <x-input wire:model="fragance_test_code_2" required />
                            </div>
                        </div>

                    </div>
                    <div class="mb-4">
                        <x-secondary-button wire:click="$toggle('openModal')" wire:loading.attr="disabled">
                            Cancelar
                        </x-secondary-button>

                        <x-button type="submit" class="ml-2" wire:loading.attr="disabled">
                            Agregar evaluación
                        </x-button>
                    </div>
                    <div wire:loading>
                        <img src="/storage/tube-spinner.svg" alt="spinner">
                    </div>
                </form>
            </x-slot>

            <x-slot name="footer">
            </x-slot>
        </x-dialog-modal>
    </div>
</div>

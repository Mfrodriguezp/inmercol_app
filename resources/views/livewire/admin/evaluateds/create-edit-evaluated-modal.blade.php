<div>
    <form
        action="{{ isset($evaluatedFragance) ? action('App\Http\Controllers\Admin\EvaluatedController@update') : action('App\Http\Controllers\Admin\EvaluatedController@store') }}"
        method="POST" class=" mt-4">
        <div class="px-6 py-4">
            <div class="mb-4 text-lg font-medium text-gray-900">
                @if (isset($evaluatedFragance) && is_object($evaluatedFragance))
                    Editar Evaluación de proyecto
                @else
                    Crear Evaluación de proyecto
                @endif
            </div>

            <div class="mt-4 text-sm text-gray-600">

                <div class="mt-4 text-sm text-gray-600">
                    @csrf
                    @if (isset($evaluatedFragance) && is_object($evaluatedFragance))
                        <input type="hidden" name="id" value="{{ $evaluatedFragance->id_evaluated_fragance }}">
                    @endif
                    <div class="dataProject px-1.5 overflow-y-scroll divide-y divide-dashed divide-gray-400">
                        <div class="mb-4 overflow-hidden">
                            <div class="title mb-4">
                                <strong>Datos Iniciales</strong>
                            </div>
                            <div class="mb-4 grid grid-cols-2 gap-4 overflow-hidden">
                                <div
                                    class="w-full border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm">
                                    @if (isset($id_project))
                                        <div
                                            class="w-full border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm">
                                            <x-input type="text" class="w-full"
                                                value="{{ $project_send->project_name }}" disabled />
                                        </div>
                                    @else
                                        @if (isset($evaluatedFragance) && is_object($evaluatedFragance))
                                            <x-select name="projects_id_project" wire:model.live="projects_id_project"
                                                class="w-full" required>
                                                <option value="" selected disabled>
                                                    Proyecto
                                                </option>
                                                @foreach ($projects as $project)
                                                    <option value="{{ $project->id_project }}">
                                                        {{ $project->project_name }}
                                                    </option>
                                                @endforeach
                                            </x-select>
                                        @else
                                            <x-select name="projects_id_project" class="w-full" required>
                                                <option value="" selected disabled>
                                                    Proyecto
                                                </option>
                                                @foreach ($projects as $project)
                                                    <option value="{{ $project->id_project }}">
                                                        {{ $project->project_name }}
                                                    </option>
                                                @endforeach
                                            </x-select>
                                        @endif
                                    @endif
                                </div>
                                <div
                                    class="w-full border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm">
                                    <x-input type="text" class="w-full" name="test_identifier"
                                        placeholder="Código de evaluacion"
                                        value="{{ $evaluatedFragance->test_identifier ?? '' }}" required />
                                </div>
                                <div
                                    class="w-full border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm">
                                    @if (isset($evaluatedFragance) && is_object($evaluatedFragance))
                                        <x-select name="number_judges" wire:model.live="number_judges" class="w-full"
                                            required>
                                            <option value="" selected disabled>Cant. Jueces</option>
                                            <option value="8">8</option>
                                            <option value="12">12</option>
                                        </x-select>
                                    @else
                                        <x-select name="number_judges" wire:model.live="number_judges" class="w-full"
                                            required>
                                            <option value="" selected disabled>Cant. Jueces</option>
                                            <option value="8">8</option>
                                            <option value="12">12</option>
                                        </x-select>
                                    @endif
                                </div>
                                @if (isset($id_project))
                                    <div class="w-full">
                                        <x-input type="hidden" class="w-full" name="projects_id_project"
                                            value="{{ $project_send->id_project }}" />
                                    </div>
                                @endif
                            </div>
                        </div>
                        <div class="mb-4 pb-2 overflow-hidden">
                            <div class="title mb-4">
                                <strong>Datos Fragancia 1</strong>
                            </div>
                            <div class="grid grid-cols-2 gap-4 overflow-hidden">
                                <div class="w-full">
                                    <x-input type="text" class="w-full" name="fragance_name_1"
                                        placeholder="Nombre Fragancia"
                                        value="{{ $evaluatedFragance->fragance_name_1 ?? '' }}" required />
                                </div>
                                <div class="w-full">
                                    <x-input type="text" class="w-full" name="fragance_counter_1"
                                        placeholder="Contador"
                                        value="{{ $evaluatedFragance->fragance_counter_1 ?? '' }}" />
                                </div>
                                <div class="w-full">
                                    <x-input type="text" class="w-full" name="fragance_ms_1" placeholder="Muestra"
                                        value="{{ $evaluatedFragance->fragance_ms_1 ?? '' }}" />
                                </div>
                                <div class="w-full">
                                    <x-input type="text" class="w-full" name="fragance_test_code_1"
                                        placeholder="Código de Test"
                                        value="{{ $evaluatedFragance->fragance_test_code_1 ?? '' }}"
                                        wire:model.live="fragance_test_code_1" required />
                                </div>
                                <div class="w-full">
                                    <x-input type="text" class="w-full" name="code_1_test_a"
                                        placeholder="Frag. 1 Portador A"
                                        value="{{ $evaluatedFragance->code_1_test_a ?? '' }}" required />
                                </div>
                                <div class="w-full">
                                    @if ($number_judges == '8' || $number_judges == '')
                                        <x-input type="text" class="w-full" name="code_1_test_b"
                                            placeholder="Frag. 1 Portador B"
                                            value="{{ $evaluatedFragance->code_1_test_b ?? '' }}" required />
                                    @else
                                    @endif
                                </div>
                                <div class="w-full p-2">
                                    @if (isset($evaluatedFragance) && is_object($evaluatedFragance) && $benchmark == $fragance_test_code_1)
                                        <input checked id="default-radio-1" type="radio"
                                            value="{{ $fragance_test_code_1 }}" name="benchmark"
                                            class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-800 focus:ring-2 dark:bg-gray-700 dark:border-gray-600"
                                            required>
                                        <label for="default-radio-1"
                                            class="ms-2 text-sm font-medium text-gray-900 dark:text-gray-300">Benchmark</label>
                                    @else
                                        <input id="default-radio-1" type="radio"
                                            value="{{ $fragance_test_code_1 }}" name="benchmark"
                                            class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-800 focus:ring-2 dark:bg-gray-700 dark:border-gray-600">
                                        <label for="default-radio-1"
                                            class="ms-2 text-sm font-medium text-gray-900 dark:text-gray-300">Benchmark</label>
                                    @endif
                                </div>
                            </div>
                        </div>
                        <div class="mb-4 grid overflow-hidden">
                            <div class="title mb-4">
                                <strong>Datos Fragancia 2</strong>
                            </div>
                            <div class="grid grid-cols-2 gap-4 overflow-hidden">
                                <div class="w-full">
                                    <x-input type="text" class="w-full" name="fragance_name_2"
                                        placeholder="Nombre Fragancia"
                                        value="{{ $evaluatedFragance->fragance_name_2 ?? '' }}" required />
                                </div>
                                <div class="w-full">
                                    <x-input type="text" class="w-full" name="fragance_counter_2"
                                        placeholder="Contador"
                                        value="{{ $evaluatedFragance->fragance_counter_2 ?? '' }}" />
                                </div>
                                <div class="w-full">
                                    <x-input type="text" class="w-full" name="fragance_ms_2"
                                        placeholder="Muestra"
                                        value="{{ $evaluatedFragance->fragance_ms_2 ?? '' }}" />
                                </div>
                                <div class="w-full">
                                    <x-input type="text" class="w-full" name="fragance_test_code_2"
                                        placeholder="Código de Test"
                                        value="{{ $evaluatedFragance->fragance_test_code_2 ?? '' }}"
                                        wire:model.live="fragance_test_code_2" required />
                                </div>
                                <div class="w-full">
                                    <x-input type="text" class="w-full" name="code_2_test_a"
                                        placeholder="Frag. 2 Portador A"
                                        value="{{ $evaluatedFragance->code_2_test_a ?? '' }}" required />
                                </div>
                                <div class="w-full">
                                    @if ($number_judges == '8' || $number_judges == '')
                                    <x-input type="text" class="w-full" name="code_2_test_b"
                                        placeholder="Frag. 2 Portador B"
                                        value="{{ $evaluatedFragance->code_2_test_b ?? '' }}" required />
                                    @else
                                    @endif
                                </div>
                                <div class="w-full p-2">
                                    @if (isset($evaluatedFragance) && is_object($evaluatedFragance) && $benchmark == $fragance_test_code_1)
                                        <input checked id="default-radio-2" type="radio"
                                            value="{{ $fragance_test_code_2 }}" name="benchmark"
                                            class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-800 focus:ring-2 dark:bg-gray-700 dark:border-gray-600">
                                        <label for="default-radio-2"
                                            class="ms-2 text-sm font-medium text-gray-900 dark:text-gray-300">Benchmark</label>
                                    @else
                                        <input id="default-radio-2" type="radio"
                                            value="{{ $fragance_test_code_2 ?? '' }}" name="benchmark"
                                            class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-800 focus:ring-2 dark:bg-gray-700 dark:border-gray-600"
                                            required>
                                        <label for="default-radio-2"
                                            class="ms-2 text-sm font-medium text-gray-900 dark:text-gray-300">Benchmark</label>
                                    @endif
                                </div>
                            </div>
                        </div>
                        <div class="mb-4 overflow-hidden">
                            <div class="title mb-4">
                                <strong>Portadores</strong>
                            </div>
                            <div class="grid grid-cols-2 gap-4 overflow-hidden">
                                <div class="w-full">
                                    <x-input type="text" class="w-full" name="name_carrier_a"
                                        placeholder="Nombre Portador A"
                                        value="{{ $evaluatedFragance->name_carrier_a ?? '' }}" required />
                                </div>
                                <div class="w-full">
                                    @if ($number_judges == '8' || $number_judges == '')
                                    <x-input type="text" class="w-full" name="name_carrier_b"
                                        placeholder="Nombre Portador B"
                                        value="{{ $evaluatedFragance->name_carrier_b ?? '' }}" required />
                                    @else
                                    @endif
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="flex flex-row justify-end px-1.5 py-4 text-end">

                </div>

            </div>
        </div>
        <div class="flex flex-row justify-end px-1.5 py-4 bg-gray-100 text-end">
            <x-secondary-button wire:click="$dispatch('closeModal')" wire:loading.attr="disabled">
                Cancelar
            </x-secondary-button>
            @if (isset($evaluatedFragance) && is_object($evaluatedFragance))
                <x-button type="submit" class="ml-2" wire:loading.attr="disabled">
                    Editar Evaluación
                </x-button>
            @else
                <x-button type="submit" class="ml-2" wire:loading.attr="disabled">
                    Crear Evaluación
                </x-button>
            @endif
        </div>
    </form>
</div>

<div>
    <div class="header flex justify-between items-center mb-4">
        <div class="title">
            <span class="title">{{ $title }}</span>
        </div>
        @if (session('message'))
            <div id="alert-1"
                class="fixed right-20 flex items-center p-4 mb-4 text-blue-800 rounded-lg bg-blue-50 dark:bg-gray-800 dark:text-blue-400"
                role="alert">
                <svg class="flex-shrink-0 w-4 h-4" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor"
                    viewBox="0 0 20 20">
                    <path
                        d="M10 .5a9.5 9.5 0 1 0 9.5 9.5A9.51 9.51 0 0 0 10 .5ZM9.5 4a1.5 1.5 0 1 1 0 3 1.5 1.5 0 0 1 0-3ZM12 15H8a1 1 0 0 1 0-2h1v-3H8a1 1 0 0 1 0-2h2a1 1 0 0 1 1 1v4h1a1 1 0 0 1 0 2Z" />
                </svg>
                <span class="sr-only">Info</span>
                <div class="ms-3 text-sm font-medium">
                    {{ session('message') }}
                </div>
                <button type="button"
                    class="ms-auto -mx-1.5 -my-1.5 bg-blue-50 text-blue-500 rounded-lg focus:ring-2 focus:ring-blue-400 p-1.5 hover:bg-blue-200 inline-flex items-center justify-center h-8 w-8 dark:bg-gray-800 dark:text-blue-400 dark:hover:bg-gray-700"
                    data-dismiss-target="#alert-1" aria-label="Close">
                    <span class="sr-only">Close</span>
                    <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none"
                        viewBox="0 0 14 14">
                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6" />
                    </svg>
                </button>
            </div>
        @endif
    </div>

    <div class="data" wire:poll.keep-alive>
        @if ($evaluateds->count())
            @foreach ($evaluateds as $evaluated)
                @switch($evaluated->number_judges)
                    @case(8)
                        {{-- Portador 1 --}}
                        <div>
                            <span class="text-teal-500 text-2xl font-semibold capitalize">Pruebas Portador:
                                {{ $evaluated->name_carrier_a }}</span>
                        </div>
                        <div class="sutantive-test grid gap-4 grid-cols-4 my-3" id="carrier1">
                            {{-- Control 1 --}}
                            <div
                                class="flex flex-col justify-between max-w-sm p-6 bg-white border border-gray-200 rounded-lg shadow dark:bg-gray-800 dark:border-gray-700">
                                <div>
                                    <h5 class="mb-2 text-2xl font-bold tracking-tight text-gray-900 dark:text-white">Control
                                        inicial
                                    </h5>
                                </div>
                                @if ($evaluated->control_1_a === 'activate')
                                    <div>
                                        <a href="{{ route('admin.judments.judment', [
                                            'control' => 1,
                                            'carrier' => 'a',
                                            'judges' => 8,
                                            'judmentNumber' => 1,
                                            'idEvaluated' => $evaluated->id_evaluated_fragance,
                                        ]) }}"
                                            class="btn-primary inline-flex items-center px-4 py-2 bg-gray-800 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 transition ease-in-out duration-150">
                                            Iniciar
                                        </a>
                                    </div>
                                @elseif ($evaluated->control_1_a === 'finish')
                                    <div class="p-4 mb-4 text-sm text-green-800 rounded-lg bg-green-50 dark:bg-gray-800 dark:text-green-400"
                                        role="alert">
                                        <span class="font-medium">Felicitaciones !</span> Este control ya ha finalizado.
                                    </div>
                                @else
                                    <div class="p-4 mb-4 text-sm text-blue-800 rounded-lg bg-blue-50 dark:bg-gray-800 dark:text-blue-400"
                                        role="alert">
                                        <span class="font-medium">Espera !</span> Aún no se encuentra habilitado este control.
                                    </div>
                                @endif
                            </div>
                            {{-- Control 2 --}}
                            <div
                                class="flex flex-col justify-between max-w-sm p-6 bg-white border border-gray-200 rounded-lg shadow dark:bg-gray-800 dark:border-gray-700">
                                <div>
                                    <h5 class="mb-2 text-2xl font-bold tracking-tight text-gray-900 dark:text-white">Control 3
                                        Hrs
                                    </h5>
                                </div>
                                @if ($evaluated->control_2_a === 'activate')
                                    <div>
                                        <a href="{{ route('admin.judments.judment', [
                                            'control' => 2,
                                            'carrier' => 'a',
                                            'judges' => 8,
                                            'judmentNumber' => 1,
                                            'idEvaluated' => $evaluated->id_evaluated_fragance,
                                        ]) }}"
                                            class="btn-primary inline-flex items-center px-4 py-2 bg-gray-800 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 transition ease-in-out duration-150">
                                            Iniciar
                                        </a>
                                    </div>
                                @elseif ($evaluated->control_2_a === 'finish')
                                    <div class="p-4 mb-4 text-sm text-green-800 rounded-lg bg-green-50 dark:bg-gray-800 dark:text-green-400"
                                        role="alert">
                                        <span class="font-medium">Felicitaciones !</span> Este control ya ha finalizado.
                                    </div>
                                @else
                                    <div class="p-4 mb-4 text-sm text-blue-800 rounded-lg bg-blue-50 dark:bg-gray-800 dark:text-blue-400"
                                        role="alert">
                                        <span class="font-medium">Espera !</span> Aún no se encuentra habilitado este control.
                                    </div>
                                @endif
                            </div>
                            {{-- Control 3 --}}
                            <div
                                class="flex flex-col justify-between max-w-sm p-6 bg-white border border-gray-200 rounded-lg shadow dark:bg-gray-800 dark:border-gray-700">
                                <div>
                                    <h5 class="mb-2 text-2xl font-bold tracking-tight text-gray-900 dark:text-white">Control 4
                                        Hrs
                                        30
                                    </h5>
                                </div>
                                @if ($evaluated->control_3_a === 'activate')
                                    <div>
                                        <a href="{{ route('admin.judments.judment', [
                                            'control' => 3,
                                            'carrier' => 'a',
                                            'judges' => 8,
                                            'judmentNumber' => 1,
                                            'idEvaluated' => $evaluated->id_evaluated_fragance,
                                        ]) }}"
                                            class="btn-primary inline-flex items-center px-4 py-2 bg-gray-800 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 transition ease-in-out duration-150">
                                            Iniciar
                                        </a>
                                    </div>
                                @elseif ($evaluated->control_3_a === 'finish')
                                    <div class="p-4 mb-4 text-sm text-green-800 rounded-lg bg-green-50 dark:bg-gray-800 dark:text-green-400"
                                        role="alert">
                                        <span class="font-medium">Felicitaciones !</span> Este control ya ha finalizado.
                                    </div>
                                @else
                                    <div class="p-4 mb-4 text-sm text-blue-800 rounded-lg bg-blue-50 dark:bg-gray-800 dark:text-blue-400"
                                        role="alert">
                                        <span class="font-medium">Espera !</span> Aún no se encuentra habilitado este control.
                                    </div>
                                @endif
                            </div>
                            {{-- Control 4 --}}
                            <div
                                class="flex flex-col justify-between max-w-sm p-6 bg-white border border-gray-200 rounded-lg shadow dark:bg-gray-800 dark:border-gray-700">
                                <div>
                                    <h5 class="mb-2 text-2xl font-bold tracking-tight text-gray-900 dark:text-white">Control 6
                                        Horas
                                    </h5>
                                </div>
                                @if ($evaluated->control_4_a === 'activate')
                                    <div>
                                        <a href="{{ route('admin.judments.judment', [
                                            'control' => 4,
                                            'carrier' => 'a',
                                            'judges' => 8,
                                            'judmentNumber' => 1,
                                            'idEvaluated' => $evaluated->id_evaluated_fragance,
                                        ]) }}"
                                            class="btn-primary inline-flex items-center px-4 py-2 bg-gray-800 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 transition ease-in-out duration-150">
                                            Iniciar
                                        </a>
                                    </div>
                                @elseif ($evaluated->control_4_a === 'finish')
                                    <div class="p-4 mb-4 text-sm text-green-800 rounded-lg bg-green-50 dark:bg-gray-800 dark:text-green-400"
                                        role="alert">
                                        <span class="font-medium">Felicitaciones !</span> Este control ya ha finalizado.
                                    </div>
                                @else
                                    <div class="p-4 mb-4 text-sm text-blue-800 rounded-lg bg-blue-50 dark:bg-gray-800 dark:text-blue-400"
                                        role="alert">
                                        <span class="font-medium">Espera !</span> Aún no se encuentra habilitado este control.
                                    </div>
                                @endif
                            </div>
                        </div>
                        {{-- Portador 2 --}}
                        <div>
                            <span class="text-teal-500 text-2xl font-semibold capitalize">Pruebas Portador:
                                {{ $evaluated->name_carrier_b }}</span>
                        </div>
                        <div class="sutantive-test grid gap-4 grid-cols-4 my-3" id="carrier2">
                            {{-- Control 1 --}}
                            <div
                                class="flex flex-col justify-between max-w-sm p-6 bg-white border border-gray-200 rounded-lg shadow dark:bg-gray-800 dark:border-gray-700">
                                <div>
                                    <h5 class="mb-2 text-2xl font-bold tracking-tight text-gray-900 dark:text-white">Control
                                        inicial
                                    </h5>
                                </div>
                                @if ($evaluated->control_1_b === 'activate')
                                    <div>
                                        <a href="{{ route('admin.judments.judment', [
                                            'control' => 1,
                                            'carrier' => 'b',
                                            'judges' => 8,
                                            'judmentNumber' => 1,
                                            'idEvaluated' => $evaluated->id_evaluated_fragance,
                                        ]) }}"
                                            class="btn-primary inline-flex items-center px-4 py-2 bg-gray-800 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 transition ease-in-out duration-150">
                                            Iniciar
                                        </a>
                                    </div>
                                @elseif ($evaluated->control_1_b === 'finish')
                                    <div class="p-4 mb-4 text-sm text-green-800 rounded-lg bg-green-50 dark:bg-gray-800 dark:text-green-400"
                                        role="alert">
                                        <span class="font-medium">Felicitaciones !</span> Este control ya ha finalizado.
                                    </div>
                                @else
                                    <div class="p-4 mb-4 text-sm text-blue-800 rounded-lg bg-blue-50 dark:bg-gray-800 dark:text-blue-400"
                                        role="alert">
                                        <span class="font-medium">Espera !</span> Aún no se encuentra habilitado este control.
                                    </div>
                                @endif
                            </div>
                            {{-- Control 2 --}}
                            <div
                                class="flex flex-col justify-between max-w-sm p-6 bg-white border border-gray-200 rounded-lg shadow dark:bg-gray-800 dark:border-gray-700">
                                <div>
                                    <h5 class="mb-2 text-2xl font-bold tracking-tight text-gray-900 dark:text-white">Control 3
                                        Hrs
                                    </h5>
                                </div>
                                @if ($evaluated->control_2_b === 'activate')
                                    <div>
                                        <a href="{{ route('admin.judments.judment', [
                                            'control' => 2,
                                            'carrier' => 'b',
                                            'judges' => 8,
                                            'judmentNumber' => 1,
                                            'idEvaluated' => $evaluated->id_evaluated_fragance,
                                        ]) }}"
                                            class="btn-primary inline-flex items-center px-4 py-2 bg-gray-800 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 transition ease-in-out duration-150">
                                            Iniciar
                                        </a>
                                    </div>
                                @elseif ($evaluated->control_2_b === 'finish')
                                    <div class="p-4 mb-4 text-sm text-green-800 rounded-lg bg-green-50 dark:bg-gray-800 dark:text-green-400"
                                        role="alert">
                                        <span class="font-medium">Felicitaciones !</span> Este control ya ha finalizado.
                                    </div>
                                @else
                                    <div class="p-4 mb-4 text-sm text-blue-800 rounded-lg bg-blue-50 dark:bg-gray-800 dark:text-blue-400"
                                        role="alert">
                                        <span class="font-medium">Espera !</span> Aún no se encuentra habilitado este control.
                                    </div>
                                @endif
                            </div>
                            {{-- Control 3 --}}
                            <div
                                class="flex flex-col justify-between max-w-sm p-6 bg-white border border-gray-200 rounded-lg shadow dark:bg-gray-800 dark:border-gray-700">
                                <div>
                                    <h5 class="mb-2 text-2xl font-bold tracking-tight text-gray-900 dark:text-white">Control 4
                                        Hrs
                                        30
                                    </h5>
                                </div>
                                @if ($evaluated->control_3_b === 'activate')
                                    <div>
                                        <a href="{{ route('admin.judments.judment', [
                                            'control' => 3,
                                            'carrier' => 'b',
                                            'judges' => 8,
                                            'judmentNumber' => 1,
                                            'idEvaluated' => $evaluated->id_evaluated_fragance,
                                        ]) }}"
                                            class="btn-primary inline-flex items-center px-4 py-2 bg-gray-800 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 transition ease-in-out duration-150">
                                            Iniciar
                                        </a>
                                    </div>
                                @elseif ($evaluated->control_3_b === 'finish')
                                    <div class="p-4 mb-4 text-sm text-green-800 rounded-lg bg-green-50 dark:bg-gray-800 dark:text-green-400"
                                        role="alert">
                                        <span class="font-medium">Felicitaciones !</span> Este control ya ha finalizado.
                                    </div>
                                @else
                                    <div class="p-4 mb-4 text-sm text-blue-800 rounded-lg bg-blue-50 dark:bg-gray-800 dark:text-blue-400"
                                        role="alert">
                                        <span class="font-medium">Espera !</span> Aún no se encuentra habilitado este control.
                                    </div>
                                @endif
                            </div>
                            {{-- Control 4 --}}
                            <div
                                class="flex flex-col justify-between max-w-sm p-6 bg-white border border-gray-200 rounded-lg shadow dark:bg-gray-800 dark:border-gray-700">
                                <div>
                                    <h5 class="mb-2 text-2xl font-bold tracking-tight text-gray-900 dark:text-white">Control 6
                                        Horas
                                    </h5>
                                </div>
                                @if ($evaluated->control_4_b === 'activate')
                                    <div>
                                        <a href="{{ route('admin.judments.judment', [
                                            'control' => 4,
                                            'carrier' => 'b',
                                            'judges' => 8,
                                            'judmentNumber' => 1,
                                            'idEvaluated' => $evaluated->id_evaluated_fragance,
                                        ]) }}"
                                            class="btn-primary inline-flex items-center px-4 py-2 bg-gray-800 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 transition ease-in-out duration-150">
                                            Iniciar
                                        </a>
                                    </div>
                                @elseif ($evaluated->control_4_b === 'finish')
                                    <div class="p-4 mb-4 text-sm text-green-800 rounded-lg bg-green-50 dark:bg-gray-800 dark:text-green-400"
                                        role="alert">
                                        <span class="font-medium">Felicitaciones !</span> Este control ya ha finalizado.
                                    </div>
                                @else
                                    <div class="p-4 mb-4 text-sm text-blue-800 rounded-lg bg-blue-50 dark:bg-gray-800 dark:text-blue-400"
                                        role="alert">
                                        <span class="font-medium">Espera !</span> Aún no se encuentra habilitado este control.
                                    </div>
                                @endif
                            </div>
                        </div>
                    @break

                    @case(12)
                        {{-- Portador 1 --}}
                        <div>
                            <span class="text-teal-500 text-2xl font-semibold capitalize">Pruebas Portador:
                                {{ $evaluated->name_carrier_a }}</span>
                        </div>
                        <div class="sutantive-test grid gap-4 grid-cols-4 my-3" id="carrier1">
                            {{-- Control 1 --}}
                            <div
                                class="flex flex-col justify-between max-w-sm p-6 bg-white border border-gray-200 rounded-lg shadow dark:bg-gray-800 dark:border-gray-700">
                                <div>
                                    <h5 class="mb-2 text-2xl font-bold tracking-tight text-gray-900 dark:text-white">Control
                                        inicial
                                    </h5>
                                </div>
                                @if ($evaluated->control_1_a === 'activate')
                                    <div>
                                        <a href="{{ route('admin.judments.judment', [
                                            'control' => 1,
                                            'carrier' => 'a',
                                            'judges' => 12,
                                            'judmentNumber' => 1,
                                            'idEvaluated' => $evaluated->id_evaluated_fragance,
                                        ]) }}"
                                            class="btn-primary inline-flex items-center px-4 py-2 bg-gray-800 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 transition ease-in-out duration-150">
                                            Iniciar
                                        </a>
                                    </div>
                                @elseif ($evaluated->control_1_a === 'finish')
                                    <div class="p-4 mb-4 text-sm text-green-800 rounded-lg bg-green-50 dark:bg-gray-800 dark:text-green-400"
                                        role="alert">
                                        <span class="font-medium">Felicitaciones !</span> Este control ya ha finalizado.
                                    </div>
                                @else
                                    <div class="p-4 mb-4 text-sm text-blue-800 rounded-lg bg-blue-50 dark:bg-gray-800 dark:text-blue-400"
                                        role="alert">
                                        <span class="font-medium">Espera !</span> Aún no se encuentra habilitado este control.
                                    </div>
                                @endif
                            </div>
                            {{-- Control 2 --}}
                            <div
                                class="flex flex-col justify-between max-w-sm p-6 bg-white border border-gray-200 rounded-lg shadow dark:bg-gray-800 dark:border-gray-700">
                                <div>
                                    <h5 class="mb-2 text-2xl font-bold tracking-tight text-gray-900 dark:text-white">Control 3
                                        Hrs
                                    </h5>
                                </div>
                                @if ($evaluated->control_2_a === 'activate')
                                    <div>
                                        <a href="{{ route('admin.judments.judment', [
                                            'control' => 2,
                                            'carrier' => 'a',
                                            'judges' => 12,
                                            'judmentNumber' => 1,
                                            'idEvaluated' => $evaluated->id_evaluated_fragance,
                                        ]) }}"
                                            class="btn-primary inline-flex items-center px-4 py-2 bg-gray-800 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 transition ease-in-out duration-150">
                                            Iniciar
                                        </a>
                                    </div>
                                @elseif ($evaluated->control_2_a === 'finish')
                                    <div class="p-4 mb-4 text-sm text-green-800 rounded-lg bg-green-50 dark:bg-gray-800 dark:text-green-400"
                                        role="alert">
                                        <span class="font-medium">Felicitaciones !</span> Este control ya ha finalizado.
                                    </div>
                                @else
                                    <div class="p-4 mb-4 text-sm text-blue-800 rounded-lg bg-blue-50 dark:bg-gray-800 dark:text-blue-400"
                                        role="alert">
                                        <span class="font-medium">Espera !</span> Aún no se encuentra habilitado este control.
                                    </div>
                                @endif
                            </div>
                            {{-- Control 3 --}}
                            <div
                                class="flex flex-col justify-between max-w-sm p-6 bg-white border border-gray-200 rounded-lg shadow dark:bg-gray-800 dark:border-gray-700">
                                <div>
                                    <h5 class="mb-2 text-2xl font-bold tracking-tight text-gray-900 dark:text-white">Control 4
                                        Hrs
                                        30
                                    </h5>
                                </div>
                                @if ($evaluated->control_3_a === 'activate')
                                    <div>
                                        <a href="{{ route('admin.judments.judment', [
                                            'control' => 3,
                                            'carrier' => 'a',
                                            'judges' => 12,
                                            'judmentNumber' => 1,
                                            'idEvaluated' => $evaluated->id_evaluated_fragance,
                                        ]) }}"
                                            class="btn-primary inline-flex items-center px-4 py-2 bg-gray-800 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 transition ease-in-out duration-150">
                                            Iniciar
                                        </a>
                                    </div>
                                @elseif ($evaluated->control_3_a === 'finish')
                                    <div class="p-4 mb-4 text-sm text-green-800 rounded-lg bg-green-50 dark:bg-gray-800 dark:text-green-400"
                                        role="alert">
                                        <span class="font-medium">Felicitaciones !</span> Este control ya ha finalizado.
                                    </div>
                                @else
                                    <div class="p-4 mb-4 text-sm text-blue-800 rounded-lg bg-blue-50 dark:bg-gray-800 dark:text-blue-400"
                                        role="alert">
                                        <span class="font-medium">Espera !</span> Aún no se encuentra habilitado este control.
                                    </div>
                                @endif
                            </div>
                            {{-- Control 4 --}}
                            <div
                                class="flex flex-col justify-between max-w-sm p-6 bg-white border border-gray-200 rounded-lg shadow dark:bg-gray-800 dark:border-gray-700">
                                <div>
                                    <h5 class="mb-2 text-2xl font-bold tracking-tight text-gray-900 dark:text-white">Control 6
                                        Horas
                                    </h5>
                                </div>
                                @if ($evaluated->control_4_a === 'activate')
                                    <div>
                                        <a href="{{ route('admin.judments.judment', [
                                            'control' => 4,
                                            'carrier' => 'a',
                                            'judges' => 12,
                                            'judmentNumber' => 1,
                                            'idEvaluated' => $evaluated->id_evaluated_fragance,
                                        ]) }}"
                                            class="btn-primary inline-flex items-center px-4 py-2 bg-gray-800 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 transition ease-in-out duration-150">
                                            Iniciar
                                        </a>
                                    </div>
                                @elseif ($evaluated->control_4_a === 'finish')
                                    <div class="p-4 mb-4 text-sm text-green-800 rounded-lg bg-green-50 dark:bg-gray-800 dark:text-green-400"
                                        role="alert">
                                        <span class="font-medium">Felicitaciones !</span> Este control ya ha finalizado.
                                    </div>
                                @else
                                    <div class="p-4 mb-4 text-sm text-blue-800 rounded-lg bg-blue-50 dark:bg-gray-800 dark:text-blue-400"
                                        role="alert">
                                        <span class="font-medium">Espera !</span> Aún no se encuentra habilitado este control.
                                    </div>
                                @endif
                            </div>
                        </div>
                        {{-- Portador 2 --}}
                        <div>
                            <span class="text-teal-500 text-2xl font-semibold capitalize">Pruebas Portador:
                                {{ $evaluated->name_carrier_b }}</span>
                        </div>
                        <div class="sutantive-test grid gap-4 grid-cols-4 my-3" id="carrier2">
                            {{-- Control 1 --}}
                            <div
                                class="flex flex-col justify-between max-w-sm p-6 bg-white border border-gray-200 rounded-lg shadow dark:bg-gray-800 dark:border-gray-700">
                                <div>
                                    <h5 class="mb-2 text-2xl font-bold tracking-tight text-gray-900 dark:text-white">Control
                                        inicial
                                    </h5>
                                </div>
                                @if ($evaluated->control_1_b === 'activate')
                                    <div>
                                        <a href="{{ route('admin.judments.judment', [
                                            'control' => 1,
                                            'carrier' => 'b',
                                            'judges' => 12,
                                            'judmentNumber' => 1,
                                            'idEvaluated' => $evaluated->id_evaluated_fragance,
                                        ]) }}"
                                            class="btn-primary inline-flex items-center px-4 py-2 bg-gray-800 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 transition ease-in-out duration-150">
                                            Iniciar
                                        </a>
                                    </div>
                                @elseif ($evaluated->control_1_b === 'finish')
                                    <div class="p-4 mb-4 text-sm text-green-800 rounded-lg bg-green-50 dark:bg-gray-800 dark:text-green-400"
                                        role="alert">
                                        <span class="font-medium">Felicitaciones !</span> Este control ya ha finalizado.
                                    </div>
                                @else
                                    <div class="p-4 mb-4 text-sm text-blue-800 rounded-lg bg-blue-50 dark:bg-gray-800 dark:text-blue-400"
                                        role="alert">
                                        <span class="font-medium">Espera !</span> Aún no se encuentra habilitado este control.
                                    </div>
                                @endif
                            </div>
                            {{-- Control 2 --}}
                            <div
                                class="flex flex-col justify-between max-w-sm p-6 bg-white border border-gray-200 rounded-lg shadow dark:bg-gray-800 dark:border-gray-700">
                                <div>
                                    <h5 class="mb-2 text-2xl font-bold tracking-tight text-gray-900 dark:text-white">Control 3
                                        Hrs
                                    </h5>
                                </div>
                                @if ($evaluated->control_2_b === 'activate')
                                    <div>
                                        <a href="{{ route('admin.judments.judment', [
                                            'control' => 2,
                                            'carrier' => 'b',
                                            'judges' => 12,
                                            'judmentNumber' => 1,
                                            'idEvaluated' => $evaluated->id_evaluated_fragance,
                                        ]) }}"
                                            class="btn-primary inline-flex items-center px-4 py-2 bg-gray-800 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 transition ease-in-out duration-150">
                                            Iniciar
                                        </a>
                                    </div>
                                @elseif ($evaluated->control_2_b === 'finish')
                                    <div class="p-4 mb-4 text-sm text-green-800 rounded-lg bg-green-50 dark:bg-gray-800 dark:text-green-400"
                                        role="alert">
                                        <span class="font-medium">Felicitaciones !</span> Este control ya ha finalizado.
                                    </div>
                                @else
                                    <div class="p-4 mb-4 text-sm text-blue-800 rounded-lg bg-blue-50 dark:bg-gray-800 dark:text-blue-400"
                                        role="alert">
                                        <span class="font-medium">Espera !</span> Aún no se encuentra habilitado este control.
                                    </div>
                                @endif
                            </div>
                            {{-- Control 3 --}}
                            <div
                                class="flex flex-col justify-between max-w-sm p-6 bg-white border border-gray-200 rounded-lg shadow dark:bg-gray-800 dark:border-gray-700">
                                <div>
                                    <h5 class="mb-2 text-2xl font-bold tracking-tight text-gray-900 dark:text-white">Control 4
                                        Hrs
                                        30
                                    </h5>
                                </div>
                                @if ($evaluated->control_3_b === 'activate')
                                    <div>
                                        <a href="{{ route('admin.judments.judment', [
                                            'control' => 3,
                                            'carrier' => 'b',
                                            'judges' => 12,
                                            'judmentNumber' => 1,
                                            'idEvaluated' => $evaluated->id_evaluated_fragance,
                                        ]) }}"
                                            class="btn-primary inline-flex items-center px-4 py-2 bg-gray-800 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 transition ease-in-out duration-150">
                                            Iniciar
                                        </a>
                                    </div>
                                @elseif ($evaluated->control_3_b === 'finish')
                                    <div class="p-4 mb-4 text-sm text-green-800 rounded-lg bg-green-50 dark:bg-gray-800 dark:text-green-400"
                                        role="alert">
                                        <span class="font-medium">Felicitaciones !</span> Este control ya ha finalizado.
                                    </div>
                                @else
                                    <div class="p-4 mb-4 text-sm text-blue-800 rounded-lg bg-blue-50 dark:bg-gray-800 dark:text-blue-400"
                                        role="alert">
                                        <span class="font-medium">Espera !</span> Aún no se encuentra habilitado este control.
                                    </div>
                                @endif
                            </div>
                            {{-- Control 4 --}}
                            <div
                                class="flex flex-col justify-between max-w-sm p-6 bg-white border border-gray-200 rounded-lg shadow dark:bg-gray-800 dark:border-gray-700">
                                <div>
                                    <h5 class="mb-2 text-2xl font-bold tracking-tight text-gray-900 dark:text-white">Control 6
                                        Horas
                                    </h5>
                                </div>
                                @if ($evaluated->control_4_b === 'activate')
                                    <div>
                                        <a href="{{ route('admin.judments.judment', [
                                            'control' => 4,
                                            'carrier' => 'b',
                                            'judges' => 12,
                                            'judmentNumber' => 1,
                                            'idEvaluated' => $evaluated->id_evaluated_fragance,
                                        ]) }}"
                                            class="btn-primary inline-flex items-center px-4 py-2 bg-gray-800 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 transition ease-in-out duration-150">
                                            Iniciar
                                        </a>
                                    </div>
                                @elseif ($evaluated->control_4_b === 'finish')
                                    <div class="p-4 mb-4 text-sm text-green-800 rounded-lg bg-green-50 dark:bg-gray-800 dark:text-green-400"
                                        role="alert">
                                        <span class="font-medium">Felicitaciones !</span> Este control ya ha finalizado.
                                    </div>
                                @else
                                    <div class="p-4 mb-4 text-sm text-blue-800 rounded-lg bg-blue-50 dark:bg-gray-800 dark:text-blue-400"
                                        role="alert">
                                        <span class="font-medium">Espera !</span> Aún no se encuentra habilitado este control.
                                    </div>
                                @endif
                            </div>
                        </div>
                    @break
                @endswitch
                
            @endforeach
        @else
            <div class="p-4 mb-4 text-sm text-yellow-800 rounded-lg bg-yellow-50 dark:bg-gray-800 dark:text-yellow-300"
                role="alert">
                <span class="font-medium">Mensaje: </span> En este momento no hay evaluaciones pendientes
            </div>
        @endif

        {{ $evaluateds->links() }}
    </div>
</div>

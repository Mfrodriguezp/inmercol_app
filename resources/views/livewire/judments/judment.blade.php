<div>
    <div class="header flex justify-between items-center mb-4">
        <div class="title basis-3/5">
            <span class="title">{{ $title }}</span>
        </div>
        {{-- Alert --}}
        @if (!is_null($message))
            <div id="alert-3"
                class="fixed right-20 flex items-center p-4 mb-4 text-green-800 rounded-lg bg-green-50 dark:bg-gray-800 dark:text-green-400"
                role="alert">
                <svg class="flex-shrink-0 w-4 h-4" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor"
                    viewBox="0 0 20 20">
                    <path
                        d="M10 .5a9.5 9.5 0 1 0 9.5 9.5A9.51 9.51 0 0 0 10 .5ZM9.5 4a1.5 1.5 0 1 1 0 3 1.5 1.5 0 0 1 0-3ZM12 15H8a1 1 0 0 1 0-2h1v-3H8a1 1 0 0 1 0-2h2a1 1 0 0 1 1 1v4h1a1 1 0 0 1 0 2Z" />
                </svg>
                <span class="sr-only">Info</span>
                <div class="ms-3 text-sm font-medium">
                    {{ $message }}
                </div>
                <button type="button"
                    class="ms-auto -mx-1.5 -my-1.5 bg-green-50 text-green-500 rounded-lg focus:ring-2 focus:ring-green-400 p-1.5 hover:bg-green-200 inline-flex items-center justify-center h-8 w-8 dark:bg-gray-800 dark:text-green-400 dark:hover:bg-gray-700"
                    data-dismiss-target="#alert-3" aria-label="Close">
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
    <div class="">
        <form action="{{ action('App\Http\Controllers\Admin\JudmentController@saveJudment') }}" method="POST">
            @csrf
            <div class="flex justify-between first-section" id="first-section">
                <div class="">
                    {{-- <input type="text" name="judge_name" id="judge_name" value="{{ $judge->judge_name }}"
                            class="block pt-5 pb-1 px-0 w-full text-sm text-gray-900 bg-transparent border-0 border-b-2 border-gray-300 appearance-none dark:text-white dark:border-gray-600 dark:focus:border-blue-500 focus:outline-none focus:ring-0 focus:border-blue-600 peer"
                            disabled />
                        <label for="judge_name"
                            class="peer-focus:font-medium absolute text-xl text-gray-500 dark:text-gray-400 duration-300 transform -translate-y-6 scale-75 top-3 -z-10 origin-[0] peer-focus:start-0 rtl:peer-focus:translate-x-1/4 rtl:peer-focus:left-auto peer-focus:text-blue-600 peer-focus:dark:text-blue-500 peer-placeholder-shown:scale-100 peer-placeholder-shown:translate-y-0 peer-focus:scale-75 peer-focus:-translate-y-6">Nombre
                            del Juez</label> --}}
                    <strong>Nombre del juez : </strong><span class="capitalize">{{ $judge->judge_name }}</span>
                </div>
                <div>
                    <span class="text-teal-500 text-2xl font-semibold capitalize">Portador:
                        {{ $carrier === 'a' ? $evaluated->nombre_portador_a : $evaluated->nombre_portador_b }}</span>
                </div>
                <div class="">
                    {{-- <input type="text" name="judge_number" value="{{ $judge->judge_number }}"
                            class="block pt-5 pb-1 px-0 w-full text-sm text-gray-900 bg-transparent border-0 border-b-2 border-gray-300 appearance-none dark:text-white dark:border-gray-600 dark:focus:border-blue-500 focus:outline-none focus:ring-0 focus:border-blue-600 peer"
                            disabled />
                        <label for="judge_name"
                            class="peer-focus:font-medium absolute text-xl text-gray-500 dark:text-gray-400 duration-300 transform -translate-y-6 scale-75 top-3 -z-10 origin-[0] peer-focus:start-0 rtl:peer-focus:translate-x-1/4 rtl:peer-focus:left-auto peer-focus:text-blue-600 peer-focus:dark:text-blue-500 peer-placeholder-shown:scale-100 peer-placeholder-shown:translate-y-0 peer-focus:scale-75 peer-focus:-translate-y-6">Número
                            de Juez</label> --}}
                    <strong>Número de Juez: </strong><span class="capitalize">{{ $judge->judge_number }}</span>
                </div>
            </div>
            <div>
                <div class="">
                    <input type="hidden" name="carrier" value="{{ $carrier }}">
                </div>
                <div class="div">
                    <input type="hidden" name="carrier_name"
                        value="{{ $carrier === 'a' ? $evaluated->nombre_portador_a : $evaluated->nombre_portador_b }}">
                </div>
                <div class="">
                    <input type="hidden" name="counter" value="{{ $counter }}">
                </div>
                <div class="">
                    <input type="hidden" name="id_proyecto" value="{{ $evaluated->id_proyecto }}">
                </div>
                <div class="">
                    <input type="hidden" name="id_judge" value="{{ $judge->id_judge }}">
                </div>
                <div class="">
                    <input type="hidden" name="id_evaluated_fragance" value="{{ $evaluated->id_evaluated_fragance }}">
                </div>
                <div class="">
                    <input type="hidden" name="marking_type" value="{{ $control }}">
                </div>
                <div class="">
                    <input type="hidden" name="number_judges" value="{{ $number_judges }}">
                </div>
            </div>
            <div class="second-section">
                <div class="mb-2">
                    <span class="text-teal-500 text-xl font-semibold"
                        aria-describedby="helper-text-explanation">Marcación</span>
                    <p id="helper-text-explanation" class="mt-2 text-sm text-gray-500 dark:text-gray-400">Por favor
                        expresar su percepción de intensidad moviendo la línea que se muestra sobre la escala LMS.</p>
                </div>
                @if ($brazo_inicial === 'derecho')
                    @if ($carrier === 'a')
                        <div id="code1" class="my-4 quality grid grid-cols-1">
                            <div class="flex justify-between">
                                <div class="mb-4">
                                    <strong>Brazo inicial : </strong><span
                                        class="capitalize">{{ $brazo_inicial }}</span>
                                </div>
                                <div class="mb-4">
                                    <input type="hidden" name="fragance_code_test_1"
                                        value="{{ $codigo_brazo_derecho === $evaluated->codigo_portador_a_fragancia_1 ? $evaluated->codigo_test_fragancia_1 : $evaluated->codigo_test_fragancia_2 }}" />
                                </div>
                                <div>
                                    <strong>Código : </strong><span
                                        class="">{{ $brazo_inicial === 'derecho' ? $evaluated->codigo_brazo_derecho : $evaluated->codigo_brazo_izquierdo }}</span>
                                </div>
                            </div>
                            <div class="m-auto">
                                <input type="range" min="0" max="20" value="0.50" name="quality_1"
                                    class="range block" step="0.05" />
                                <div class="scala">
                                    <div class="markingA">
                                        <div class="numero">A<div class="linea"></div>
                                        </div>
                                    </div>
                                    <div class="markingB">
                                        <div class="numero">B<div class="linea"></div>
                                        </div>
                                    </div>
                                    <div class="markingC">
                                        <div class="numero">C<div class="linea"></div>
                                        </div>
                                    </div>
                                    <div class="markingD">
                                        <div class="numero">D<div class="linea"></div>
                                        </div>
                                    </div>
                                    <div class="markingE">
                                        <div class="numero">E<div class="linea"></div>
                                        </div>
                                    </div>
                                    <div class="markingF">
                                        <div class="numero">F<div class="linea"></div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div id="code2" class="my-4 quality grid grid-cols-1">
                            <div class="flex justify-between">
                                <div class="mb-4">
                                    <strong>Brazo final : </strong><span class="capitalize">izquierdo</span>
                                </div>
                                <div class="mb-4">
                                    <input type="hidden" name="fragance_code_test_2"
                                        value="{{ $codigo_brazo_izquierdo === $evaluated->codigo_portador_a_fragancia_1 ? $evaluated->codigo_test_fragancia_1 : $evaluated->codigo_test_fragancia_2 }}" />
                                </div>
                                <div>
                                    <strong>Código : </strong><span
                                        class="capitalize">{{ $evaluated->codigo_brazo_izquierdo }}</span>
                                </div>
                            </div>
                            <div class="m-auto">
                                <input type="range" min="0" max="20" value="0" name="quality_2"
                                    class="range block" step="0.05" />
                                <div class="scala">
                                    <div class="markingA">
                                        <div class="numero">A<div class="linea"></div>
                                        </div>
                                    </div>
                                    <div class="markingB">
                                        <div class="numero">B<div class="linea"></div>
                                        </div>
                                    </div>
                                    <div class="markingC">
                                        <div class="numero">C<div class="linea"></div>
                                        </div>
                                    </div>
                                    <div class="markingD">
                                        <div class="numero">D<div class="linea"></div>
                                        </div>
                                    </div>
                                    <div class="markingE">
                                        <div class="numero">E<div class="linea"></div>
                                        </div>
                                    </div>
                                    <div class="markingF">
                                        <div class="numero">F<div class="linea"></div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @else
                        <div id="code1" class="my-4 quality grid grid-cols-1">
                            <div class="flex justify-between">
                                <div class="mb-4">
                                    <strong>Brazo inicial : </strong><span
                                        class="capitalize">{{ $brazo_inicial }}</span>
                                </div>
                                <div class="mb-4">
                                    <input type="hidden" name="fragance_code_test_1"
                                        value="{{ $codigo_brazo_derecho === $evaluated->codigo_portador_b_fragancia_1 ? $evaluated->codigo_test_fragancia_1 : $evaluated->codigo_test_fragancia_2 }}" />
                                </div>
                                <div>
                                    <strong>Código : </strong><span
                                        class="capitalize">{{ $brazo_inicial === 'derecho' ? $evaluated->codigo_brazo_derecho : $evaluated->codigo_brazo_izquierdo }}</span>
                                </div>
                            </div>
                            <div class="m-auto">
                                <input type="range" min="0" max="20" value="0.50" name="quality_1"
                                    class="range block" step="0.05" />
                                <div class="scala">
                                    <div class="markingA">
                                        <div class="numero">A<div class="linea"></div>
                                        </div>
                                    </div>
                                    <div class="markingB">
                                        <div class="numero">B<div class="linea"></div>
                                        </div>
                                    </div>
                                    <div class="markingC">
                                        <div class="numero">C<div class="linea"></div>
                                        </div>
                                    </div>
                                    <div class="markingD">
                                        <div class="numero">D<div class="linea"></div>
                                        </div>
                                    </div>
                                    <div class="markingE">
                                        <div class="numero">E<div class="linea"></div>
                                        </div>
                                    </div>
                                    <div class="markingF">
                                        <div class="numero">F<div class="linea"></div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div id="code2" class="my-4 quality grid grid-cols-1">
                            <div class="flex justify-between">
                                <div class="mb-4">
                                    <strong>Brazo final : </strong><span class="capitalize">izquierdo</span>
                                </div>
                                <div class="mb-4">
                                    <input type="hidden" name="fragance_code_test_2"
                                        value="{{ $codigo_brazo_izquierdo === $evaluated->codigo_portador_b_fragancia_1 ? $evaluated->codigo_test_fragancia_1 : $evaluated->codigo_test_fragancia_2 }}" />
                                </div>
                                <div>
                                    <strong>Código : </strong><span
                                        class="capitalize">{{ $evaluated->codigo_brazo_izquierdo }}</span>
                                </div>
                            </div>
                            <div class="m-auto">
                                <input type="range" min="0" max="20" value="0" name="quality_2"
                                    class="range block" id="rango" step="0.05" />
                                <div class="scala">
                                    <div class="markingA">
                                        <div class="numero">A<div class="linea"></div>
                                        </div>
                                    </div>
                                    <div class="markingB">
                                        <div class="numero">B<div class="linea"></div>
                                        </div>
                                    </div>
                                    <div class="markingC">
                                        <div class="numero">C<div class="linea"></div>
                                        </div>
                                    </div>
                                    <div class="markingD">
                                        <div class="numero">D<div class="linea"></div>
                                        </div>
                                    </div>
                                    <div class="markingE">
                                        <div class="numero">E<div class="linea"></div>
                                        </div>
                                    </div>
                                    <div class="markingF">
                                        <div class="numero">F<div class="linea"></div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endif
                @else
                    @if ($carrier === 'a')
                        <div id="code1" class="my-4 quality grid grid-cols-1">
                            <div class="flex justify-between">
                                <div class="mb-4">
                                    <strong>Brazo inicial : </strong><span
                                        class="capitalize">{{ $brazo_inicial }}</span>
                                </div>
                                <div class="mb-4">
                                    <input type="hidden" name="fragance_code_test_1"
                                        value="{{ $codigo_brazo_izquierdo === $evaluated->codigo_portador_a_fragancia_2 ? $evaluated->codigo_test_fragancia_2 : $evaluated->codigo_test_fragancia_1 }}" />
                                </div>
                                <div>
                                    <strong>Código : </strong><span
                                        class="capitalize">{{ $brazo_inicial === 'izquierdo' ? $evaluated->codigo_brazo_izquierdo : $evaluated->codigo_brazo_derecho }}</span>
                                </div>
                            </div>
                            <div class="m-auto">
                                <input type="range" min="0" max="20" value="0" name="quality_1"
                                    class="range block" id="rango" step="0.05" />
                                <div class="scala">
                                    <div class="markingA">
                                        <div class="numero">A<div class="linea"></div>
                                        </div>
                                    </div>
                                    <div class="markingB">
                                        <div class="numero">B<div class="linea"></div>
                                        </div>
                                    </div>
                                    <div class="markingC">
                                        <div class="numero">C<div class="linea"></div>
                                        </div>
                                    </div>
                                    <div class="markingD">
                                        <div class="numero">D<div class="linea"></div>
                                        </div>
                                    </div>
                                    <div class="markingE">
                                        <div class="numero">E<div class="linea"></div>
                                        </div>
                                    </div>
                                    <div class="markingF">
                                        <div class="numero">F<div class="linea"></div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div id="code2" class="my-4 quality grid grid-cols-1">
                            <div class="flex justify-between">
                                <div class="mb-4">
                                    <strong>Brazo final : </strong><span class="capitalize">derecho</span>
                                </div>
                                <div class="mb-4">
                                    <input type="hidden" name="fragance_code_test_2"
                                        value="{{ $codigo_brazo_derecho === $evaluated->codigo_portador_a_fragancia_2 ? $evaluated->codigo_test_fragancia_2 : $evaluated->codigo_test_fragancia_1 }}" />
                                </div>
                                <div>
                                    <strong>Código : </strong><span
                                        class="">{{ $evaluated->codigo_brazo_derecho }}</span>
                                </div>
                            </div>
                            <div class="m-auto">
                                <input type="range" min="0" max="20" value="0" name="quality_2"
                                    class="range block" id="rango" step="0.05" />
                                <div class="scala">
                                    <div class="markingA">
                                        <div class="numero">A<div class="linea"></div>
                                        </div>
                                    </div>
                                    <div class="markingB">
                                        <div class="numero">B<div class="linea"></div>
                                        </div>
                                    </div>
                                    <div class="markingC">
                                        <div class="numero">C<div class="linea"></div>
                                        </div>
                                    </div>
                                    <div class="markingD">
                                        <div class="numero">D<div class="linea"></div>
                                        </div>
                                    </div>
                                    <div class="markingE">
                                        <div class="numero">E<div class="linea"></div>
                                        </div>
                                    </div>
                                    <div class="markingF">
                                        <div class="numero">F<div class="linea"></div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @else
                        <div id="code1" class="my-4 quality grid grid-cols-1">
                            <div class="flex justify-between">
                                <div class="mb-4">
                                    <strong>Brazo inicial : </strong><span
                                        class="capitalize">{{ $brazo_inicial }}</span>
                                </div>
                                <div class="mb-4">
                                    <input type="hidden" name="fragance_code_test_1"
                                        value="{{ $codigo_brazo_izquierdo === $evaluated->codigo_portador_b_fragancia_2 ? $evaluated->codigo_test_fragancia_2 : $evaluated->codigo_test_fragancia_1 }}" />
                                </div>
                                <div>
                                    <strong>Código : </strong><span
                                        class="">{{ $brazo_inicial === 'izquierdo' ? $evaluated->codigo_brazo_izquierdo : $evaluated->codigo_brazo_derecho }}</span>
                                </div>
                            </div>
                            <div class="m-auto">
                                <input type="range" min="0" max="20" value="0" name="quality_1"
                                    class="range block" id="rango" step="0.05" />
                                <div class="scala">
                                    <div class="markingA">
                                        <div class="numero">A<div class="linea"></div>
                                        </div>
                                    </div>
                                    <div class="markingB">
                                        <div class="numero">B<div class="linea"></div>
                                        </div>
                                    </div>
                                    <div class="markingC">
                                        <div class="numero">C<div class="linea"></div>
                                        </div>
                                    </div>
                                    <div class="markingD">
                                        <div class="numero">D<div class="linea"></div>
                                        </div>
                                    </div>
                                    <div class="markingE">
                                        <div class="numero">E<div class="linea"></div>
                                        </div>
                                    </div>
                                    <div class="markingF">
                                        <div class="numero">F<div class="linea"></div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div id="code2" class="my-4 quality grid grid-cols-1">
                            <div class="flex justify-between">
                                <div class="mb-4">
                                    <strong>Brazo final : </strong><span class="capitalize">derecho</span>
                                </div>
                                <div class="mb-4">
                                    <input type="hidden" name="fragance_code_test_2"
                                        value="{{ $codigo_brazo_derecho === $evaluated->codigo_portador_b_fragancia_2 ? $evaluated->codigo_test_fragancia_2 : $evaluated->codigo_test_fragancia_1 }}" />
                                </div>
                                <div>
                                    <strong>Código : </strong><span
                                        class="uppercase">{{ $evaluated->codigo_brazo_derecho }}</span>
                                </div>
                            </div>
                            <div class="m-auto">
                                <input type="range" min="0" max="20" value="0" name="quality_2"
                                    class="range block" id="rango" step="0.05" />
                                <div class="scala">
                                    <div class="markingA">
                                        <div class="numero">A<div class="linea"></div>
                                        </div>
                                    </div>
                                    <div class="markingB">
                                        <div class="numero">B<div class="linea"></div>
                                        </div>
                                    </div>
                                    <div class="markingC">
                                        <div class="numero">C<div class="linea"></div>
                                        </div>
                                    </div>
                                    <div class="markingD">
                                        <div class="numero">D<div class="linea"></div>
                                        </div>
                                    </div>
                                    <div class="markingE">
                                        <div class="numero">E<div class="linea"></div>
                                        </div>
                                    </div>
                                    <div class="markingF">
                                        <div class="numero">F<div class="linea"></div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endif
                @endif
                <div class="footer flex justify-between items-center">
                    <div class="flex justify-between basis-3/5">
                        <span class="block text-xs">Escala: </span>
                        <span class="block text-xs">A= Ligeramente suave</span>
                        <span class="block text-xs">B= Suave</span>
                        <span class="block text-xs">C= Moderado</span>
                        <span class="block text-xs">D= Fuerte</span>
                        <span class="block text-xs">E= Muy Fuerte</span>
                        <span class="block text-xs">F= Extremo Fuerte</span>
                    </div>
                    <x-button>
                        Registrar Prueba
                    </x-button>
                </div>
            </div>
        </form>
    </div>
</div>

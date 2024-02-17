<div>
    <div class="header flex items-center mb-4">
        <div class="title basis-3/5">
            <span class="title">{{ $title }}</span>
        </div>
    </div>
    <div class="">
        <form action="{{ action('App\Http\Controllers\Admin\JudmentController@saveJudment') }}" method="POST">
            @csrf
            <div class="flex justify-between first-section" id="first-section">
                <div class="">
                    <div class="relative z-0 w-full mb-5 group">
                        <input type="text" name="judge_name" id="judge_name" value="{{ $judge->judge_name }}"
                            class="block pt-5 pb-1 px-0 w-full text-sm text-gray-900 bg-transparent border-0 border-b-2 border-gray-300 appearance-none dark:text-white dark:border-gray-600 dark:focus:border-blue-500 focus:outline-none focus:ring-0 focus:border-blue-600 peer"
                            disabled />
                        <label for="judge_name"
                            class="peer-focus:font-medium absolute text-xl text-gray-500 dark:text-gray-400 duration-300 transform -translate-y-6 scale-75 top-3 -z-10 origin-[0] peer-focus:start-0 rtl:peer-focus:translate-x-1/4 rtl:peer-focus:left-auto peer-focus:text-blue-600 peer-focus:dark:text-blue-500 peer-placeholder-shown:scale-100 peer-placeholder-shown:translate-y-0 peer-focus:scale-75 peer-focus:-translate-y-6">Nombre
                            del Juez</label>
                    </div>
                </div>
                <div>
                    <span class="text-teal-500 text-2xl font-semibold capitalize">Portador {{ $carrier }}</span>
                </div>
                <div class="">
                    <div class="relative z-0 w-full mb-5 group">
                        <input type="text" value="{{ $judge->judge_number }}"
                            class="block pt-5 pb-1 px-0 w-full text-sm text-gray-900 bg-transparent border-0 border-b-2 border-gray-300 appearance-none dark:text-white dark:border-gray-600 dark:focus:border-blue-500 focus:outline-none focus:ring-0 focus:border-blue-600 peer"
                            disabled />
                        <label for="id_judge"
                            class="peer-focus:font-medium absolute text-xl text-gray-500 dark:text-gray-400 duration-300 transform -translate-y-6 scale-75 top-3 -z-10 origin-[0] peer-focus:start-0 rtl:peer-focus:translate-x-1/4 rtl:peer-focus:left-auto peer-focus:text-blue-600 peer-focus:dark:text-blue-500 peer-placeholder-shown:scale-100 peer-placeholder-shown:translate-y-0 peer-focus:scale-75 peer-focus:-translate-y-6">Número
                            de Juez</label>
                    </div>
                </div>
            </div>
            <div>
                <div class="">
                    <input type="hidden" name="carrier" value="{{ $carrier }}">
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
                        <div id="code1" class="my-6 quality grid grid-cols-1">
                            <div class="flex justify-between">
                                <div class="mb-4">
                                    <div class="relative z-0 w-full mb-5 group">
                                        <input type="text" name="first_arm" id="first_arm"
                                            value="{{ $brazo_inicial }}"
                                            class="block capitalize pt-5 pb-1 px-0 w-full text-sm text-gray-900 bg-transparent border-0 border-b-2 border-gray-300 appearance-none dark:text-white dark:border-gray-600 dark:focus:border-blue-500 focus:outline-none focus:ring-0 focus:border-blue-600 peer"
                                            disabled />
                                        <label for="first_arm"
                                            class="peer-focus:font-medium absolute text-xl text-gray-500 dark:text-gray-400 duration-300 transform -translate-y-6 scale-75 top-3 -z-10 origin-[0] peer-focus:start-0 rtl:peer-focus:translate-x-1/4 rtl:peer-focus:left-auto peer-focus:text-blue-600 peer-focus:dark:text-blue-500 peer-placeholder-shown:scale-100 peer-placeholder-shown:translate-y-0 peer-focus:scale-75 peer-focus:-translate-y-6">Brazo
                                            inicial</label>
                                    </div>
                                </div>
                                <div class="mb-4">
                                    <input type="text" name="fragance_code_test_1"
                                        value="{{ $codigo_brazo_derecho === $evaluated->codigo_portador_a_fragancia_1 ? $evaluated->codigo_test_fragancia_1 : $evaluated->codigo_test_fragancia_2 }}" />
                                </div>
                                <div>
                                    <div class="relative z-0 w-full mb-5 group">
                                        <input type="text"
                                            value="{{ $brazo_inicial === 'derecho' ? $evaluated->codigo_brazo_derecho : $evaluated->codigo_brazo_izquierdo }}"
                                            class="block pt-5 pb-1 px-0 w-full text-sm text-gray-900 bg-transparent border-0 border-b-2 border-gray-300 appearance-none dark:text-white dark:border-gray-600 dark:focus:border-blue-500 focus:outline-none focus:ring-0 focus:border-blue-600 peer"
                                            disabled />
                                        <label for="first_arm"
                                            class="peer-focus:font-medium absolute text-xl text-gray-500 dark:text-gray-400 duration-300 transform -translate-y-6 scale-75 top-3 -z-10 origin-[0] peer-focus:start-0 rtl:peer-focus:translate-x-1/4 rtl:peer-focus:left-auto peer-focus:text-blue-600 peer-focus:dark:text-blue-500 peer-placeholder-shown:scale-100 peer-placeholder-shown:translate-y-0 peer-focus:scale-75 peer-focus:-translate-y-6">Código</label>
                                    </div>
                                </div>
                            </div>
                            <div class="m-auto">
                                <input type="range" name="quality_1" class="range block" id="rango"
                                    step="0.05" />
                                <div class="scala">
                                    escala
                                </div>
                            </div>
                        </div>
                        <div id="code2" class="my-6 quality grid grid-cols-1">
                            <div class="flex justify-between">
                                <div class="mb-4">
                                    <div class="relative z-0 w-full mb-5 group">
                                        <input type="text" name="seconds_arm" value="Izquierdo"
                                            class="block capitalize pt-5 pb-1 px-0 w-full text-sm text-gray-900 bg-transparent border-0 border-b-2 border-gray-300 appearance-none dark:text-white dark:border-gray-600 dark:focus:border-blue-500 focus:outline-none focus:ring-0 focus:border-blue-600 peer"
                                            disabled />
                                        <label for="seconds_arm"
                                            class="peer-focus:font-medium absolute text-xl text-gray-500 dark:text-gray-400 duration-300 transform -translate-y-6 scale-75 top-3 -z-10 origin-[0] peer-focus:start-0 rtl:peer-focus:translate-x-1/4 rtl:peer-focus:left-auto peer-focus:text-blue-600 peer-focus:dark:text-blue-500 peer-placeholder-shown:scale-100 peer-placeholder-shown:translate-y-0 peer-focus:scale-75 peer-focus:-translate-y-6">Brazo
                                            Final</label>
                                    </div>
                                </div>
                                <div class="mb-4">
                                    <input type="text" name="fragance_code_test_2"
                                        value="{{ $codigo_brazo_izquierdo === $evaluated->codigo_portador_a_fragancia_1 ? $evaluated->codigo_test_fragancia_1 : $evaluated->codigo_test_fragancia_2 }}" />
                                </div>
                                <div>
                                    <div class="relative z-0 w-full mb-5 group">
                                        <input type="text" value="{{ $evaluated->codigo_brazo_izquierdo }}"
                                            class="block pt-5 pb-1 px-0 w-full text-sm text-gray-900 bg-transparent border-0 border-b-2 border-gray-300 appearance-none dark:text-white dark:border-gray-600 dark:focus:border-blue-500 focus:outline-none focus:ring-0 focus:border-blue-600 peer"
                                            disabled />
                                        <label for="first_arm"
                                            class="peer-focus:font-medium absolute text-xl text-gray-500 dark:text-gray-400 duration-300 transform -translate-y-6 scale-75 top-3 -z-10 origin-[0] peer-focus:start-0 rtl:peer-focus:translate-x-1/4 rtl:peer-focus:left-auto peer-focus:text-blue-600 peer-focus:dark:text-blue-500 peer-placeholder-shown:scale-100 peer-placeholder-shown:translate-y-0 peer-focus:scale-75 peer-focus:-translate-y-6">Código</label>
                                    </div>
                                </div>
                            </div>
                            <div class="m-auto">
                                <input type="range" name="quality_2" class="range block" id="rango"
                                    step="0.05" />
                                <div class="scala">
                                    escala
                                </div>
                            </div>
                        </div>
                    @else
                        <div id="code1" class="my-6 quality grid grid-cols-1">
                            <div class="flex justify-between">
                                <div class="mb-4">
                                    <div class="relative z-0 w-full mb-5 group">
                                        <input type="text" name="first_arm" id="first_arm"
                                            value="{{ $brazo_inicial }}"
                                            class="block capitalize pt-5 pb-1 px-0 w-full text-sm text-gray-900 bg-transparent border-0 border-b-2 border-gray-300 appearance-none dark:text-white dark:border-gray-600 dark:focus:border-blue-500 focus:outline-none focus:ring-0 focus:border-blue-600 peer"
                                            disabled />
                                        <label for="first_arm"
                                            class="peer-focus:font-medium absolute text-xl text-gray-500 dark:text-gray-400 duration-300 transform -translate-y-6 scale-75 top-3 -z-10 origin-[0] peer-focus:start-0 rtl:peer-focus:translate-x-1/4 rtl:peer-focus:left-auto peer-focus:text-blue-600 peer-focus:dark:text-blue-500 peer-placeholder-shown:scale-100 peer-placeholder-shown:translate-y-0 peer-focus:scale-75 peer-focus:-translate-y-6">Brazo
                                            inicial</label>
                                    </div>
                                </div>
                                <div class="mb-4">
                                    <input type="text" name="fragance_code_test_1"
                                        value="{{ $codigo_brazo_derecho === $evaluated->codigo_portador_b_fragancia_1 ? $evaluated->codigo_test_fragancia_1 : $evaluated->codigo_test_fragancia_2 }}" />
                                </div>
                                <div>
                                    <div class="relative z-0 w-full mb-5 group">
                                        <input type="text"
                                            value="{{ $brazo_inicial === 'derecho' ? $evaluated->codigo_brazo_derecho : $evaluated->codigo_brazo_izquierdo }}"
                                            class="block pt-5 pb-1 px-0 w-full text-sm text-gray-900 bg-transparent border-0 border-b-2 border-gray-300 appearance-none dark:text-white dark:border-gray-600 dark:focus:border-blue-500 focus:outline-none focus:ring-0 focus:border-blue-600 peer"
                                            disabled />
                                        <label for="first_arm"
                                            class="peer-focus:font-medium absolute text-xl text-gray-500 dark:text-gray-400 duration-300 transform -translate-y-6 scale-75 top-3 -z-10 origin-[0] peer-focus:start-0 rtl:peer-focus:translate-x-1/4 rtl:peer-focus:left-auto peer-focus:text-blue-600 peer-focus:dark:text-blue-500 peer-placeholder-shown:scale-100 peer-placeholder-shown:translate-y-0 peer-focus:scale-75 peer-focus:-translate-y-6">Código</label>
                                    </div>
                                </div>
                            </div>
                            <div class="m-auto">
                                <input type="range" name="quality_1" class="range block" id="rango"
                                    step="0.05" />
                                <div class="scala">
                                    escala
                                </div>
                            </div>
                        </div>
                        <div id="code2" class="my-6 quality grid grid-cols-1">
                            <div class="flex justify-between">
                                <div class="mb-4">
                                    <div class="relative z-0 w-full mb-5 group">
                                        <input type="text" name="seconds_arm" value="Izquierdo"
                                            class="block capitalize pt-5 pb-1 px-0 w-full text-sm text-gray-900 bg-transparent border-0 border-b-2 border-gray-300 appearance-none dark:text-white dark:border-gray-600 dark:focus:border-blue-500 focus:outline-none focus:ring-0 focus:border-blue-600 peer"
                                            disabled />
                                        <label for="seconds_arm"
                                            class="peer-focus:font-medium absolute text-xl text-gray-500 dark:text-gray-400 duration-300 transform -translate-y-6 scale-75 top-3 -z-10 origin-[0] peer-focus:start-0 rtl:peer-focus:translate-x-1/4 rtl:peer-focus:left-auto peer-focus:text-blue-600 peer-focus:dark:text-blue-500 peer-placeholder-shown:scale-100 peer-placeholder-shown:translate-y-0 peer-focus:scale-75 peer-focus:-translate-y-6">Brazo
                                            Final</label>
                                    </div>
                                </div>
                                <div class="mb-4">
                                    <input type="text" name="fragance_code_test_2"
                                        value="{{ $codigo_brazo_izquierdo === $evaluated->codigo_portador_b_fragancia_1 ? $evaluated->codigo_test_fragancia_1 : $evaluated->codigo_test_fragancia_2 }}" />
                                </div>
                                <div>
                                    <div class="relative z-0 w-full mb-5 group">
                                        <input type="text" value="{{ $evaluated->codigo_brazo_izquierdo }}"
                                            class="block pt-5 pb-1 px-0 w-full text-sm text-gray-900 bg-transparent border-0 border-b-2 border-gray-300 appearance-none dark:text-white dark:border-gray-600 dark:focus:border-blue-500 focus:outline-none focus:ring-0 focus:border-blue-600 peer"
                                            disabled />
                                        <label for="first_arm"
                                            class="peer-focus:font-medium absolute text-xl text-gray-500 dark:text-gray-400 duration-300 transform -translate-y-6 scale-75 top-3 -z-10 origin-[0] peer-focus:start-0 rtl:peer-focus:translate-x-1/4 rtl:peer-focus:left-auto peer-focus:text-blue-600 peer-focus:dark:text-blue-500 peer-placeholder-shown:scale-100 peer-placeholder-shown:translate-y-0 peer-focus:scale-75 peer-focus:-translate-y-6">Código</label>
                                    </div>
                                </div>
                            </div>
                            <div class="m-auto">
                                <input type="range" name="quality_2" class="range block" id="rango"
                                    step="0.05" />
                                <div class="scala">
                                    escala
                                </div>
                            </div>
                        </div>
                    @endif
                @else
                    @if ($carrier === 'a')
                        <div id="code1" class="my-6 quality grid grid-cols-1">
                            <div class="flex justify-between">
                                <div class="mb-4">
                                    <div class="relative z-0 w-full mb-5 group">
                                        <input type="text" name="first_arm" id="first_arm"
                                            value="{{ $brazo_inicial }}"
                                            class="block capitalize pt-5 pb-1 px-0 w-full text-sm text-gray-900 bg-transparent border-0 border-b-2 border-gray-300 appearance-none dark:text-white dark:border-gray-600 dark:focus:border-blue-500 focus:outline-none focus:ring-0 focus:border-blue-600 peer"
                                            disabled />
                                        <label for="first_arm"
                                            class="peer-focus:font-medium absolute text-xl text-gray-500 dark:text-gray-400 duration-300 transform -translate-y-6 scale-75 top-3 -z-10 origin-[0] peer-focus:start-0 rtl:peer-focus:translate-x-1/4 rtl:peer-focus:left-auto peer-focus:text-blue-600 peer-focus:dark:text-blue-500 peer-placeholder-shown:scale-100 peer-placeholder-shown:translate-y-0 peer-focus:scale-75 peer-focus:-translate-y-6">Brazo
                                            inicial</label>
                                    </div>
                                </div>
                                <div class="mb-4">
                                    <input type="text" name="fragance_code_test_1"
                                        value="{{ $codigo_brazo_izquierdo === $evaluated->codigo_portador_a_fragancia_2 ? $evaluated->codigo_test_fragancia_2 : $evaluated->codigo_test_fragancia_1 }}" />
                                </div>
                                <div>
                                    <div class="relative z-0 w-full mb-5 group">
                                        <input type="text"
                                            value="{{ $brazo_inicial === 'izquierdo' ? $evaluated->codigo_brazo_izquierdo : $evaluated->codigo_brazo_derecho }}"
                                            class="block pt-5 pb-1 px-0 w-full text-sm text-gray-900 bg-transparent border-0 border-b-2 border-gray-300 appearance-none dark:text-white dark:border-gray-600 dark:focus:border-blue-500 focus:outline-none focus:ring-0 focus:border-blue-600 peer"
                                            disabled />
                                        <label for="first_arm"
                                            class="peer-focus:font-medium absolute text-xl text-gray-500 dark:text-gray-400 duration-300 transform -translate-y-6 scale-75 top-3 -z-10 origin-[0] peer-focus:start-0 rtl:peer-focus:translate-x-1/4 rtl:peer-focus:left-auto peer-focus:text-blue-600 peer-focus:dark:text-blue-500 peer-placeholder-shown:scale-100 peer-placeholder-shown:translate-y-0 peer-focus:scale-75 peer-focus:-translate-y-6">Código</label>
                                    </div>
                                </div>
                            </div>
                            <div class="m-auto">
                                <input type="range" name="quality_1" class="range block" id="rango"
                                    step="0.05" />
                                <div class="scala">
                                    escala
                                </div>
                            </div>
                        </div>
                        <div id="code2" class="my-6 quality grid grid-cols-1">
                            <div class="flex justify-between">
                                <div class="mb-4">
                                    <div class="relative z-0 w-full mb-5 group">
                                        <input type="text" name="second_arm" value="Derecho"
                                            class="block capitalize pt-5 pb-1 px-0 w-full text-sm text-gray-900 bg-transparent border-0 border-b-2 border-gray-300 appearance-none dark:text-white dark:border-gray-600 dark:focus:border-blue-500 focus:outline-none focus:ring-0 focus:border-blue-600 peer" />
                                        <label for="second_arm"
                                            class="peer-focus:font-medium absolute text-xl text-gray-500 dark:text-gray-400 duration-300 transform -translate-y-6 scale-75 top-3 -z-10 origin-[0] peer-focus:start-0 rtl:peer-focus:translate-x-1/4 rtl:peer-focus:left-auto peer-focus:text-blue-600 peer-focus:dark:text-blue-500 peer-placeholder-shown:scale-100 peer-placeholder-shown:translate-y-0 peer-focus:scale-75 peer-focus:-translate-y-6">Brazo
                                            Final</label>
                                    </div>
                                </div>
                                <div class="mb-4">
                                    <input type="text" name="fragance_code_test_2"
                                        value="{{ $codigo_brazo_derecho === $evaluated->codigo_portador_a_fragancia_2 ? $evaluated->codigo_test_fragancia_2 : $evaluated->codigo_test_fragancia_1 }}" />
                                </div>
                                <div>
                                    <div class="relative z-0 w-full mb-5 group">
                                        <input type="text" value="{{ $evaluated->codigo_brazo_derecho }}"
                                            class="block pt-5 pb-1 px-0 w-full text-sm text-gray-900 bg-transparent border-0 border-b-2 border-gray-300 appearance-none dark:text-white dark:border-gray-600 dark:focus:border-blue-500 focus:outline-none focus:ring-0 focus:border-blue-600 peer"
                                            disabled />
                                        <label for="first_arm"
                                            class="peer-focus:font-medium absolute text-xl text-gray-500 dark:text-gray-400 duration-300 transform -translate-y-6 scale-75 top-3 -z-10 origin-[0] peer-focus:start-0 rtl:peer-focus:translate-x-1/4 rtl:peer-focus:left-auto peer-focus:text-blue-600 peer-focus:dark:text-blue-500 peer-placeholder-shown:scale-100 peer-placeholder-shown:translate-y-0 peer-focus:scale-75 peer-focus:-translate-y-6">Código</label>
                                    </div>
                                </div>
                            </div>
                            <div class="m-auto">
                                <input type="range" name="quality_2" class="range block" id="rango"
                                    step="0.05" />
                                <div class="scala">
                                    escala
                                </div>
                            </div>
                        </div>
                    @else
                        <div id="code1" class="my-6 quality grid grid-cols-1">
                            <div class="flex justify-between">
                                <div class="mb-4">
                                    <div class="relative z-0 w-full mb-5 group">
                                        <input type="text" name="first_arm" id="first_arm"
                                            value="{{ $brazo_inicial }}"
                                            class="block capitalize pt-5 pb-1 px-0 w-full text-sm text-gray-900 bg-transparent border-0 border-b-2 border-gray-300 appearance-none dark:text-white dark:border-gray-600 dark:focus:border-blue-500 focus:outline-none focus:ring-0 focus:border-blue-600 peer"
                                            disabled />
                                        <label for="first_arm"
                                            class="peer-focus:font-medium absolute text-xl text-gray-500 dark:text-gray-400 duration-300 transform -translate-y-6 scale-75 top-3 -z-10 origin-[0] peer-focus:start-0 rtl:peer-focus:translate-x-1/4 rtl:peer-focus:left-auto peer-focus:text-blue-600 peer-focus:dark:text-blue-500 peer-placeholder-shown:scale-100 peer-placeholder-shown:translate-y-0 peer-focus:scale-75 peer-focus:-translate-y-6">Brazo
                                            inicial</label>
                                    </div>
                                </div>
                                <div class="mb-4">
                                    <input type="text" name="fragance_code_test_1"
                                        value="{{ $codigo_brazo_izquierdo === $evaluated->codigo_portador_b_fragancia_2 ? $evaluated->codigo_test_fragancia_2 : $evaluated->codigo_test_fragancia_1 }}" />
                                </div>
                                <div>
                                    <div class="relative z-0 w-full mb-5 group">
                                        <input type="text"
                                            value="{{ $brazo_inicial === 'izquierdo' ? $evaluated->codigo_brazo_izquierdo : $evaluated->codigo_brazo_derecho }}"
                                            class="block pt-5 pb-1 px-0 w-full text-sm text-gray-900 bg-transparent border-0 border-b-2 border-gray-300 appearance-none dark:text-white dark:border-gray-600 dark:focus:border-blue-500 focus:outline-none focus:ring-0 focus:border-blue-600 peer"
                                            disabled />
                                        <label for="first_arm"
                                            class="peer-focus:font-medium absolute text-xl text-gray-500 dark:text-gray-400 duration-300 transform -translate-y-6 scale-75 top-3 -z-10 origin-[0] peer-focus:start-0 rtl:peer-focus:translate-x-1/4 rtl:peer-focus:left-auto peer-focus:text-blue-600 peer-focus:dark:text-blue-500 peer-placeholder-shown:scale-100 peer-placeholder-shown:translate-y-0 peer-focus:scale-75 peer-focus:-translate-y-6">Código</label>
                                    </div>
                                </div>
                            </div>
                            <div class="m-auto">
                                <input type="range" name="quality_1" class="range block" id="rango"
                                    step="0.05" />
                                <div class="scala">
                                    escala
                                </div>
                            </div>
                        </div>
                        <div id="code2" class="my-6 quality grid grid-cols-1">
                            <div class="flex justify-between">
                                <div class="mb-4">
                                    <div class="relative z-0 w-full mb-5 group">
                                        <input type="text" name="second_arm" value="Derecho"
                                            class="block capitalize pt-5 pb-1 px-0 w-full text-sm text-gray-900 bg-transparent border-0 border-b-2 border-gray-300 appearance-none dark:text-white dark:border-gray-600 dark:focus:border-blue-500 focus:outline-none focus:ring-0 focus:border-blue-600 peer" />
                                        <label for="second_arm"
                                            class="peer-focus:font-medium absolute text-xl text-gray-500 dark:text-gray-400 duration-300 transform -translate-y-6 scale-75 top-3 -z-10 origin-[0] peer-focus:start-0 rtl:peer-focus:translate-x-1/4 rtl:peer-focus:left-auto peer-focus:text-blue-600 peer-focus:dark:text-blue-500 peer-placeholder-shown:scale-100 peer-placeholder-shown:translate-y-0 peer-focus:scale-75 peer-focus:-translate-y-6">Brazo
                                            Final</label>
                                    </div>
                                </div>
                                <div class="mb-4">
                                    <input type="text" name="fragance_code_test_2"
                                        value="{{ $codigo_brazo_derecho === $evaluated->codigo_portador_b_fragancia_2 ? $evaluated->codigo_test_fragancia_2 : $evaluated->codigo_test_fragancia_1 }}" />
                                </div>
                                <div>
                                    <div class="relative z-0 w-full mb-5 group">
                                        <input type="text" value="{{ $evaluated->codigo_brazo_derecho }}"
                                            class="block pt-5 pb-1 px-0 w-full text-sm text-gray-900 bg-transparent border-0 border-b-2 border-gray-300 appearance-none dark:text-white dark:border-gray-600 dark:focus:border-blue-500 focus:outline-none focus:ring-0 focus:border-blue-600 peer"
                                            disabled />
                                        <label for="first_arm"
                                            class="peer-focus:font-medium absolute text-xl text-gray-500 dark:text-gray-400 duration-300 transform -translate-y-6 scale-75 top-3 -z-10 origin-[0] peer-focus:start-0 rtl:peer-focus:translate-x-1/4 rtl:peer-focus:left-auto peer-focus:text-blue-600 peer-focus:dark:text-blue-500 peer-placeholder-shown:scale-100 peer-placeholder-shown:translate-y-0 peer-focus:scale-75 peer-focus:-translate-y-6">Código</label>
                                    </div>
                                </div>
                            </div>
                            <div class="m-auto">
                                <input type="range" name="quality_2" class="range block" id="rango"
                                    step="0.05" />
                                <div class="scala">
                                    escala
                                </div>
                            </div>
                        </div>
                    @endif
                @endif
                <div class="footer flex justify-end">
                    <x-button>
                        Registrar Prueba
                    </x-button>
                </div>
            </div>
        </form>
    </div>
</div>

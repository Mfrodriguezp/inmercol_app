<div>
    <div class="header flex justify-between items-center mb-4">
        <div class="title basis-3/5">
            <span class="title">{{ $title }} {{ $evaluated->test_identifier }}</span>
        </div>
    </div>
    <div class="">
        <form action="{{ action('App\Http\Controllers\Admin\JudmentController@saveJudment') }}" method="POST">
            @csrf
            <div class="flex justify-between first-section" id="first-section">
                <div class="">
                    <strong>Nombre del juez : </strong><span class="capitalize">{{ $judge->judge_name }}</span>
                </div>
                <div>
                    <span class="text-teal-500 text-2xl font-semibold capitalize">Portador:
                        {{ $carrier === 'a' ? $evaluated->nombre_portador_a : $evaluated->nombre_portador_b }}</span>
                </div>
                <div class="">
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
                    <span class="text-teal-500 text-xl font-semibold" aria-describedby="helper-text-explanation">Iniciar
                        con brazo {{ $brazo_inicial }}</span>
                    <p id="helper-text-explanation" class="mt-2 text-sm text-gray-500 dark:text-gray-400">Por favor
                        expresar su percepción de intensidad moviendo la línea que se muestra sobre la escala LMS.</p>
                </div>
                {{-- @if ($brazo_inicial === 'derecho')
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
                                <input type="range" min="0" max="20" value="0" name="quality_1"
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
                                <input type="range" min="0" max="20" value="0" name="quality_1"
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
                @else --}}
                @if ($carrier === 'a')
                    <div id="code1" class="my-4 quality grid grid-cols-1">
                        <div class="flex justify-between">
                            <div class="mb-4">
                                <strong>Brazo izquierdo</strong>
                            </div>
                            <div class="mb-4">
                                <input type="hidden" name="fragance_code_test_1"
                                    value="{{ $codigo_brazo_izquierdo === $evaluated->codigo_portador_a_fragancia_2 ? $evaluated->codigo_test_fragancia_2 : $evaluated->codigo_test_fragancia_1 }}" />
                            </div>
                            <div>
                                <strong>Código : </strong><span
                                    class="capitalize">{{ $evaluated->codigo_brazo_izquierdo }}</span>
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
                                <strong>Brazo derecho</strong>
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
                                <strong>Brazo izquierdo</strong>
                            </div>
                            <div class="mb-4">
                                <input type="hidden" name="fragance_code_test_1"
                                    value="{{ $codigo_brazo_izquierdo === $evaluated->codigo_portador_b_fragancia_2 ? $evaluated->codigo_test_fragancia_2 : $evaluated->codigo_test_fragancia_1 }}" />
                            </div>
                            <div>
                                <strong>Código : </strong><span
                                    class="">{{ $evaluated->codigo_brazo_izquierdo }}</span>
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
                                <strong>Brazo derecho</strong>
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
                {{-- @endif --}}
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
                    <x-label>
                        <x-checkbox wire:click="$toggle('checked')" />Confirmar marcación
                    </x-label>
                    @if ($checked)
                        <x-button>
                            Registrar Marcación
                        </x-button>
                    @else
                        <x-button disabled>
                            Deshabilitado<i class="fa-solid fa-ban"></i>
                        </x-button>
                    @endif
                </div>
            </div>
        </form>
    </div>
    {{-- Alert --}}
    @if (!is_null($message))
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
                        title: "{{ $message }}"
                    });
                });
            </script>
        @endpush
    @endif
</div>

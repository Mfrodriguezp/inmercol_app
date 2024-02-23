<x-app-layout>
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white ml-9 mt-8 m-auto overflow-hidden shadow-xl sm:rounded-lg p-8">
                {{--Paso de parámetros desde el controlador al componente livewire judment --}}
                @livewire('judments.judment',[
                    'rotationJudges'=>$rotationJudges,
                    'carrier'=>$carrier,
                    'control'=>$control,
                    'evaluated'=>$evaluated,
                    'counter'=>$counter,
                    'message'=>$message //Contador de jueces
                ])
            </div>
        </div>
    </div>
</x-app-layout>
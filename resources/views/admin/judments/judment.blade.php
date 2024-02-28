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
                    'counter'=>$counter,//Contador de jueces del paso de jueces
                    'number_judges'=>$number_judges, //Cantidad de jueces para el control
                    'message'=>$message 
                ])
            </div>
        </div>
    </div>
</x-app-layout>
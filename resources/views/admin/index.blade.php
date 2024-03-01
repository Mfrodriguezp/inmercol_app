<x-app-layout>
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="min-h-96 flex flex-col justify-center items-center bg-white ml-9 mt-10 m-auto overflow-hidden shadow-xl sm:rounded-lg p-8">
                
                <div class="header title w-full">
                    <span class="title">Bienvenid@ {{Auth::user()->name}}</span>
                </div>
                <div>
                    <img class="m-auto" src="{{ asset('storage/inmercol_logo.svg') }}" type="img/svg" alt="logo inmercol">
                </div>
            </div>
        </div>
    </div>
</x-app-layout>

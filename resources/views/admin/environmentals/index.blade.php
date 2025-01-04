<x-app-layout>

    <div class="py-12">
        <div class="max-w-6xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white ml-9 mt-10 m-auto verflow-hidden shadow-xl sm:rounded-lg p-8">
                @livewire('admin.environmentals.form-environmentals-conditions')
                @vite(['resources/js/spinnerLoading.js'])
            </div>
        </div>
    </div>
</x-app-layout>

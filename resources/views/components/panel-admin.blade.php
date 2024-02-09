<x-app-layout>
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white mt-10 m-auto overflow-hidden shadow-xl sm:rounded-lg">
                @dump($option)
                @switch($option)
                @case('projects')
                    @livewire('admin.projects')
                @break

                @case('judges')
                    @livewire('admin.judges')
                @break

                @case('reports')
                    @livewire('admin.reports')
                @break

                @case('settings')
                    @livewire('admin.settings')
                @break
            @endswitch
            </div>
        </div>
    </div>
</x-app-layout>

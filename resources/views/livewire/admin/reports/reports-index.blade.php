{{-- resources/views/livewire/admin/reports/report-generator.blade.php --}}
<div>
    <div class="header flex items-start">
        <div class="title basis-3/5">
            <span class="title">{{ $title }}</span>
        </div>
    </div>
    <div class="py-4">
        <div class="flex gap-3 items-end mb-2">
            <div class="flex-auto">
                <label for="reportName" class="block text-sm font-medium text-gray-700 mb-1">
                    Seleccione el tipo de reporte
                </label>
                <x-select name="report_type" wire:model.live="report_type" class="w-1/4" required>
                    <option value="1">Reporte Standar</option>
                    <option value="2">Reporte Consolidado</option>
                </x-select>
            </div>
        </div>
    </div>
    @if ($report_type == 1)
        <div class="data">
            <h2 class="text-xl font-semibold text-teal-600 mb-4">Reporte Standar</h2>
            <livewire:admin.reports.judment-table />
        </div>
    @else
        <div class="bg-white rounded-lg shadow-sm">
            <h2 class="text-xl font-semibold text-teal-600 mb-4">Reporte Consolidado</h2>

            <div class="flex flex-col gap-3 items-start mb-2">
                <div class="flex-auto">
                    <label for="reportName" class="block text-sm font-medium text-gray-700 mb-1">
                        Nombre del Reporte
                    </label>
                    <input type="text" id="reportName" wire:model="reportName" name="testIdentified"
                        class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-teal-500 focus:border-transparent"
                        placeholder="Código de Evaluación">
                    <div class="flex items-center pt-2">
                        <label for="reportName" class="block text-sm font-medium text-gray-700 mb-1">
                            Estilo data Juicios
                        </label>
                    </div>
                    <div class="flex">
                        <div class="flex items-center">
                            <input required checked id="standar" type="radio" value="standar" name="dataOption" wire:model="dataOption"
                                class="w-4 h-4 text-teal-600 bg-gray-100 border-gray-300 focus:ring-teal-500 dark:focus:ring-teal-600 dark:ring-offset-gray-800 focus:ring-2 dark:bg-gray-700 dark:border-gray-600">
                            <label for="standar"
                                class="w-full py-4 ms-2 text-sm font-medium text-gray-900 dark:text-gray-300">Standar</label>
                        </div>
                        <div class="flex items-center ps-4 ">
                            <input required id="modified" type="radio" value="modified" name="dataOption" wire:model="dataOption"
                                class="w-4 h-4 text-teal-600 bg-gray-100 border-gray-300 focus:ring-teal-500 dark:focus:ring-teal-600 dark:ring-offset-gray-800 focus:ring-2 dark:bg-gray-700 dark:border-gray-600">
                            <label for="modified"
                                class="w-full py-4 ms-2 text-sm font-medium text-gray-900 dark:text-gray-300">Modificado
                                (Belcorp)</label>
                        </div>
                    </div>
                    @error('reportName')
                        <span class="text-red-500 text-sm">{{ $message }}</span>
                    @enderror
                </div>

                <button wire:click="generateReport"
                    class="px-4 py-2 bg-teal-600 text-white rounded-md hover:bg-teal-700 transition-colors flex items-center gap-2">
                    <div wire:loading wire:target="generateReport" class="animate-spin mr-2">
                        ⚪
                    </div>
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 24 24" fill="none"
                        stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                        <circle cx="11" cy="11" r="8"></circle>
                        <line x1="21" y1="21" x2="16.65" y2="16.65"></line>
                    </svg>
                    Generar Reporte
                </button>
            </div>

            <div class="text-sm text-gray-500">
                * El reporte incluirá los datos filtrados según los criterios seleccionados
            </div>
        </div>
    @endif

</div>

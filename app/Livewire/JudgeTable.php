<?php

namespace App\Livewire;

use App\Models\Judge;
use Illuminate\Support\Carbon;
use Illuminate\Database\Eloquent\Builder;
use PowerComponents\LivewirePowerGrid\Button;
use PowerComponents\LivewirePowerGrid\Column;
use PowerComponents\LivewirePowerGrid\Exportable;
use PowerComponents\LivewirePowerGrid\Facades\Filter;
use PowerComponents\LivewirePowerGrid\Footer;
use PowerComponents\LivewirePowerGrid\Header;
use PowerComponents\LivewirePowerGrid\PowerGrid;
use PowerComponents\LivewirePowerGrid\PowerGridFields;
use PowerComponents\LivewirePowerGrid\PowerGridComponent;
use PowerComponents\LivewirePowerGrid\Traits\WithExport;
use Illuminate\Support\Facades\Blade;

final class JudgeTable extends PowerGridComponent
{
    use WithExport;
    public string $primaryKey = 'judges.id_judge';
    public string $sortField = 'judges.id_judge';
    public int $perPage = 10;
    public array $perPageValues = [0, 5, 10, 20];

    public function setUp(): array
    {
        $this->showCheckBox('id_judge');

        return [
            Exportable::make('export')
                ->striped()
                ->type(Exportable::TYPE_XLS, Exportable::TYPE_CSV),
            Header::make()->showSearchInput()
                ->showToggleColumns()
                ->withoutLoading(),
            Footer::make()
                ->showPerPage($this->perPage, $this->perPageValues)
                ->showRecordCount()
                ->showRecordCount(mode: 'min'),
        ];
    }

    public function datasource(): Builder
    {
        return Judge::query();
    }

    public function relationSearch(): array
    {
        return [];
    }

    public function fields(): PowerGridFields
    {
        return PowerGrid::fields()
            ->addColumn('judge_number')
            ->addColumn('judge_name');
    }

    public function columns(): array
    {
        return [
            Column::make('Judge number', 'judge_number')
                ->sortable()
                ->searchable(),

            Column::make('Judge name', 'judge_name')
                ->sortable()
                ->searchable(),

            Column::action('Action')
        ];
    }

    public function filters(): array
    {
        return [];
    }

    #[\Livewire\Attributes\On('edit')]
    public function edit($rowId): void
    {
        $this->js('alert(' . $rowId . ')');
    }

    public function actions(\App\Models\Judge $row): array
    {
        return [
            Button::add('edit')
                ->slot('<i class="fa-solid fa-pencil"></i>')
                ->class('inline-flex items-center justify-center px-2 py-2 bg-yellow-600 border border-transparent rounded-full font-semibold text-xs text-white uppercase tracking-widest hover:bg-yellow-500 active:bg-yellow-700 focus:outline-none focus:ring-2 focus:ring-red-500 focus:ring-offset-2 transition ease-in-out duration-150')
                ->openModal('admin.create-edit-judge-modal',['judge'=>$row->id_judge])
                ->tooltip('Editar'),
            Button::add('destroy')
                ->slot('<i class="fa-solid fa-trash"></i>')
                ->class('inline-flex items-center justify-center px-2 py-2 bg-red-600 border border-transparent rounded-full font-semibold text-xs text-white uppercase tracking-widest hover:bg-red-500 active:bg-red-700 focus:outline-none focus:ring-2 focus:ring-red-500 focus:ring-offset-2 transition ease-in-out duration-150')
                ->openModal('admin.destroy-judge-modal', ['judge' => $row->id_judge])
                ->tooltip('Eliminar'),
        ];
    }

    /*
    public function actionRules($row): array
    {
        return [
            // Hide button edit for ID 1
            Rule::button('edit')
                ->when(fn ($row) => $row->id === 1)
                ->hide(),
        ];
    }*/
}

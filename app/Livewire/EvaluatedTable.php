<?php

namespace App\Livewire;

use App\Models\EvaluatedFragance;
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

final class EvaluatedTable extends PowerGridComponent
{
    use WithExport;
    public string $primaryKey = 'evaluated_fragances.id_evaluated_fragance';
    public string $sortField = 'evaluated_fragances.id_evaluated_fragance';
    public int $perPage = 5;
    public array $perPageValues = [0, 5, 10, 20, 50,100];

    public function setUp(): array
    {
        $this->showCheckBox('id_evaluated_fragance');

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
        return EvaluatedFragance::query()
            ->join('projects', function ($projects) {
                $projects->on('evaluated_fragances.projects_id_project', '=', 'projects.id_project');
            })
            ->select([
                'id_evaluated_fragance',
                'tb',
                'projects.project_name as project_name',
                'fragance_name_1',
                'fragance_counter_1',
                'fragance_ms_1',
                'fragance_test_code_1',
                'fragance_name_2',
                'fragance_counter_2',
                'fragance_ms_2',
                'fragance_test_code_2',
                'rot_fragance_aplication',
                'name_carrier_a',
                'name_carrier_b',
                'control_1',
                'control_2',
                'control_3',
                'control_4',
                'status_evaluation',
            ])->orderByDesc('id_evaluated_fragance');
    }

    public function relationSearch(): array
    {
        return [];
    }

    public function fields(): PowerGridFields
    {
        return PowerGrid::fields()
            ->addColumn('id_evaluated_fragance')
            ->addColumn('tb')
            ->addColumn('project_name')
            ->addColumn('fragance_name_1')
            ->addColumn('fragance_ms_1')
            ->addColumn('fragance_test_code_1')
            ->addColumn('fragance_name_2')
            ->addColumn('fragance_ms_2')
            ->addColumn('fragance_test_code_2')
            ->addColumn('rot_fragance_aplication')
            ->addColumn('name_carrier_a')
            ->addColumn('name_carrier_b')
            ->addColumn('control_1')
            ->addColumn('control_2')
            ->addColumn('control_3')
            ->addColumn('control_4')
            ->addColumn('status_evaluation');
    }

    public function columns(): array
    {
        return [
            Column::make('ID', 'id_evaluated_fragance'),
            Column::make('Tb', 'tb')
                ->sortable()
                ->searchable(),
            Column::make('Proyecto', 'project_name')
                ->sortable()
                ->searchable(),
            Column::make('Nombre Fragancia 1', 'fragance_name_1')
                ->sortable()
                ->searchable(),

            Column::make('Ms Fragancia 1', 'fragance_ms_1')
                ->sortable()
                ->searchable(),

            Column::make('Cod. Fragancia 1', 'fragance_test_code_1')
                ->sortable()
                ->searchable(),

            Column::make('Nombre Fragancia 2', 'fragance_name_2')
                ->sortable()
                ->searchable(),

            Column::make('Ms Fragancia 1', 'fragance_ms_2')
                ->sortable()
                ->searchable(),

            Column::make('Cod. Fragancia 2', 'fragance_test_code_2')
                ->sortable()
                ->searchable(),

            Column::make('Rot fragance aplication', 'rot_fragance_aplication')
                ->sortable()
                ->searchable(),

            Column::make('Portador A', 'name_carrier_a')
                ->sortable()
                ->searchable(),

            Column::make('Portador B', 'name_carrier_b')
                ->sortable()
                ->searchable(),

            Column::make('Control 1', 'control_1')
                ->sortable()
                ->searchable(),

            Column::make('Control 2', 'control_2')
                ->sortable()
                ->searchable(),

            Column::make('Control 3', 'control_3')
                ->sortable()
                ->searchable(),

            Column::make('Control 4', 'control_4')
                ->sortable()
                ->searchable(),

            Column::make('Estado', 'status_evaluation')
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

    public function actions(\App\Models\EvaluatedFragance $row): array
    {
        return [
            Button::add('edit')
                ->slot('Edit: ' . $row->id)
                ->id()
                ->class('pg-btn-white dark:ring-pg-primary-600 dark:border-pg-primary-600 dark:hover:bg-pg-primary-700 dark:ring-offset-pg-primary-800 dark:text-pg-primary-300 dark:bg-pg-primary-700')
                ->dispatch('edit', ['rowId' => $row->id])
        ];
    }

    /*
    public function actionRules($row): array
    {
       return [
            // Hide button edit for ID 1
            Rule::button('edit')
                ->when(fn($row) => $row->id === 1)
                ->hide(),
        ];
    }
    */
}

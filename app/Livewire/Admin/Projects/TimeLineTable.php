<?php

namespace App\Livewire\Admin\Projects;

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

final class TimeLineTable extends PowerGridComponent
{
    use WithExport;
    public string $primaryKey = 'evaluated_fragances.id_evaluated_fragance';
    public string $sortField = 'evaluated_fragances.id_evaluated_fragance';
    public int $perPage = 5;
    public array $perPageValues = [0, 5, 10, 20, 50, 100];
    public ?string $id_project;
    public bool $showFilters = true;

    public function setUp(): array
    {
        $this->showCheckBox('id_evaluated_fragance');

        return [
            Exportable::make('export')
                ->striped()
                ->type(Exportable::TYPE_XLS, Exportable::TYPE_CSV),
            Header::make()->showSearchInput(),
            Footer::make()
                ->showPerPage()
                ->showRecordCount(),
        ];
    }

    public function datasource(): ?Builder
    {
        return EvaluatedFragance::query()
        ->where('projects_id_project',$this->id_project)
        ->join('projects', function ($projects) {
            $projects->on('evaluated_fragances.projects_id_project', '=', 'projects.id_project');
        })
        ->select([
            'id_evaluated_fragance',
            'test_identifier',
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
            'control_1_a',
            'control_2_a',
            'control_3_a',
            'control_4_a',
            'control_1_b',
            'control_2_b',
            'control_3_b',
            'control_4_b',
            'code_1_test_a',
            'code_2_test_a',
            'code_1_test_b',
            'code_2_test_b',
            'status_evaluation',
        ])->orderByDesc('id_evaluated_fragance');;
    }

    public function relationSearch(): array
    {
        return [];
    }

    public function fields(): PowerGridFields
    {
        return PowerGrid::fields()
        ->add('id_evaluated_fragance')
        ->add('test_identifier')
        ->add('project_name')
        ->add('fragance_name_1')
        ->add('fragance_counter_1')
        ->add('fragance_ms_1')
        ->add('fragance_test_code_1')
        ->add('fragance_name_2')
        ->add('fragance_counter_2')
        ->add('fragance_ms_2')
        ->add('fragance_test_code_2')
        ->add('rot_fragance_aplication')
        ->add('name_carrier_a')
        ->add('name_carrier_b')
        ->add('status_evaluation');
    }

    public function columns(): array
    {
        return [
            Column::make('ID', 'id_evaluated_fragance'),
            Column::make('cod. evaluacion', 'test_identifier')
                ->sortable()
                ->searchable(),
            Column::make('proyecto', 'project_name')
                ->sortable()
                ->searchable(),
            Column::make('Fragancia 1', 'fragance_name_1')
                ->sortable()
                ->searchable(),
            Column::make('Contador Frag. 1', 'fragance_counter_1')
                ->sortable()
                ->searchable()
                ->hidden($isHidden = true, $isForceHidden = false),
            Column::make('Muestra Frag. 1', 'fragance_ms_1')
                ->sortable()
                ->searchable()
                ->hidden($isHidden = true, $isForceHidden = false),

            Column::make('Cod. Test Frag. 1', 'fragance_test_code_1')
                ->sortable()
                ->searchable(),

            Column::make('Fragancia 2', 'fragance_name_2')
                ->sortable()
                ->searchable(),
            Column::make('Contador Frag. 2', 'fragance_counter_2')
                ->sortable()
                ->searchable()
                ->hidden($isHidden = true, $isForceHidden = false),
            Column::make('Muestra Frag. 2', 'fragance_ms_2')
                ->sortable()
                ->searchable()
                ->hidden($isHidden = true, $isForceHidden = false),

            Column::make('Cod. Test Frag. 2', 'fragance_test_code_2')
                ->sortable()
                ->searchable(),

            Column::make('Rotacion Aplicacion Fragancia', 'rot_fragance_aplication')
                ->sortable()
                ->searchable()
                ->hidden($isHidden = true, $isForceHidden = false),
            Column::make('Portador A', 'name_carrier_a')
                ->sortable()
                ->searchable()
                ->hidden($isHidden = true, $isForceHidden = false),

            Column::make('Portador B', 'name_carrier_b')
                ->sortable()
                ->searchable()
                ->hidden($isHidden = true, $isForceHidden = false),

            Column::make('Estado', 'status_evaluation')
                ->sortable()
                ->searchable(),
        ];
    }

    public function filters(): array
    {
        return [
        ];
    }

    #[\Livewire\Attributes\On('edit')]
    public function edit($rowId): void
    {
        $this->js('alert('.$rowId.')');
    }

    /*public function actions(EvaluatedFragance $row): array
    {
        return [
            Button::add('edit')
                ->slot('Edit: '.$row->id)
                ->id()
                ->class('pg-btn-white dark:ring-pg-primary-600 dark:border-pg-primary-600 dark:hover:bg-pg-primary-700 dark:ring-offset-pg-primary-800 dark:text-pg-primary-300 dark:bg-pg-primary-700')
                ->dispatch('edit', ['rowId' => $row->id])
        ];
    }*/

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

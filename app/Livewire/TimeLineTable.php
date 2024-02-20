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

final class TimeLineTable extends PowerGridComponent
{
    use WithExport;
    public string $primaryKey = 'evaluated_fragances.id_evaluated_fragance';
    public string $sortField = 'evaluated_fragances.id_evaluated_fragance';
    public int $perPage = 5;
    public array $perPageValues = [0, 5, 10, 20, 50, 100];
    public ?string $id_project;

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
        return EvaluatedFragance::query()->where('projects_id_project',$this->id_project);
    }

    public function relationSearch(): array
    {
        return [];
    }

    public function fields(): PowerGridFields
    {
        return PowerGrid::fields()
            ->add('id_evaluated_fragance')
            ->add('tb')
            ->add('projects_id_project')
            ->add('fragance_name_1')
            ->add('fragance_counter_1')
            ->add('fragance_ms_1')
            ->add('fragance_test_code_1')
            ->add('fragance_name_2')
            ->add('fragance_counter_2')
            ->add('fragance_ms_2')
            ->add('fragance_test_code_2')
            ->add('number_judges')
            ->add('rot_fragance_aplication')
            ->add('name_carrier_a')
            ->add('name_carrier_b')
            ->add('control_1_a')
            ->add('control_2_a')
            ->add('control_3_a')
            ->add('control_4_a')
            ->add('control_1_b')
            ->add('control_2_b')
            ->add('control_3_b')
            ->add('control_4_b')
            ->add('code_1_test_a')
            ->add('code_2_test_a')
            ->add('code_1_test_b')
            ->add('code_2_test_b')
            ->add('status_evaluation');
    }

    public function columns(): array
    {
        return [
            Column::make('Id evaluated fragance', 'id_evaluated_fragance')
                ->sortable()
                ->searchable(),

            Column::make('Tb', 'tb')
                ->sortable()
                ->searchable(),

            Column::make('Projects id project', 'projects_id_project')
                ->sortable()
                ->searchable(),

            Column::make('Fragance name 1', 'fragance_name_1')
                ->sortable()
                ->searchable(),

            Column::make('Fragance counter 1', 'fragance_counter_1')
                ->sortable()
                ->searchable(),

            Column::make('Fragance ms 1', 'fragance_ms_1')
                ->sortable()
                ->searchable(),

            Column::make('Fragance test code 1', 'fragance_test_code_1')
                ->sortable()
                ->searchable(),

            Column::make('Fragance name 2', 'fragance_name_2')
                ->sortable()
                ->searchable(),

            Column::make('Fragance counter 2', 'fragance_counter_2')
                ->sortable()
                ->searchable(),

            Column::make('Fragance ms 2', 'fragance_ms_2')
                ->sortable()
                ->searchable(),

            Column::make('Fragance test code 2', 'fragance_test_code_2')
                ->sortable()
                ->searchable(),

            Column::make('Number judges', 'number_judges')
                ->sortable()
                ->searchable(),

            Column::make('Rot fragance aplication', 'rot_fragance_aplication')
                ->sortable()
                ->searchable(),

            Column::make('Name carrier a', 'name_carrier_a')
                ->sortable()
                ->searchable(),

            Column::make('Name carrier b', 'name_carrier_b')
                ->sortable()
                ->searchable(),

            Column::make('Control 1 a', 'control_1_a')
                ->sortable()
                ->searchable(),

            Column::make('Control 2 a', 'control_2_a')
                ->sortable()
                ->searchable(),

            Column::make('Control 3 a', 'control_3_a')
                ->sortable()
                ->searchable(),

            Column::make('Control 4 a', 'control_4_a')
                ->sortable()
                ->searchable(),

            Column::make('Control 1 b', 'control_1_b')
                ->sortable()
                ->searchable(),

            Column::make('Control 2 b', 'control_2_b')
                ->sortable()
                ->searchable(),

            Column::make('Control 3 b', 'control_3_b')
                ->sortable()
                ->searchable(),

            Column::make('Control 4 b', 'control_4_b')
                ->sortable()
                ->searchable(),

            Column::make('Code 1 test a', 'code_1_test_a')
                ->sortable()
                ->searchable(),

            Column::make('Code 2 test a', 'code_2_test_a')
                ->sortable()
                ->searchable(),

            Column::make('Code 1 test b', 'code_1_test_b')
                ->sortable()
                ->searchable(),

            Column::make('Code 2 test b', 'code_2_test_b')
                ->sortable()
                ->searchable(),

            Column::make('Status evaluation', 'status_evaluation')
                ->sortable()
                ->searchable(),

            Column::action('Action')
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

    public function actions(EvaluatedFragance $row): array
    {
        return [
            Button::add('edit')
                ->slot('Edit: '.$row->id)
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

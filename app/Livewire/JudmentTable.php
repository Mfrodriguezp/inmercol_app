<?php

namespace App\Livewire;

use App\Livewire\Admin\Judges;
use App\Models\Judment;
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

final class JudmentTable extends PowerGridComponent
{
    use WithExport;
    public string $primaryKey = 'judments.id_judment';
    public string $sortField = 'judments.id_judment';
    public int $perPage = 5;
    public array $perPageValues = [0, 5, 10, 20, 50, 100];
    public bool $showFilters = true;
    public function setUp(): array
    {
        $this->showCheckBox('id_judment');

        return [
            Exportable::make('export')
                ->striped()
                ->type(Exportable::TYPE_XLS, Exportable::TYPE_CSV),
            Header::make()->showToggleColumns()
                ->withoutLoading(),
            Footer::make()
                ->showPerPage($this->perPage, $this->perPageValues)
                ->showRecordCount(),
        ];
    }

    public function datasource(): ?Builder
    {
        return Judment::query()
            ->join('projects', function ($projects) {
                $projects->on('judments.projects_id_project', '=', 'projects.id_project');
            })->join('evaluated_fragances', function ($evaluatedFragance) {
                $evaluatedFragance->on('judments.evaluated_fragances_id_evaluated_fragance', '=', 'evaluated_fragances.id_evaluated_fragance');
            })
            ->join('judges', function ($judges) {
                $judges->on('judments.judges_id_judge', '=', 'judges.id_judge');
            })
            ->select([
                'judments.id_judment as id_judment',
                'projects.project_name AS proyecto',
                'evaluated_fragances.test_identifier AS test_identifier',
                'carrier_type AS portador',
                'judges.judge_number as numero_juez',
                'judges.judge_name as nombre_juez',
                'fragance_code AS codigo_fragancia',
                'qualification_control_1 AS control_1',
                'qualification_control_2 AS control_2',
                'qualification_control_3 AS control_3',
                'qualification_control_4 AS control_4',
                'evaluation_date'
            ]);
    }

    public function relationSearch(): array
    {
        return [
            'project' => [ // relationship on dishes model
                'projects_id_project', // column enabled to search
                'project' => ['project_name'] // nested relation and column enabled to search
            ]
        ];
    }

    public function fields(): PowerGridFields
    {
        return PowerGrid::fields()
            ->add('id_judment')
            ->add('proyecto')
            ->add('test_identifier')
            ->add('nombre_juez')
            ->add('numero_juez')
            ->add('codigo_fragancia')
            ->add('portador', function (Judment $judment) {
                return strtoupper($judment->portador);
            })
            ->add('control_1')
            ->add('control_2')
            ->add('control_3')
            ->add('control_4')
            ->add('evaluation_date', function (Judment $judment) {
                return Carbon::parse($judment->evaluation_date)->format('d-m-Y | H:i');
            });
    }

    public function columns(): array
    {
        return [
            Column::make('proyecto', 'proyecto')
                ->sortable()
                ->searchable()
                ->visibleInExport(false),
            Column::make('codigo de evaluacion', 'test_identifier')
                ->sortable()
                ->searchable()
                ->visibleInExport(false),
            Column::make('N° Juez', 'numero_juez')
                ->sortable()
                ->searchable(),
            Column::make('juez', 'nombre_juez')
                ->sortable()
                ->searchable()
                ->visibleInExport(false),
            Column::make('codigo fragancia', 'codigo_fragancia')
                ->sortable()
                ->searchable(),

            Column::make('portador', 'portador')
                ->sortable()
                ->searchable(),

            Column::make('control 1', 'control_1'),
            Column::make('control 2', 'control_2'),
            Column::make('control 3', 'control_3'),
            Column::make('control 4', 'control_4'),
            Column::make('fecha evaluacion', 'evaluation_date')
                ->sortable()
                ->visibleInExport(false),
        ];
    }

    public function filters(): array
    {
        return [
            Filter::inputText('test_identifier', 'test_identifier')
                ->operators(['contains']),
        ];
    }

    #[\Livewire\Attributes\On('edit')]
    public function edit($rowId): void
    {
        $this->js('alert(' . $rowId . ')');
    }

    /*
    public function actions(\App\Models\Judment $row): array
    {
        return [
            Button::add('edit')
                ->slot('Edit: ' . $row->id)
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

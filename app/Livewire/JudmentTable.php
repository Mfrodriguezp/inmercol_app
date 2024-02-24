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
                'evaluated_fragances_id_evaluated_fragance as id_evaluated',
                'projects.project_name AS proyecto',
                'evaluated_fragances.tb AS tb',
                'carrier_type AS portador',
                'judges.judge_number as numero_juez',
                'judges.judge_name as nombre_juez',
                'marking_type AS control',
                'fragance_code AS codigo_fragancia',
                'qualification AS calificacion',
                'evaluation_date as fecha_evaluacion'
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
            ->add('tb')
            ->add('nombre_juez')
            ->add('codigo_fragancia')
            ->add('portador', function (Judment $judment) {
                return strtoupper($judment->portador);
            })
            ->add('control')
            ->add('calificacion')
            ->add('fecha_evaluacion', function (Judment $judment) {
                return Carbon::parse($judment->evaluation_date)->format('d-m-Y | H:i');
            });
    }

    public function columns(): array
    {
        return [
            Column::make('ID', 'id_judment'),
            Column::make('proyecto', 'proyecto')
                ->sortable()
                ->searchable(),
            Column::make('id evaluacion', 'id_evaluated')
                ->sortable()
                ->searchable(),
            Column::make('tb', 'tb')
                ->sortable()
                ->searchable(),

            Column::make('juez', 'nombre_juez')
                ->sortable()
                ->searchable(),

            Column::make('codigo fragancia', 'codigo_fragancia')
                ->sortable()
                ->searchable(),

            Column::make('portador', 'portador')
                ->sortable()
                ->searchable(),

            Column::make('control', 'control')
                ->sortable()
                ->searchable(),

            Column::make('calificacion', 'calificacion')
                ->sortable()
                ->searchable(),

            Column::make('fecha evaluacion', 'fecha_evaluacion')
                ->sortable(),

            //Column::action('Action')
        ];
    }

    public function filters(): array
    {
        return [
            Filter::inputText('id_evaluated', 'evaluated_fragances_id_evaluated_fragance')
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

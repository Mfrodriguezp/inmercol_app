<?php

namespace App\Livewire\Admin\Reports;

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
use Illuminate\Support\Facades\DB;

final class JudmentTable extends PowerGridComponent
{
    use WithExport;
    public string $primaryKey = 'judments.id_judment';
    public string $sortField = 'judments.id_judment';
    public int $perPage = 20;
    public array $perPageValues = [0, 5, 10, 20, 50, 100];
    public bool $showFilters = true;
    public function setUp(): array
    {

        $nameFile = Carbon::parse(now())->format('mdy_His'); // Nombre para el archivo exportable basado en la fecha/hora
        $this->showCheckBox('id_judment');
        return [
            Exportable::make($nameFile)
                ->striped('82CDD0')
                ->type(Exportable::TYPE_XLS, Exportable::TYPE_CSV)
                ->columnWidth([
                    3 => 12,
                    4 => 10,
                    5 => 10,
                    6 => 10,
                    7 => 10,
                    8 => 12,
                    9 => 10,
                    10 => 10,
                    11 => 10,
                    12 => 10,
                ]),
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
                'evaluated_fragances.id_evaluated_fragance',
                'judments.id_judment',
                'projects.project_name',
                'evaluated_fragances.test_identifier',
                'carrier_type',
                'judges.judge_number',
                'judges.judge_name',
                'fragance_1',
                'qualification_control_1_frag_1',
                'qualification_control_2_frag_1',
                'qualification_control_3_frag_1',
                'qualification_control_4_frag_1',
                'fragance_2',
                'qualification_control_1_frag_2',
                'qualification_control_2_frag_2',
                'qualification_control_3_frag_2',
                'qualification_control_4_frag_2',
                'evaluation_date'
            ])
            ->orderByDesc('evaluated_fragances.id_evaluated_fragance')
            ->orderBy('carrier_type')
            ->orderBy(DB::raw('judges.judge_number + 0'));
    }


    public function fields(): PowerGridFields
    {
        return PowerGrid::fields()
            ->add('id_judment')
            ->add('projects.project_name')
            ->add('evaluated_fragances.test_identifier')
            ->add('carrier_type', function (Judment $judment) {
                return strtoupper($judment->carrier_type);
            })
            ->add('judges.judge_number')
            ->add('judges.judge_name')
            ->add('fragance_1')
            ->add('qualification_control_1_frag_1',function (Judment $judment){
                //Return number with two decimals and colon with decimal separator
                return number_format($judment->qualification_control_1_frag_1,2,",",".");
            })
            ->add('qualification_control_2_frag_1',function (Judment $judment){
                //Return number with two decimals and colon with decimal separator
                return number_format($judment->qualification_control_2_frag_1,2,",",".");
            })
            ->add('qualification_control_3_frag_1',function (Judment $judment){
                //Return number with two decimals and colon with decimal separator
                return number_format($judment->qualification_control_3_frag_1,2,",",".");
            })
            ->add('qualification_control_4_frag_1',function (Judment $judment){
                //Return number with two decimals and colon with decimal separator
                return number_format($judment->qualification_control_4_frag_1,2,",",".");
            })
            ->add('fragance_2')
            ->add('qualification_control_1_frag_2',function (Judment $judment){
                //Return number with two decimals and colon with decimal separator
                return number_format($judment->qualification_control_1_frag_2,2,",",".");
            })
            ->add('qualification_control_2_frag_2',function (Judment $judment){
                //Return number with two decimals and colon with decimal separator
                return number_format($judment->qualification_control_2_frag_2,2,",",".");
            })
            ->add('qualification_control_3_frag_2',function (Judment $judment){
                //Return number with two decimals and colon with decimal separator
                return number_format($judment->qualification_control_3_frag_2,2,",",".");
            })
            ->add('qualification_control_4_frag_2',function (Judment $judment){
                //Return number with two decimals and colon with decimal separator
                return number_format($judment->qualification_control_4_frag_2,2,",",".");
            })
            ->add('evaluation_date', function (Judment $judment) {
                return Carbon::parse($judment->evaluation_date)->format('d-m-Y | H:i');
            });
    }

    public function columns(): array
    {
        return [
            Column::make('cod. evaluación', 'test_identifier')
                ->sortable()
                ->searchable()
                ->visibleInExport(false),
            Column::make('proyecto', 'project_name')
                ->sortable()
                ->searchable()
                ->visibleInExport(false),
            Column::make('portador', 'carrier_type')
                ->sortable()
                ->searchable(),
            Column::make('N° Juez', 'judge_number')
                ->sortable()
                ->searchable(),
            Column::make('juez', 'judge_name')
                ->sortable()
                ->searchable()
                ->visibleInExport(false),
            Column::make('fragancia 1', 'fragance_1')
                ->sortable()
                ->searchable(),
            Column::make('c1 frag 1', 'qualification_control_1_frag_1'),
            Column::make('c2 frag 1', 'qualification_control_2_frag_1'),
            Column::make('c3 frag 1', 'qualification_control_3_frag_1'),
            Column::make('c4 frag 1', 'qualification_control_4_frag_1'),
            Column::make('fragancia 2', 'fragance_2')
                ->sortable()
                ->searchable(),
            Column::make('c1 frag 2', 'qualification_control_1_frag_2'),
            Column::make('c2 frag 2', 'qualification_control_2_frag_2'),
            Column::make('c3 frag 2', 'qualification_control_3_frag_2'),
            Column::make('c4 frag 2', 'qualification_control_4_frag_2'),
            Column::make('fecha evaluacion', 'evaluation_date')
                ->sortable()
                ->visibleInExport(false),
        ];
    }

    public function filters(): array
    {
        return [
            Filter::inputText('test_identifier', 'test_identifier')
                ->operators(['contains','is','is_not']),
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

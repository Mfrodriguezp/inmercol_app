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
use Illuminate\Support\Facades\Auth;
use App\Models\User;

final class EvaluatedTable extends PowerGridComponent
{
    use WithExport;
    public string $primaryKey = 'evaluated_fragances.id_evaluated_fragance';
    public string $sortField = 'evaluated_fragances.id_evaluated_fragance';
    public int $perPage = 5;
    public array $perPageValues = [0, 5, 10, 20, 50, 100];

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
            ])->orderByDesc('id_evaluated_fragance');
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
            ->add('fragance_ms_1')
            ->add('fragance_test_code_1')
            ->add('fragance_name_2')
            ->add('fragance_ms_2')
            ->add('fragance_test_code_2')
            ->add('rot_fragance_aplication')
            ->add('name_carrier_a')
            ->add('name_carrier_b')
            ->add('control_1')
            ->add('control_2')
            ->add('control_3')
            ->add('control_4')
            ->add('status_evaluation');
    }

    public function columns(): array
    {
        return [
            Column::make('ID', 'id_evaluated_fragance'),
            Column::make('codigo de evaluacion', 'test_identifier')
                ->sortable()
                ->searchable(),
            Column::make('proyecto', 'project_name')
                ->sortable()
                ->searchable(),
            Column::make('Fragancia 1', 'fragance_name_1')
                ->sortable()
                ->searchable(),

            Column::make('Muestra Frag. 1', 'fragance_ms_1')
                ->sortable()
                ->searchable(),

            Column::make('Cod. Test Frag. 1', 'fragance_test_code_1')
                ->sortable()
                ->searchable(),

            Column::make('Fragancia 2', 'fragance_name_2')
                ->sortable()
                ->searchable(),

            Column::make('Muestra Frag. 2', 'fragance_ms_2')
                ->sortable()
                ->searchable(),

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

            Column::make('Control 1', 'control_1')
                ->sortable()
                ->searchable()
                ->hidden($isHidden = true, $isForceHidden = false),

            Column::make('Control 2', 'control_2')
                ->sortable()
                ->searchable()
                ->hidden($isHidden = true, $isForceHidden = false),

            Column::make('Control 3', 'control_3')
                ->sortable()
                ->searchable()
                ->hidden($isHidden = true, $isForceHidden = false),

            Column::make('Control 4', 'control_4')
                ->sortable()
                ->searchable()
                ->hidden($isHidden = true, $isForceHidden = false),

            Column::make('Estado', 'status_evaluation')
                ->sortable()
                ->searchable(),

            Column::action('Action')
        ];
    }

    public function filters(): array
    {
        return [
            Filter::inputText('proyecto', '')
                ->operators(['contains']),
        ];
    }

    #[\Livewire\Attributes\On('edit')]
    public function edit($rowId): void
    {
        $this->js('alert(' . $rowId . ')');
    }

    public function actions(\App\Models\EvaluatedFragance $row): array
    {
        //Validación de usuario actual para permiso de eliminar
        $id_user = Auth::user()->id;
        $this_authorize = User::permission('admin.evaluateds.destroy')
            ->where('id', $id_user)
            ->get();
        if (count($this_authorize) == 0) {
            $canDestroy = false;
        } else {
            $canDestroy = true;
        }

        return [
            Button::add('edit')
                ->slot('<i class="fa-solid fa-spray-can-sparkles"></i>')
                ->class('inline-flex items-center justify-center px-2 py-2 bg-lime-600 border border-transparent rounded-full font-semibold text-xs text-white uppercase tracking-widest hover:bg-lime-500 active:bg-lime-700 focus:outline-none focus:ring-2 focus:ring-lime-500 focus:ring-offset-2 transition ease-in-out duration-150')
                ->openModal('admin.rot-fragance-carriers-modal', ['evaluatedFragance' => $row->id_evaluated_fragance])
                ->tooltip('Ver aplicación de fragancias'),
            Button::add('edit')
                ->slot('<i class="fa-solid fa-pencil"></i>')
                ->class('inline-flex items-center justify-center px-2 py-2 bg-yellow-600 border border-transparent rounded-full font-semibold text-xs text-white uppercase tracking-widest hover:bg-yellow-500 active:bg-yellow-700 focus:outline-none focus:ring-2 focus:ring-red-500 focus:ring-offset-2 transition ease-in-out duration-150')
                ->openModal('admin.create-edit-evaluated-modal', ['evaluatedFragance' => $row->id_evaluated_fragance])
                ->tooltip('Editar'),
            Button::add('destroy')
                ->slot('<i class="fa-solid fa-trash"></i>')
                ->class('inline-flex items-center justify-center px-2 py-2 bg-red-600 border border-transparent rounded-full font-semibold text-xs text-white uppercase tracking-widest hover:bg-red-500 active:bg-red-700 focus:outline-none focus:ring-2 focus:ring-red-500 focus:ring-offset-2 transition ease-in-out duration-150')
                ->openModal('admin.destroy-evaluated-modal', ['evaluatedFragance' => $row->id_evaluated_fragance])
                ->can($canDestroy)
                ->tooltip('Eliminar'),
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

<?php

namespace App\Livewire;

use App\Models\Project;
use App\Models\User;
use Illuminate\Auth\Access\Gate;
use Illuminate\Support\Carbon;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Facades\Auth;
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
use PowerComponents\LivewirePowerGrid\Facades\Rule;
use Illuminate\Support\Facades\Blade;
use PowerComponents\LivewirePowerGrid\Themes\Components\Toggleable;


final class ProjectTable extends PowerGridComponent
{
    use WithExport;

    public string $primaryKey = 'id_project';
    public string $sortField = 'id_project';
    public int $perPage = 10;
    public array $perPageValues = [0, 5, 10, 20, 50, 100];
    public bool $showFilters = true;
    public function setUp(): array
    {
        $this->showCheckBox('id_project');

        return [
            Exportable::make('export')
                ->striped()
                ->type(Exportable::TYPE_XLS, Exportable::TYPE_CSV),
            Header::make()
                ->showSearchInput()
                ->showToggleColumns()
                ->withoutLoading(),
            Footer::make()
                ->showPerPage($this->perPage, $this->perPageValues)
                ->showRecordCount()
                ->showRecordCount(mode: 'min'),
        ];
    }

    public function datasource(): ?Builder
    {
        return Project::query()

            ->join('clients', function ($clients) {
                $clients->on('projects.clients_id_client', '=', 'clients.id_client');
            })
            ->select([
                'projects.id_project',
                'projects.id_analisys',
                'projects.project_name',
                'projects.status',
                'projects.date_creation',
                'projects.last_evaluation',
                'clients.client_name as client_name',
            ]);
    }

    public function relationSearch(): array
    {
        return [];
    }



    public function fields(): PowerGridFields
    {

        return PowerGrid::fields()
            ->add('id_project')
            ->add('id_analisys')
            ->add('project_name')
            ->add('client_name')
            ->add('status')
            ->add('date_creation', function (Project $project) {
                return Carbon::parse($project->date_creation)->format('d-m-Y | H:i');
            })
            ->add('last_evaluation', function (Project $project) {
                return Carbon::parse($project->last_evaluation)->format('d-m-Y | H:i');
            });
    }

    public function onUpdatedToggleable(string $id, string $field, string $value): void
    {

        $project = Project::query()->find($id)->update([
            $field => $value,
        ]);
        $this->skipRender();
    }

    public function columns(): array
    {
        $canEdit = true;
        return [
            Column::make('ID', 'id_project')
                ->sortable()
                ->searchable(),
            Column::make('ID Analisis', 'id_analisys')
                ->sortable()
                ->searchable(),
            Column::make('Proyecto', 'project_name')
                ->sortable()
                ->searchable(),
            Column::make('Cliente', 'client_name')
                ->sortable()
                ->searchable(),
            Column::make('Fecha Creación', 'date_creation')
                ->sortable()
                ->searchable(),
            Column::make('Última Evaluación', 'last_evaluation')
                ->sortable()
                ->searchable(),
            Column::make('Estado', 'status')
                ->sortable()
                ->searchable()
                ->toggleable($canEdit, 'Finalizado', 'En curso'),
            Column::action('Action')
        ];
    }

    public function filters(): array
    {
        return [
            Filter::boolean('status')
                ->label('Finalizado', 'En curso')
        ];
    }

    #[\Livewire\Attributes\On('edit')]
    public function edit($rowId): void
    {
        $this->js('alert(' . $rowId . ')');
    }

    public function actions(\App\Models\Project $row): array
    {
        //Validación de usuario actual para permiso de eliminar
        $id_user = Auth::user()->id;
        $this_authorize = User::permission('admin.projects.destroy')
        ->where('id',$id_user)
        ->get();
        if(count($this_authorize)==0){
            $canDestroy = false;
        }else{
            $canDestroy = true;
        }

        return [
            Button::add('evaluated')
                ->slot('<i class="fa-solid fa-flask-vial"></i>')
                ->class('inline-flex items-center px-2 py-2 bg-gray-800 border border-transparent rounded-full font-semibold text-xs text-white uppercase tracking-widest hover:bg-gray-700 focus:bg-gray-700 active:bg-gray-900 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 transition ease-in-out duration-150')
                ->openModal('admin.create-edit-evaluated-modal', ['id_project' => $row->id_project])
                ->tooltip('Añadir Evaluaciones'),
            Button::add('historial')
                ->slot('<i class="fa-solid fa-timeline"></i>')
                ->class('btn-primary inline-flex items-center px-2 py-2 border border-transparent rounded-full font-semibold text-xs text-white uppercase tracking-widest hover:bg-green-700 focus:bg-green-700 active:bg-green-900 focus:outline-none focus:ring-2 focus:ring-green-500 focus:ring-offset-2 transition ease-in-out duration-150')
                ->openModal('admin.time-line-modal', ['project' => $row->id_project])
                ->tooltip('Histórico de evaluaciones'),
            Button::add('edit')
                ->slot('<i class="fa-solid fa-pencil"></i>')
                ->class('inline-flex items-center justify-center px-2 py-2 bg-yellow-600 border border-transparent rounded-full font-semibold text-xs text-white uppercase tracking-widest hover:bg-yellow-500 active:bg-yellow-700 focus:outline-none focus:ring-2 focus:ring-red-500 focus:ring-offset-2 transition ease-in-out duration-150')
                ->openModal('admin.create-edit-modal', ['project' => $row->id_project])
                ->tooltip('Editar'),
            Button::add('destroy')
                ->slot('<i class="fa-solid fa-trash"></i>')
                ->class('inline-flex items-center justify-center px-2 py-2 bg-red-600 border border-transparent rounded-full font-semibold text-xs text-white uppercase tracking-widest hover:bg-red-500 active:bg-red-700 focus:outline-none focus:ring-2 focus:ring-red-500 focus:ring-offset-2 transition ease-in-out duration-150')
                ->openModal('admin.destroy-modal', ['project' => $row->id_project])
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
                ->when(fn ($row) => $row->id === 1)
                ->hide(),
        ];
    }*/
}

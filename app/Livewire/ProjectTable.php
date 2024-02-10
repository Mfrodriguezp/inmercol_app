<?php

namespace App\Livewire;

use App\Models\Project;
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
use PowerComponents\LivewirePowerGrid\Facades\Rule;
use Illuminate\Support\Facades\Blade;

final class ProjectTable extends PowerGridComponent
{
    use WithExport;

    public string $primaryKey = 'projects.id_project';
    public string $sortField = 'projects.id_project';
    public int $perPage = 5;
    public array $perPageValues = [0, 5, 10, 20, 50, 100];
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
                'projects.project_name',
                'projects.status',
                'projects.date_creation',
                'projects.last_evaluation',
                'clients.client_name as client_name',
            ])->orderByDesc('id_project');
    }

    public function relationSearch(): array
    {
        return [];
    }

    public function fields(): PowerGridFields
    {
        return PowerGrid::fields()
            ->addColumn('project_name')
            ->addColumn('client_name')
            ->addColumn('status')
            ->addColumn('date_creation',function(Project $project){
                return Carbon::parse($project->date_creation)->format('d-m-Y');
            })
            ->addColumn('last_evaluation',function(Project $project){
                return Carbon::parse($project->last_evaluation)->format('d-m-Y');
            });
    }

    public function columns(): array
    {
        return [
            Column::make('Proyecto', 'project_name')
                ->sortable()
                ->searchable(),
            Column::make('Cliente', 'client_name')
                ->sortable()
                ->searchable(),
            Column::make('Fecha Creación', 'date_creation')
                ->sortable()
                ->searchable(),
            Column::make('Última Evaluación', 'last_evaluation_formatted', 'last_evaluation')
                ->sortable(),
            Column::make('Estado', 'status')
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

    public function actions(\App\Models\Project $row): array
    {
        return [
            Button::add('evaluated')
                ->slot('<i class="fa-solid fa-flask-vial"></i>')
                ->class('inline-flex items-center px-2 py-2 bg-gray-800 border border-transparent rounded-full font-semibold text-xs text-white uppercase tracking-widest hover:bg-gray-700 focus:bg-gray-700 active:bg-gray-900 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 transition ease-in-out duration-150')
                ->dispatch('admin.edit-modal', ['rowId' => $row->id])
                ->tooltip('Añadir Evaluaciones'),
            Button::add('Historial')
                ->slot('<i class="fa-solid fa-timeline"></i>')
                ->class('btn-primary inline-flex items-center px-2 py-2 border border-transparent rounded-full font-semibold text-xs text-white uppercase tracking-widest hover:bg-green-700 focus:bg-green-700 active:bg-green-900 focus:outline-none focus:ring-2 focus:ring-green-500 focus:ring-offset-2 transition ease-in-out duration-150')
                ->dispatch('admin.edit-modal', ['rowId' => $row->id])
                ->tooltip('Permisos'),
            Button::add('edit')
                ->slot('<i class="fa-solid fa-pencil"></i>')
                ->class('inline-flex items-center justify-center px-2 py-2 bg-yellow-600 border border-transparent rounded-full font-semibold text-xs text-white uppercase tracking-widest hover:bg-yellow-500 active:bg-yellow-700 focus:outline-none focus:ring-2 focus:ring-red-500 focus:ring-offset-2 transition ease-in-out duration-150')
                ->openModal('admin.create-edit-user-modal', ['user' => $row])
                ->tooltip('Editar'),
            Button::add('destroy')
                ->slot('<i class="fa-solid fa-trash"></i>')
                ->class('inline-flex items-center justify-center px-2 py-2 bg-red-600 border border-transparent rounded-full font-semibold text-xs text-white uppercase tracking-widest hover:bg-red-500 active:bg-red-700 focus:outline-none focus:ring-2 focus:ring-red-500 focus:ring-offset-2 transition ease-in-out duration-150')
                ->openModal('admin.edit-modal', ['rowId' => $row->id])
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

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
                $clients->on('projects.id_client', '=', 'clients.id_client');
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
            ->addColumn('date_creation')
            ->addColumn('last_evaluation');
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
            Column::make('Last evaluation', 'last_evaluation_formatted', 'last_evaluation')
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
            Button::add('addEvaluated')
                ->render(function (Project $project) {
                    return Blade::render(<<<HTML
            <x-button-evaluated wire:click="editStock('$project->id')">
            <i class="fa-solid fa-flask-vial"></i>
            </x-button-evaluated>
            HTML);
                }),
            Button::add('view')
                ->render(function (Project $project) {
                    return Blade::render(<<<HTML
        <x-button-view wire:click="editStock('$project->id')">
        <i class="fa-solid fa-timeline"></i>
            </x-button-view>
        HTML);
                }),
            Button::add('edit')
                ->tooltip('Editar registro')
                ->render(function (Project $project) {
                    return Blade::render(<<<HTML
            <x-button-edit wire:click="projects.editProject($project->id_project)">
            <i class="fa-solid fa-pencil"></i>
            </x-button-edit>
            HTML);
                }),
            Button::add('delete')
                ->render(function (Project $project) {
                    return Blade::render(<<<HTML
            <x-button-delete wire:click="editStock('$project->id')">
            <i class="fa-solid fa-trash"></i>
            </x-button-delete>
            HTML);
                }),
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

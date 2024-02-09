<?php

namespace App\Livewire;

use App\Models\Judge;
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
use Illuminate\Support\Facades\Blade;

final class JudgeTable extends PowerGridComponent
{
    use WithExport;
    public string $primaryKey = 'judges.id_judge';
    public string $sortField = 'judges.id_judge';
    public int $perPage = 5;
    public array $perPageValues = [0, 5, 10, 20];

    public function setUp(): array
    {
        $this->showCheckBox('id_judge');

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
        return Judge::query();
    }

    public function relationSearch(): array
    {
        return [];
    }

    public function fields(): PowerGridFields
    {
        return PowerGrid::fields()
            ->addColumn('judge_number')
            ->addColumn('judge_name');
    }

    public function columns(): array
    {
        return [
            Column::make('Judge number', 'judge_number')
                ->sortable()
                ->searchable(),

            Column::make('Judge name', 'judge_name')
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

    public function actions(\App\Models\Judge $row): array
    {
        return [
            Button::add('view')
                ->render(function (Judge $judge) {
                    return Blade::render(<<<HTML
    <x-button-view wire:click="editStock('$judge->id')">
    <i class="fa-solid fa-eye"></i>
        </x-button-view>
    HTML);
                }),
            Button::add('edit')
                ->render(function (Judge $judge) {
                    return Blade::render(<<<HTML
        <x-button-edit wire:click="editStock('$judge->id')">
        <i class="fa-solid fa-pencil"></i>
        </x-button-edit>
        HTML);
                }),
            Button::add('delete')
                ->render(function (Judge $judge) {
                    return Blade::render(<<<HTML
        <x-button-delete wire:click="editStock('$judge->id')">
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

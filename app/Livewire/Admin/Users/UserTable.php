<?php

namespace App\Livewire\Admin\Users;

use App\Models\User;
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
use Illuminate\View\View;
use Livewire\Component;
use Illuminate\Support\Facades\Auth;

final class UserTable extends PowerGridComponent
{
    use WithExport;
    public int $perPage = 10;
    public array $perPageValues = [0, 5, 10, 20, 50, 100];
    public bool $showFilters = true;

    public function setUp(): array
    {
        $this->showCheckBox();

        return [
            Exportable::make('export')
                ->striped()
                ->type(Exportable::TYPE_XLS, Exportable::TYPE_CSV),
            Header::make()->showSearchInput(),
            Footer::make()
                ->showPerPage($this->perPage, $this->perPageValues)
                ->showRecordCount(),
        ];
    }

    public function datasource(): Builder
    {
        return User::query();
    }

    public function relationSearch(): array
    {
        return [];
    }

    public function fields(): PowerGridFields
    {
        return PowerGrid::fields()
            ->add('id')
            ->add('name')
            ->add('email')
            ->add('created_at');
    }

    public function columns(): array
    {
        return [
            Column::make('ID', 'id'),
            Column::make('Nombre', 'name')
                ->sortable()
                ->searchable(),

            Column::make('Correo', 'email')
                ->sortable()
                ->searchable(),

            Column::make('Fecha Creación', 'created_at')
                ->sortable()
                ->searchable(),

            Column::action('Opciones')
        ];
    }

    public function filters(): array
    {
        return [];
    }

    #[\Livewire\Attributes\On('edit')]
    public function edit($rowId)
    {
        //$this->js('alert('.$rowId.')');
        return redirect()->route('admin.users.edit', [$rowId]);
    }

    #[\Livewire\Attributes\On('destroy')]
    public function destroy($rowId): void
    {
        $this->js('alert(' . $rowId . ')');
    }
    #[\Livewire\Attributes\On('test')]
    public function test($rowId)
    {
        $openModal = true;
        return redirect()->route('admin.users.index', compact('openModal'));
        //$this->js('alert('.$rowId.')');
    }


    public function actions(\App\Models\User $row): array
    {
        //Validación de usuario actual para permiso de eliminar
        $id_user = Auth::user()->id;
        $this_authorize = User::permission('admin.users.destroy')
        ->where('id',$id_user)
        ->get();
        if(count($this_authorize)==0){
            $canDestroy = false;
        }else{
            $canDestroy = true;
        }
        return [
            Button::add('edit')
                ->slot('<i class="fa-solid fa-pencil"></i>')
                ->class('inline-flex items-center justify-center px-2 py-2 bg-yellow-600 border border-transparent rounded-full font-semibold text-xs text-white uppercase tracking-widest hover:bg-yellow-500 active:bg-yellow-700 focus:outline-none focus:ring-2 focus:ring-red-500 focus:ring-offset-2 transition ease-in-out duration-150')
                ->openModal('admin.users.create-edit-user-modal', ['user' => $row->id])
                ->tooltip('Editar'),
            Button::add('reset')
                ->slot('<i class="fa-solid fa-rotate-left"></i>')
                ->class('inline-flex items-center justify-center px-2 py-2 bg-lime-600 border border-transparent rounded-full font-semibold text-xs text-white uppercase tracking-widest hover:bg-lime-500 active:bg-lime-700 focus:outline-none focus:ring-2 focus:ring-lime-500 focus:ring-offset-2 transition ease-in-out duration-150')
                ->openModal('admin.users.reset-password-modal', ['user' => $row->id])
                ->tooltip('Restablecer Password'),
            Button::add('destroy')
                ->slot('<i class="fa-solid fa-trash"></i>')
                ->class('inline-flex items-center justify-center px-2 py-2 bg-red-600 border border-transparent rounded-full font-semibold text-xs text-white uppercase tracking-widest hover:bg-red-500 active:bg-red-700 focus:outline-none focus:ring-2 focus:ring-red-500 focus:ring-offset-2 transition ease-in-out duration-150')
                ->openModal('admin.users.destroy-modal', ['user' => $row->id])
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

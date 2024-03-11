<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use Spatie\Permission\Models\Role;
use Illuminate\Support\Facades\Validator;
use Illuminate\Foundation\Exceptions\ReportableHandler;
use Spatie\FlareClient\Truncation\ReportTrimmer;
use Throwable;
class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('admin.users.index');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        try {
            $user= User::Create([
                'name'=>$request->input('name'),
                'email'=>$request->input('email'),
                'password'=>bcrypt($request->input('password_confirmation'))
            ])->assignRole($request->input('role'));
        } catch (Throwable $e) {
            //report($e);
            return redirect()->route('admin.users.index')
            ->with('error','No se ha podido crear el usuario, por favor valide la información ingresada');
        }

        return redirect()->route('admin.users.index')
        ->with('success','El usuario ha sido creado satisfactoriamente');
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, User $user)
    {
        $user->roles()->sync($request->role);
        return redirect()->route('admin.users.index')
        ->with('success','El usuario ha sido modificado');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(User $user)
    {
        $user->delete();
        return redirect()->route('admin.users.index')
        ->with('success','El usuario '.$user->name.' ha sido eliminado correctamente');
    }
}

<?php

namespace App\Http\Controllers;

use App\Models\Role;
use Illuminate\Http\Request;

class RoleController extends Controller
{
    public function __construct()
    {
        $this->middleware(['auth','active']);
        $this->middleware('roles:Administrador,Supervisor');

    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //listar los roles select + from roles
        $roles = Role::select('id','name')->get();

        return view('roles.index',[
            'roles' => $roles,
            'module' => 'Roles',
            'new' => 'Nuevo Rol',
            'notice' => 'No hay roles registrados',
            'subject' => 'Lista de Roles',
            'route' => route('roles.create'),
        ]);

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('roles.create',[
            'role' => $role = new Role,
            'module' => 'Roles',
            'subject' => 'Nuevo Rol',
            'button' => 'Guardar',
            'process' => route('roles.store'),
            'back' => route('roles.index'),
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request,[
            'name' => 'required|string|min:3|unique:roles'
        ]);

        $role = new Role;
        $role->name = $request->name;
        $role->save();

        return redirect('/roles')->with('success','El rol se ha registrado correctamente');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Role  $role
     * @return \Illuminate\Http\Response
     */
    public function show(Role $role)
    {
        return view('roles.show', [
            'role' => $role,
            'module' => 'Roles',
            'subject' => 'Detalle de Rol',
            'back' => route('roles.index')
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Role  $role
     * @return \Illuminate\Http\Response
     */
    public function edit(Role $role)
    {
        return view('roles.edit',[
            'role' => $role,
            'module' => 'Roles',
            'subject' => 'Editar Rol',
            'button' => 'Editar',
            'process' => route('roles.update', $role),
            'back' => route('roles.index')
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Role  $role
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Role $role)
    {
        $this->validate($request,[
            'name' => 'required|string|min:3'
        ]);

        $role = Role::find($role->id); //select * from roles where id = {$id};
        $role->name = $request->name;
        $role->save();

        return redirect('/roles/' . $role->id)->with('success','El rol se ha modificado correctamente');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Role  $role
     * @return \Illuminate\Http\Response
     */
    public function destroy(Role $role)
    {
        //
    }
}

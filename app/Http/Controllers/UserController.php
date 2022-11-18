<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Role;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    public function __construct()
    {
        //$this->middleware(['auth','active']);

    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //mostraremos los usuarios asociados a un rol
        $users = User::with('role')->get();

        return view('users.index',[
            'users' => $users,
            'module' => 'Usuarios',
            'new' => 'Nuevo Usuario',
            'notice' => 'No hay usuarios registrados',
            'subject' => 'Lista de Usuarios',
            'route' => route('users.create'),
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $roles = Role::select('id','name')->orderBy('name')->get();

        return view('users.create',[
            'user' => $user = new User,
            'roles' => $roles,
            'module' => 'Usuarios',
            'button' => 'Guardar',
            'subject' => 'Nuevo Usuario',
            'process' => route('users.store'),
            'back' => route('users.index')
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
            'name' => 'required|string|min:3',
            'email' => 'required|email|unique:users',
            'role' => 'required|integer',
            'password' => 'required|string|min:8|confirmed'
        ]);

        $user = new User;
        $user->name = $request->name;
        $user->email = $request->email;
        $user->active = 1; //usuario activo
        $user->password = Hash::make($request->password);
        $user->role_id = $request->role;
        $user->save();

        return redirect('/users')->with('success','El usuario se ha registrado correctamente');
    }

    /**
    * Display the specified resource.
    *
    * @param \App\Models\User $user
    * @return \Illuminate\Http\Response
    */
    public function show(User $user)
    {
        return view('users.show',[
            'user' => $user,
            'module' => 'Usuarios',
            'subject' => 'Detalle Usuario',
            'back' => route('users.index')
        ]);
    }

    /**
    * Show the form for editing the specified resource.
    *
    * @param \App\Models\User $user
    * @return \Illuminate\Http\Response
    */
    public function edit(User $user)
    {
        $roles = Role::select('id','name')->orderBy('name')->get();

        return view('users.edit',[
        'user' => $user,
        'roles' => $roles,
        'module' => 'Usuarios',
        'button' => 'Editar',
        'subject' => 'Editar Usuario',
        'process' => route('users.update', $user),
        'back' => route('users.index')
        ]);
    }

    /**
    * Update the specified resource in storage.
    *
    * @param \Illuminate\Http\Request $request
    * @param \App\Models\User $user
    * @return \Illuminate\Http\Response
    */
    public function update(Request $request, User $user)
    {
        $this->validate($request,[
            'name' => 'required|string|min:3',
            'email' => 'required|email',
            'role' => 'required|integer',
            'active' => 'required|integer',
        ]);

        $user = User::find($user->id);
        $user->name = $request->name;
        $user->email = $request->email;
        $user->active = $request->active;
        $user->role_id = $request->role;
        $user->save();

        return redirect('/users/' . $user->id)->with('success','El usuario se ha modificado correctamente');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}

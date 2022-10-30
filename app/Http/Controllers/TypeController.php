<?php

namespace App\Http\Controllers;

use App\Models\Type;
use Illuminate\Http\Request;

class TypeController extends Controller
{
    public function __construct()
    {
        $this->middleware(['auth','active','roles:Administrador']);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $types = Type::select('id','name')->get();

        return view('types.index',[
            'types' => $types,
            'module' => 'Tipos',
            'new' => 'Nuevo Tipo',
            'notice' => 'No hay tipos registrados',
            'subject' => 'Lista de Tipos',
            'route' => route('types.create'),
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('types.create',[
            'type' => $type = new Type,
            'module' => 'Tipos',
            'subject' => 'Nuevo Tipo',
            'button' => 'Guardar',
            'process' => route('types.store'),
            'back' => route('types.index')
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
        $this->validate($request, [
            'name' => 'required|string|min:3|unique:types'
        ]);

        $type = new Type;
        $type->name = $request->name;
        $type->save();

        return redirect('/types')->with('success','El tipo de ha registrado correctamente');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Type  $type
     * @return \Illuminate\Http\Response
     */
    public function show(Type $type)
    {
        return view('types.show',[
            'type' => $type,
            'subject' => 'Detalle Tipo',
            'module' => 'Tipos',
            'back' => route('types.index')
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Type  $type
     * @return \Illuminate\Http\Response
     */
    public function edit(Type $type)
    {
        return view('types.edit',[
            'type' => $type,
            'module' => 'Tipos',
            'subject' => ']Editar Tipo',
            'button' => 'Editar',
            'process' => route('types.update', $type),
            'back' => route('types.index')
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Type  $type
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Type $type)
    {
        $this->validate($request, [
            'name' => 'required|string|min:3|unique:types'
        ]);

        $type = Type::find($type->id);
        $type->name = $request->name;
        $type->save();

        return redirect('/types/' . $type->id)->with('success','El tipo de ha modificado correctamente');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Type  $type
     * @return \Illuminate\Http\Response
     */
    public function destroy(Type $type)
    {
        //
    }
}

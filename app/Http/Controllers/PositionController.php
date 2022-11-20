<?php

namespace App\Http\Controllers;

use App\Models\Position;
use Illuminate\Http\Request;

class PositionController extends Controller
{
    public function __construct()
    {
        $this->middleware(['auth','active']);
        $this->middleware('roles:Administrador');

    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $positions = Position::select('id','name')->get();

        return view('positions.index',[
            'positions' => $positions,
            'module' => 'Cargos',
            'new' => 'Nuevo Cargo',
            'notice' => 'No hay cargos registrados',
            'subject' => 'Lista de Cargos',
            'route' => route('positions.create'),
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('positions.create',[
            'position' => $position = new Position,
            'module' => 'Cargos',
            'subject' => 'Nuevo Cargo',
            'button' => 'Guardar',
            'process' => route('positions.store'),
            'back' => route('positions.index'),
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
            'name' => 'required|string|min:3|unique:positions'
        ]);

        $position = new Position;
        $position->name = $request->name;
        $position->save();

        return redirect('/positions')->with('success','El cargo se ha registrado correctamente');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Position  $position
     * @return \Illuminate\Http\Response
     */
    public function show(Position $position)
    {
        return view('positions.show', [
            'position' => $position,
            'module' => 'Cargos',
            'subject' => 'Detalle de Cargo',
            'back' => route('positions.index')
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Position  $position
     * @return \Illuminate\Http\Response
     */
    public function edit(Position $position)
    {
        return view('positions.create',[
            'position' => $position,
            'module' => 'Cargos',
            'subject' => 'Editar Cargo',
            'button' => 'Editar',
            'process' => route('positions.update', $position),
            'back' => route('positions.index'),
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Position  $position
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Position $position)
    {
        $this->validate($request,[
            'name' => 'required|string|min:3|unique:positions'
        ]);

        $position = Position::find($position->id);
        $position->name = $request->name;
        $position->save();

        return redirect('/positions/' . $position->id)->with('success','El cargo se ha modificado correctamente');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Position  $position
     * @return \Illuminate\Http\Response
     */
    public function destroy(Position $position)
    {
        //
    }
}

<?php

namespace App\Http\Controllers;

use App\Models\Area;
use Illuminate\Http\Request;

class AreaController extends Controller
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
        $areas = Area::select('id','name')->get();

        return view('areas.index',[
            'areas' => $areas,
            'module' => 'Regiones',
            'new' => 'Nueva Region',
            'notice' => 'No hay regiones registradas',
            'subject' => 'Lista de Regiones',
            'route' => route('areas.create'),
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('areas.create',[
            'area' => $area = new Area,
            'module' => 'Regiones',
            'subject' => 'Nueva Regiom',
            'button' => 'Guardar',
            'process' => route('areas.store'),
            'back' => route('areas.index'),
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
            'name' => 'required|string|min:3|unique:areas'
        ]);

        $area = new Area;
        $area->name = $request->name;
        $area->save();

        return redirect('/areas')->with('success','La región se ha registrado correctamente');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Area  $area
     * @return \Illuminate\Http\Response
     */
    public function show(Area $area)
    {
        return view('areas.show', [
            'area' => $area,
            'module' => 'Regiones',
            'subject' => 'Detalle de Region',
            'back' => route('areas.index')
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Area  $area
     * @return \Illuminate\Http\Response
     */
    public function edit(Area $area)
    {
        return view('areas.edit',[
            'area' => $area,
            'module' => 'Regiones',
            'subject' => 'Editar Regiom',
            'button' => 'Editar',
            'process' => route('areas.update', $area),
            'back' => route('areas.index'),
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Area  $area
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Area $area)
    {
        $this->validate($request,[
            'name' => 'required|string|min:3|unique:areas'
        ]);

        $area = Area::find($area->id);
        $area->name = $request->name;
        $area->save();

        return redirect('/areas/' . $area->id)->with('success','La región se ha modificado correctamente');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Area  $area
     * @return \Illuminate\Http\Response
     */
    public function destroy(Area $area)
    {
        //
    }
}

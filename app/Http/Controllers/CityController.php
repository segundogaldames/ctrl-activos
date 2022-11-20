<?php

namespace App\Http\Controllers;

use App\Models\City;
use App\Models\Area;
use Illuminate\Http\Request;

class CityController extends Controller
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
        $cities = City::with('area')->get();

        return view('cities.index',[
            'cities' => $cities,
            'module' => 'Comunas',
            'new' => 'Nueva Comuna',
            'notice' => 'No hay comunas registradas',
            'subject' => 'Lista de Comunas',
            'route' => route('cities.create'),
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $areas = Area::select('id','name')->orderBy('name')->get();

        return view('cities.create',[
            'city' => $city = new City,
            'areas' => $areas,
            'module' => 'Comunas',
            'subject' => 'Nueva Comuna',
            'button' => 'Guardar',
            'process' => route('cities.store'),
            'back' => route('cities.index'),
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
            'name' => 'required|string|min:3|unique:areas',
            'area' => 'required|integer'
        ]);

        $city = new City;
        $city->name = $request->name;
        $city->area_id = $request->area;
        $city->save();

        return redirect('/cities')->with('success','La comuna se ha registrado correctamente');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\City  $city
     * @return \Illuminate\Http\Response
     */
    public function show(City $city)
    {
        return view('cities.show', [
            'city' => $city,
            'module' => 'Comunas',
            'subject' => 'Detalle de Comuna',
            'back' => route('cities.index')
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\City  $city
     * @return \Illuminate\Http\Response
     */
    public function edit(City $city)
    {
        $areas = Area::select('id','name')->orderBy('name')->get();

        return view('cities.create',[
            'city' => $city,
            'areas' => $areas,
            'module' => 'Comunas',
            'subject' => 'Editar Comuna',
            'button' => 'Editar',
            'process' => route('cities.update', $city),
            'back' => route('cities.index'),
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\City  $city
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, City $city)
    {
        $this->validate($request,[
            'name' => 'required|string|min:3',
            'area' => 'required|integer'
        ]);

        $city = City::find($city->id);
        $city->name = $request->name;
        $city->area_id = $request->area;
        $city->save();

        return redirect('/cities/' . $city->id)->with('success','La comuna se ha modificado correctamente');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\City  $city
     * @return \Illuminate\Http\Response
     */
    public function destroy(City $city)
    {
        //
    }
}

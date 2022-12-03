<?php

namespace App\Http\Controllers;

use App\Models\Adquisition;
use App\Models\Provider;
use Illuminate\Http\Request;

class AdquisitionController extends Controller
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
        $adquisitions = Adquisition::with(['provider','user'])->get();

        return view('adquisitions.index',[
            'adquisitions' => $adquisitions,
            'module' => 'Adquisiciones',
            'new' => 'Nueva Adquisición',
            'notice' => 'No hay adquisiciones registradas',
            'subject' => 'Lista de Adquisitiones',
            'route' => route('adquisitions.create'),
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $providers = Provider::select('id','name')->orderBy('name')->get();

        return view('adquisitions.create',[
            'adquisition' => $adquisition = new Adquisition,
            'module' => 'Adquisiciones',
            'subject' => 'Nueva Adquisición',
            'button' => 'Guardar',
            'process' => route('adquisitions.store'),
            'back' => route('adquisitions.index'),
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
            'provider' => 'request|integer'
        ]);

        $adquisition = new Adquisition;
        $adquisition->provider_id = $request->provider;
        $adquisition->user_id = auth()->user()->id;
        $adquisition->save();

        return redirect('/adquisitions')->with('success','La adquisición se ha registrado correctamente');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Adquisition  $adquisition
     * @return \Illuminate\Http\Response
     */
    public function show(Adquisition $adquisition)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Adquisition  $adquisition
     * @return \Illuminate\Http\Response
     */
    public function edit(Adquisition $adquisition)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Adquisition  $adquisition
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Adquisition $adquisition)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Adquisition  $adquisition
     * @return \Illuminate\Http\Response
     */
    public function destroy(Adquisition $adquisition)
    {
        //
    }
}

<?php

namespace App\Http\Controllers;

use App\Models\Adquisition;
use App\Models\Provider;
use App\Models\Detail;
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
            'subject' => 'Lista de Adquisiciones',
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
            'providers' => $providers,
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
            'provider' => 'required|integer'
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
        return view('adquisitions.show', [
            'adquisition' => $adquisition,
            'module' => 'Adquisiciones',
            'subject' => 'Detalle de Adquisición',
            'back' => route('adquisitions.index')
        ]);
    }

}

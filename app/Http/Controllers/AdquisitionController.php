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
            'factura' => 'required|integer|unique:adquisitions',
            'provider' => 'required|integer'
        ]);

        $adquisition = new Adquisition;
        $adquisition->factura = $request->factura;
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
        $suma = $this->sumAdquisition($adquisition);

        return view('adquisitions.show', [
            'adquisition' => $adquisition,
            'suma' => $suma,
            'module' => 'Adquisiciones',
            'subject' => 'Detalle de Adquisición',
            'back' => route('adquisitions.index')
        ]);
    }

    public function edit(Adquisition $adquisition)
    {
        return view('adquisitions.edit',[
            'adquisition' => $adquisition,
            'adquisition' => $adquisition,
            'module' => 'Adquisiciones',
            'subject' => 'Editar Adquisición',
            'button' => 'Editar',
            'process' => route('adquisitions.update', $adquisition),
            'back' => route('adquisitions.index'),
        ]);
    }

    public function update(Request $request, Adquisition $adquisition)
    {
        $this->validate($request, [
            'factura' => 'required|integer|unique:adquisitions',
        ]);

        $adquisition = Adquisition::find($adquisition->id);
        $adquisition->factura = $request->factura;
        $adquisition->save();

        return redirect('/adquisitions/' . $adquisition->id)->with('success','La adquisición se ha modificado correctamente');
    }

    #############################################################
    private function sumAdquisition($adquisition)
    {
        $suma = 0;
        $details = Detail::select('id','count','price')->where('adquisition_id', $adquisition->id)->get();

        if ($details) {
            foreach ($details as $detail) {
                $suma = $suma + ($detail->count * $detail->price);
            }
        }

        return $suma;
    }
}

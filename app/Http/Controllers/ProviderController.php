<?php

namespace App\Http\Controllers;

use App\Models\Provider;
use App\Models\City;
use Illuminate\Http\Request;

class ProviderController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $providers = Provider::with('city')->get();

        return view('providers.index',[
            'providers' => $providers,
            'module' => 'Proveedores',
            'new' => 'Nuevo Proveedor',
            'notice' => 'No hay proveedores registrados',
            'subject' => 'Lista de Proveedores',
            'route' => route('providers.create'),
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $cities = City::select('id','name')->orderBy('name')->get();

        return view('providers.create',[
            'provider' => $provider = new Provider,
            'cities' => $cities,
            'module' => 'Proveedores',
            'subject' => 'Nuevo Proveedor',
            'button' => 'Guardar',
            'process' => route('providers.store'),
            'back' => route('providers.index')
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
            'name' => 'required|string|min:3',
            'rut' => 'required|string|min:8|unique:providers',
            'business' => 'required|string|min:3',
            'email' => 'required|email',
            'address' => 'required|string:3',
            'city' => 'required|integer'
        ]);

        if ($request->website) {
            $this->validate($request,[
                'website' => 'url',
            ]);
        }

        if (!$this->validateRut($request->rut)) {
            return redirect('providers/create')->with('danger','El RUT ingresado no es válido');
        }

        $provider = new Provider;
        $provider->name = $request->name;
        $provider->rut = $request->rut;
        $provider->address = $request->address;
        $provider->business = $request->business;
        $provider->email = $request->email;
        $provider->website = $request->website;
        $provider->city_id = $request->city;
        $provider->save();

        return redirect('/providers')->with('success','El proveedor se ha registrado correctamente');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Provider  $provider
     * @return \Illuminate\Http\Response
     */
    public function show(Provider $provider)
    {
        return view('providers.show',[
            'provider' => $provider,
            'subject' => 'Detalle Proveedor',
            'module' => 'Proveedores',
            'back' => route('providers.index')
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Provider  $provider
     * @return \Illuminate\Http\Response
     */
    public function edit(Provider $provider)
    {
        $cities = City::select('id','name')->orderBy('name')->get();

        return view('providers.create',[
            'provider' => $provider,
            'cities' => $cities,
            'module' => 'Proveedores',
            'subject' => 'Editar Proveedor',
            'button' => 'Editar',
            'process' => route('providers.update', $provider),
            'back' => route('providers.index')
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Provider  $provider
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Provider $provider)
    {
        $this->validate($request, [
            'name' => 'required|string|min:3',
            'rut' => 'required|string|min:8',
            'business' => 'required|string|min:3',
            'email' => 'required|email',
            'address' => 'required|string:3',
            'city' => 'required|integer'
        ]);

        if ($request->website) {
            $this->validate($request,[
                'website' => 'url',
            ]);
        }

        if (!$this->validateRut($request->rut)) {
            return redirect('providers/' . $provider->id . '/edit')->with('danger','El RUT ingresado no es válido');
        }

        $provider = Provider::find($provider->id);
        $provider->name = $request->name;
        $provider->rut = $request->rut;
        $provider->address = $request->address;
        $provider->business = $request->business;
        $provider->email = $request->email;
        $provider->website = $request->website;
        $provider->city_id = $request->city;
        $provider->save();

        return redirect('/providers/' . $provider->id)->with('success','El proveedor se ha modificado correctamente');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Provider  $provider
     * @return \Illuminate\Http\Response
     */
    public function destroy(Provider $provider)
    {
        //
    }

    #########################################################################################
    private function validateRut($rut)
    {
        $rut = preg_replace('/[^k0-9]/i', '', $rut);
        $dv = substr($rut, -1);
        $num = substr($rut, 0, strlen($rut)-1);
        $i = 2;
        $sum = 0;

        foreach(array_reverse(str_split($num)) as $v)
        {
            if($i==8)
            $i = 2;

            $sum += $v * $i;
            ++$i;
        }

        $dvr = 11 - ($sum % 11);

        if($dvr == 11)
            $dvr = 0;
        if($dvr == 10)
            $dvr = 'K';

        if($dvr == strtoupper($dv))
            return true;
        else
            return false;
    }
}

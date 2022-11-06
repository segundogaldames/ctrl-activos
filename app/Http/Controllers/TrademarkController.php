<?php

namespace App\Http\Controllers;

use App\Models\Trademark;
use Illuminate\Http\Request;

class TrademarkController extends Controller
{
    public function __construct(){
        $this->middleware(['auth','active','roles:Administrador']);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $trademarks = Trademark::select('id','name')->get();

        return view('trademarks.index',[
            'trademarks' => $trademarks,
            'module' => 'Marcas',
            'new' => 'Nueva Marca',
            'notice' => 'No hay marcas registradas',
            'subject' => 'Lista de Marcas',
            'route' => route('trademarks.create'),
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('trademarks.create',[
            'trademark' => $trademark = new Trademark,
            'module' => 'Marcas',
            'subject' => 'Nueva Marca',
            'button' => 'Guardar',
            'process' => route('trademarks.store'),
            'back' => route('trademarks.index')
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
            'name' => 'required|string|min:3|unique:trademarks'
        ]);

        $trademark = new Trademark;
        $trademark->name = $request->name;
        $trademark->save();

        return redirect('/trademarks')->with('success','La marca se ha registrado correctamente');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Trademark  $trademark
     * @return \Illuminate\Http\Response
     */
    public function show(Trademark $trademark)
    {
        return view('trademarks.show',[
            'trademark' => $trademark,
            'subject' => 'Detalle Marca',
            'module' => 'Marcas',
            'back' => route('trademarks.index')
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Trademark  $trademark
     * @return \Illuminate\Http\Response
     */
    public function edit(Trademark $trademark)
    {
        return view('trademarks.edit',[
            'trademark' => $trademark,
            'module' => 'Marcas',
            'subject' => 'Editar Marca',
            'button' => 'Editar',
            'process' => route('trademarks.update', $trademark),
            'back' => route('trademarks.index')
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Trademark  $trademark
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Trademark $trademark)
    {
        $this->validate($request,[
            'name' => 'required|string|min:3|unique:trademarks'
        ]);

        $trademark = Trademark::find($trademark->id);
        $trademark->name = $request->name;
        $trademark->save();

        return redirect('/trademarks/' . $trademark->id)->with('success','La marca se ha modificado correctamente');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Trademark  $trademark
     * @return \Illuminate\Http\Response
     */
    public function destroy(Trademark $trademark)
    {
        //
    }
}

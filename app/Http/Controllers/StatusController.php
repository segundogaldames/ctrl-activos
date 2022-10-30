<?php

namespace App\Http\Controllers;

use App\Models\Status;
use Illuminate\Http\Request;

class StatusController extends Controller
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
        $statuses = Status::select('id','name')->get();

        return view('statuses.index',[
            'statuses' => $statuses,
            'module' => 'Estados',
            'new' => 'Nuevo Estado',
            'notice' => 'No hay estados registrados',
            'subject' => 'Lista de Estados',
            'route' => route('statuses.create'),
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('statuses.create',[
            'status' => $status = new Status,
            'module' => 'Estados',
            'subject' => 'Nuevo Estado',
            'button' => 'Guardar',
            'process' => route('statuses.store'),
            'back' => route('statuses.index')
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
            'name' => 'required|string|min:3|unique:statuses'
        ]);

        $status = new Status;
        $status->name = $request->name;
        $status->save();

        return redirect('/statuses')->with('success','El estado sa ha registrado correctamente');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Status  $status
     * @return \Illuminate\Http\Response
     */
    public function show(Status $status)
    {
        return view('statuses.show',[
            'status' => $status,
            'subject' => 'Detalle Estado',
            'module' => 'Estados',
            'back' => route('statuses.index')
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Status  $status
     * @return \Illuminate\Http\Response
     */
    public function edit(Status $status)
    {
        return view('statuses.edit',[
            'status' => $status,
            'module' => 'Estados',
            'subject' => 'Editar Estado',
            'button' => 'Editar',
            'process' => route('statuses.update', $status),
            'back' => route('statuses.index')
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Status  $status
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Status $status)
    {
         $this->validate($request,[
            'name' => 'required|string|min:3|unique:statuses'
         ]);

         $status = Status::find($status->id);
         $status->name = $request->name;
         $status->save();

         return redirect('/statuses/' . $status->id)->with('success','El estado sa ha modificado correctamente');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Status  $status
     * @return \Illuminate\Http\Response
     */
    public function destroy(Status $status)
    {
        //
    }
}

<?php

namespace App\Http\Controllers;

use App\Models\Adquisition;
use App\Models\Detail;
use App\Models\Product;
use Illuminate\Http\Request;

class DetailController extends Controller
{
    public function __construct()
    {
        $this->middleware(['auth','active']);
        $this->middleware('roles:Administrador');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Detail  $detail
     * @return \Illuminate\Http\Response
     */
    public function show(Detail $detail)
    {
        return view('details.show', [
            'detail' => $detail,
            'module' => 'Detalles de Adquisición',
            'subject' => 'Detalle de Adquisición',
            'back' => route('adquisitions.show', $detail->adquisition_id)
        ]);
    }

    public function addDetail(Adquisition $adquisition)
    {
        $products = Product::with('trademark')->orderBy('name')->get();

        return view('details.addDetail',[
            'detail' => $detail = new Detail,
            'adquisition' => $adquisition,
            'products' => $products,
            'module' => 'Detalles de Adquisición',
            'subject' => 'Nuevo Detalle',
            'button' => 'Guardar',
            'process' => route('details.newDetail', $adquisition),
            'back' => route('adquisitions.show', $adquisition),
        ]);
    }

    public function newDetail(Request $request, Adquisition $adquisition)
    {
        $this->validate($request,[
            'count' => 'required|integer|min:1',
            'price' => 'required|integer|min:1',
            'product' => 'required|integer'
        ]);

        //verificar que no haya un mismo producto en un detalle relacionado con la adquisicion
        $data = Detail::select('id')
            ->where('product_id', $request->product)
            ->where('adquisition_id', $adquisition->id)
            ->first();

        if ($data) {
            return redirect('/details/addDetail/' . $adquisition->id)->with('danger','El producto seleccionado ya existe en este detalle... seleccione otro');
        }

        $detail = new Detail;
        $detail->count = $request->count;
        $detail->price = $request->price;
        $detail->product_id = $request->product;
        $detail->adquisition_id = $adquisition->id;
        $detail->save();

        return redirect('/adquisitions/' . $adquisition->id)->with('success','El detalle se ha registrado correctamente');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Detail  $detail
     * @return \Illuminate\Http\Response
     */
    public function edit(Detail $detail)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Detail  $detail
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Detail $detail)
    {
        //
    }
}

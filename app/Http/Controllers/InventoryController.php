<?php

namespace App\Http\Controllers;

use App\Models\Inventory;
use App\Models\Product;
use App\Models\Status;
use App\Models\Adquisition;
use Illuminate\Http\Request;

class InventoryController extends Controller
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
        $inventories = Inventory::with(['product','status','adquisition'])->get();

        return view('inventories.index',[
            'inventories' => $inventories,
            'module' => 'Inventarios',
            'new' => 'Nuevo Inventario',
            'notice' => 'No hay inventarios registrados',
            'subject' => 'Lista de Inventarios',
            'route' => route('inventories.index'),
        ]);
    }

    public function addInventory(Product $product)
    {
        $statuses = Status::select('id','name')->orderBy('name')->get();
        $adquisitions = Adquisition::select('id','factura')->orderBy('created_at','desc')->get();

        return view('inventories.addInventory',[
            'inventory' => $inventory = new Inventory,
            'statuses' => $statuses,
            'adquisitions' => $adquisitions,
            'product' => $product,
            'module' => 'Inventarios',
            'subject' => 'Nuevo Inventario',
            'button' => 'Guardar',
            'process' => route('inventories.newInventory', $product),
            'back' => route('products.show', $product),
        ]);
    }

    public function newInventory(Request $request, Product $product)
    {
        $this->validate($request,[
            'code' => 'required|string|min:3|unique:inventories',
            'adquisition' => 'required|integer',
        ]);

        $inventory = new Inventory;
        $inventory->code = $request->code;
        $inventory->product_id = $product->id;
        $inventory->adquisition_id = $request->adquisition;
        $inventory->status_id = 1; //disponible
        $inventory->save();

        return redirect('/inventories')->with('success','El inventario se ha registrado correctamente');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Inventory  $inventory
     * @return \Illuminate\Http\Response
     */
    public function show(Inventory $inventory)
    {
        return view('inventories.show', [
            'inventory' => $inventory,
            'module' => 'Inventarios',
            'subject' => 'Detalle de Inventario',
            'back' => route('inventories.index')
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Inventory  $inventory
     * @return \Illuminate\Http\Response
     */
    public function edit(Inventory $inventory)
    {
        $statuses = Status::select('id','name')->orderBy('name')->get();
        $adquisitions = Adquisition::select('id','factura')->orderBy('created_at','desc')->get();

        return view('inventories.edit',[
            'inventory' => $inventory,
            'statuses' => $statuses,
            'adquisitions' => $adquisitions,
            'module' => 'Inventarios',
            'subject' => 'Editar Inventario',
            'button' => 'Editar',
            'process' => route('inventories.update', $inventory),
            'back' => route('inventories.index'),
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Inventory  $inventory
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Inventory $inventory)
    {
        $this->validate($request,[
            'code' => 'required|string|min:3',
            'adquisition' => 'required|integer',
            'status' => 'required|integer',
        ]);

        $inventory = Inventory::find($inventory->id);
        $inventory->code = $request->code;
        $inventory->adquisition_id = $request->adquisition;
        $inventory->status_id = $request->status;
        $inventory->save();

        return redirect('/inventories/' . $inventory->id)->with('success','El inventario se ha modificado correctamente');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Inventory  $inventory
     * @return \Illuminate\Http\Response
     */
    public function destroy(Inventory $inventory)
    {
        //
    }
}

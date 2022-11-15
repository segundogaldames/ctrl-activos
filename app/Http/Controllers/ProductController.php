<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Trademark;
use App\Models\Type;
use App\Models\Status;
use Illuminate\Http\Request;

class ProductController extends Controller
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
        $products = Product::with(['trademark','type','status'])->get();

        return view('products.index',[
        'products' => $products,
        'module' => 'Productos',
        'new' => 'Nuevo Producto',
        'notice' => 'No hay productos registrados',
        'subject' => 'Lista de Productos',
        'route' => route('products.create'),
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $trademarks = Trademark::select('id','name')->orderBy('name')->get();
        $types = Type::select('id','name')->orderBy('name')->get();
        $statuses = Status::select('id','name')->orderBy('name')->get();

        return view('products.create',[
        'product' => $product = new Product,
        'trademarks' => $trademarks,
        'types' => $types,
        'statuses' => $statuses,
        'module' => 'Productos',
        'subject' => 'Nuevo Producto',
        'button' => 'Guardar',
        'process' => route('products.store'),
        'back' => route('products.index'),
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
            'code' => 'required|string|min:6|unique:products',
            'model' => 'required|string|min:3',
            'trademark' => 'required|integer',
            'type' => 'required|integer',
            'status' => 'required|integer'
        ]);

        $product = new Product;
        $product->name = $request->name;
        $product->code = $request->code;
        $product->model = $request->model;
        $product->trademark_id = $request->trademark;
        $product->type_id = $request->type;
        $product->status_id = $request->status;
        $product->save();

        return redirect('/products')->with('success','El producto se ha registrado correctamente');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function show(Product $product)
    {
        return view('products.show', [
            'product' => $product,
            'module' => 'Productos',
            'subject' => 'Detalle del Producto',
            'back' => route('products.index')
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function edit(Product $product)
    {
        $trademarks = Trademark::select('id','name')->orderBy('name')->get();
        $types = Type::select('id','name')->orderBy('name')->get();
        $statuses = Status::select('id','name')->orderBy('name')->get();

        return view('products.edit',[
            'product' => $product,
            'trademarks' => $trademarks,
            'types' => $types,
            'statuses' => $statuses,
            'module' => 'Productos',
            'subject' => 'Editar Producto',
            'button' => 'Editar',
            'process' => route('products.update', $product),
            'back' => route('products.index'),
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Product $product)
    {
        $this->validate($request, [
            'name' => 'required|string|min:3',
            'code' => 'required|string|min:6',
            'model' => 'required|string|min:3',
            'trademark' => 'required|integer',
            'type' => 'required|integer',
            'status' => 'required|integer'
        ]);

        $product = Product::find($product->id);
        $product->name = $request->name;
        $product->code = $request->code;
        $product->model = $request->model;
        $product->trademark_id = $request->trademark;
        $product->type_id = $request->type;
        $product->status_id = $request->status;
        $product->save();

        return redirect('/products/' . $product->id)->with('success','El producto se ha modificado correctamente');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function destroy(Product $product)
    {
        //
    }
}

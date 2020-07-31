<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Str;

use App\Product;
use App\ProductCategory;

use App\Http\Requests\ProductRequest;


class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $title = "Products List";

        $items = Product::with([
            'category'
        ])->get();
        return view('pages.product.index', [
            'title' => $title,
            'items' => $items
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $title = "Create new product";

        $categories = ProductCategory::all();
        return view('pages.product.create', [
            'title' => $title,
            'categories' => $categories
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(ProductRequest $request)
    {
        $file = $request->file('photo');

        $data = $request->all();
        $data['photo'] = $file->store(
            'assets/product', 'public'
        );

        Product::create($data);

        return redirect()->route('product.index')->with('success','Produk berhasil ditambahkan!');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $title = "Edit Product";

        $item = Product::findOrFail($id);
        $categories = ProductCategory::all();

        return view('pages.product.edit', [
            'title' => $title,
            'item' => $item,
            'categories' => $categories
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $file = $request->file('photo');
        
        $data['name'] = $request->input('name');
        $data['category_id'] = $request->input('category_id');
        $data['stock'] = $request->input('stock');
        $data['purchase_price'] = $request->input('purchase_price');
        $data['selling_price'] = $request->input('selling_price');
        
        if ($file){
            $data['photo'] = $file->store(
                'assets/product', 'public'
            );
        }

        $product = Product::findOrFail($id);
        $product->update($data);

        return redirect()->route('product.index')->with('success','Produk berhasil diperbarui!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $product = Product::findOrFail($id);
        $product->delete();

        return redirect()->route('product.index')->with('success','Produk berhasil dihapus!');
    }
}

<?php

namespace App\Domains\Products\Http\Controllers;

use App\Domains\Products\Models\Product;
use App\Domains\Products\Models\Warehouse;
use App\Domains\Products\Models\Status;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class ProductController extends Controller
{
  /**
   * Display a listing of the resource.
   *
   * @return \Illuminate\Http\Response
   */
  public function index()
  {
    return view('backend.products.product.index');
  }

  /**
   * Show the form for creating a new resource.
   *
   * @return \Illuminate\Http\Response
   */
  public function create()
  {
    $status = Status::all();
    $warehouse = Warehouse::all();
    $product = Product::with('warehouse', 'staus');

    return view('backend.products.product.create', compact('product', 'warehouse', 'status'));
  }

  /**
   * Store a newly created resource in storage.
   *
   * @param  \Illuminate\Http\Request  $request
   * @return \Illuminate\Http\Response
   */
  public function store(Request $request)
  {

    $createProduct = new Product();
    $createProduct->productName = json_encode($request->productName);
    $createProduct->status_id = $request->status;
    $createProduct->warehouse_id = $request->warehouse; //receive warehouse ID
    $createProduct->shipping_type = $request->shipping_type;
    $createProduct->invoice = $request->invoice;
    $createProduct->user_id = auth()->id();
    $createProduct->save();

    return redirect()
      ->route('admin.product.product.index')
      ->withFlashSuccess('product created successfully');
  }

  /**
   * Display the specified resource.
   *
   * @param  int  $id
   * @return \Illuminate\Http\Response
   */
  public function show(Request $request, $id)
  {
    // $product = Product::findOrFail($id);

    // return view('show', compact('product', $product));
  }

  /**
   * Show the form for editing the specified resource.
   *
   * @param  int  $id
   * @return \Illuminate\Http\Response
   */
  public function edit($id)
  {
    $product = Product::find($id);
    $warehouse = Warehouse::all();
    $status = Status::all();

    return view('backend.products.product.edit', compact('product', 'warehouse', 'status'));
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
    $updateProduct = product::findOrFail($id);
    if ($updateProduct) {

      $updateProduct->productName = $request->productName;
      $updateProduct->status_id = $request->status;
      $updateProduct->warehouse_id = $request->warehouse;
      $updateProduct->shipping_type = $request->shipping_type;
      $updateProduct->invoice = $request->invoice;
      $updateProduct->user_id = auth()->id();
      $updateProduct->save();

      // return (compact('products', 'warehouse', 'warehouses'));
    }
    return redirect()
      ->route('admin.product.product.index')
      ->withFlashSuccess('product updated successfully');
  }

  /**
   * Remove the specified resource from storage.
   *
   * @param  int  $id
   * @return \Illuminate\Http\Response
   */
  public function destroy($id)
  {
    $product = product::find($id);
    if ($product) {

      $product->delete($product);
    }

    return redirect()
      ->route('admin.product.product.index')
      ->withFlashSuccess('product deleted successfully');
  }

  public function validateproducts($id = 0)
  {

    $data = request()->validate([
      'productName' => 'required',
      'shipping_type' => 'nullable|string|max:191',
      'invoice' => 'required|string|max:191',
      'status' => 'nullable|string|max:191',

    ]);
    if (!$id) {
      $data['user_id'] = auth()->id();
    }

    return $data;
  }
}

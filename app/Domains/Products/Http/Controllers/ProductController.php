<?php

namespace App\Domains\Products\Http\Controllers;

use App\Domains\Products\Models\Product;
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
    return view('backend.products.product.create');
  }

  /**
   * Store a newly created resource in storage.
   *
   * @param  \Illuminate\Http\Request  $request
   * @return \Illuminate\Http\Response
   */
  public function store(Request $request)
  {
    $data = $this->validateproducts();

    product::create($data);
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
    $product = product::findOrFail($id);
    return view('backend.products.product.edit', compact('product'));
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
    $data = $this->validateproducts($id);
    $product = product::find($id);
    if ($product) {
      $product->update($data);
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
      'name' => 'nullable|string|max:191',
      'shipping_type' => 'nullable|string|max:191',
      'invoice' => 'required|string|max:191',
      'status' => 'nullable|string|max:191',
      'warehouse' => 'nullable|string|max:191',
    ]);
    if (!$id) {
      $data['user_id'] = auth()->id();
    }
    return $data;
  }
}

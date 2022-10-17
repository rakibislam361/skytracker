<?php

namespace App\Domains\Products\Http\Controllers;

use App\Domains\Products\Models\Product;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;


class StatusController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('backend.products.status.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('backend.products.status.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $data = $this->validatestatuses();
        product::create($data);
        return redirect()
            ->route('admin.product.status.index')
            ->withFlashSuccess('status created successfully');
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
        $status = product::findOrFail($id);
        return view('backend.products.status.edit', compact('status'));
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
        $data = $this->validatestatuses($id);
        $status = product::find($id);
        if ($status) {
            $status->update($data);
        }
        return redirect()
            ->route('admin.product.status.index')
            ->withFlashSuccess('status updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $status = product::find($id);
        if ($status) {
            $status->delete($status);
        }
        return redirect()
            ->route('admin.product.status.index')
            ->withFlashSuccess('status deleted successfully');
    }


    public function validatestatuses($id = 0)
    {
        $data = request()->validate([
            'status' => 'nullable|string|max:191',
            'warehouse' => 'required|string|max:191',
        ]);
        if (!$id) {
            $data['user_id'] = auth()->id();
        }

        return $data;
    }
}

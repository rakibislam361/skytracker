<?php

namespace App\Http\Controllers\Frontend;

use App\Domains\Contacts\Models\Contact;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class ContactController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('frontend.pages.contact');
        // dd('index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $createContact = new Contact();
        $createContact->name = $request->name;
        $createContact->phone = $request->phone;
        $createContact->email = $request->email;
        $createContact->message = $request->message;
        $createContact->user_id = auth()->id();
        $createContact->save();


        // product::create($data);
        return redirect()
            ->route('frontend.pages.contact')
            ->withFlashSuccess('Message sent successfully');
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
        //
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
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }

    public function validatecontacts($id = 0)
    {

        $data = request()->validate([
            'name' => 'required',
            'phone' => 'nullable|string|max:191',
            'email' => 'required|string|max:191',
            'message' => 'nullable|string|max:191',
        ]);


        return $data;
    }
}

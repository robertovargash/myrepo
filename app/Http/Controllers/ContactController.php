<?php

namespace App\Http\Controllers;

use App\Models\Contact;
use App\Models\Contacttype;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class ContactController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $title = "Contacts";
        $contacts =  Contact::all();
        $contacttypes = Contacttype::all();
        return view('contacts.index',compact('title','contacttypes','contacts'));
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
        $request->validate([
            'name' => ['required'],
            'birthdate' => ['required'],
            'contacttype_id' => ['required'],
        ],[
            'name.required' => 'Name is mandatory field',
            'birthdate.required' => 'Birth date is mandatory field',
            'contacttype_id.required' => 'Select a type',
        ]);
        Contact::create($request->all());

        return redirect()->route('contacts.index')
                        ->with('success',trans('contact_list.contact_added'));
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Contact  $contact
     * @return \Illuminate\Http\Response
     */
    public function show(Contact $contact)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Contact  $contact
     * @return \Illuminate\Http\Response
     */
    public function edit(Contact $contact)
    {
        $title = "Contact data";
        $contacttypes = Contacttype::all();
        return view('contacts.edit',compact('contacttypes','title','contact'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Contact  $contact
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Contact $contact)
    {
        $request->validate([
            'name' => ['required'],
            'birthdate' => ['required'],
            'contacttype_id' => ['required'],
        ],[
            'name.required' => 'Name is mandatory field',
            'birthdate.required' => 'Birth date is mandatory field',
            'contacttype_id.required' => 'Select a type',
        ]);

        $contact->update($request->all());

        return redirect()->route('contacts.index')
                        ->with('success',trans('contact_list.contact_updated'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Contact  $contact
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request)
    {
        $contact_id=$request->input('id');
        $contact = Contact::find($contact_id);
        $contact->delete();

        return redirect()->route('contacts.index')
                        ->with('success',trans('contact_list.contact_deleted'));
    }
}

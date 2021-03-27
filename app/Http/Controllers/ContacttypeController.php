<?php

namespace App\Http\Controllers;

use App\Models\Contact;
use App\Models\Contacttype;
use Illuminate\Http\Request;

class ContacttypeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $title = "Contact types";
        $contacttypes = Contacttype::all();
        return view('contacttypes.index',compact('title','contacttypes'));
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
            'type' => ['required']
        ],[
            'type.required' => 'Type is required field'
        ]);
        Contacttype::create($request->all());

        return redirect()->route('contacttypes.index')
                        ->with('success',trans('contact_list.contactt_added'));
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Contacttype  $contacttype
     * @return \Illuminate\Http\Response
     */
    public function show(Contacttype $contacttype)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Contacttype  $contacttype
     * @return \Illuminate\Http\Response
     */
    public function edit(Contacttype $contacttype)
    {
        $title = "Contact type data";
        return view('contacttypes.edit',compact('title','contacttype'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Contacttype  $contacttype
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Contacttype $contacttype)
    {
        $request->validate([
            'type' => ['required']
        ],[
            'type.required' => 'Name is required field'
        ]);

        $contacttype->update($request->all());

        return redirect()->route('contacttypes.index')
                        ->with('success',trans('contact_list.contactt_updated'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Contacttype  $contacttype
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request)
    {
        $contactt_id=$request->input('id');
        $contact = Contact::where('contacts.contacttype_id','=',$contactt_id)->get();
        // dd($contact->count() > 0);
        if ($contact->count() > 0) {
            return redirect()->route('contacttypes.index')
            ->with('error','There are contacts with this type');            
        }else{
            $contactype = Contacttype::find($contactt_id);
            $contactype->delete();            
            return redirect()->route('contacttypes.index')
                            ->with('success',trans('contact_list.contactt_deleted'));
        }       
    }
}

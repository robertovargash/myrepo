<?php

namespace App\Http\Controllers;

use App\Models\Contact;
use App\Models\Contacttype;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        // $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $title = "Inicio";
        $contacts = Contact::all()->count();
        $contacttypes = Contacttype::all()->count();
        // dd($contacts);
        return view('welcome',compact('title','contacts','contacttypes'));
    }
}

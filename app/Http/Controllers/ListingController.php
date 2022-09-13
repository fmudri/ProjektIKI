<?php

namespace App\Http\Controllers;

use App\Models\Listing;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class ListingController extends Controller
{
    // Show all listings
    // listings.index jer se tako zove file u kreiranom folderu listings
    // Također omogućena pretraga prema filterima ili generalni search
    // index.blade.php

    //Show latest, if there is filter, filter them and paginate them by the number(x)
    public function index(){
        return view('listings.index', ['listings' => Listing::latest()->filter(request(['tag', 'search']))->paginate(3)]);
    }

    // Show single listing
    // -||-
    //show.blade.php
    public function show(Listing $listing){
        return view('listings.show', ['listing' => $listing]);
    }

    // Show Create Form
    // create.blade.php
    public function create(){
        return view('listings.create');
    }

    // Store Listing Data
    // Request $request je Dependency injection
    public function store(Request $request){
        $formFields = $request->validate([
            'title' => 'required',
            'company' => ['required', 
            //'listings' je tablica koju koristimo
            //'company je polje koje mora biti jedinstveno
            Rule::unique('listings', 'company')],
            'location' => 'required',
            'website' => 'required',
            // 'email' znači da mora biti format emaila
            'email' => ['required', 'email'],
            'tags' => 'required',
            'description' => 'required'
        ]);

        //Cheks if there is file added and stores it if there is
        if($request->hasFile('logo')){
            $formFields['logo'] = $request->file('logo')->store('logos','public');
        }

        $formFields['user_id'] = auth()->id();
        //Ako prođe validator, model Listing stvara zapis
        // Kao parametar validatora i podataka uzima $formFields
        Listing::create($formFields);

        //Nakon unosa stranica vraća na početak ('/') i priprema Pop-up message
        // flash-message.php ispisuje poruku, ovdje je samo zapisana
        return redirect('/')->with('message','Listing created successfully');
    }

    //Show Edit Form
    public function edit(Listing $listing){
        return view('listings.edit',['listing' => $listing]);
    }

        //Update listing data
    public function update(Request $request, Listing $listing){

        //Make sure logged in user is owner
        if($listing->user_id != auth()->id()){
            abort(403, 'Unauthorized Action');
        }

        $formFields = $request->validate([
            'title' => 'required',
            'company' => ['required'],
            'location' => 'required',
            'website' => 'required',
            'email' => ['required', 'email'],
            'tags' => 'required',
            'description' => 'required'
        ]);
        if($request->hasFile('logo')){
            $formFields['logo'] = $request->file('logo')->store('logos','public');
        }

        $listing->update($formFields);

        return back()->with('message','Oglas uspješno postavljen');
    }

    //Delete Listing
    public function destroy(Listing $listing) {

        //Make sure logged in user is owner
        if($listing->user_id != auth()->id()){
            abort(403, 'Unauthorized Action');
        }

        $listing->delete();
        return redirect('/')->with('message','Oglas uspješno izbrisan');
    }

    //Manage Listings and pass users listings
    public function manage(){
        return view('listings.manage',['listings' => auth()->user()->listings()->get()]);
    }
}

<?php

namespace App\Http\Controllers;

use App\Villa;
use Illuminate\Http\Request;

class VillaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $villa =  villa::all();
        return view('villa.index')->with('villas',$villa);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('villa.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request,Offer $offer)
    {
        $villa->etage =$request->etage;
        $villa->chombre = $request->chombre;
        $villa->salledebain = $request->salledebain;
        $villa->balcon = $request->balcon;
        $villa->toilettes = $request->toilettes;
        $villa->cuisine = $request->cuisine;
        $villa->garage = $request->garage;
        $villa->save();

          Offer::create([
        'address' => $request['address'],
        'prix' => $request['prix'],
        'surfface' => $request['surfface'], ]);
     
        return redirect('/villa');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Villa  $villa
     * @return \Illuminate\Http\Response
     */
    public function show(Villa $villa)
    {
        return  view('villa.show')->with('villa',$villa);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Villa  $villa
     * @return \Illuminate\Http\Response
     */
    public function edit(Villa $villa)
    {
        return view('villa.edit')->with('villa',$villa);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Villa  $villa
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Villa $villa)
    {

            $villa->etage =$request->etage;
            $villa->chombre = $request->chombre;
            $villa->salledebain = $request->salledebain;
            $villa->balcon = $request->balcon;
            $villa->toilettes = $request->toilettes;
            $villa->cuisine = $request->cuisine;
            $villa->garage = $request->garage;
            $villa->save();

        foreach ($villa->offers()->get() as $offer ){
            $offer->prix =  $request->prix;
            $offer->surfface =  $request->surfface;
            $offer->adresse =  $request->adresse;

           $offer->save();
           }
           return  view('villa.show')->with('villa',$villa);

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Villa  $villa
     * @return \Illuminate\Http\Response
     */
    public function destroy(Villa $villa)
    {
        $villa->offers()->delete();

        //delete villa
        $villa->delete();

        return redirect('/villa');
    }
}
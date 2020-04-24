<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use App\User;
use App\Bakery;
use App\Description_Bakery;
use App\Image;
use App\Provider;

class BakeryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    public function bakery(Request $request){
        // dd($request);
        $user = User::find($request->id);
        // dd($user);
        $provider = Provider::with('bakery.image', 'bakery.description')->where('person_id', $user->person_id)->get();
        // dd($provider);
        
        return response()->json($bakery);
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
        // dd($request);

        $user = User::find($request->id);
        // dd($user);
        $provider = Provider::where('person_id', $user->person_id)->first();
        // dd($provider);
        
        $bakery =  Bakery::create([
            'name'         => $request->name,
            'price_bs'     => $request->price_bs,
            'price_us'     => $request->price_us,
        ]);
        
        $description = Description_Bakery::create([
            'description' => $request->description,
            'providers_id' => $provider->id,
            'bakeries_id' =>  $bakery->id,
        ]);

        $bakery->provider()->attach($provider->id);
        
        // $image = $request->file('image'); 
        // dd($image);
        // $path = $image->store('public/bakery'); 
        // dd($path);
        // $path = str_replace('public/', '', $path); 
        // dd($path);
        $image = new Image;
        // $image->path = $path;  
        $image->path = $request->image;
        $image->imageable_type = "App\Bakery";
        $image->imageable_id = $bakery->id;
        $image->save();

        return response()->json('Guardado con exito');
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
    public function update(Request $request)
    {
         // dd($request);
        $bakery = Bakery::find($request->id);
        $description = Description_Bakery::where('bakeries_id', $bakery->id)->first();

        $bakery->name = $request->name;
        $bakery->price_bs = $request->price_bs;
        $bakery->price_us = $request->price_us;
        $bakery->save();

        // dd($bakery);
        $description->description = $request->description;
        $description->save();

        if ($request->image != null) {
            if ( $bakery->image == null) {

                // $image = $request->file('image');
                // $path = $image->store('public/bakery');
                // $path = str_replace('public/', '', $path);
                $image = new Image;
                // $image->path = $path;
                $image->path = $request->image;
                $image->imageable_type = "App\Bakery";
                $image->imageable_id = $bakery->id;
                $image->save();
            }else{
                // dd($bakery->image->path);
                Storage::disk('public')->delete($bakery->image->path);

                // $image = $request->file('image');
                // $path = $image->store('public/bakery');
                // $path = str_replace('public/', '', $path);
                // $bakery->image->path = $path;
                $bakery->image->path = $request->image;
                $bakery->image->save();
            }
        }

        return response()->json([
            'bakery' => $bakery,
            'description' => $description,
            'message' => 'Cambios guardados exitosamente.!']);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $bakery = Bakery::find($id);
        $description = Description_Bakery::where('bakeries_id', $bakery->id)->first();

        $bakery->delete();
        $description->delete();

        return response()->json('Eliminado');
    }
}

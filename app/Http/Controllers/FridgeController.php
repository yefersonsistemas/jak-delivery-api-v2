<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use App\User;
use App\Fridge;
use App\Description_Fridge;
use App\Image;
use App\Provider;

class FridgeController extends Controller
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

    public function fridge(Request $request){
        // dd($request);
        $user = User::find($request->id);
        // dd($user);
        $provider = Provider::with('fridge.image', 'fridge.description')->where('person_id', $user->person_id)->get();
        // dd($provider);
        
        return response()->json($fridge);
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
        
        $fridge = Fridge::create([
            'name'         => $request->name,
            'price_bs'     => $request->price_bs,
            'price_us'     => $request->price_us,
            'type'         => $request->type,
        ]);
        
        $description = Description_Fridge::create([
            'description' => $request->description,
            'providers_id' => $provider->id,
            'fridge_id' =>  $fridge->id,
        ]);

        $fridge->provider()->attach($provider->id);
        
        // $image = $request->file('image'); 
        // dd($image);
        // $path = $image->store('public/fridge'); 
        // dd($path);
        // $path = str_replace('public/', '', $path); 
        // dd($path);
        $image = new Image;
        // $image->path = $path;  
        $image->path = $request->image;
        $image->imageable_type = "App\Fridge";
        $image->imageable_id = $fridge->id;
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
        $fridge = Fridge::find($request->id);
        $description = Description_Fridge::where('fridge_id', $fridge->id)->first();

        $fridge->name = $request->name;
        $fridge->price_bs = $request->price_bs;
        $fridge->price_us = $request->price_us;
        $fridge->type = $request->type;
        $fridge->save();

        // dd($fridge);
        $description->description = $request->description;
        $description->save();

        if ($request->image != null) {
            if ( $fridge->image == null) {

                // $image = $request->file('image');
                // $path = $image->store('public/fridge');
                // $path = str_replace('public/', '', $path);
                $image = new Image;
                // $image->path = $path;
                $image->path = $request->image;
                $image->imageable_type = "App\Fridge";
                $image->imageable_id = $fridge->id;
                $image->save();
            }else{
                // dd($fridge->image->path);
                Storage::disk('public')->delete($fridge->image->path);

                // $image = $request->file('image');
                // $path = $image->store('public/fridge');
                // $path = str_replace('public/', '', $path);
                // $fridge->image->path = $path;
                $fridge->image->path = $request->image;
                $fridge->image->save();
            }
        }

        return response()->json([
            'fridge' => $fridge,
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
        $fridge = Fridge::find($id);
        $description = Description_Fridge::where('fridge_id', $fridge->id)->first();

        $fridge->delete();
        $description->delete();

        return response()->json('Eliminado');
    }
}

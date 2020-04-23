<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\User;
use App\Food_Vegetarian;
use App\Description_Vegetarian;
use App\Image;

class VegetarianController extends Controller
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

    public function vegetarian(Request $request){
        // dd($request);
        $user = User::find($request->id);
        // dd($user);
        $vegetarian = Food_Vegetarian::with('image')->where('providers_id', $user->id)->get(); //falta with('image')
        // dd( $vegetarian); 
        
        return response()->json($vegetarian);
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

        $vegetarian =  Food_Vegetarian::create([
            'name'         => $request->name,
            'price_bs'     => $request->price_bs,
            'price_us'     => $request->price_us,
            'type'         => $request->type,
            'providers_id' => $provider->id,
        ]);
        
        $description = Description_Vegetarian::create([
            'description' => $request->description,
            'providers_id' => $provider->id,
            'vegetarian_id' =>  $vegetarian->id,
        ]);
        
        // $image = $request->file('image'); 
        // dd($image);
        // $path = $image->store('public/vegetarian'); 
        // dd($path);
        // $path = str_replace('public/', '', $path); 
        // dd($path);
        $image = new Image;
        // $image->path = $path;  
        $image->path = $request->image;
        $image->imageable_type = "App\Food_Vegetarian";
        $image->imageable_id = $vegetarian->id;
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
             // dd($id, $request->name);
        $vegetarian = Food_Vegetarian::find($request->id);
        $description = Description_Vegetarian::where('vegetarian_id', $vegetarian->id)->first();

        $vegetarian->name = $request->name;
        $vegetarian->price_bs = $request->price_bs;
        $vegetarian->price_us = $request->price_us;
        $vegetarian->type = $request->type;
        $vegetarian->save();

        $description->description = $request->description;
        $description->save();

        
        if ($request->image != null) {
            if ( $vegetarian->image == null) {

                // $image = $request->file('image');
                // $path = $image->store('public/vegetarian');
                // $path = str_replace('public/', '', $path);
                $image = new Image;
                // $image->path = $path;
                $image->path = $request->image;
                $image->imageable_type = "App\Food_Vegetarian";
                $image->imageable_id = $vegetarian->id;
                $image->save();
            }else{
                // dd($vegetarian->image->path);
                Storage::disk('public')->delete($vegetarian->image->path);

                // $image = $request->file('image');
                // $path = $image->store('public/vegetarian');
                // $path = str_replace('public/', '', $path);
                // $vegetarian->image->path = $path;
                $vegetarian->image->path = $request->image;
                $vegetarian->image->save();
            }
        }

        return response()->json([
            'vegetarian' => $vegetarian,
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
        $vegetarian = Food_Vegetarian::find($id);
        $description = Description_Vegetarian::where('vegetarian_id', $vegetarian->id)->first();

        $vegetarian->delete();
        $description->delete();

        return response()->json('Eliminado');
    }
}

<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\User;
use App\Food_Salad;
use App\Description_Salad;
use App\Image;

class SaladController extends Controller
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

    public function salad(Request $request){
        // dd($request);
        $user = User::find($request->id);
        // dd($user);
        $salad = Food_Salad::with('image')->where('providers_id', $user->id)->get(); //falta with('image')
        // dd( $salad); 
        
        return response()->json($salad);
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
        
        $salad =  Food_Salad::create([
            'name'         => $request->name,
            'price_bs'     => $request->price_bs,
            'price_us'     => $request->price_us,
            'type'         => $request->type,
            'providers_id' => $provider->id,
        ]);
        
        $description = Description_Salad::create([
            'description' => $request->description,
            'providers_id' => $provider->id,
            'salads_id' =>  $salad->id,
        ]);
        
        // $image = $request->file('image'); 
        // dd($image);
        // $path = $image->store('public/salad'); 
        // dd($path);
        // $path = str_replace('public/', '', $path); 
        // dd($path);
        $image = new Image;
        // $image->path = $path;  
        $image->path = $request->image;
        $image->imageable_type = "App\Food_Salad";
        $image->imageable_id = $salad->id;
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
        $salad = Food_Salad::find($request->id);
        $description = Description_Salad::where('salad_id', $salad->id)->first();

        $salad->name = $request->name;
        $salad->price_bs = $request->price_bs;
        $salad->price_us = $request->price_us;
        $salad->type = $request->type;
        $salad->save();

        $description->description = $request->description;
        $description->save();

        
        if ($request->image != null) {
            if ( $salad->image == null) {

                // $image = $request->file('image');
                // $path = $image->store('public/salad');
                // $path = str_replace('public/', '', $path);
                $image = new Image;
                // $image->path = $path;
                $image->path = $request->image;
                $image->imageable_type = "App\Food_Salad";
                $image->imageable_id = $salad->id;
                $image->save();
            }else{
                // dd($salad->image->path);
                Storage::disk('public')->delete($salad->image->path);

                // $image = $request->file('image');
                // $path = $image->store('public/salad');
                // $path = str_replace('public/', '', $path);
                // $salad->image->path = $path;
                $salad->image->path = $request->image;
                $salad->image->save();
            }
        }

        return response()->json([
            'salad' => $salad,
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
        $salad = Food_Salad::find($id);
        $description = Description_Salad::where('salad_id', $salad->id)->first();

        $salad->delete();
        $description->delete();

        return response()->json('Eliminado');
    }
}

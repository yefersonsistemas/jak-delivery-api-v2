<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\User;
use App\Food_Vegan;
use App\Description_Vegan;
use App\Image;
use Illuminate\Support\Facades\Storage;

class VeganController extends Controller
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

    public function vegan(Request $request){
        // dd($request);
        $user = User::find($request->id);
        // dd($user);
        $vegan = Food_Vegan::with('image')->where('providers_id', $user->id)->get(); //falta with('image')
        // dd( $vegan); 
        
        return response()->json($vegan);
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
        
        $vegan =  Food_Vegan::create([
            'name'         => $request->name,
            'price_bs'     => $request->price_bs,
            'price_us'     => $request->price_us,
            'type'         => $request->type,
            'providers_id' => $provider->id,
        ]);

        // dd($vegan->id);
        
        $description = Description_Vegan::create([
            'description' => $request->description,
            'providers_id' => $provider->id,
            'vegans_id' => $vegan->id,
        ]);

        // dd($description);
        
        if($request->image != null){

            // $image = $request->file('image'); 
            // dd($image);
            // $path = $image->store('public/vegan'); 
            // dd($path);
            // $path = str_replace('public/', '', $path); 
            // dd($path);
            $image = new Image;
            // $image->path = $path;  
            $image->path = $request->image;
            $image->imageable_type = "App\Food_Vegan";
            $image->imageable_id = $vegan->id;
            $image->save();
        }

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
        $vegan = Food_Vegan::find($request->id);
        $description = Description_Vegan::where('vegan_id', $vegan->id)->first();

        $vegan->name = $request->name;
        $vegan->price_bs = $request->price_bs;
        $vegan->price_us = $request->price_us;
        $vegan->type = $request->type;
        $vegan->save();

        $description->description = $request->description;
        $description->save();

        
        if ($request->image != null) {
            if ( $vegan->image == null) {

                // $image = $request->file('image');
                // $path = $image->store('public/vegan');
                // $path = str_replace('public/', '', $path);
                $image = new Image;
                // $image->path = $path;
                $image->path = $request->image;
                $image->imageable_type = "App\Food_Vegan";
                $image->imageable_id = $vegan->id;
                $image->save();
            }else{
                // dd($vegan->image->path);
                Storage::disk('public')->delete($vegan->image->path);

                // $image = $request->file('image');
                // $path = $image->store('public/vegan');
                // $path = str_replace('public/', '', $path);
                // $vegan->image->path = $path;
                $vegan->image->path = $request->image;
                $vegan->image->save();
            }
        }

        return response()->json([
            'vegan' => $vegan,
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
        $vegan = Food_Vegan::find($id);
        $description = Description_Vegan::where('vegan_id', $vegan->id)->first();

        $vegan->delete();
        $description->delete();

        return response()->json('Eliminado');
    }
}

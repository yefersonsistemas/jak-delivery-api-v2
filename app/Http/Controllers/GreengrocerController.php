<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use App\User;
use App\Greengrocer;
use App\Description_Greengrocer;
use App\Image;
use App\Provider;

class GreengrocerController extends Controller
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

    public function greengrocer(Request $request){
        // dd($request);
        $user = User::find($request->id);
        // dd($user);
        $provider = Provider::with('greengrocer.image', 'greengrocer.description')->where('person_id', $user->person_id)->get();
        // dd( $provider); 
        
        return response()->json($provider);
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
        
        $greengrocer = Greengrocer::create([
            'name'         => $request->name,
            'price_bs'     => $request->price_bs,
            'price_us'     => $request->price_us,
            'type'         => $request->type,
        ]);
        
        $description = Description_Greengrocer::create([
            'description' => $request->description,
            'providers_id' => $provider->id,
            'greengrocer_id' =>  $greengrocer->id,
        ]);

        $greengrocer->provider()->attach($provider->id);
        
        // $image = $request->file('image'); 
        // dd($image);
        // $path = $image->store('public/greengrocer'); 
        // dd($path);
        // $path = str_replace('public/', '', $path); 
        // dd($path);
        $image = new Image;
        // $image->path = $path;  
        $image->path = $request->image;
        $image->imageable_type = "App\Greengrocer";
        $image->imageable_id = $greengrocer->id;
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
    public function update(Request $request, $id)
    {
        // dd($request);
        $greengrocer = Greengrocer::find($request->id);
        $description = Description_Greengrocer::where('greengrocer_id', $greengrocer->id)->first();

        $greengrocer->name = $request->name;
        $greengrocer->price_bs = $request->price_bs;
        $greengrocer->price_us = $request->price_us;
        $greengrocer->type = $request->type;
        $greengrocer->save();

        // dd($greengrocer);
        $description->description = $request->description;
        $description->save();

        if ($request->image != null) {
            if ( $greengrocer->image == null) {

                // $image = $request->file('image');
                // $path = $image->store('public/greengrocer');
                // $path = str_replace('public/', '', $path);
                $image = new Image;
                // $image->path = $path;
                $image->path = $request->image;
                $image->imageable_type = "App\Greengrocer";
                $image->imageable_id = $greengrocer->id;
                $image->save();
            }else{
                // dd($greengrocer->image->path);
                Storage::disk('public')->delete($greengrocer->image->path);

                // $image = $request->file('image');
                // $path = $image->store('public/greengrocer');
                // $path = str_replace('public/', '', $path);
                // $greengrocer->image->path = $path;
                $greengrocer->image->path = $request->image;
                $greengrocer->image->save();
            }
        }

        return response()->json([
            'greengrocer' => $greengrocer,
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
        $greengrocer = Greengrocer::find($id);
        $description = Description_Greengrocer::where('greengrocer_id', $greengrocer->id)->first();

        $greengrocer->delete();
        $description->delete();

        return response()->json('Eliminado');
    }
}

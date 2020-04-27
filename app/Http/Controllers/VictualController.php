<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use App\User;
use App\Victual;
use App\Description_Victual;
use App\Image;
use App\Provider;

class VictualController extends Controller
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

    public function victual(Request $request){
        // dd($request);
        $user = User::find($request->id);
        // dd($user);
        $provider = Provider::with('victual.image', 'victual.description')->where('person_id', $user->person_id)->get();
        // dd($provider);
        
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
        // dd($provider->id);
        
        $victual = Victual::create([
            'name'         => $request->name,
            'price_bs'     => $request->price_bs,
            'price_us'     => $request->price_us,
            'type'         => $request->type,
        ]);

        // dd($victual);
        
        $description = Description_Victual::create([
            'description' => $request->description,
            'providers_id' => $provider->id,
            'victuals_id' =>  $victual->id,
        ]);
        
        $victual->provider()->attach($provider->id);
        
        if($request->image != null){

            // $image = $request->file('image'); 
            // dd($image);
            // $path = $image->store('public/victual'); 
            // dd($path);
            // $path = str_replace('public/', '', $path); 
            // dd($path);
            $image = new Image;
            // $image->path = $path;  
            $image->path = $request->image;
            $image->imageable_type = "App\Victual";
            $image->imageable_id = $victual->id;
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
        // dd($request);
        $victual = Victual::find($request->id);
        $description = Description_Victual::where('victuals_id', $victual->id)->first();

        $victual->name = $request->name;
        $victual->price_bs = $request->price_bs;
        $victual->price_us = $request->price_us;
        $victual->type = $request->type;
        $victual->save();

        // dd($victual);
        $description->description = $request->description;
        $description->save();

        if ($request->image != null) {
            if ( $victual->image == null) {

                // $image = $request->file('image');
                // $path = $image->store('public/victual');
                // $path = str_replace('public/', '', $path);
                $image = new Image;
                // $image->path = $path;
                $image->path = $request->image;
                $image->imageable_type = "App\Victual";
                $image->imageable_id = $victual->id;
                $image->save();
            }else{
                // dd($victual->image->path);
                Storage::disk('public')->delete($victual->image->path);

                // $image = $request->file('image');
                // $path = $image->store('public/victual');
                // $path = str_replace('public/', '', $path);
                // $victual->image->path = $path;
                $victual->image->path = $request->image;
                $victual->image->save();
            }
        }

        return response()->json([
            'victual' => $victual,
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
        $victual = Victual::find($id);
        $description = Description_Victual::where('victuals_id', $victual->id)->first();

        $victual->delete();
        $description->delete();

        return response()->json('Eliminado');
    }
}

<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use App\User;
use App\Liquor;
use App\Description_Liquor;
use App\Image;
use App\Provider;

class LiquorStoreController extends Controller
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

    public function liquor(Request $request){
        // dd($request);
        $user = User::find($request->id);
        // dd($user);
        $provider = Provider::with('liquor.image', 'liquor.description')->where('person_id', $user->person_id)->get();
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
        
        $liquor = Liquor::create([
            'name'         => $request->name,
            'price_bs'     => $request->price_bs,
            'price_us'     => $request->price_us,
        ]);
        // dd($liquor);

        $description = Description_Liquor::create([
            'description' => $request->description,
            'providers_id' => $provider->id,
            'liquor_id' =>  $liquor->id,
        ]);
        // dd($description);

        $liquor->provider()->attach($provider->id);
        
        if($request->image != null){

            // $image = $request->file('image'); 
            // dd($image);
            // $path = $image->store('public/liquor'); 
            // dd($path);
            // $path = str_replace('public/', '', $path); 
            // dd($path);
            $image = new Image;
            // $image->path = $path;  
            $image->path = $request->image;
            $image->imageable_type = "App\Liquor";
            $image->imageable_id = $liquor->id;
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
        $liquor = Liquor::find($request->id);
        $description = Description_Liquor::where('liquor_id', $liquor->id)->first();

        $liquor->name = $request->name;
        $liquor->price_bs = $request->price_bs;
        $liquor->price_us = $request->price_us;
        $liquor->save();

        // dd($liquor);
        $description->description = $request->description;
        $description->save();

        if ($request->image != null) {
            if ( $liquor->image == null) {

                // $image = $request->file('image');
                // $path = $image->store('public/liquor');
                // $path = str_replace('public/', '', $path);
                $image = new Image;
                // $image->path = $path;
                $image->path = $request->image;
                $image->imageable_type = "App\Liquor";
                $image->imageable_id = $liquor->id;
                $image->save();
            }else{
                // dd($liquor->image->path);
                Storage::disk('public')->delete($liquor->image->path);

                // $image = $request->file('image');
                // $path = $image->store('public/liquor');
                // $path = str_replace('public/', '', $path);
                // $liquor->image->path = $path;
                $liquor->image->path = $request->image;
                $liquor->image->save();
            }
        }

        return response()->json([
            'liquor' => $liquor,
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
        $liquor = Liquor::find($id);
        $description = Description_Liquor::where('liquor_id', $liquor->id)->first();

        $liquor->delete();
        $description->delete();

        return response()->json('Eliminado');
    }
}

<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\User;
use App\Food_Traditional;
use App\Description_Traditional;
use App\Image;
use Illuminate\Support\Facades\Storage;

class TraditionalController extends Controller
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
    
    public function traditional(Request $request){
        // dd($request);
        $user = User::find($request->id);
        // dd($user);
        $traditional = Food_Traditional::with('image')->where('providers_id', $user->id)->get(); //falta with('image')
        // dd( $traditional); 
        
        return response()->json($traditional);
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
        
        $traditional =  Food_Traditional::create([
            'name'         => $request->name,
            'price_bs'     => $request->price_bs,
            'price_us'     => $request->price_us,
            'type'         => $request->type,
            'providers_id' => $provider->id,
        ]);
        
        $description = Description_Traditional::create([
            'description' => $request->description,
            'providers_id' => $provider->id,
            'traditional_id' =>  $traditional->id,
        ]);
        
        // $image = $request->file('image'); 
        // dd($image);
        // $path = $image->store('public/traditional'); 
        // dd($path);
        // $path = str_replace('public/', '', $path); 
        // dd($path);
        $image = new Image;
        // $image->path = $path;  
        $image->path = $request->image;
        $image->imageable_type = "App\Food_Traditional";
        $image->imageable_id = $traditional->id;
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
        $traditional = Food_Traditional::find($request->id);
        $description = Description_Traditional::where('traditional_id', $traditional->id)->first();

        $traditional->name = $request->name;
        $traditional->price_bs = $request->price_bs;
        $traditional->price_us = $request->price_us;
        $traditional->type = $request->type;
        $traditional->save();

        $description->description = $request->description;
        $description->save();

        
        if ($request->image != null) {
            if ( $traditional->image == null) {

                // $image = $request->file('image');
                // $path = $image->store('public/traditional');
                // $path = str_replace('public/', '', $path);
                $image = new Image;
                // $image->path = $path;
                $image->path = $request->image;
                $image->imageable_type = "App\Food_Traditional";
                $image->imageable_id = $traditional->id;
                $image->save();
            }else{
                // dd($traditional->image->path);
                Storage::disk('public')->delete($traditional->image->path);

                // $image = $request->file('image');
                // $path = $image->store('public/traditional');
                // $path = str_replace('public/', '', $path);
                // $traditional->image->path = $path;
                $traditional->image->path = $request->image;
                $traditional->image->save();
            }
        }

        return response()->json([
            'traditional' => $traditional,
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
        $traditional = Food_Traditional::find($id);
        $description = Description_Traditional::where('traditional_id', $traditional->id)->first();

        $traditional->delete();
        $description->delete();

        return response()->json('Eliminado');
    }
}

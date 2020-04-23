<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\User;
use App\Food_Mexican;
use App\Description_Mexican;
use App\Image;

class MexicanController extends Controller
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
           
    public function mexican(Request $request){
        // dd($request);
        $user = User::find($request->id);
        // dd($user);
        $mexican = Food_Mexican::with('image')->where('providers_id', $user->id)->get(); //falta with('image')
        // dd( $mexican); 
        
        return response()->json($mexican);
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
        
        $mexican =  Food_Mexican::create([
            'name'         => $request->name,
            'price_bs'     => $request->price_bs,
            'price_ud'     => $request->price_ud,
            'type'         => $request->type,
            'providers_id' => $provider->id,
        ]);
        
        $description = Description_Mexican::create([
            'description' => $request->description,
            'providers_id' => $provider->id,
            'mexican_id' =>  $mexican->id,
        ]);
        
       // $image = $request->file('image'); 
        // dd($image);
        // $path = $image->store('public/mexican'); 
        // dd($path);
        // $path = str_replace('public/', '', $path); 
        // dd($path);
        $image = new Image;
        // $image->path = $path;  
        $image->path = $request->image;
        $image->imageable_type = "App\Food_Mexican";
        $image->imageable_id = $mexican->id;
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
        $mexican = Food_Mexican::find($request->id);
        $description = Description_Mexican::where('mexican_id', $mexican->id)->first();

        $mexican->name = $request->name;
        $mexican->price_bs = $request->price_bs;
        $mexican->price_us = $request->price_us;
        $mexican->type = $request->type;
        $mexican->save();

        $description->description = $request->description;
        $description->save();

        
        if ($request->image != null) {
            if ( $mexican->image == null) {

                // $image = $request->file('image');
                // $path = $image->store('public/mexican');
                // $path = str_replace('public/', '', $path);
                $image = new Image;
                // $image->path = $path;
                $image->path = $request->image;
                $image->imageable_type = "App\Food_Mexican";
                $image->imageable_id = $mexican->id;
                $image->save();
            }else{
                // dd($mexican->image->path);
                Storage::disk('public')->delete($mexican->image->path);

                // $image = $request->file('image');
                // $path = $image->store('public/mexican');
                // $path = str_replace('public/', '', $path);
                // $mexican->image->path = $path;
                $mexican->image->path = $request->image;
                $mexican->image->save();
            }
        }

        return response()->json([
            'mexican' => $mexican,
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
        $mexican = Food_Mexican::find($id);
        $description = Description_Mexican::where('mexican_id', $mexican->id)->first();

        $mexican->delete();
        $description->delete();

        return response()->json('Eliminado');
    }
}

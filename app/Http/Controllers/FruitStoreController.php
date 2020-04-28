<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use App\User;
use App\Fruit;
use App\Description_Fruit;
use App\Image;
use App\Provider;

class FruitStoreController extends Controller
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
    
    public function fruit(Request $request){
        // dd($request);
        $user = User::find($request->id);
        // dd($user);
       $provider = Provider::with('fruit.image', 'fruit.description')->where('person_id', $user->person_id)->get();
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
        
        $fruit = Fruit::create([
            'name'         => $request->name,
            'price_bs'     => $request->price_bs,
            'price_us'     => $request->price_us,
            'type'         => $request->type,
        ]);
        
        $description = Description_Fruit::create([
            'description' => $request->description,
            'providers_id' => $provider->id,
            'fruit_id' =>  $fruit->id,
        ]);

        $fruit->provider()->attach($provider->id);

        if($request->image != null){

            // $image = $request->file('image'); 
            // dd($image);
            // $path = $image->store('public/fruit'); 
            // dd($path);
            // $path = str_replace('public/', '', $path); 
            // dd($path);
            $image = new Image;
            // $image->path = $path;  
            $image->path = $request->image;
            $image->imageable_type = "App\Fruit";
            $image->imageable_id = $fruit->id;
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
        $fruit = Fruit::find($request->id);
        $description = Description_Fruit::where('fruit_id', $fruit->id)->first();

        $fruit->name = $request->name;
        $fruit->price_bs = $request->price_bs;
        $fruit->price_us = $request->price_us;
        $fruit->type = $request->type;
        $fruit->save();

        // dd($fruit);
        $description->description = $request->description;
        $description->save();

        if ($request->image != null) {
            if ( $fruit->image == null) {

                // $image = $request->file('image');
                // $path = $image->store('public/fruit');
                // $path = str_replace('public/', '', $path);
                $image = new Image;
                // $image->path = $path;
                $image->path = $request->image;
                $image->imageable_type = "App\Fruit";
                $image->imageable_id = $fruit->id;
                $image->save();
            }else{
                // dd($fruit->image->path);
                Storage::disk('public')->delete($fruit->image->path);

                // $image = $request->file('image');
                // $path = $image->store('public/fruit');
                // $path = str_replace('public/', '', $path);
                // $fruit->image->path = $path;
                $fruit->image->path = $request->image;
                $fruit->image->save();
            }
        }

        return response()->json([
            'fruit' => $fruit,
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
        $fruit = Fruit::find($id);
        $description = Description_Fruit::where('fruit_id', $fruit->id)->first();

        $fruit->delete();
        $description->delete();

        return response()->json('Eliminado');
    }
}

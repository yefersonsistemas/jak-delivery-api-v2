<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\User;
use App\Food_Chicken;
use App\Description_Chicken;
use App\Image;
use Illuminate\Support\Facades\Storage;

class ChickenController extends Controller
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

    public function chicken(Request $request){
        // dd($request);
        $user = User::find($request->id);
        // dd($user);
        $chicken = Food_Chicken::with('image')->where('providers_id', $user->id)->get(); //falta with('image')
        // dd( $chicken); 
        
        return response()->json($chicken);
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
        
        $chicken =  Food_Chicken::create([
            'name'         => $request->name,
            'price_bs'     => $request->price_bs,
            'price_us'     => $request->price_us,
            'type'         => $request->type,
            'providers_id' => $provider->id,
        ]);
        
        $description = Description_Chicken::create([
            'description' => $request->description,
            'providers_id' => $provider->id,
            'chicken_id' =>  $chicken->id,
        ]);
        
        if($request->image != null){

            // $image = $request->file('image'); 
            // dd($image);
            // $path = $image->store('public/chicken'); 
            // dd($path);
            // $path = str_replace('public/', '', $path); 
            // dd($path);
            $image = new Image;
            // $image->path = $path;  
            $image->path = $request->image;
            $image->imageable_type = "App\Food_Chicken";
            $image->imageable_id = $chicken->id;
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
        $chicken = Food_Chicken::find($request->id);
        $description = Description_Chicken::where('chicken_id', $chicken->id)->first();

        $chicken->name = $request->name;
        $chicken->price_bs = $request->price_bs;
        $chicken->price_us = $request->price_us;
        $chicken->type = $request->type;
        $chicken->save();

        $description->description = $request->description;
        $description->save();

        if ($request->image != null) {
            if ( $chicken->image == null) {

                // $image = $request->file('image');
                // $path = $image->store('public/chicken');
                // $path = str_replace('public/', '', $path);
                $image = new Image;
                // $image->path = $path;
                $image->path = $request->image;
                $image->imageable_type = "App\Food_Chicken";
                $image->imageable_id = $chicken->id;
                $image->save();
            }else{
                // dd($chicken->image->path);
                Storage::disk('public')->delete($chicken->image->path);

                // $image = $request->file('image');
                // $path = $image->store('public/chicken');
                // $path = str_replace('public/', '', $path);
                // $chicken->image->path = $path;
                $chicken->image->path = $request->image;
                $chicken->image->save();
            }
        }

        return response()->json([
            'chicken' => $chicken,
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
        $chicken = Food_Chicken::find($id);
        $description = Description_Chicken::where('chicken_id', $chicken->id)->first();

        $chicken->delete();
        $description->delete();

        return response()->json('Eliminado');
    }
}

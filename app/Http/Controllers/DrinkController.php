<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\User;
use App\Drink;
use App\Description_Drink;
use App\Image;
use Illuminate\Support\Facades\Storage;

class DrinkController extends Controller
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

    public function drink(Request $request){
        // dd($request);
        $user = User::find($request->id);
        // dd($user);
        $drink = Drink::with('image')->where('providers_id', $user->id)->get(); 
        // dd( $drink); 
        
        return response()->json($drink);
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
        
        $drink =  Drink::create([
            'name'         => $request->name,
            'price_bs'     => $request->price_bs,
            'price_us'     => $request->price_us,
            'type_drink'   => $request->type_drink,
            'providers_id' => $provider->id,
        ]);
        
        // dd($drink);
        $description = Description_Drink::create([
            'description' => $request->description,
            'providers_id' => $provider->id,
            'drinks_id' =>  $drink->id,
        ]);

        if($request->image != null){

            // $image = $request->file('image'); 
        // dd($image);
        // $path = $image->store('public/drink'); 
        // dd($path);
        // $path = str_replace('public/', '', $path); 
        // dd($path);
        $image = new Image;
        // $image->path = $path;  
        $image->path = $request->image;
        $image->imageable_type = "App\Drink";
        $image->imageable_id = $drink->id;
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
        $drink = Drink::find($request->id);
        $description = Description_Drink::where('drink_id', $drink->id)->first();

        $drink->name = $request->name;
        $drink->price_bs = $request->price_bs;
        $drink->price_us = $request->price_us;
        $drink->type_drink = $request->type_drink;
        $drink->save();

        $description->description = $request->description;
        $description->save();

        
        if ($request->image != null) {
            if ( $drink->image == null) {

                // $image = $request->file('image');
                // $path = $image->store('public/drink');
                // $path = str_replace('public/', '', $path);
                $image = new Image;
                // $image->path = $path;
                $image->path = $request->image;
                $image->imageable_type = "App\Drink";
                $image->imageable_id = $drink->id;
                $image->save();
            }else{
                // dd($drink->image->path);
                Storage::disk('public')->delete($drink->image->path);

                // $image = $request->file('image');
                // $path = $image->store('public/drink');
                // $path = str_replace('public/', '', $path);
                // $drink->image->path = $path;
                $drink->image->path = $request->image;
                $drink->image->save();
            }
        }

        return response()->json([            
            'drink' => $drink,
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
        $drink = Drink::find($id);
        $description = Description_Drink::where('drink_id', $drink->id)->first();

        $drink->delete();
        $description->delete();

        return response()->json('Eliminado');
    }
}

<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\User;
use App\Food_Pizza;
use App\Description_Pizza;
use App\Image;
use Illuminate\Support\Facades\Storage;

class PizzaController extends Controller
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

    public function pizza(Request $request){
        // dd($request);
        $user = User::find($request->id);
        // dd($user);
        $pizza = Food_Pizza::with('image')->where('providers_id', $user->id)->get(); //falta with('image')
        // dd( $pizza); 
        
        return response()->json($pizza);
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
        
        $pizza =  Food_Pizza::create([
            'name'         => $request->name,
            'price_bs'     => $request->price_bs,
            'price_us'     => $request->price_us,
            'type'         => $request->type,
            'providers_id' => $provider->id,
        ]);
        
        $description = Description_Pizza::create([
            'description' => $request->description,
            'providers_id' => $provider->id,
            'pizza_id' =>  $pizza->id,
        ]);
        
        // $image = $request->file('image'); 
        // dd($image);
        // $path = $image->store('public/pizza'); 
        // dd($path);
        // $path = str_replace('public/', '', $path); 
        // dd($path);
        $image = new Image;
        // $image->path = $path;  
        $image->path = $request->image;
        $image->imageable_type = "App\Food_Pizza";
        $image->imageable_id = $pizza->id;
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
        $pizza = Food_Pizza::find($request->id);
        $description = Description_Pizza::where('pizza_id', $pizza->id)->first();

        $pizza->name = $request->name;
        $pizza->price_bs = $request->price_bs;
        $pizza->price_us = $request->price_us;
        $pizza->type = $request->type;
        $pizza->save();

        $description->description = $request->description;
        $description->save();

        
        if ($request->image != null) {
            if ( $pizza->image == null) {

                // $image = $request->file('image');
                // $path = $image->store('public/pizza');
                // $path = str_replace('public/', '', $path);
                $image = new Image;
                // $image->path = $path;
                $image->path = $request->image;
                $image->imageable_type = "App\Food_Pizza";
                $image->imageable_id = $pizza->id;
                $image->save();
            }else{
                // dd($pizza->image->path);
                Storage::disk('public')->delete($pizza->image->path);

                // $image = $request->file('image');
                // $path = $image->store('public/pizza');
                // $path = str_replace('public/', '', $path);
                // $pizza->image->path = $path;
                $pizza->image->path = $request->image;
                $pizza->image->save();
            }
        }

        return response()->json([
            'pizza' => $pizza,
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
        $pizza = Food_Pizza::find($id);
        $description = Description_Pizza::where('pizza_id', $pizza->id)->first();

        $pizza->delete();
        $description->delete();

        return response()->json('Eliminado');
    }
}

<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use App\User;
use App\Lunch;
use App\Description_Lunch;
use App\Image;
use App\Provider;

class LunchController extends Controller
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

    public function lunch(Request $request){
        // dd($request);
        $user = User::find($request->id);
        // dd($user);
       $provider = Provider::with('lunch.image', 'lunch.description')->where('person_id', $user->person_id)->get();
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
        
        $lunch = Lunch::create([
            'name'         => $request->name,
            'price_bs'     => $request->price_bs,
            'price_us'     => $request->price_us,
            'type'         => $request->type,
        ]);
        
        $description = Description_Lunch::create([
            'description' => $request->description,
            'providers_id' => $provider->id,
            'lunch_id' =>  $lunch->id,
        ]);

        $lunch->provider()->attach($provider->id);
        
        // $image = $request->file('image'); 
        // dd($image);
        // $path = $image->store('public/lunch'); 
        // dd($path);
        // $path = str_replace('public/', '', $path); 
        // dd($path);
        $image = new Image;
        // $image->path = $path;  
        $image->path = $request->image;
        $image->imageable_type = "App\Lunch";
        $image->imageable_id = $lunch->id;
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
        // dd($request);
        $lunch = Lunch::find($request->id);
        $description = Description_Lunch::where('lunch_id', $lunch->id)->first();

        $lunch->name = $request->name;
        $lunch->price_bs = $request->price_bs;
        $lunch->price_us = $request->price_us;
        $lunch->type = $request->type;
        $lunch->save();

        // dd($lunch);
        $description->description = $request->description;
        $description->save();

        if ($request->image != null) {
            if ( $lunch->image == null) {

                // $image = $request->file('image');
                // $path = $image->store('public/lunch');
                // $path = str_replace('public/', '', $path);
                $image = new Image;
                // $image->path = $path;
                $image->path = $request->image;
                $image->imageable_type = "App\Lunch";
                $image->imageable_id = $lunch->id;
                $image->save();
            }else{
                // dd($lunch->image->path);
                Storage::disk('public')->delete($lunch->image->path);

                // $image = $request->file('image');
                // $path = $image->store('public/lunch');
                // $path = str_replace('public/', '', $path);
                // $lunch->image->path = $path;
                $lunch->image->path = $request->image;
                $lunch->image->save();
            }
        }

        return response()->json([
            'lunch' => $lunch,
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
        $lunch = Lunch::find($id);
        $description = Description_Lunch::where('lunch_id', $lunch->id)->first();

        $lunch->delete();
        $description->delete();

        return response()->json('Eliminado');
    }
}

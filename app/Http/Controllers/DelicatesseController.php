<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use App\User;
use App\Delicatesse;
use App\Description_Delicatesse;
use App\Image;
use App\Provider;

class DelicatesseController extends Controller
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

    public function delicatesse(Request $request){
        // dd($request);
        $user = User::find($request->id);
        // dd($user);
       $provider = Provider::with('delicatesse.image', 'delicatesse.description')->where('person_id', $user->person_id)->get();
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
        // dd($provider);
        
        $delicatesse = Delicatesse::create([
            'name'         => $request->name,
            'price_bs'     => $request->price_bs,
            'price_us'     => $request->price_us,
            'type'         => $request->type,
        ]);
        
        $description = Description_Delicatesse::create([
            'description' => $request->description,
            'providers_id' => $provider->id,
            'delicatesse_id' =>  $delicatesse->id,
        ]);

        $delicatesse->provider()->attach($provider->id);
        
        if($request->image != null){

            // $image = $request->file('image'); 
            // dd($image);
            // $path = $image->store('public/delicatesse'); 
            // dd($path);
            // $path = str_replace('public/', '', $path); 
            // dd($path);
            $image = new Image;
            // $image->path = $path;  
            $image->path = $request->image;
            $image->imageable_type = "App\Delicatesse";
            $image->imageable_id = $delicatesse->id;
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
        $delicatesse = Delicatesse::find($request->id);
        $description = Description_Delicatesse::where('delicatesse_id', $delicatesse->id)->first();

        $delicatesse->name = $request->name;
        $delicatesse->price_bs = $request->price_bs;
        $delicatesse->price_us = $request->price_us;
        $delicatesse->type = $request->type;
        $delicatesse->save();

        // dd($delicatesse);
        $description->description = $request->description;
        $description->save();

        if ($request->image != null) {
            if ( $delicatesse->image == null) {

                // $image = $request->file('image');
                // $path = $image->store('public/delicatesse');
                // $path = str_replace('public/', '', $path);
                $image = new Image;
                // $image->path = $path;
                $image->path = $request->image;
                $image->imageable_type = "App\Delicatesse";
                $image->imageable_id = $delicatesse->id;
                $image->save();
            }else{
                // dd($delicatesse->image->path);
                Storage::disk('public')->delete($delicatesse->image->path);

                // $image = $request->file('image');
                // $path = $image->store('public/delicatesse');
                // $path = str_replace('public/', '', $path);
                // $delicatesse->image->path = $path;
                $delicatesse->image->path = $request->image;
                $delicatesse->image->save();
            }
        }

        return response()->json([
            'delicatesse' => $delicatesse,
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
        $delicatesse = Delicatesse::find($id);
        $description = Description_Delicatesse::where('delicatesse_id', $delicatesse->id)->first();

        $delicatesse->delete();
        $description->delete();

        return response()->json('Eliminado');
    }
}

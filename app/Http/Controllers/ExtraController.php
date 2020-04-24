<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\User;
use App\Extra;
use App\Description_Extra;
use App\Image;
use Illuminate\Support\Facades\Storage;

class ExtraController extends Controller
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

    public function extra(Request $request){
        // dd($request);
        $user = User::find($request->id);
        // dd($user);
        $extra = Extra::with('image')->where('providers_id', $user->id)->get(); //falta with('image')
        // dd( $extra); 
        
        return response()->json($extra);
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
        
        $extra =  Extra::create([
            'name'         => $request->name,
            'price_bs'     => $request->price_bs,
            'price_us'     => $request->price_us,
            'type_extra'   => $request->type_extra,
            'providers_id' => $provider->id,
        ]);
        
        $description = Description_Extra::create([
            'description' => $request->description,
            'providers_id' => $provider->id,
            'extras_id' =>  $extra->id,
        ]);
        
        // $image = $request->file('image'); 
        // dd($image);
        // $path = $image->store('public/extra'); 
        // dd($path);
        // $path = str_replace('public/', '', $path); 
        // dd($path);
        $image = new Image;
        // $image->path = $path;  
        $image->path = $request->image;
        $image->imageable_type = "App\Extra";
        $image->imageable_id = $extra->id;
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
        $extra = Extra::find($request->id);
        $description = Description_Extra::where('extra_id', $extra->id)->first();

        $extra->name = $request->name;
        $extra->price_bs = $request->price_bs;
        $extra->price_us = $request->price_us;
        $extra->type_extra = $request->type_extra;
        $extra->save();

        $description->description = $request->description;
        $description->save();

        
        if ($request->image != null) {
            if ( $extra->image == null) {

                // $image = $request->file('image');
                // $path = $image->store('public/extra');
                // $path = str_replace('public/', '', $path);
                $image = new Image;
                // $image->path = $path;
                $image->path = $request->image;
                $image->imageable_type = "App\Extra";
                $image->imageable_id = $extra->id;
                $image->save();
            }else{
                // dd($extra->image->path);
                Storage::disk('public')->delete($extra->image->path);

                // $image = $request->file('image');
                // $path = $image->store('public/extra');
                // $path = str_replace('public/', '', $path);
                // $extra->image->path = $path;
                $extra->image->path = $request->image;
                $extra->image->save();
            }
        }

        return response()->json([
            'extra' => $extra,
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
        $extra = Extra::find($id);
        $description = Description_Extra::where('extra_id', $extra->id)->first();

        $extra->delete();
        $description->delete();

        return response()->json('Eliminado');
    }
}

<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\User;
use App\Food_Chinese;
use App\Description_Chinese;
use App\Image;
use Illuminate\Support\Facades\Storage;

class ChineseController extends Controller
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

    public function chinese(Request $request){
        // dd($request);
        $user = User::find($request->id);
        // dd($user);
        $chinese = Food_Chinese::with('image')->where('providers_id', $user->id)->get(); //falta with('image')
        // dd( $chinese); 
        
        return response()->json($chinese);
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
        
        $chinese =  Food_Chinese::create([
            'name'         => $request->name,
            'price_bs'     => $request->price_bs,
            'price_ud'     => $request->price_us,
            'type'         => $request->type,
            'providers_id' => $provider->id,
        ]);
        
        $description = Description_Chinese::create([
            'description' => $request->description,
            'providers_id' => $provider->id,
            'chinese_id' =>  $chinese->id,
        ]);
        
        if($request->image != null){

            // $image = $request->file('image'); 
            // dd($image);
            // $path = $image->store('public/chinese'); 
            // dd($path);
            // $path = str_replace('public/', '', $path); 
            // dd($path);
            $image = new Image;
            // $image->path = $path;  
            $image->path = $request->image;
            $image->imageable_type = "App\Food_Chinese";
            $image->imageable_id = $chinese->id;
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
        $chinese = Food_Chinese::find($request->id);
        $description = Description_Chinese::where('chinese_id', $chinese->id)->first();

        $chinese->name = $request->name;
        $chinese->price_bs = $request->price_bs;
        $chinese->price_us = $request->price_us;
        $chinese->type = $request->type;
        $chinese->save();

        $description->description = $request->description;
        $description->save();
        
        if ($request->image != null) {
            if ( $chinese->image == null) {

                // $image = $request->file('image');
                // $path = $image->store('public/chinese');
                // $path = str_replace('public/', '', $path);
                $image = new Image;
                // $image->path = $path;
                $image->path = $request->image;
                $image->imageable_type = "App\Food_Chinese";
                $image->imageable_id = $chinese->id;
                $image->save();
            }else{
                // dd($chinese->image->path);
                Storage::disk('public')->delete($chinese->image->path);

                // $image = $request->file('image');
                // $path = $image->store('public/chinese');
                // $path = str_replace('public/', '', $path);
                // $chinese->image->path = $path;
                $chinese->image->path = $request->image;
                $chinese->image->save();
            }
        }

        return response()->json([
            'chinese' => $chinese,
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
        //
    }
}

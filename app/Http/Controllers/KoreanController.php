<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\User;
use App\Food_Korean;
use App\Description_Korean;
use App\Image;
use Illuminate\Support\Facades\Storage;

class KoreanController extends Controller
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
       
    public function korean(Request $request){
        // dd($request);
        $user = User::find($request->id);
        // dd($user);
        $korean = Food_Korean::with('image')->where('providers_id', $user->id)->get(); //falta with('image')
        // dd( $korean); 
        
        return response()->json($korean);
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
        
        $korean =  Food_Korean::create([
            'name'         => $request->name,
            'price_bs'     => $request->price_bs,
            'price_us'     => $request->price_us,
            'type'         => $request->type,
            'providers_id' => $provider->id,
        ]);
        
        $description = Description_Korean::create([
            'description' => $request->description,
            'providers_id' => $provider->id,
            'korean_id' =>  $korean->id,
        ]);
        
        if($request->image != null){

            // $image = $request->file('image'); 
            // dd($image);
            // $path = $image->store('public/korean'); 
            // dd($path);
            // $path = str_replace('public/', '', $path); 
            // dd($path);
            $image = new Image;
            // $image->path = $path;  
            $image->path = $request->image;
            $image->imageable_type = "App\Food_Korean";
            $image->imageable_id = $korean->id;
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
        $korean = Food_Korean::find($request->id);
        $description = Description_Korean::where('korean_id', $korean->id)->first();

        $korean->name = $request->name;
        $korean->price_bs = $request->price_bs;
        $korean->price_us = $request->price_us;
        $korean->type = $request->type;
        $korean->save();

        $description->description = $request->description;
        $description->save();

        
        if ($request->image != null) {
            if ( $korean->image == null) {

                // $image = $request->file('image');
                // $path = $image->store('public/korean');
                // $path = str_replace('public/', '', $path);
                $image = new Image;
                // $image->path = $path;
                $image->path = $request->image;
                $image->imageable_type = "App\Food_Korean";
                $image->imageable_id = $korean->id;
                $image->save();
            }else{
                // dd($korean->image->path);
                Storage::disk('public')->delete($korean->image->path);

                // $image = $request->file('image');
                // $path = $image->store('public/korean');
                // $path = str_replace('public/', '', $path);
                // $korean->image->path = $path;
                $korean->image->path = $request->image;
                $korean->image->save();
            }
        }

        return response()->json([
            'korean' => $korean,
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
        $korean = Food_Korean::find($id);
        $description = Description_Korean::where('korean_id', $korean->id)->first();

        $korean->delete();
        $description->delete();

        return response()->json('Eliminado');
    }
}

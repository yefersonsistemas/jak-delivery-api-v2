<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\User;
use App\Food_Japanese;
use App\Description_Japanese;
use App\Image;

class JapaneseController extends Controller
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

    
    public function japanese(Request $request){
        // dd($request);
        $user = User::find($request->id);
        // dd($user);
        $japanese = Food_Japanese::with('image')->where('providers_id', $user->id)->get(); //falta with('image')
        // dd( $japanese); 
        
        return response()->json($japanese);
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
        
        $provider = User::find($request->id);
        // dd( $provider);
        
        $japanese =  Food_Japanese::create([
            'name'         => $request->name,
            'price_bs'     => $request->price_bs,
            'price_us'     => $request->price_us,
            'type'         => $request->type,
            'providers_id' => $provider->id,
        ]);
        
        $description = Description_Japanese::create([
            'description' => $request->description,
            'providers_id' => $provider->id,
            'japanese_id' =>  $japanese->id,
        ]);
        
        // $image = $request->file('image');  //de esta manera no trae nada quizas xq no viene de un input type file
        // dd($image);
        // $path = $image->store('public/japanese');  //se guarda en la carpeta public
        // dd($path);
        // $path = str_replace('public/', '', $path);  //se cambia la ruta para que busque directamente en japanese
        // dd($path);
        $image = new Image;
        // $image->path = $path;  //esta es la forma original si se guardara la img en storage
        $image->path = $request->image;
        $image->imageable_type = "App\Food_Japanese";
        $image->imageable_id = $japanese->id;
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
    public function update(Request $request, $id)
    {
           // dd($id, $request->name);
        $japanese = Food_Japanese::find($id);
        $description = Description_Japanese::where('japanese_id', $japanese->id)->first();

        $japanese->name = $request->name;
        $japanese->price_bs = $request->price_bs;
        $japanese->price_us = $request->price_us;
        $japanese->type = $request->type;
        $japanese->save();

        $description->description = $request->description;
        $description->save();

        return response()->json([
            'japanese' => $japanese,
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
        $japanese = Food_Japanese::find($id);
        $description = Description_Japanese::where('japanese_id', $japanese->id)->first();

        $japanese->delete();
        $description->delete();

        return response()->json('Eliminado');
    }
}

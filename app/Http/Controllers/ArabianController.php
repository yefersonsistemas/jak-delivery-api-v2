<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\User;
use App\Food_Arabian;
use App\Description_Arabian;
use App\Image;

class ArabianController extends Controller
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

    public function arabian(Request $request){
        // dd($request);
        $user = User::find($request->id);
        // dd($user);
        $arabian = Food_Arabian::with('image')->where('providers_id', $user->id)->get(); 
        // dd( $arabian); 
        
        return response()->json($arabian);
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
        //dd($request);
        
        $provider = User::find($request->id);
        // dd( $provider);
        
        $arabian =  Food_Arabian::create([
            'name'         => $request->name,
            'price_bs'     => $request->price_bs,
            'price_us'     => $request->price_us,
            'type'         => $request->type,
            'providers_id' => $provider->id,
        ]);
        
        $description = Description_Arabian::create([
            'description' => $request->description,
            'providers_id' => $provider->id,
            'arabian_id' =>  $arabian->id,
        ]);
        
        // $image = $request->file('image');  //de esta manera no trae nada quizas xq no viene de un input type file
        // dd($image);
        // $path = $image->store('public/arabian');  //se guarda en la carpeta public
        // dd($path);
        // $path = str_replace('public/', '', $path);  //se cambia la ruta para que busque directamente en arabian
        // dd($path);
        $image = new Image;
        // $image->path = $path;  //esta es la forma original si se guardara la img en storage
        $image->path = $request->image;
        $image->imageable_type = "App\Food_Arabian";
        $image->imageable_id = $arabian->id;
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
        dd($id,$request);
        $arabian = Food_Arabian::find($id);
        $description = Description_Arabian::where('arabian_id', $arabian->id)->first();

        $arabian->name = $request->name;
        $arabian->price_bs = $request->price_bs;
        $arabian->price_us = $request->price_us;
        $arabian->type = $request->type;
        $arabian->save();

        // dd($arabian);
        $description->description = $request->description;
        $description->save();

        return response()->json([
            'arabian' => $arabian,
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
        $arabian = Food_Arabian::find($id);
        $description = Description_Arabian::where('arabian_id', $arabian->id)->first();

        $arabian->delete();
        $description->delete();

        return response()->json('Eliminado');
    }
}

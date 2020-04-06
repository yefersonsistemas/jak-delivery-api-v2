<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Food_Indian;
use App\User;
use App\Description_Indian;
use App\Image;

class IndianController extends Controller
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
    
    public function indian(Request $request){
        // dd($request);
        $user = User::find($request->id);
        // dd($user);
        $indian = Food_Indian::with('image')->where('providers_id', $user->id)->get(); //falta with('image')
        // dd( $indian); 
        
        return response()->json($indian);
    }

      public function photoIndian(Request $request)
    {
        // dd($request);
        
        $provider = User::find($request->id);
        // dd( $provider);
        
        $indian =  Food_Indian::create([
            'name'         => $request->name,
            'price_bs'     => $request->price_bs,
            'price_us'     => $request->price_us,
            'type'         => $request->type,
            'providers_id' => $provider->id,
        ]);
        
        $description = Description_Indian::create([
            'description' => $request->description,
            'providers_id' => $provider->id,
            'indian_id' =>  $indian->id,
        ]);
        
        // $image = $request->file('image');  //de esta manera no trae nada quizas xq no viene de un input type file
        // dd($image);
        // $path = $image->store('public/indian');  //se guarda en la carpeta public
        // dd($path);
        // $path = str_replace('public/', '', $path);  //se cambia la ruta para que busque directamente en indian
        // dd($path);
        $image = new Image;
        // $image->path = $path;  //esta es la forma original si se guardara la img en storage
        $image->path = $request->image;
        $image->imageable_type = "App\Food_Indian";
        $image->imageable_id = $indian->id;
        $image->save();

        return response()->json('Guardado con exito');
    }

    
    public function editIndian(Request $request, $id){
        // dd($id, $request->name);
        $indian = Food_Indian::find($id);
        $description = Description_Indian::where('indian_id', $indian->id)->first();

        $indian->name = $request->name;
        $indian->price_bs = $request->price_bs;
        $indian->price_us = $request->price_us;
        $indian->type = $request->type;
        $indian->save();

        $description->description = $request->description;
        $description->save();

        return response()->json([
            'indian' => $indian,
            'message' => 'Cambios guardados exitosamente.!']);
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
        //
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
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $indian = Food_Indian::find($id);
        $description = Description_Indian::where('indian_id', $indian->id)->first();

        $indian->delete();
        $description->delete();

        return response()->json('Eliminado');
    }
}

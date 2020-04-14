<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\User;
use App\Food_Italian;
use App\Description_Italian;
use App\Image;

class ItalianController extends Controller
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

    public function italian(Request $request){
        // dd($request);
        $user = User::find($request->id);
        // dd($user);
        $italian = Food_Italian::with('image')->where('providers_id', $user->id)->get(); //falta with('image')
        // dd( $italian); 
        
        return response()->json($italian);
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
        
        $italian =  Food_Italian::create([
            'name'         => $request->name,
            'price_bs'     => $request->price_bs,
            'price_us'     => $request->price_us,
            'type'         => $request->type,
            'providers_id' => $provider->id,
        ]);
        
        $description = Description_Italian::create([
            'description' => $request->description,
            'providers_id' => $provider->id,
            'italian_id' =>  $italian->id,
        ]);
        
        // $image = $request->file('image');  //de esta manera no trae nada quizas xq no viene de un input type file
        // dd($image);
        // $path = $image->store('public/italian');  //se guarda en la carpeta public
        // dd($path);
        // $path = str_replace('public/', '', $path);  //se cambia la ruta para que busque directamente en italian
        // dd($path);
        $image = new Image;
        // $image->path = $path;  //esta es la forma original si se guardara la img en storage
        $image->path = $request->image;
        $image->imageable_type = "App\Food_Italian";
        $image->imageable_id = $italian->id;
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
        $italian = Food_Italian::find($id);
        $description = Description_Italian::where('italian_id', $italian->id)->first();

        $italian->name = $request->name;
        $italian->price_bs = $request->price_bs;
        $italian->price_us = $request->price_us;
        $italian->type = $request->type;
        $italian->save();

        $description->description = $request->description;
        $description->save();

        return response()->json([
            'italian' => $italian,
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
        $Italian = Food_Italian::find($id);
        $description = Description_Italian::where('Italian_id', $Italian->id)->first();

        $Italian->delete();
        $description->delete();

        return response()->json('Eliminado');
    }
}

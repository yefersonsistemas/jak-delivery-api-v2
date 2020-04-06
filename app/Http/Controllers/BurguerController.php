<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Food_Burguer;
use App\User;
use App\Image;
use App\Description_Burguer;


class BurguerController extends Controller
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

    public function burguer(Request $request){
        // dd($request);
        $user = User::find($request->id);
        // dd($user);
        $burguer = Food_Burguer::with('image')->where('providers_id', $user->id)->get(); //falta with('image')
        // dd( $burguer); 
        
        return response()->json($burguer);
    }

    public function photoBurguer(Request $request)
    {
        // dd($request);
        
        $provider = User::find($request->id);
        // dd( $provider);
        
        $burguer =  Food_Burguer::create([
            'name'         => $request->name,
            'price_bs'     => $request->price_bs,
            'price_us'     => $request->price_us,
            'type'         => $request->type,
            'providers_id' => $provider->id,
        ]);
        
        $description = Description_Burguer::create([
            'description' => $request->description,
            'providers_id' => $provider->id,
            'burguer_id' =>  $burguer->id,
        ]);
        
        // $image = $request->file('image');  //de esta manera no trae nada quizas xq no viene de un input type file
        // dd($image);
        // $path = $image->store('public/burguer');  //se guarda en la carpeta public
        // dd($path);
        // $path = str_replace('public/', '', $path);  //se cambia la ruta para que busque directamente en burguer
        // dd($path);
        $image = new Image;
        // $image->path = $path;  //esta es la forma original si se guardara la img en storage
        $image->path = $request->image;
        $image->imageable_type = "App\Food_Burguer";
        $image->imageable_id = $burguer->id;
        $image->save();

        return response()->json('Guardado con exito');
    }

    public function editBurguer(Request $request, $id){
        // dd($id, $request->name);
        $burguer = Food_Burguer::find($id);
        $description = Description_Burguer::where('burguer_id', $burguer->id)->first();

        $burguer->name = $request->name;
        $burguer->price_bs = $request->price_bs;
        $burguer->price_us = $request->price_us;
        $burguer->type = $request->type;
        $burguer->save();

        $description->description = $request->description;
        $description->save();

        return response()->json([
            'burguer' => $burguer,
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
        //
    }
}
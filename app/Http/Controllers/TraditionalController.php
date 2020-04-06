<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use App\Food_Traditional;
use App\Description_Traditional;
use App\Image;

class TraditionalController extends Controller
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
    
    public function traditional(Request $request){
        // dd($request);
        $user = User::find($request->id);
        // dd($user);
        $traditional = Food_Traditional::with('image')->where('providers_id', $user->id)->get(); //falta with('image')
        // dd( $traditional); 
        
        return response()->json($traditional);
    }

      public function photoTraditional(Request $request)
    {
        // dd($request);
        
        $provider = User::find($request->id);
        // dd( $provider);
        
        $traditional =  Food_Traditional::create([
            'name'         => $request->name,
            'price_bs'     => $request->price_bs,
            'price_us'     => $request->price_us,
            'type'         => $request->type,
            'providers_id' => $provider->id,
        ]);
        
        $description = Description_Traditional::create([
            'description' => $request->description,
            'providers_id' => $provider->id,
            'traditional_id' =>  $traditional->id,
        ]);
        
        // $image = $request->file('image');  //de esta manera no trae nada quizas xq no viene de un input type file
        // dd($image);
        // $path = $image->store('public/traditional');  //se guarda en la carpeta public
        // dd($path);
        // $path = str_replace('public/', '', $path);  //se cambia la ruta para que busque directamente en traditional
        // dd($path);
        $image = new Image;
        // $image->path = $path;  //esta es la forma original si se guardara la img en storage
        $image->path = $request->image;
        $image->imageable_type = "App\Food_Traditional";
        $image->imageable_id = $traditional->id;
        $image->save();

        return response()->json('Guardado con exito');
    }

    
    public function editTraditional(Request $request, $id){
        // dd($id, $request->name);
        $traditional = Food_Traditional::find($id);
        $description = Description_Traditional::where('traditional_id', $traditional->id)->first();

        $traditional->name = $request->name;
        $traditional->price_bs = $request->price_bs;
        $traditional->price_us = $request->price_us;
        $traditional->type = $request->type;
        $traditional->save();

        $description->description = $request->description;
        $description->save();

        return response()->json([
            'traditional' => $traditional,
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

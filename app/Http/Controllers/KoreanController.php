<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use App\Food_Korean;
use App\Description_Korean;
use App\Image;

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

      public function photoKorean(Request $request)
    {
        // dd($request);
        
        $provider = User::find($request->id);
        // dd( $provider);
        
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
        
        // $image = $request->file('image');  //de esta manera no trae nada quizas xq no viene de un input type file
        // dd($image);
        // $path = $image->store('public/korean');  //se guarda en la carpeta public
        // dd($path);
        // $path = str_replace('public/', '', $path);  //se cambia la ruta para que busque directamente en korean
        // dd($path);
        $image = new Image;
        // $image->path = $path;  //esta es la forma original si se guardara la img en storage
        $image->path = $request->image;
        $image->imageable_type = "App\Food_Korean";
        $image->imageable_id = $korean->id;
        $image->save();

        return response()->json('Guardado con exito');
    }

    
    public function editKorean(Request $request, $id){
        // dd($id, $request->name);
        $korean = Food_Korean::find($id);
        $description = Description_Korean::where('korean_id', $korean->id)->first();

        $korean->name = $request->name;
        $korean->price_bs = $request->price_bs;
        $korean->price_us = $request->price_us;
        $korean->type = $request->type;
        $korean->save();

        $description->description = $request->description;
        $description->save();

        return response()->json([
            'korean' => $korean,
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
        $korean = Food_Korean::find($id);
        $description = Description_Korean::where('korean_id', $korean->id)->first();

        $korean->delete();
        $description->delete();

        return response()->json('Eliminado');
    }
}

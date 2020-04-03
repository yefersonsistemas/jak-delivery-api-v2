<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use App\Extra;
use App\Description_Extra;
use App\Image;

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

      public function photoextra(Request $request)
    {
        // dd($request);
        
        $provider = User::find($request->id);
        // dd( $provider);
        
        $extra =  Extra::create([
            'name'         => $request->name,
            'price_bs'     => $request->price_bs,
            'price_ud'     => $request->price_ud,
            'type_extra'   => $request->type_extra,
            'providers_id' => $provider->id,
        ]);
        
        $description = Description_Extra::create([
            'description' => $request->description,
            'providers_id' => $provider->id,
            'extras_id' =>  $extra->id,
        ]);
        
        // $image = $request->file('image');  //de esta manera no trae nada quizas xq no viene de un input type file
        // dd($image);
        // $path = $image->store('public/extra');  //se guarda en la carpeta public
        // dd($path);
        // $path = str_replace('public/', '', $path);  //se cambia la ruta para que busque directamente en extra
        // dd($path);
        $image = new Image;
        // $image->path = $path;  //esta es la forma original si se guardara la img en storage
        $image->path = $request->image;
        $image->imageable_type = "App\Extra";
        $image->imageable_id = $extra->id;
        $image->save();

        return response()->json('Guardado con exito');
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
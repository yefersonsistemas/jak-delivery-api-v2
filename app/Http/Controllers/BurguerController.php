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
        $burguer = Food_Burguer::where('providers_id', $user->id)->get(); //falta with('image')
        // dd( $burguer); 
        
        return response()->json($burguer);
    }

    public function photoBurguer(Request $request)
    {
        // dd($request);
        
        $provider = User::find($request->id);
        
        // $burguer =  Food_Burguer::create([
        //     'name'         => $request->name,
        //     'price_bs'     => $request->price_bs,
        //     'price_ud'     => $request->price_ud,
        //     'type'         => $request->type,
        //     'providers_id' => $provider->id,
        // ]);
        
        // $description = Description_Burguer::create([
        //     'description' => $request->description,
        //     'providers_id' => $provider->id,
        //     'burguer_id' =>  $burguer->id,
        // ]);
        
        // $image = $request->file('image');
        // $path = $image->store('public/burguer');  //se guarda en la carpeta public
        // $path = str_replace('public/', '', $path);  //se cambia la ruta para que busque directamente en especialidad
        $image = new Image;
        $image->path = $request->image;
        $image->imageable_type = "App\Food_Burguer";
        $image->imageable_id = $request->id;
        $image->branch_id = 1;
        $image->save();
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
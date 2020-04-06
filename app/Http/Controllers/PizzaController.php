<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use App\Food_Pizza;
use App\Description_Pizza;
use App\Image;

class PizzaController extends Controller
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

    public function pizza(Request $request){
        // dd($request);
        $user = User::find($request->id);
        // dd($user);
        $pizza = Food_Pizza::with('image')->where('providers_id', $user->id)->get(); //falta with('image')
        // dd( $pizza); 
        
        return response()->json($pizza);
    }

      public function photoPizza(Request $request)
    {
        // dd($request);
        
        $provider = User::find($request->id);
        // dd( $provider);
        
        $pizza =  Food_Pizza::create([
            'name'         => $request->name,
            'price_bs'     => $request->price_bs,
            'price_us'     => $request->price_us,
            'type'         => $request->type,
            'providers_id' => $provider->id,
        ]);
        
        $description = Description_Pizza::create([
            'description' => $request->description,
            'providers_id' => $provider->id,
            'pizza_id' =>  $pizza->id,
        ]);
        
        // $image = $request->file('image');  //de esta manera no trae nada quizas xq no viene de un input type file
        // dd($image);
        // $path = $image->store('public/pizza');  //se guarda en la carpeta public
        // dd($path);
        // $path = str_replace('public/', '', $path);  //se cambia la ruta para que busque directamente en pizza
        // dd($path);
        $image = new Image;
        // $image->path = $path;  //esta es la forma original si se guardara la img en storage
        $image->path = $request->image;
        $image->imageable_type = "App\Food_Pizza";
        $image->imageable_id = $pizza->id;
        $image->save();

        return response()->json('Guardado con exito');
    }

    
    public function editPizza(Request $request, $id){
        // dd($id, $request->name);
        $pizza = Food_Pizza::find($id);
        $description = Description_Pizza::where('pizza_id', $pizza->id)->first();

        $pizza->name = $request->name;
        $pizza->price_bs = $request->price_bs;
        $pizza->price_us = $request->price_us;
        $pizza->type = $request->type;
        $pizza->save();

        $description->description = $request->description;
        $description->save();

        return response()->json([
            'pizza' => $pizza,
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

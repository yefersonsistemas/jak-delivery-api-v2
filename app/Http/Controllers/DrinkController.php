<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use App\Drink;
use App\Description_Drink;
use App\Image;

class DrinkController extends Controller
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

    public function drink(Request $request){
        // dd($request);
        $user = User::find($request->id);
        // dd($user);
        $drink = Drink::with('image')->where('providers_id', $user->id)->get(); 
        // dd( $drink); 
        
        return response()->json($drink);
    }

      public function photodrink(Request $request)
    {
        // dd($request);
        
        $provider = User::find($request->id);
        // dd( $provider);
        
        $drink =  Drink::create([
            'name'         => $request->name,
            'price_bs'     => $request->price_bs,
            'price_us'     => $request->price_us,
            'type_drink'   => $request->type_drink,
            'providers_id' => $provider->id,
        ]);
        
        // dd($drink);
        $description = Description_Drink::create([
            'description' => $request->description,
            'providers_id' => $provider->id,
            'drinks_id' =>  $drink->id,
        ]);
        
        // $image = $request->file('image');  //de esta manera no trae nada quizas xq no viene de un input type file
        // dd($image);
        // $path = $image->store('public/drink');  //se guarda en la carpeta public
        // dd($path);
        // $path = str_replace('public/', '', $path);  //se cambia la ruta para que busque directamente en drink
        // dd($path);
        $image = new Image;
        // $image->path = $path;  //esta es la forma original si se guardara la img en storage
        $image->path = $request->image;
        $image->imageable_type = "App\Drink";
        $image->imageable_id = $drink->id;
        $image->save();

        return response()->json('Guardado con exito');
    }

    
    public function editDrink(Request $request, $id){
        // dd($id, $request->name);
        $drink = Drink::find($id);
        $description = Description_Drink::where('drink_id', $drink->id)->first();

        $drink->name = $request->name;
        $drink->price_bs = $request->price_bs;
        $drink->price_us = $request->price_us;
        $drink->type_drink = $request->type_drink;
        $drink->save();

        $description->description = $request->description;
        $description->save();

        return response()->json([            
            'drink' => $drink,
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

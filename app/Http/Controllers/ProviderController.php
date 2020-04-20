<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Provider;
use App\Food_Arabian;
use App\Food_Mexican;
use App\Food_Japanese;
use App\Food_Italian;
use App\Food_Indian;
use App\Food_Chicken;
use App\Food_Chinese;
use App\Food_Korean;
use App\Food_Traditional;
use App\Food_Pizza;
use App\Food_Salad;
use App\Food_Vegan;
use App\Food_Vegetarian;
use App\Drink;
use App\Extra;
use App\Food_Burguer;
use App\Fridge;
use App\Fruit_Store;
use App\Greengrocer;
use App\Liquor_Store;
use App\Lunch;
use App\Delicatesse;
use App\Victual;
use App\Bakery;

class ProviderController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $provider = Provider::with('person.user')->get();

        return response()->json($provider);
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

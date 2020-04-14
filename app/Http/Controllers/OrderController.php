<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Carbon\Carbon;
use App\Order;
use App\AssigmentOrder;
use Illuminate\Support\Facades\Auth;

class OrderController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $order = Order::whereDate('created_at', Carbon::now()->format('d-m-Y'))->get();

        return response()->json($order);
    }

    public function assigment($id){

        $user = Auth::id();  //trae el courier en sesion que se postula
        $courier = Courier::with('person')->where('id', $user)->first();  //compara el user y lo busca en la tabla courier
        $order = Order::find($id);  //busca el id de la orden que se asignara

        $postulado = AssigmentOrder::create([  //se crea el registro de la asignacion del pedido
             'courier_id' => $courier->id,
             'order_id' => $order,
        ]);

        $order->courier_id = $courier->id;  //se actualiza la orden y se guarda el courier que la entregara
        $order->save();

        return response()->json($order);

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
    public function store($id, $Usd)
    {
        $dolar = $Usd;
        $order = Order::with('burguer','arabian','italian', 'indian', 'mexican', 'korean', 'japanese', 'pizza', 'chicken', 
        'drink', 'extra', 'salad', 'vegan', 'vegetarian', 'traditional', 'chinese', 'liquor', 'fruit', 'greengrocer',
        'victual', 'delicatesse', 'bakery', 'fridge', 'lunch', 'typepayment')->where('id', $id)->first();

        $arabe = Food_Arabian::with('description')->get();
        $rapida = Food_Burguer::with('description')->get();
        $china = Food_Chinese::with('description')->get();
        $japonesa = Food_Japanese::with('description')->get();
        $corana = Food_Korean::with('description')->get();
        $italiana = Food_Italian::with('description')->get();
        $india = Food_Indian::with('description')->get();
        $pollo = Food_Chicken::with('description')->get();
        $pizza_c = Food_Pizza::with('description')->get();
        $mexicana = Food_Mexican::with('description')->get();
        $enslada = Food_Salad::with('description')->get();
        $vegetariana = Food_Vegetarian::with('description')->get();
        $vegano = Food_Vegan::with('description')->get();
        $tradicional = Food_Traditional::with('description')->get();
        $licor = Food_Liquor_Store::with('description')->get();
        $fruta = Food_Fruit_Store::with('description')->get();
        $vivere = Victual::with('description')->get();
        $verdura = Greengrocer::with('description')->get();
        $charcuteria = Delicatesse::with('description')->get();
        $panaderia = Bakery::with('description')->get();
        $desayuno = Lunch::with('description')->get();
        $bebida = Drink::with('description')->get();
        $extra_c = Extra::with('description')->get();
        $carne = Fridge::with('description')->get();
        $pago = Typepayment::get();

        //se decodifica el tipo comida solicitada
        $arabian = Food_Arabian::explode(',', $order->arabian_id);
        $chinese = Food_Chinese::explode(',', $order->chinese_id);
        $indian = Food_Indian::explode(',', $order->indian_id);
        $italian = Food_Italian::explode(',', $order->italian_id);
        $chicken = Food_Chicken::explode(',', $order->chicken_id);
        $pizza = Food_Pizza::explode(',', $order->pizza_id);
        $korean = Food_Korean::explode(',', $order->korean_id);
        $mexican = Food_Mexican::explode(',', $order->mexican_id);
        $japanese = Food_Japanese::explode(',', $order->japanese_id);
        $salad = Food_Salad::explode(',', $order->salad_id);
        $vegan = Food_Vegan::explode(',', $order->vegan_id);
        $vegetarian = Food_Vegetarian::explode(',', $order->vegetarian_id);
        $traditional = Food_Traditional::explode(',', $order->traditional_id);
        $burguer = Food_Burguer::explode(',', $order->burguer_id);
        $drink = Drink::explode(',', $order->drink_id);
        $extra = Extra::explode(',', $order->extra_id);
        $liquor = liquor_Store::explode(',', $order->liquor_id);
        $fruit = Fruit_Store::explode(',', $order->fruit_id);
        $greengrocer = Greengrocer::explode(',', $order->greengrocer_id);
        $victual = Victual::explode(',', $order->victual_id);
        $delicatesse = Delicatesse::explode(',', $order->delicatesse_id);
        $bakery = Bakery::explode(',', $order->bakery_id);
        $fridge = Fridge::explode(',', $order->fridge_id);
        $lunch = Lunch::explode(',', $order->lunch_id);
        $typepayment = Typepayment::explode(',', $order->typepayment_id);


        $total_bs=0;
        $total_us=0;
        
        if(!empty($arabian)){
            for ($i=0; $i < count($arabian) ; $i++) {          //buscando datos de cada comida
                $arabian[] = Food_Arabian::find($arabian[$i]);
                    $total += $Arabian[$i]->price_bs;
                    $total_us = $total * $dolar;
            }
        }else{
            $Arabian = null;
            $total_bs = null;
            $total_us = null;
        }

        if(!empty($burguer)){
            for ($i=0; $i < count($burguer) ; $i++) {         
                $burguer[] = Food_Burguer::find($burguer[$i]);
                    $total += $Burguer[$i]->price_bs;
                    $total_us = $total * $dolar;
            }
        }else{
            $Burguer = null;
            $total_bs = null;
            $total_us = null;
        }

        if(!empty($indian)){
            for ($i=0; $i < count($indian) ; $i++) {         
                $indian[] = Food_Indian::find($indian[$i]);
                    $total += $Indian[$i]->price_bs;
                    $total_us = $total * $dolar;
            }
        }else{
            $Indian = null;
            $total_bs = null;
            $total_us = null;
        }

        if(!empty($italian)){
            for ($i=0; $i < count($italian) ; $i++) {         
                $italian[] = Food_Italian::find($italian[$i]);
                    $total += $Italian[$i]->price_bs;
                    $total_us = $total * $dolar;
            }
        }else{
            $Italian = null;
            $total_bs = null;
            $total_us = null;
        }

        if(!empty($pizza)){
            for ($i=0; $i < count($pizza) ; $i++) {         
                $pizza[] = Food_Pizza::find($pizza[$i]);
                    $total += $Pizza[$i]->price_bs;
                    $total_us = $total * $dolar;
            }
        }else{
            $Pizza = null;
            $total_bs = null;
            $total_us = null;
        }

        if(!empty($chinese)){
            for ($i=0; $i < count($chinese) ; $i++) {         
                $chinese[] = Food_cChinese::find($chinese[$i]);
                    $total += $Chinese[$i]->price_bs;
                    $total_us = $total * $dolar;
            }
        }else{
            $Chinese = null;
            $total_bs = null;
            $total_us = null;
        }

        if(!empty($japanese)){
            for ($i=0; $i < count($japanese) ; $i++) {         
                $japanese[] = Food_Japanese::find($japanese[$i]);
                    $total += $Japanese[$i]->price_bs;
                    $total_us = $total * $dolar;
            }
        }else{
            $Japanese = null;
            $total_bs = null;
            $total_us = null;
        }

        if(!empty($mexican)){
            for ($i=0; $i < count($mexican) ; $i++) {         
                $mexican[] = Food_Mexican::find($mexican[$i]);
                    $total += $Mexican[$i]->price_bs;
                    $total_us = $total * $dolar;
            }
        }else{
            $Mexican = null;
            $total_bs = null;
            $total_us = null;
        }

        if(!empty($korean)){
            for ($i=0; $i < count($korean) ; $i++) {         
                $korean[] = Food_Korean::find($korean[$i]);
                    $total += $Korean[$i]->price_bs;
                    $total_us = $total * $dolar;
            }
        }else{
            $Korean = null;
            $total_bs = null;
            $total_us = null;
        }

        if(!empty($chicken)){
            for ($i=0; $i < count($chicken) ; $i++) {         
                $chicken[] = Food_Chicken::find($chicken[$i]);
                    $total += $Chicken[$i]->price_bs;
                    $total_us = $total * $dolar;
            }
        }else{
            $Chicken = null;
            $total_bs = null;
            $total_us = null;
        }

        if(!empty($salad)){
            for ($i=0; $i < count($salad) ; $i++) {         
                $salad[] = Food_Salad::find($salad[$i]);
                    $total += $Salad[$i]->price_bs;
                    $total_us = $total * $dolar;
            }
        }else{
            $Salad = null;
            $total_bs = null;
            $total_us = null;
        }

        if(!empty($vegan)){
            for ($i=0; $i < count($vegan) ; $i++) {         
                $vegan[] = Food_Vegan::find($vegan[$i]);
                    $total += $Vegan[$i]->price_bs;
                    $total_us = $total * $dolar;
            }
        }else{
            $Vegan = null;
            $total_bs = null;
            $total_us = null;
        }

        if(!empty($vegetarian)){
            for ($i=0; $i < count($vegetarian) ; $i++) {         
                $vegetarian[] = Food_Vegetarian::find($vegetarian[$i]);
                    $total += $Vegetarian[$i]->price_bs;
                    $total_us = $total * $dolar;
            }
        }else{
            $Vegetarian = null;
            $total_bs = null;
            $total_us = null;
        }

        if(!empty($traditional)){
            for ($i=0; $i < count($traditional) ; $i++) {         
                $traditional[] = Food_traditional::find($traditional[$i]);
                    $total += $Traditional[$i]->price_bs;
                    $total_us = $total * $dolar;
            }
        }else{
            $Traditional = null;
            $total_bs = null;
            $total_us = null;
        }

        if(!empty($extra)){
            for ($i=0; $i < count($extra) ; $i++) {         
                $extra[] = Extra::find($extra[$i]);
                    $total += $Extra[$i]->price_bs;
                    $total_us = $total * $dolar;
            }
        }else{
            $Extra = null;
            $total_bs = null;
            $total_us = null;
        }

        if(!empty($drink)){
            for ($i=0; $i < count($drink) ; $i++) {         
                $drink[] = Drink::find($drink[$i]);
                    $total += $Drink[$i]->price_bs;
                    $total_us = $total * $dolar;
            }
        }else{
            $Drink = null;
            $total_bs = null;
            $total_us = null;
        }

        if(!empty($liquor)){
            for ($i=0; $i < count($liquor) ; $i++) {         
                $liquor[] = liquor_store::find($liquor[$i]);
                    $total += $Liquor[$i]->price_bs;
                    $total_us = $total * $dolar;
            }
        }else{
            $Liquor = null;
            $total_bs = null;
            $total_us = null;
        }

        if(!empty($fruit)){
            for ($i=0; $i < count($fruit) ; $i++) {         
                $fruit[] = Fruit_Store::find($fruit[$i]);
                    $total += $Fruit[$i]->price_bs;
                    $total_us = $total * $dolar;
            }
        }else{
            $Fruit = null;
            $total_bs = null;
            $total_us = null;
        }

        if(!empty($victual)){
            for ($i=0; $i < count($victual) ; $i++) {         
                $victual[] = Victual::find($victual[$i]);
                    $total += $Victual[$i]->price_bs;
                    $total_us = $total * $dolar;
            }
        }else{
            $Victual = null;
            $total_bs = null;
            $total_us = null;
        }

        if(!empty($delicatesse)){
            for ($i=0; $i < count($delicatesse) ; $i++) {         
                $delicatesse[] = Delicatesse::find($delicatesse[$i]);
                    $total += $Delicatesse[$i]->price_bs;
                    $total_us = $total * $dolar;
            }
        }else{
            $Delicatesse = null;
            $total_bs = null;
            $total_us = null;
        }

        if(!empty($bakery)){
            for ($i=0; $i < count($bakery) ; $i++) {         
                $bakery[] = Bakery::find($bakery[$i]);
                    $total += $Bakery[$i]->price_bs;
                    $total_us = $total * $dolar;
            }
        }else{
            $Bakery = null;
            $total_bs = null;
            $total_us = null;
        }

        if(!empty($lunch)){
            for ($i=0; $i < count($lunch) ; $i++) {         
                $lunch[] = Lunch::find($lunch[$i]);
                    $total += $Lunch[$i]->price_bs;
                    $total_us = $total * $dolar;
            }
        }else{
            $Lunch = null;
            $total_bs = null;
            $total_us = null;
        }

        if(!empty($greengrocer)){
            for ($i=0; $i < count($greengrocer) ; $i++) {         
                $greengrocer[] = Greengrocer::find($greengrocer[$i]);
                    $total += $Greengrocer[$i]->price_bs;
                    $total_us = $total * $dolar;
            }
        }else{
            $Greengrocer = null;
            $total_bs = null;
            $total_us = null;
        }

        if(!empty($fridge)){
            for ($i=0; $i < count($fridge) ; $i++) {         
                $fridge[] = fridge::find($fridge[$i]);
                    $total += $Fridge[$i]->price_bs;
                    $total_us = $total * $dolar;
            }
        }else{
            $Fridge = null;
            $total_bs = null;
            $total_us = null;
        }
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

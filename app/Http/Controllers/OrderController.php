<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Carbon\Carbon;
use App\Order;
use App\AssigmentOrder;
use Illuminate\Support\Facades\Auth;
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
use App\Typepayment;

class OrderController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // $order = Order::whereDate('created_at', Carbon::now()->format('d-m-Y'))->get();
        $order = Order::get();
        // dd($order);

        return response()->json($order);
    }

    public function assigment(Request $request){

        // dd($request);
        $user = Auth::id();  //trae el courier en sesion que se postula
        $courier = Courier::with('person')->where('id', $user)->first();  //compara el user y lo busca en la tabla courier
        $order = Order::find($request->id);  //busca el id de la orden que se asignara

        $postulado = AssigmentOrder::create([  //se crea el registro de la asignacion del pedido
             'courier_id' => $courier->id,
             'order_id' => $order,
        ]);

        $order->courier_id = $courier->id;  //se actualiza la orden y se guarda el courier que la entregara
        $order->status = 'Por entregar';
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


    public function createOrder(Request $request)
    {
        // dd($request);

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
        $licor = Liquor_Store::with('description')->get();
        $fruta = Fruit_Store::with('description')->get();
        $vivere = Victual::with('description')->get();
        $verdura = Greengrocer::with('description')->get();
        $charcuteria = Delicatesse::with('description')->get();
        $panaderia = Bakery::with('description')->get();
        $desayuno = Lunch::with('description')->get();
        $bebida = Drink::with('description')->get();
        $extra_c = Extra::with('description')->get();
        $carne = Fridge::with('description')->get();
        $pago = Typepayment::get();

        $order = Order::create([
        'clients_id' => $request->clients_id, 
        'couriers_id' => $request->couriers_id, 
        'status' => 'Pendiente', 
        'providers_id' => $request->providers_id, 
        'food_arabian_id' => $request->food_arabian_id, 
        'food_chinese_id' => $request->food_chinese_id, 
        'food_burguer_id' => $request->food_burguer_id, 
        'food_pizza_id' => $request->food_pizza_id, 
        'food_chicken_id' => $request->food_chicken_id,
        'food_korean_id' => $request->food_korean_id, 
        'food_indian_id' => $request->food_indian_id, 
        'food_italian_id' => $request->food_italian_id, 
        'food_salads_id' => $request->food_salads_id, 
        'food_vegetarian_id' => $request->food_vegetarian_id, 
        'food_vegans_id' => $request->food_vegans_id, 
        'food_traditional_id' => $request->food_traditional_id, 
        'food_japanese_id' => $request->food_japanese_id,
        'food_mexican_id' => $request->food_mexican_id, 
        'extras_id' => $request->typepayment_id, 
        'drinks_id' => $request->drinks_id, 
        'bakeries_id' => $request->bakeries_id, 
        'liquor_store_id' => $request->liquor_store_id, 
        'victuals_id' => $request->victuals_id, 
        'delicatesse_id' => $request->delicatesse_id, 
        'fruit_store_id' => $request->fruit_store_id, 
        'greengrocer_id' => $request->greengrocer_id,
        'fridge_id' => $request->fridge_id, 
        'lunch_id' => $request->lunch_id, 
        'typepayment_id' => $request->typepayment_id,
        ]);

        // dd($order);

        return response()->json($order);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)//$usd variable q trae el monto del dolar al dia y pasar com parametro en el metodo
    {
        // dd($request);
        $dolar = 100000;
        $order = Order::with('burguer','arabian','italian', 'indian', 'mexican', 'korean', 'japanese', 'pizza', 'chicken', 
        'drink', 'extra', 'salad', 'vegan', 'vegetarian', 'traditional', 'chinese', 'liquor', 'fruit', 'greengrocer',
        'victual', 'delicatesse', 'bakery', 'fridge', 'lunch', 'typepayment')->where('id', $request->id)->first();

        // dd($order);

        // dd(count(explode(',', $order->food_burguer_id)));

        //se decodifica el tipo comida solicitada

        $typepayment = explode(',', $order->typepayment_id);

        $total_bs=0;
        $total_us=0;

        foreach ($order as $pedido) {
            if ($pedido->food_arabian_id != null) {
                $orden_id[] = explode(',', $pedido->food_arabian_id); //decodificando los procedimientos en $encontrado
                if ($orden_id != null) {
                    for ($i=0; $i < count($orden_id); $i++) {
                        $arabian[] = Food_Arabian::find($orden_id[$i]);
                        $total += $arabian[$i]->price_bs;
                        $total_us = $total * $dolar;
                    }
                }
            }else{
                $arabian = null;
                $total_bs = null;
                $total_us = null;
            }
        }

        foreach ($order as $pedido) {
            if ($pedido->food_burguer_id != null) {
                $orden_id[] = explode(',', $pedido->food_burguer_id); 
                if ($orden_id != null) {
                    for ($i=0; $i < count($orden_id); $i++) {
                        $burguer[] = Food_Burguer::find($orden_id[$i]);
                        $total += $burguer[$i]->price_bs;
                        $total_us = $total * $dolar;
                    }
                }
            }else{
                $burguer = null;
                $total_bs = null;
                $total_us = null;
            }
        }

         foreach ($order as $pedido) {
            if ($pedido->food_chicken_id != null) {
                $orden_id[] = explode(',', $pedido->food_chicken_id); 
                if ($orden_id != null) {
                    for ($i=0; $i < count($orden_id); $i++) {
                        $chicken[] = Food_Chicken::find($orden_id[$i]);
                        $total += $chicken[$i]->price_bs;
                        $total_us = $total * $dolar;
                    }
                }
            }else{
                $chicken = null;
                $total_bs = null;
                $total_us = null;
            }
        }

         foreach ($order as $pedido) {
            if ($pedido->food_chinese_id != null) {
                $orden_id[] = explode(',', $pedido->food_chinese_id); 
                if ($orden_id != null) {
                    for ($i=0; $i < count($orden_id); $i++) {
                        $chinese[] = Food_Chinese::find($orden_id[$i]);
                        $total += $chinese[$i]->price_bs;
                        $total_us = $total * $dolar;
                    }
                }
            }else{
                $chinese = null;
                $total_bs = null;
                $total_us = null;
            }
        }

         foreach ($order as $pedido) {
            if ($pedido->food_indian_id != null) {
                $orden_id[] = explode(',', $pedido->food_indian_id); 
                if ($orden_id != null) {
                    for ($i=0; $i < count($orden_id); $i++) {
                        $indian[] = Food_Indian::find($orden_id[$i]);
                        $total += $indian[$i]->price_bs;
                        $total_us = $total * $dolar;
                    }
                }
            }else{
                $indian = null;
                $total_bs = null;
                $total_us = null;
            }
        }

         foreach ($order as $pedido) {
            if ($pedido->food_italian_id != null) {
                $orden_id[] = explode(',', $pedido->food_italian_id); 
                if ($orden_id != null) {
                    for ($i=0; $i < count($orden_id); $i++) {
                        $italian[] = Food_Italian::find($orden_id[$i]);
                        $total += $italian[$i]->price_bs;
                        $total_us = $total * $dolar;
                    }
                }
            }else{
                $italian = null;
                $total_bs = null;
                $total_us = null;
            }
        }

         foreach ($order as $pedido) {
            if ($pedido->food_japanese_id != null) {
                $orden_id[] = explode(',', $pedido->food_japanese_id); 
                if ($orden_id != null) {
                    for ($i=0; $i < count($orden_id); $i++) {
                        $japanese[] = Food_Japanese::find($orden_id[$i]);
                        $total += $japanese[$i]->price_bs;
                        $total_us = $total * $dolar;
                    }
                }
            }else{
                $japanese = null;
                $total_bs = null;
                $total_us = null;
            }
        }

         foreach ($order as $pedido) {
            if ($pedido->food_mexican_id != null) {
                $orden_id[] = explode(',', $pedido->food_mexican_id); 
                if ($orden_id != null) {
                    for ($i=0; $i < count($orden_id); $i++) {
                        $mexican[] = Food_Mexican::find($orden_id[$i]);
                        $total += $mexican[$i]->price_bs;
                        $total_us = $total * $dolar;
                    }
                }
            }else{
                $mexican = null;
                $total_bs = null;
                $total_us = null;
            }
        }

         foreach ($order as $pedido) {
            if ($pedido->food_korean_id != null) {
                $orden_id[] = explode(',', $pedido->food_korean_id); 
                if ($orden_id != null) {
                    for ($i=0; $i < count($orden_id); $i++) {
                        $korean[] = Food_Korean::find($orden_id[$i]);
                        $total += $korean[$i]->price_bs;
                        $total_us = $total * $dolar;
                    }
                }
            }else{
                $korean = null;
                $total_bs = null;
                $total_us = null;
            }
        }

         foreach ($order as $pedido) {
            if ($pedido->food_pizza_id != null) {
                $orden_id[] = explode(',', $pedido->food_pizza_id); 
                if ($orden_id != null) {
                    for ($i=0; $i < count($orden_id); $i++) {
                        $pizza[] = Food_Pizza::find($orden_id[$i]);
                        $total += $pizza[$i]->price_bs;
                        $total_us = $total * $dolar;
                    }
                }
            }else{
                $pizza = null;
                $total_bs = null;
                $total_us = null;
            }
        }

         foreach ($order as $pedido) {
            if ($pedido->food_salad_id != null) {
                $orden_id[] = explode(',', $pedido->food_salad_id); 
                if ($orden_id != null) {
                    for ($i=0; $i < count($orden_id); $i++) {
                        $salad[] = Food_Salad::find($orden_id[$i]);
                        $total += $salad[$i]->price_bs;
                        $total_us = $total * $dolar;
                    }
                }
            }else{
                $salad = null;
                $total_bs = null;
                $total_us = null;
            }
        }

         foreach ($order as $pedido) {
            if ($pedido->food_traditional_id != null) {
                $orden_id[] = explode(',', $pedido->food_traditional_id); 
                if ($orden_id != null) {
                    for ($i=0; $i < count($orden_id); $i++) {
                        $traditional[] = Food_Traditional::find($orden_id[$i]);
                        $total += $traditional[$i]->price_bs;
                        $total_us = $total * $dolar;
                    }
                }
            }else{
                $traditional = null;
                $total_bs = null;
                $total_us = null;
            }
        }

         foreach ($order as $pedido) {
            if ($pedido->food_vegan_id != null) {
                $orden_id[] = explode(',', $pedido->food_vegan_id); 
                if ($orden_id != null) {
                    for ($i=0; $i < count($orden_id); $i++) {
                        $vegan[] = Food_Vegan::find($orden_id[$i]);
                        $total += $vegan[$i]->price_bs;
                        $total_us = $total * $dolar;
                    }
                }
            }else{
                $vegan = null;
                $total_bs = null;
                $total_us = null;
            }
        }

         foreach ($order as $pedido) {
            if ($pedido->food_vegetarian_id != null) {
                $orden_id[] = explode(',', $pedido->food_vegetarian_id); 
                if ($orden_id != null) {
                    for ($i=0; $i < count($orden_id); $i++) {
                        $vegetarian[] = Food_Vegetarian::find($orden_id[$i]);
                        $total += $vegetarian[$i]->price_bs;
                        $total_us = $total * $dolar;
                    }
                }
            }else{
                $vegetarian = null;
                $total_bs = null;
                $total_us = null;
            }
        }

         foreach ($order as $pedido) {
            if ($pedido->delicatesse_id != null) {
                $orden_id[] = explode(',', $pedido->delicatesse_id); 
                if ($orden_id != null) {
                    for ($i=0; $i < count($orden_id); $i++) {
                        $delicatesse[] = Delicatesse::find($orden_id[$i]);
                        $total += $delicatesse[$i]->price_bs;
                        $total_us = $total * $dolar;
                    }
                }
            }else{
                $delicatesse = null;
                $total_bs = null;
                $total_us = null;
            }
        }

         foreach ($order as $pedido) {
            if ($pedido->bakeries_id != null) {
                $orden_id[] = explode(',', $pedido->bakeries_id); 
                if ($orden_id != null) {
                    for ($i=0; $i < count($orden_id); $i++) {
                        $bakery[] = Bakery::find($orden_id[$i]);
                        $total += $bakery[$i]->price_bs;
                        $total_us = $total * $dolar;
                    }
                }
            }else{
                $bakery = null;
                $total_bs = null;
                $total_us = null;
            }
        }

         foreach ($order as $pedido) {
            if ($pedido->fridge_id != null) {
                $orden_id[] = explode(',', $pedido->fridge_id); 
                if ($orden_id != null) {
                    for ($i=0; $i < count($orden_id); $i++) {
                        $fridge[] = Fridge::find($orden_id[$i]);
                        $total += $fridge[$i]->price_bs;
                        $total_us = $total * $dolar;
                    }
                }
            }else{
                $fridge = null;
                $total_bs = null;
                $total_us = null;
            }
        }

         foreach ($order as $pedido) {
            if ($pedido->fruit_store_id != null) {
                $orden_id[] = explode(',', $pedido->fruit_store_id); 
                if ($orden_id != null) {
                    for ($i=0; $i < count($orden_id); $i++) {
                        $fruit[] = Fruit_Store::find($orden_id[$i]);
                        $total += $fruit[$i]->price_bs;
                        $total_us = $total * $dolar;
                    }
                }
            }else{
                $fruit = null;
                $total_bs = null;
                $total_us = null;
            }
        }

         foreach ($order as $pedido) {
            if ($pedido->liquor_store_id != null) {
                $orden_id[] = explode(',', $pedido->liquor_store_id); 
                if ($orden_id != null) {
                    for ($i=0; $i < count($orden_id); $i++) {
                        $liquor[] = Liquor_Store::find($orden_id[$i]);
                        $total += $liquor[$i]->price_bs;
                        $total_us = $total * $dolar;
                    }
                }
            }else{
                $liquor = null;
                $total_bs = null;
                $total_us = null;
            }
        }

         foreach ($order as $pedido) {
            if ($pedido->greengrocer_id != null) {
                $orden_id[] = explode(',', $pedido->greengrocer_id); 
                if ($orden_id != null) {
                    for ($i=0; $i < count($orden_id); $i++) {
                        $greengrocer[] = Greengrocer::find($orden_id[$i]);
                        $total += $greengrocer[$i]->price_bs;
                        $total_us = $total * $dolar;
                    }
                }
            }else{
                $greengrocer = null;
                $total_bs = null;
                $total_us = null;
            }
        }

         foreach ($order as $pedido) {
            if ($pedido->lunch_id != null) {
                $orden_id[] = explode(',', $pedido->lunch_id); 
                if ($orden_id != null) {
                    for ($i=0; $i < count($orden_id); $i++) {
                        $lunch[] = Lunch::find($orden_id[$i]);
                        $total += $lunch[$i]->price_bs;
                        $total_us = $total * $dolar;
                    }
                }
            }else{
                $lunch = null;
                $total_bs = null;
                $total_us = null;
            }
        }

         foreach ($order as $pedido) {
            if ($pedido->victuals_id != null) {
                $orden_id[] = explode(',', $pedido->victuals_id); 
                if ($orden_id != null) {
                    for ($i=0; $i < count($orden_id); $i++) {
                        $victual[] = Victual::find($orden_id[$i]);
                        $total += $victual[$i]->price_bs;
                        $total_us = $total * $dolar;
                    }
                }
            }else{
                $victual = null;
                $total_bs = null;
                $total_us = null;
            }
        }

         foreach ($order as $pedido) {
            if ($pedido->drinks_id != null) {
                $orden_id[] = explode(',', $pedido->drinks_id); 
                if ($orden_id != null) {
                    for ($i=0; $i < count($orden_id); $i++) {
                        $drink[] = Drink::find($orden_id[$i]);
                        $total += $drink[$i]->price_bs;
                        $total_us = $total * $dolar;
                    }
                }
            }else{
                $drink = null;
                $total_bs = null;
                $total_us = null;
            }
        }

         foreach ($order as $pedido) {
            if ($pedido->extras_id != null) {
                $orden_id[] = explode(',', $pedido->extras_id); 
                if ($orden_id != null) {
                    for ($i=0; $i < count($orden_id); $i++) {
                        $extra[] = Extra::find($orden_id[$i]);
                        $total += $extra[$i]->price_bs;
                        $total_us = $total * $dolar;
                    }
                }
            }else{
                $extra = null;
                $total_bs = null;
                $total_us = null;
            }
        }

        foreach ($order as $pedido) {
            if ($pedido->typepayment_id != null) {
                $orden_id[] = explode(',', $pedido->typepayment_id); 
                if ($orden_id != null) {
                    for ($i=0; $i < count($orden_id); $i++) {
                        $typepayment[] = Typepayment::find($orden_id[$i]);
                    }
                }
            }else{
                $typepayment = null;
            }
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

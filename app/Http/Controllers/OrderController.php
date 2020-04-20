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
use App\Client;
use App\Provider;

class OrderController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $order = Order::whereDate('created_at', Carbon::now()->format('Y-m-d'))->get();
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

        $order = Order::create([
        'clients_id' => $request->clients_id, 
        'couriers_id' => $request->couriers_id, 
        'providers_id' => $request->providers_id, 
        'status' => 'Pendiente', 
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
        'extras_id' => $request->extras_id, 
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

     public function food(Request $request){
        // dd($request);
        $provider = Provider::with('person.user')->find($request->id);
        // dd($provider);
       
      
        $arabian = Food_Arabian::with('description')->where('providers_id', $provider->id)->get();
        $burguer = Food_Burguer::with('description')->where('providers_id', $provider->id)->get();
        $chinese = Food_Chinese::with('description')->where('providers_id', $provider->id)->get();
        $chicken = Food_Chicken::with('description')->where('providers_id', $provider->id)->get();
        $indian = Food_Indian::with('description')->where('providers_id', $provider->id)->get();
        $italian = Food_Italian::with('description')->where('providers_id', $provider->id)->get();
        $korean = Food_Korean::with('description')->where('providers_id', $provider->id)->get();
        $japanese = Food_Japanese::with('description')->where('providers_id', $provider->id)->get();
        $pizza = Food_Pizza::with('description')->where('providers_id', $provider->id)->get();
        $mexican = Food_Mexican::with('description')->where('providers_id', $provider->id)->get();
        $salad = Food_Salad::with('description')->where('providers_id', $provider->id)->get();
        $vegetarian = Food_Vegetarian::with('description')->where('providers_id', $provider->id)->get();
        $vegan = Food_Vegan::with('description')->where('providers_id', $provider->id)->get();
        $traditional = Food_Traditional::with('description')->where('providers_id', $provider->id)->get();
        $liquor = Liquor_Store::with('description')->where('providers_id', $provider->id)->get();
        $fruit = Fruit_Store::with('description')->where('providers_id', $provider->id)->get();
        $victual = Victual::with('description')->where('providers_id', $provider->id)->get();
        $greengrocer = Greengrocer::with('description')->where('providers_id', $provider->id)->get();
        $delicatesse = Delicatesse::with('description')->where('providers_id', $provider->id)->get();
        $bakery = Bakery::with('description')->where('providers_id', $provider->id)->get();
        $lunch = Lunch::with('description')->where('providers_id', $provider->id)->get();
        $drink = Drink::with('description')->where('providers_id', $provider->id)->get();
        $extra = Extra::with('description')->where('providers_id', $provider->id)->get();  
        $fridge = Fridge::with('description')->where('providers_id', $provider->id)->get();
       

        $all =  [
            'chinese'=>$chinese, 
            'extra'=>$extra, 
            'salad'=>$salad, 
            'vegetarian'=>$vegetarian, 
            'vegan'=>$vegan, 
            'tradicional'=>$traditional, 
            'chicken'=>$chicken, 
            'drink'=>$drink, 
            'delicatesse'=>$delicatesse, 
            'indian'=>$indian, 
            'italian'=>$italian, 
            'burguer'=>$burguer,
            'mexican'=>$mexican, 
            'japanes'=>$japanese, 
            'arabian'=>$arabian, 
            'korean'=>$korean, 
            'victual'=>$victual, 
            'frige'=>$fridge, 
            'fruit'=>$fruit, 
            'lunch'=>$lunch, 
            'liquor'=>$liquor, 
            'greengrocer'=>$greengrocer, 
            'bakery'=>$bakery, 
            'pizza'=>$pizza];


        return response()->json($all);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // dd($request);
        $order = Order::with('burguer','arabian','italian', 'indian', 'mexican', 'korean', 'japanese', 'pizza', 'chicken', 
        'drink', 'extra', 'salad', 'vegan', 'vegetarian', 'traditional', 'chinese', 'liquor', 'fruit', 'greengrocer',
        'victual', 'delicatesse', 'bakery', 'fridge', 'lunch', 'typepayment')->where('id', $request->id)->first();
        // dd($order);

        //se decodifica el tipo de comida solicitada
        
        $total_a = 0; 
        $dolar_a = 0;
        if ($order->food_arabian_id != null) {
                $orden_id = explode(',', $order->food_arabian_id); 
                if ($orden_id != null) {
                    for ($i=0; $i < count($orden_id); $i++) {
                        $arabian[] = Food_Arabian::find($orden_id[$i]);
                        $total_a += $arabian[$i]->price_bs;
                        $dolar_a += $arabian[$i]->price_us;
                        $name_a[] = $arabian[$i]->name;
                    }
                }
        }else{
            $arabian = null;
            $total_a = 0;
            $dolar_a = 0;
            $name_a = null;
        }

        $total_b = 0;
        $dolar_b = 0;
        if ($order->food_burguer_id != null) {
                $orden_id = explode(',', $order->food_burguer_id); 
                if ($orden_id != null) {
                    for ($i=0; $i < count($orden_id); $i++) {
                        $burguer[] = Food_Burguer::find($orden_id[$i]);
                        $total_b += $burguer[$i]->price_bs;
                        $dolar_b += $burguer[$i]->price_us;
                        $name_b[] = $burguer[$i]->name;
                    }
                }
        }else{
            $burguer = null;
            $total_b = 0;
            $dolar_b = 0;
            $name_b = null;
        }

        $total_chik;
        $dolar_chik = 0;
        if ($order->food_chicken_id != null) {
            $orden_id = explode(',', $order->food_chicken_id); 
            if ($orden_id != null) {
                for ($i=0; $i < count($orden_id); $i++) {
                    $chicken[] = Food_Chicken::find($orden_id[$i]);
                    $total_chik += $chicken[$i]->price_bs;
                    $dolar_chik += $chicken[$i]->price_us;
                    $name_chik[] = $chicken[$i]->name;
                }
            }
        }else{
            $chicken = null;
            $total_chik = 0;
            $dolar_chik = 0;
            $name_chik = null;
        }

        $total_chin = 0;
        $dolar_chin = 0;
        if ($order->food_chinese_id != null) {
            $orden_id = explode(',', $order->food_chinese_id); 
            if ($orden_id != null) {
                for ($i=0; $i < count($orden_id); $i++) {
                    $chinese[] = Food_Chinese::find($orden_id[$i]);
                    $total_chin += $chinese[$i]->price_bs;
                    $dolar_chin += $chinese[$i]->price_us;
                    $name_chin[] =$chinese[$i]->name;
                }
            }
        }else{
            $chinese = null;
            $total_chin = 0;
            $dolar_chin = 0;
            $name_chin = null;
        }

        $total_in = 0;
        $dolar_in = 0;
        if ($order->food_indian_id != null) {
                $orden_id = explode(',', $order->food_indian_id); 
                if ($orden_id != null) {
                    for ($i=0; $i < count($orden_id); $i++) {
                        $indian[] = Food_Indian::find($orden_id[$i]);
                        $total_in += $indian[$i]->price_bs;
                        $dolar_in += $indian[$i]->price_us;
                        $name_in[] = $indian[$i]->name;
                    }
                }
        }else{
            $indian = null;
            $total_in = 0;
            $dolar_in = 0;
            $name_in = null;
        }

        $total_i = 0;
        $dolar_i = 0;
        if ($order->food_italian_id != null) {
                $orden_id = explode(',', $order->food_italian_id); 
                if ($orden_id != null) {
                    for ($i=0; $i < count($orden_id); $i++) {
                        $italian[] = Food_Italian::find($orden_id[$i]);
                        $total_i += $italian[$i]->price_bs;
                        $dolar_i += $italian[$i]->price_us;
                        $name_i[] = $italian[$i]->name;
                    }
                }
        }else{
            $italian = null;
            $total_i = 0;
            $dolar_i = 0;
            $name_i = null;
        }

        $total_j = 0;
        $dolar_j = 0;
        if ($order->food_japanese_id != null) {
                $orden_id = explode(',', $order->food_japanese_id); 
                if ($orden_id != null) {
                    for ($i=0; $i < count($orden_id); $i++) {
                        $japanese[] = Food_Japanese::find($orden_id[$i]);
                        $total_j += $japanese[$i]->price_bs;
                        $dolar_j += $japanese[$i]->price_us;
                        $name_j[] = $japanese[$i]->name;
                    }
                }
        }else{
            $japanese = null;
            $total_j = 0;
            $dolar_j = 0;
            $name_j = null;
        }

        $total_m = 0;
        $dolar_m = 0;
        if ($order->food_mexican_id != null) {
                $orden_id = explode(',', $order->food_mexican_id); 
                if ($orden_id != null) {
                    for ($i=0; $i < count($orden_id); $i++) {
                        $mexican[] = Food_Mexican::find($orden_id[$i]);
                        $total_m += $mexican[$i]->price_bs;
                        $dolar_m += $mexican[$i]->price_us;
                        $name_m[] = $mexican[$i]->name;
                    }
                }
        }else{
            $mexican = null;
            $total_m = 0;
            $dolar_m = 0;
            $name_m = null;
        }

        $total_k =0;
        $dolar_k = 0;
        if ($order->food_korean_id != null) {
                $orden_id = explode(',', $order->food_korean_id); 
                if ($orden_id != null) {
                    for ($i=0; $i < count($orden_id); $i++) {
                        $korean[] = Food_Korean::find($orden_id[$i]);
                        $total_k += $korean[$i]->price_bs;
                        $dolar_k += $korean[$i]->price_us;
                        $name_k[] = $korean[$i]->name;
                    }
                }
        }else{
            $korean = null;
            $total_k = 0;
            $dolar_k = 0;
            $name_k = null;
        }

        $total_p = 0;
        $dolar_p = 0;
        if ($order->food_pizza_id != null) {
                $orden_id = explode(',', $order->food_pizza_id); 
                if ($orden_id != null) {
                    for ($i=0; $i < count($orden_id); $i++) {
                        $pizza[] = Food_Pizza::find($orden_id[$i]);
                        $total_p += $pizza[$i]->price_bs;
                        $dolar_p += $pizza[$i]->price_us;
                        $name_p[] = $pizza[$i]->name;
                    }
                }
        }else{
            $pizza = null;
            $total_p = 0;
            $dolar_p = 0;
            $name_p = null;
        }

        $total_s = 0;
        $dolar_s = 0;
        if ($order->food_salad_id != null) {
                $orden_id = explode(',', $order->food_salad_id); 
                if ($orden_id != null) {
                    for ($i=0; $i < count($orden_id); $i++) {
                        $salad[] = Food_Salad::find($orden_id[$i]);
                        $total_s += $salad[$i]->price_bs;
                        $dolar_s += $salad[$i]->price_us;
                        $name_s[] = $salad[$i]->name;
                    }
                }
        }else{
            $salad = null;
            $total_s = 0;
            $dolar_s = 0;
            $name_s = null;
        }

        $total_t = 0;
        $dolar_t = 0;
        if ($order->food_traditional_id != null) {
                $orden_id = explode(',', $order->food_traditional_id); 
                if ($orden_id != null) {
                    for ($i=0; $i < count($orden_id); $i++) {
                        $traditional[] = Food_Traditional::find($orden_id[$i]);
                        $total_t += $traditional[$i]->price_bs;
                        $dolar_t += $traditional[$i]->price_us;
                        $name_t[] = $traditional[$i]->name;
                    }
                }
        }else{
            $traditional = null;
            $total_t = 0;
            $dolar_t = 0;
            $name_t = null;
        }

        $total_ve = 0;
        $dolar_ve = 0;
        if ($order->food_vegan_id != null) {
                $orden_id = explode(',', $order->food_vegan_id); 
                if ($orden_id != null) {
                    for ($i=0; $i < count($orden_id); $i++) {
                        $vegan[] = Food_Vegan::find($orden_id[$i]);
                        $total_ve += $vegan[$i]->price_bs;
                        $dolar_ve += $vegan[$i]->price_us;
                        $name_ve[] = $vegan[$i]->name;
                    }
                }
        }else{
            $vegan = null;
            $total_ve = 0;
            $dolar_ve = 0;
            $name_ve = null;
        }

        $total_v = 0;
        $dolar_v = 0;
        if ($order->food_vegetarian_id != null) {
                $orden_id = explode(',', $order->food_vegetarian_id); 
                if ($orden_id != null) {
                    for ($i=0; $i < count($orden_id); $i++) {
                        $vegetarian[] = Food_Vegetarian::find($orden_id[$i]);
                        $total_v += $vegetarian[$i]->price_bs;
                        $dolar_v += $vegetarian[$i]->price_us;
                        $name_v[] = $vegetarian[$i]->name;
                    }
                }
        }else{
            $vegetarian = null;
            $total_v = 0;
            $dolar_v = 0;
            $name_v = null;
        }

        $total_d =0;
        $dolar_de = 0;
        if ($order->delicatesse_id != null) {
                $orden_id = explode(',', $order->delicatesse_id); 
                if ($orden_id != null) {
                    for ($i=0; $i < count($orden_id); $i++) {
                        $delicatesse[] = Delicatesse::find($orden_id[$i]);
                        $total_de += $delicatesse[$i]->price_bs;
                        $dolar_de += $delicatesse[$i]->price_us;
                        $name_de[] = $delicatesse[$i]->name;
                    }
                }
        }else{
            $delicatesse = null;
            $total_de = 0;
            $dolar_de = 0;
            $name_de = null;
        }

        $total_ba =0;
        $dolar_ba = 0;
        if ($order->bakeries_id != null) {
                $orden_id = explode(',', $order->bakeries_id); 
                if ($orden_id != null) {
                    for ($i=0; $i < count($orden_id); $i++) {
                        $bakery[] = Bakery::find($orden_id[$i]);
                        $total_ba += $bakery[$i]->price_bs;
                        $dolar_ba += $bakery[$i]->price_us;
                        $name_ba[] = $bakery[$i]->name;
                    }
                }
        }else{
            $bakery = null;
            $total_ba = 0;
            $dolar_ba = 0;
            $name_ba = null;
        }

        $total_f = 0;
        $dolar_f = 0;
        if ($order->fridge_id != null) {
                $orden_id = explode(',', $order->fridge_id); 
                if ($orden_id != null) {
                    for ($i=0; $i < count($orden_id); $i++) {
                        $fridge = Fridge::find($orden_id[$i]);
                        $total_f += $fridge[$i]->price_bs;
                        $dolar_f += $fridge[$i]->price_us;
                        $name_f[] = $fridge[$i]->name;
                    }
                }
        }else{
            $fridge = null;
            $total_f = 0;
            $dolar_f = 0;
            $name_f = null;
        }

        $total_fru = 0;
        $dolar_fru = 0;
        if ($order->fruit_store_id != null) {
                $orden_id = explode(',', $order->fruit_store_id); 
                if ($orden_id != null) {
                    for ($i=0; $i < count($orden_id); $i++) {
                        $fruit[] = Fruit_Store::find($orden_id[$i]);
                        $total_fru += $fruit[$i]->price_bs;
                        $dolar_fru += $fruit[$i]->price_us;
                        $name_fru[] = $fruit[$i]->name;
                    }
                }
        }else{
            $fruit = null;
            $total_fru = 0;
            $dolar_fru = 0;
            $name_fru = null;
        }

        $total_li = 0;
        $dolar_li = 0;
        if ($order->liquor_store_id != null) {
                $orden_id = explode(',', $order->liquor_store_id); 
                if ($orden_id != null) {
                    for ($i=0; $i < count($orden_id); $i++) {
                        $liquor[] = Liquor_Store::find($orden_id[$i]);
                        $total_li += $liquor[$i]->price_bs;
                        $dolar_li += $liquor[$i]->price_us;
                        $name_li[] = $liquor[$i]->name;
                    }
                }
        }else{
            $liquor = null;
            $total_li = 0;
            $dolar_li = 0;
            $name_li = null;
        }

        $total_g = 0;
        $dolar_g = 0;
        if ($order->greengrocer_id != null) {
                $orden_id = explode(',', $order->greengrocer_id); 
                if ($orden_id != null) {
                    for ($i=0; $i < count($orden_id); $i++) {
                        $greengrocer[] = Greengrocer::find($orden_id[$i]);
                        $total_g += $greengrocer[$i]->price_bs;
                        $dolar_g += $greengrocer[$i]->price_us;
                        $name_g[] = $greengrocer[$i]->name;
                    }
                }
        }else{
            $greengrocer = null;
            $total_g = 0;
            $dolar_g = 0;
            $name_g = null;
        }

        $total_l = 0;
        $dolar_l = 0;
        if ($order->lunch_id != null) {
                $orden_id = explode(',', $order->lunch_id); 
                if ($orden_id != null) {
                    for ($i=0; $i < count($orden_id); $i++) {
                        $lunch[] = Lunch::find($orden_id[$i]);
                        $total_l += $lunch[$i]->price_bs;
                        $dolar_l += $lunch[$i]->price_us;
                        $name_l[] = $lunch[$i]->name;
                    }
                }
        }else{
            $lunch = null;
            $total_l = 0;
            $dolar_l = 0;
            $name_l = null;
        }

        $total_vi = 0;
        $dolar_ = 0;
        if ($order->victuals_id != null) {
                $orden_id = explode(',', $order->victuals_id); 
                if ($orden_id != null) {
                    for ($i=0; $i < count($orden_id); $i++) {
                        $victual[] = Victual::find($orden_id[$i]);
                        $total_vi += $victual[$i]->price_bs;
                        $dolar_vi += $victual[$i]->price_us;
                        $name_vi[] = $victual[$i]->name;
                    }
                }
        }else{
            $victual = null;
            $total_vi = 0;
            $dolar_vi = 0;
            $name_vi = null;
        }

        $total_d = 0;
        $dolar_d = 0;
        if ($order->drinks_id != null) {
                $orden_id = explode(',', $order->drinks_id); 
                if ($orden_id != null) {
                    for ($i=0; $i < count($orden_id); $i++) {
                        $drink[] = Drink::find($orden_id[$i]);
                        $total_d += $drink[$i]->price_bs;
                        $dolar_d += $drink[$i]->price_us;
                        $name_d[] =$drink[$i]->name;
                    }
                }
        }else{
            $drink = null;
            $total_d = 0;
            $dolar_d = 0;
            $name_d = null;
        }

        $total_e = 0;
        $dolar_e = 0;
        if ($order->extras_id != null) {
                $orden_id = explode(',', $order->extras_id); 
                if ($orden_id != null) {
                    for ($i=0; $i < count($orden_id); $i++) {
                        $extra[] = Extra::find($orden_id[$i]);
                        $total_e += $extra[$i]->price_bs;
                        $dolar_e += $extra[$i]->price_us;
                        $name_e[] = $extra[$i]->name;
                    }
                }
        }else{
            $extra = null;
            $total_e = 0;
            $dolar_e = 0;
            $name_e = null;
        }

        $total_us = 0;
        $total = 0;

        $total = ($total_e + $total_d + $total_s + $total_v + $total_ve + $total_t + $total_chik + $total_de +
        $total_chin + $total_in + $total_i + $total_m + $total_j + $total_a + $total_k + $total_vi +
        $total_f + $total_fru + $total_l + $total_li + $total_b + $total_ba + $total_p + $total_g);

        $total_us = ($dolar_e + $dolar_d + $dolar_s + $dolar_v + $dolar_ve + $dolar_t + $dolar_chik + $dolar_de +
        $dolar_chin + $dolar_in + $dolar_i + $dolar_m + $dolar_j + $dolar_a + $dolar_k + $dolar_vi +
        $dolar_f + $dolar_fru + $dolar_l + $dolar_li + $dolar_b + $dolar_ba + $dolar_p + $dolar_g);

       
        if ($order->typepayment_id != null) {
            $orden_id = explode(',', $order->typepayment_id); 
            if ($orden_id != null) {
                for ($i=0; $i < count($orden_id); $i++) {
                    $typepayment[] = Typepayment::find($orden_id[$i]);
                    $pago[] = $typepayment[$i]->name;
                }
            }
        }else{
            $typepayment = null;
        }
        
        $pedido =  [$name_chin, $name_e, $name_s, $name_v, $name_ve, $name_t, $name_chik, $name_d, $name_de, $name_in, $name_i, $name_b,
                    $name_m, $name_j, $name_a, $name_k, $name_vi, $name_f, $name_fru, $name_l, $name_li, $name_g, $name_ba, $name_p];

        
        // dd($total, $total_us, $pago);
        // dd($pedido, $total, $total_us, $pago);

        return response()->json([
            'pedido' => $pedido,
            'Total bs' => $total, 
            'Total us' => $total_us, 
            'Forma de pago' => $pago
        ]);
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
<?php

namespace App\Http\Controllers;

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
    public function store(Request $request)
    {
        
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

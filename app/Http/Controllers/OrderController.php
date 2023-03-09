<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Order;
use App\Models\User;
use App\Mail\OrderShipped;
use App\Mail\OrderComplete;
use Illuminate\Support\Facades\Mail;

class OrderController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $orders = Order::orderBy('created_at', 'desc')
        ->get()
        ->map(function($country){
            $country->travels =json_decode($country->order_json);
            return $country;
        });
        return view('back.orders.index',[
            'orders'=>$orders
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  \App\Models\Order  $order
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Order $order)
    {
        $order->status=1;
        $order->save();
        $to = User::find($order->user_id);
        Mail::to($to)->send(new OrderShipped($order));

        return redirect()->route('order-index', ['#'.$order->id]);
        //redirect()->route('index', ['#'.$order->id])
    }


        public function ticket(Request $request, Order $order)
    {

        $to = User::find($order->user_id);
        Mail::to($to)->send(new OrderComplete($order));
        $order->status=2;
        $order->save();
        $order = Order::where('id','=',$request->ticket)
        ->get()
        ->map(function($country){
            $country->travels =json_decode($country->order_json);
            return $country;
        });
        $order->ticket=$request->ticket;

        

        return view('back.orders.ticket',[
          'order'=>$order
        ]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Order  $order
     * @return \Illuminate\Http\Response
     */
    public function destroy(Order $order)
    {
        $order->delete();
        return redirect()->route('order-index', ['#'.$order->id]);
    }
}
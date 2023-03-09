<?php

namespace App\Services;

use App\Models\Country;
use App\Models\Hotel;


class CartService
{

    private $cart, $date, $cartList, $dateList, $total=0, $count=0;

    public function __construct()
    {
        $this->cart = session()->get('cart',[]);
        $ids = array_keys($this->cart);
        $this->cartList = Country::whereIn('id', $ids)
        ->get()
        ->map(function($country){
            $country->count=$this->cart[$country->id];
            $country->sum = $country->count*$country->price;
            $this->total += $country->sum ;
            return $country;
        });
        $this->count = $this->cartList->count(); 
 
        // $this->date = session()->get('date',[]);
        // $this->dateList = Country::whereIn('id', $ids)->get();
    }
    
    public function __get($props)
    {
        return match($props){
            'total'=>$this->total,
            'count'=>$this->count,
            'list'=>$this->cartList,
            'date'=>$this->date,
            'dateList'=>$this->dateList,
            default=>null
        };
    }


    public function add(int $id, int $count)
    {
        if(isset($this->cart[$id])){
            $this->cart[$id] += $count;
        }else {
            $this->cart[$id] = $count;
        }
        session()->put('cart',$this->cart);
    }

    
        public function addBook(int $id, string $date)
    {   
        if(isset($this->date[$id])){
            $this->cart[$id] = $date;
        }
        session()->put('date',$this->date);
    }

    public function update(array $cart)
    {
        session()->put('cart',$cart);
    }
    public function delete(int $id)
    {
        unset($this->cart[$id]);
        session()->put('cart',$this->cart);
    }

    public function order()
    {
        $order = (object)[];
        $order->total = $this->total;
        $order->travels = [];
        foreach ($this->cartList as $travel) {
          $order -> travels[] = (object)[
            'title' => $travel->title,
            'count'=> $travel->count,
            'price'=> $travel->price,
            'bookDate'=> $travel->bookDate,
            'checkout'=> $travel->checkout,
            'lenght'=> $travel->lenght,
            'id'=> $travel->id,
            'hotel_id'=> $travel->hotel_id,
            'city'=> $travel->city,
            'des'=> $travel->des,
            'hotel'=> $travel->countryHotel_name->title,
            'total'=> $this->total,
          ];
        }
        return $order;
    }

    public function empty()
    {
        session()->put('cart',[]);
        $this->total = 0;
        $this->count= 0;
        $this->cartList= collect();
        $this->cart= [];
    }


    public function test()
    {
        return 'Test from service';
    }   

    

}
<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\Country;
use App\Models\Hotel;
use App\Models\Order;
use Illuminate\Http\Request;
use Barryvdh\DomPDF\Facade\Pdf;
use App\Services\CartService;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use App\Models\User;
use App\Mail\OrderBasket;



class FrontController extends Controller
{
    public function home(Request $request)
    {
        $perPageShow = in_array($request->per_page, Country::PER_PAGE) ? $request->per_page : 'All';
        if (!$request->s && !$request->start && !$request->end){
          $countrys=match($request->sort ?? ''){
            'asc_country'=>Country::orderBy('title'),
            'desc_country'=>Country::orderBy('title', 'desc'),
            'asc_city'=>Country::orderBy('city'),
            'desc_city'=>Country::orderBy('city', 'desc'),
            'asc_price'=>Country::orderBy('price'),
            'dessc_price'=>Country::orderBy('price', 'desc'),
            default =>Country::where('hotel_id','>',0)
          };
            if ($perPageShow =='All'){
            $countrys= $countrys->whereDate('bookDate', '>=', Carbon::today())->get();
            }else{
            $countrys= $countrys->whereDate('bookDate', '>=', Carbon::today())->paginate($perPageShow)->withQueryString();}
        }else{
            $s = explode(' ', $request->s);
            $start = explode(' ', $request->start);
            $end = explode(' ', $request->end);
            if ( count($s) == 1 ) {
                $countrys = Country::where('title', 'like', '%'.$request->s.'%')
                ->orWhere('city', 'like', '%'.$request->s.'%')
                ->whereDate('bookDate', '>=', Carbon::today())
                ->get();
            }
            else {
                $countrys = Country::where('title', 'like', '%'.$s[0].'%'.$s[1].'%')
                ->orWhere('title', 'like', '%'.$s[1].'%'.$s[0].'%')
                ->orWhere('city', 'like', '%'.$s[1].'%'.$s[0].'%')
                ->orWhere('city', 'like', '%'.$s[0].'%'.$s[1].'%')
                ->whereDate('bookDate', '>=', Carbon::today())
                ->get();
            }
            if ( count($start) == 1 && count($end) == 1 && $request->start && $request->end) {
                $countrys = Country::whereDate('bookDate', '>', $request->start)
                ->whereDate('checkout', '<', $request->end)
                ->orderBy('bookDate')
                ->get();
            }
            if ( count($start) == 1 && $request->start && !$request->end) {
                $countrys = Country::whereDate('bookDate', '>', Carbon::today())
                ->orderBy('bookDate')
                ->get();
            }
            if ( count($end) == 1 && !$request->start && $request->end) {
                 $countrys = Country::whereDate('bookDate', '>', Carbon::today())
                ->whereDate('checkout', '<', $request->end)
                ->orderBy('checkout')
                ->get();
            }
        }
         
        return view('front.home',[
            'countrys'=>$countrys,
            'sortSelect' => Country::SORT,
            'sortShow' => isset(Country::SORT[$request->sort]) ? $request->sort : '',
            'perPageSelect' => Country::PER_PAGE,
            'perPageShow' => in_array($request->per_page, Country::PER_PAGE) ? $request->per_page : 'All',
            's' => $request->s ?? '',
            'start' => $request->start ?? '',
            'end' => $request->end ?? ''
        ]);
    }
        public function showHotel(Request $request, Country $country)
    {
        return view('front.show',[
            'country'=>$country
        ]);
    }
            public function pdf(Country $country)
    {
        // return view('front.pdf',[
        //     'country'=>$country
        // ]);

        $pdf = Pdf::loadView('front.pdf', ['country'=>$country]);
        return $pdf->stream();

    }
    public function addToBasket(Request $request, CartService $cart)
    { 
    $id = (int)$request->product;
        $count = (int)$request->count;
        $cart->add($id, $count);

        return redirect(url()->previous().'#'.$request->product)->with('ok', 'Add to basket succses');
       // return redirect()->back()->with('ok', 'Add to basket succses');
    }
        public function addToDate(Request $request, CartService $date)
    {    
        $id = (int)$request->id;
        $date = (string)$request->date;

        //$request->session()->put('date', $date);
 
        $date->addBook($id, $date);
        
        return redirect()->back();
    }
    

    public function cart(CartService $cart)
    {
        return view('front.cart',[
            'cartList'=>$cart->list      
        ]);
    }
    public function updateCart(Request $request, CartService $cart)
    {
        if ($request->delete) {
            $cart->delete($request->delete);
        } else {
        $updatedCart = array_combine($request->ids ?? [], $request->count ?? []);
        $cart->update($updatedCart);
        }
        return redirect(url()->previous().'#'.$request->update)->with('ok', 'Person qty update complete');
        //return redirect()->back()->with('ok', 'Person qty update complete');;
    }
    
    public function order(Request $request, CartService $cart)
    {   
        if ($request->delete) {
            $cart->delete($request->delete);
        } else {
        $updatedCart = array_combine($request->ids ?? [], $request->count ?? []);
        $cart->update($updatedCart);
        }
        return redirect()->back();
    }
    
    public function makeOrder(Request $request, CartService $cart)
    {
        $order = new Order;
        $order->user_id = Auth::user()->id;
        $order->order_json=json_encode($cart->order());
        $order->save();
        $cart->empty();
        $to = User::find($order->user_id);
        Mail::to($to)->send(new OrderBasket($order));
        //dump($order->id);
        return redirect()->route('cart'); 
    }

    public function date(CartService $cart)
    {
        return view('front.date',[
            'cartList'=>$cart->list      
        ]);
    }

    public function showHotelCountrys(Request $request,Hotel $hotel)
    {
        $countrys=Country::where('hotel_id', $hotel->id)->get();
        $countrys=$countrys->sortBy('title');

        return view('front.home',[
            'countrys'=>$countrys,
            'sortSelect' => Country::SORT,
            'sortShow' => isset(Country::SORT[$request->sort]) ? $request->sort : '',
            'perPageSelect' => Country::PER_PAGE,
            'perPageShow' => in_array($request->per_page, Country::PER_PAGE) ? $request->per_page : 'All',
            's' => $request->s ?? '',
            'start' => $request->start ?? '',
            'end' => $request->end ?? ''
        ]);
    }
        public function showCountryHotels(Request $request,Country $country)
    {
        $hotels=Hotel::where('id', $country->hotel_id)->get();
        $hotels=$hotels->sortBy('title');
        return view('front.home',[
            'hotel'=>$hotel,
            'sortSelect' => Country::SORT,
            'sortShow' => isset(Country::SORT[$request->sort]) ? $request->sort : '',
            'perPageSelect' => Country::PER_PAGE,
            'perPageShow' => in_array($request->per_page, Country::PER_PAGE) ? $request->per_page : 'All',
            's' => $request->s ?? '',
            'start' => $request->start ?? '',
            'end' => $request->end ?? ''
        ]);
    }

}
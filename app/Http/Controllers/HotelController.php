<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Hotel;

class HotelController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $hotels = Hotel::all()->sortBy('title');
        return view('back.hotels.index',[
            'hotels'=> $hotels
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('back.hotels.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $hotel = new Hotel;
        $hotel->title=$request->hotels_title.' Hotel';
        $hotel->save();

        return redirect()->route('hotels-index');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Hotel  $hotel
     * @return \Illuminate\Http\Response
     */
    public function show(Hotel $hotel)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Hotel  $hotel
     * @return \Illuminate\Http\Response
     */
    public function edit( Hotel $hotel)
    {
            return view('back.hotels.edit',[
            'hotel'=> $hotel,
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\Request  $request
     * @param  \App\Models\Hotel  $hotel
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Hotel $hotel)
    {
        $hotel->title=$request->hotel_title;
        $hotel->save();
        return redirect()->route('hotels-index',['#'.$hotel->id])->with('ok', 'Hotel update sucsses');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Hotel  $hotel
     * @return \Illuminate\Http\Response
     */
    public function destroy(Hotel $hotel)
    {  
        if(!$hotel->hotel_Country()->count()){
            $hotel->delete();
            return redirect()->route('hotels-index')->with('ok', 'Hotel date was delet');
        }else{
            $countOffer=$hotel->hotel_Country()->count();
            //dump($count);
            return redirect()->back()->with('not', 'Hotel date can,t delet. Hotel have open '.$countOffer.' offer. ');
        }

    }
}
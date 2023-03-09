<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\Country;
use App\Models\Hotel;
use Illuminate\Http\Request;    
use Barryvdh\DomPDF\Facade\Pdf;
use Spatie\Browsershot\Browsershot;

class CountryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {   //$countrys = Country::paginate(21); 
       $countrys = Country::all();
    //    $countrys = Country::all()->sortBy('title');
        return view('back.countrys.index',[
            'countrys'=> $countrys
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $hotels = Hotel::all()->sortBy('title');
        return view('back.countrys.create',[
            'hotels'=> $hotels
        ]);
     
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $country = new Country;

        if($request->file('photo')){
            $photo = $request->file('photo');
            $ext = $photo->getClientOriginalExtension();
            $name = pathinfo($photo->getClientOriginalName(), PATHINFO_FILENAME);
            $file = $name.'-'.time().'.'.$ext;
            $photo->move(public_path().'/images',$file);
            //$country->photo=asset('/images').'/'.$file;
            $country->photo='/'.'images/'.$file;
        }else{
            $country->photo='/images/temp/noimage.jpg';
        }

        $start= Carbon::parse($request->country_book);
        $country->hotel_id=$request->hotel_id;
        $country->title=$request->country_title;
        $country->city=$request->country_city;
        $country->start=$request->country_start;
        $country->end=$request->country_end;
        $country->price=$request->country_price;
        $country->lenght=$request->country_lenght;
        $country->des=$request->country_des;
        $country->bookDate=$request->country_book;
        $country->checkout=$start->addDays($request->country_lenght);
        $country->save();

        return redirect()->route('countrys-index');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Country  $country
     * @return \Illuminate\Http\Response
     */
    public function show(Country $country)
    {
         return view('back.countrys.show',[
            'country'=>$country
         ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Country  $country
     * @return \Illuminate\Http\Response
     */
    public function edit(Country $country)
    {
        $hotels = Hotel::all()->sortBy('title');
        return view('back.countrys.edit',[
            'country'=> $country,
            'hotels'=> $hotels
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\Request  $request
     * @param  \App\Models\Country  $country
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Country $country)
    {  

            if($request->delet_photo){
            $country->deletePhoto();
            return redirect()->back()->with('ok', 'Photo deleted');
        }

        if($request->file('photo')){
            $photo = $request->file('photo');
            $ext = $photo->getClientOriginalExtension();
            $name = pathinfo($photo->getClientOriginalName(), PATHINFO_FILENAME);
            $file = $name.''.time().'.'.$ext;

            if($country->photo){
                $country->deletePhoto();
            }

            $photo->move(public_path().'/images',$file);
            //$country->photo=asset('/images').'/'.$file;
            $country->photo='/'.'images/'.$file;
        }
        
        $start= Carbon::parse($request->country_book);
        $country->hotel_id=$request->hotel_id;
        $country->title=$request->country_title;
        $country->city=$request->country_city;
        $country->start=$request->country_start;
        $country->end=$request->country_end;
        $country->price=$request->country_price;
        $country->lenght=$request->country_lenght;
        $country->des=$request->country_des;
        $country->bookDate=$request->country_book;
        $country->checkout=$start->addDays($request->country_lenght);
        $country->save();

        return redirect()->route('countrys-index', ['#'.$country->id])->with('ok', 'Edit complete');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Country  $country
     * @return \Illuminate\Http\Response
     */
    public function destroy(Country $country)
    {
        $country->deletePhoto();
        $country->delete();
        return redirect()->route('countrys-index')->with('ok', 'Offer delet complete');
    }

    public function pdf(Country $country)
    {
        $file = asset($country->photo);
        // dump($file);

        
        $pdf = Pdf::loadView('back.countrys.pdf', ['country'=>$country]);
        return $pdf->stream();
        //return $pdf->download($country->countryHotel_name->title.'.pdf');
    }
}
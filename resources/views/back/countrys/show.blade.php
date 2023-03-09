@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">

            <div class="card mt-2" style="max-width: 1wm;">
                <div class="row g-0 shadow p-3 bg-body-tertiary rounded">
                    <div class="col-md-12">
                        <h1>{{$country->countryHotel_name->title}} information</h1>
                    </div>
                    <div class="col-md-6">
                        <div class="card-body">
                            <h6>Hotel: <b><i>{{$country->countryHotel_name->title}}</b></i></h6>
                            <h6>Country: <b><i>{{$country->title}}</b></i></h6>
                            <h6>City: <b><i>{{$country->city}}</b></i></h6>
                            <h6>Season: <b><i>{{$country->start}}</b> to <b>{{$country->end}}</b></i></h6>
                            <h6>Chekin: <b><i>{{$country->bookDate}} Chekout:{{$country->checkout}}</b></i></h6>
                            <h6>Time: <b><i>{{$country->lenght}} day</b></i></h6>
                            <h6>Price: <b><i>{{$country->price}} &euro;</b></i></h6>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <img src="{{asset($country->photo)}}" class="img-fluid rounded-start" alt="imageset">
                    </div>
                    <div class="col-md-12">
                        <div class="card-body">
                            <h6 class="card-title">Description:</h6>
                            <p>{{$country->des}}</p>
                        </div>
                        <div class="list-table__buttons m-3">
                            <a href="{{route('countrys-index', $country)}}" class="btn btn-secondary m-2">BACK</a>
                            <a href="{{route('countrys-pdf', $country)}}" target="_blank" class="btn btn-info m-2">PDF</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

</div>
@endsection

@extends('layouts.front')

@section('content')
<div class="container">
    <div class="row justify-content-center ">
        <div class="col-md-12">
            <div class="card mt-2" style="max-width: 1wm;">
                <div class="card g-0 shadow p-3 bg-body-tertiary rounded">

                    {{-- <div class="col-md-6">
                    </div> --}}
                    <div class="col-md-12">
                        <img src="{{asset($country->photo)}}" class="img-fluid rounded-start" alt="imageset">
                    </div>
                    <div class="col-md-12">
                        <div class="card-body">
                            <h2><i><b>{{$country->countryHotel_name->title}} information</b></h2></i>

                            <h6>Country: <b><i>{{$country->title}}</b></i></h6>
                            <h6>City: <b><i>{{$country->city}}</b></i></h6>
                            <h6>Season: <b><i>{{$country->start}}</b> to <b>{{$country->end}}</b></i></h6>
                            <h6>Time: <b><i>{{$country->lenght}} day</b></i></h6>
                            <h6>Price: <b><i>{{$country->price}} &euro;</b></i></h6>
                        </div>
                        <div class="col-md-12">
                            <div class="card-body">
                                <p>{{$country->des}}</p>
                            </div>
                        </div>

                        <div class="list-table__buttons m-3 float-end bottom-0">
                            <a href="{{route('show-pdf', $country)}}" target="_blank" class="btn btn-info">PDF</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

</div>
@endsection

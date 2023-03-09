@extends('layouts.front')
@section('content')

<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            @if($cartList->count())
            {{-- <div class="col-md-12 mt-1 shadow bg-body-tertiary rounded">
                @if(Session::has('ok'))
                <h6 class=" alert alert-success alert-dismissible fade show" role="alert">{{Session::get('ok')}}</h6>
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            @endif
        </div> --}}
        <div class="card shadow bg-body-tertiary rounded">
            <div class="card-header">
                <h1>Basket</h1>
            </div>
        </div>

        @endif

        <form action="{{route('update-cart')}}" method="post">
            @forelse($cartList as $country)
            <div id="{{ $country['id'] }}" class="card mt-1" style="max-width: 1wm; ">

                <div class="row g-0 shadow p-3 bg-body-tertiary rounded" id="{{ $country['id'] }}">

                    <div class="col-md-4">
                        <img src="{{asset($country->photo)}}" class="img-fluid rounded" alt="imageset">
                    </div>
                    <div class="col-md-3">
                        <div class="card-body align-content-center text-start">

                            <h6>Hotel: <b><i>{{$country->countryHotel_name->title}}</b></i></h6>
                            <h6>Country: <b><i>{{$country->title}}</b></i></h6>
                            <h6>City: <b><i>{{$country->city}}</b></i></h6>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="card-body align-content-center text-start">

                            <h6>Person qty:</h6>
                            <input type="number" class="form-control imputnumber" name="count[]" value="{{$country->count}}" min="0">
                            <div class="mt-3">
                                <h6>Check-in: <b><i>{{$country->bookDate}}</b></i></h6>
                                <h6>Chek-out: <b><i>{{$country->checkout}}</b></i></h6>
                                <h6>Price per person: <b><i>{{$country->price}} &euro;</b></i></h6>
                            </div>
                            <input type="hidden" class="form-control" name="ids[]" value="{{$country->id}}">
                        </div>
                    </div>
                    <div class="col-md-1">
                        <div class="card-body container text-end">
                            <button type="submit" name="update" value="{{$country->id}}" class="btn btn-secondary">UPDATE</button>


                        </div>
                    </div>
                    <div class="col-md-1">
                        <div class="card-body container text-end">
                            <button type="submit" name="delete" class="btn btn-danger" value="{{$country->id}}">DELETE</button>
                        </div>
                    </div>
                </div>
            </div>
            @empty

            <div class="col-md-12 ">
                <div class="card shadow bg-body-tertiary rounded ">
                    <div class="card-header">
                        <h1>Basket empty</h1>
                    </div>
                </div>
            </div>
            @endforelse
            @csrf
            @method('post')
            {{-- <ul class="list-group">
                    <li class="list-group-item">
                        <div class="col-md-1">
                            <div class="card-body container text-end">
                                <button type="submit" class="btn btn-secondary">UPDATE</button>
                            </div>
                        </div>
                    </li>
                </ul> --}}
        </form>
        @if($cartList->count())
        <div class="col-md-12">
            <ul class="list-group text-end mt-1">
                <li class="list-group-item">
                    {{-- style=" background-color:skyblue;" --}}
                    <form action="{{route('date')}}" method="get">
                        <button type="submit" class="btn btn-secondary m-2">NEXT</button>
                        @csrf
                    </form>
                </li>
            </ul>
        </div>
        @endif
    </div>
    <div class="mt-4">
        {{-- {{$cart->links()}} --}}
    </div>
</div>
</div>
@endsection

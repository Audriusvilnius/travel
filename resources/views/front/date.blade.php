@extends('layouts.front')
@section('content')

<div class="container ">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card shadow bg-body-tertiary rounded">
                <div class="card-header">
                    <h1>Basket</h1>
                </div>
            </div>
            <div class="col-md-12 mt-1 shadow bg-body-tertiary rounded">
                @if(Session::has('ok'))
                <h6 class=" alert alert-success alert-dismissible fade show" role="alert">{{Session::get('ok')}}</h6>
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                @endif
            </div>
            <form action="{{route('make-order')}}" method="post">
                {{-- <form action="{{route('add-date')}}" method="post"> --}}
                @forelse($cartList as $country)
                <div class="card mt-1" style="max-width: 1wm;">
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


                                <h6>Person: <b><i>{{$country->count}}</b></i></h6>
                                <h6>Check-in: <b><i>{{$country->bookDate}}</b></i></h6>
                                <h6>Chek-out: <b><i>{{$country->checkout}}</b></i></h6>
                                <h6>Price per person: <b><i>{{$country->price}} &euro;</b></i></h6>

                                {{-- <input type="date" class="form-control " name="date[]" min="{{$country->start}}" max="{{$country->end}}" value="{{old('date',$country->date)}}">
                                <input type="hidden" class="form-control" name="id[]" value="{{$country->id}}"> --}}

                                <h6>Sum: <b><i>{{$country->price*$country->count}} &euro;</b></i></h6>
                            </div>
                        </div>
                        <div class="col-md-1">
                            <div class="card-body container text-end">
                            </div>
                        </div>

                        {{-- <div class="col-md-1">
                            <div class="card-body container text-end">
                                <button type="submit" class="btn btn-secondary">BUY</button>
                                <button type="submit" name="delete" class="btn btn-danger" value="{{$country->id}}">DELETE</button>
                        <button type="submit" name="buy" class=" btn btn-secondary" value="{{$country->date}}">BUY</button>
                    </div>
                </div> --}}
        </div>
    </div>
    @empty
    <h2 class="list-group-item">Basket empty</h2>
    @endforelse
    @if($cartList->count())
    <ul class="list-group mt-1">
        <li class="list-group-item">
            <div class="col-md-12">
                <div class="card-body container text-end align-items-end d-flex justify-content-end">
                    <a href="{{route('cart')}}" class="btn btn-secondary m-2">BACK</a>
                    <button type="submit" name="delete" class="btn btn-danger m-2" value="{{$country->id}}">DELETE</button>
                    <button type="submit" class="btn btn-success m-2">BUY</button>

                </div>
            </div>
        </li>
    </ul>
    @endif
    @csrf
    @method('post')
    </form>
</div>
<div class="mt-4">
    {{-- {{$cart->links()}} --}}
</div>
</div>
</div>
@endsection

@extends('layouts.front')

@section('content')
<section class="py-1 text-center container" style="min-height: calc(100% - 1em);">


    <div class="col-lg-4 col-md-8 mx-auto mt-1">

        @if(Session::has('ok'))
        <h6 class=" alert alert-success alert-dismissible fade show" role="alert">{{Session::get('ok')}}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button></h6>
        @endif
    </div>
</section>

<section class="py-1 text-center container ">
    <h1 class="fw-light m-2 ">LOST-Vacation</h1>
    <p class="lead text-muted m-5 fs-3">Lorem, ipsum dolor sit amet consectetur adipisicing elit. Assumenda, blanditiis. Optio architecto quos rem sint ipsam alias iste nihil illum nesciunt? Maiores sunt quos quod. Tempora eum nulla itaque sint! Lorem, ipsum dolor sit amet consectetur adipisicing elit.</p>


    <hr class=" border border-second border-1 opacity-75 m-5">

    <div class="row ">
        <div class="col-md-3">
        </div>
        <div class="col-md-6">
            <form class="col-12" role="search" action="{{url('/')}}" method="get">
                <div class="card-body align-content-center gap-3 d-flex">
                    <input type="search" class="form-control form-control-dark text-bg-dark " placeholder="Search...  Country & City" aria-label="Search" name="s" value="{{$s}}">
                    <button type="submit" class="btn btn-info">FIND</button>
                </div>
            </form>
        </div>
    </div>

    <hr class=" border border-second border-0 opacity-50">

    <div class="row ">
        <div class="col-md-4"></div>
        <div class="col-md-4">
            <form action="{{url('/')}}" method="get">
                <div class="card-body align-content-center gap-3 d-flex">
                    <input type="date" class="form-control form-control-dark text-bg-dark " name="start" value="{{old('start',$start)}}">
                    <input type="date" class="form-control form-control-dark text-bg-dark " name="end" value="{{old('end',$end)}}">
                    <button type="submit" class="btn btn-info">FIND</button>
                </div>
            </form>
            {{-- @include('front.common.hotel') --}}
        </div>
    </div>
    <hr class="border border-second border-0 opacity-50 m-5">
</section>
<a href="#" class="text-decoration-none" style="color:black;">
    <div class="up">
        <b>
            < </b>
    </div>
</a>

<div class="page blure"></div>
<div class="page">
    <hr class="border border-second border-0 opacity-50 m-1">
    <div class="container">
        <hr class="border border-second border-0 opacity-50">
        <div class="row ">
            <div class="col-md-7">
            </div>
            <div class="col-md-2 btnsort">
                <div class="card-body align-content-center">
                    <form action="{{url('/')}}" method="get">
                        <select class="form-select bg-dark text-white " name="sort">
                            <option>Default</option>
                            @foreach($sortSelect as $value => $name)
                            <option value="{{$value}}" @if($sortShow==$value) selected @endif>{{$name}}</option>
                            @endforeach
                        </select>
                </div>
            </div>
            <div class="col-md-1">
                <div class="card-body align-content-center d-flex ">
                    <select class="form-select bg-dark text-white d-flex" name="per_page">
                        @foreach($perPageSelect as $value)
                        <option value="{{$value}}" @if($perPageShow==$value) selected @endif>{{$value}}</option>
                        @endforeach
                    </select>
                </div>
            </div>

            <div class="col-md-2">
                <div class="card-body align-content-end gap-1 d-flex float-end">

                    <button type="submit" class="btn btn-secondary ">SHOW</button>
                    </form>
                    <a href=" {{url('/')}}" class="btn btn-danger" style="">RESET</a>

                </div>
            </div>
        </div>
        <hr class="border border-second border-0 opacity-50">
        <div class="row row-cols-1 row-cols-sm-2 row-cols-md-3 g-3">
            @forelse($countrys as $country)
            <div id="{{ $country['id'] }}" class="col d-flex justify-content-md-between">
                <div class="card g-0 shadow p-2 bg-body-tertiary rounded">
                    <a href=" {{route('show-hotel', $country)}}" target="blanc"> <img src="{{asset($country->photo)}}" class="img-fluid rounded shadow bg-body-tertiary " alt=" hotel"></a>
                    <div class=" card-body ">
                        <h6>Hotel: <b style="font-size:17px;"><i>{{$country->countryHotel_name->title}}</b></i></h6>
                        <h6>Country: <b><i>{{$country->title}}</b></i></h6>
                        <h6>City: <b><i>{{$country->city}}</b></i></h6>
                        <h6>Season: <b><i>{{$country->start}}</b> to <b>{{$country->end}}</b></i></h6>
                        <hr class="border border-second border-2 opacity-50">
                        <h6>Check-in: <b><i>{{$country->bookDate}}</b></i></h6>
                        <h6>Chek-out: <b><i>{{$country->checkout}}</b></i></h6>
                        <h6>Time: <b><i>{{$country->lenght}} night</b></i></h6>
                        {{-- <p class="fw-light">{{$country->des}}</p> --}}
                        <h6 @if($country->price<750) style="color:crimson; font-size:16px;" @endif>Price: <b><i>{{$country->price}} &euro;</b></i></h6>
                        <hr class="border border-second border-2 opacity-50">
                        <form action="{{route('add-basket')}}" method="post">
                            <div class="gap-3 align-items-center d-flex justify-content-center">
                                {{-- From:
                                <input type="date" name="data_book" style="width:120px;"> --}}
                                <input type="hidden" name="product" value="{{$country->id}}">
                                <b>Qty:</b>
                                <input type="number" min="1" name="count" value="0" class="form-control imputnumber">
                                <div class="btn-group">
                                    <button type="submit" class="btn btn-secondary">ADD</button>
                                </div>
                            </div>
                            @csrf
                        </form>
                    </div>
                </div>
            </div>
            @empty
            <div class="card-body align-content-center">

                <h2 class="list-group-item ">No offer</h2>
            </div>
            @endforelse
        </div>
        <div class="mt-4">
            @if($perPageShow!='All')
            {{$countrys->links()}}
            @endif
        </div>
    </div>
    <hr class="border border-second border-0 opacity-50 m-1">
    <div class="page blure"></div>
</div>
@endsection

@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card shadow bg-body-tertiary rounded d-flex">
                <div class="card-header">
                    <h1>All offers</h1>
                    <ul class="navbar-nav me-auto float-end">
                        @include('front.common.hotel')
                    </ul>
                </div>
            </div>
            <div class="col-md-12 mt-3 shadow bg-body-tertiary rounded">
                @if(Session::has('ok'))
                <h6 class=" alert alert-success alert-dismissible fade show" role="alert">{{Session::get('ok')}}
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button></h6>
                @endif
            </div>
            @forelse($countrys as $country)
            <div id="{{ $country['id'] }}" class="card mt-2" style="max-width: 1wm;">
                <div class="row g-0 shadow p-3 bg-body-tertiary rounded">
                    <div class="col-md-3">
                        <img src="{{asset($country->photo)}}" class="img-fluid rounded" alt="imageset">
                    </div>
                    <div class="col-md-4">
                        <div class="card-body">
                            <h6>Hotel: <b><i>{{$country->countryHotel_name->title}}</b></i></h6>
                            <h6>Country: <b><i>{{$country->title}}</b></i></h6>
                            <h6>City: <b><i>{{$country->city}}</b></i></h6>
                            <h6>Season: <b><i>{{$country->start}}</b> to <b>{{$country->end}}</b></i></h6>
                            <h6>Chekin: <b><i>{{$country->bookDate}}</b></i></h6>
                            <h6>Time: <b><i>{{$country->lenght}} day</b></i></h6>
                            <h6>Price: <b><i>{{$country->price}} &euro;</b></i></h6>
                        </div>
                    </div>
                    <div class="col-md-5">
                        <div class="card-body">
                            <h6 class="card-title">Description:</h6>
                            <textarea class="form-control" placeholder="{{$country->des}}" rows="2" cols="auto"></textarea>
                            {{-- <h6 class="card-title text-muted">Additional info:</h6>
                                <p class="card-text"><small class="text-muted">Last updated 3 mins ago</small></p> --}}
                        </div>
                        <div class="list-table__buttons ">
                            <a href="{{route('countrys-show', $country)}}" class="btn btn-info m-2">SHOW</a>
                            <a href="{{route('countrys-edit', $country)}}" class="btn btn-secondary m-2">EDIT</a>

                            <form action="{{route('countrys-delete', $country)}}" method="post">
                                <button type="submit" class="btn btn-danger m-2">DELET</button>
                                @csrf
                                @method('delete')
                            </form>
                        </div>
                    </div>
                </div>
            </div>
            @empty
            <h2 class="list-group-item">No types yet</h2>
            @endforelse
            <div class="mt-4">
                {{-- {{$countrys->links()}} --}}
            </div>
        </div>
    </div>
</div>
@endsection

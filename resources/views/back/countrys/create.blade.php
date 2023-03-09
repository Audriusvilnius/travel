@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <h1>Add new hotel offer</h1>
                </div>
            </div>
            <form action="{{route('countrys-store')}}" method="post" enctype="multipart/form-data">
                <div class="card mt-2" style="max-width: 1wm;">
                    <div class="row g-0 shadow p-3 bg-body-tertiary rounded">
                        <div class="col-md-4">
                            <div class="card-body">
                                <h6>Hotel</h6>
                                <select class="form-select" name="hotel_id">
                                    @foreach($hotels as $hotel)
                                    <option value="{{$hotel->id}}" @if($hotel->id == old('hotel_id')) selected @endif>{{$hotel->title}}</option>
                                    @endforeach
                                </select>
                                <h6 class="mt-2">Country</h6>
                                <input type="text" class="form-control" name="country_title" value="{{old('country_title')}}">
                                <h6 class="mt-2">City</h6>
                                <input type="text" class="form-control" name="country_city" value="{{old('country_city')}}">
                                <h6 class="mt-2">Photo</h6>
                                <input type="file" class="form-control" name="photo">
                            </div>
                        </div>
                        <div class="col-md-2">
                            <div class="card-body">
                                <h6>Start season</h6>
                                <input type="date" class="form-control" name="country_start" value="{{old('countrys_start')}}">
                                <h6 class="mt-2">End season</h6>
                                <input type="date" class="form-control" name="country_end" value="{{old('country_end')}}">
                                <h6 class="mt-2">Lenght</h6>
                                <input type="text" class="form-control" name="country_lenght" value="{{old('country_lenght')}}" placeholder="Day">
                                <h6 class="mt-2">Price</h6>
                                <input type="text" class="form-control" name="country_price" value="{{old('country_price')}}" placeholder="0.00 &euro;">
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="card-body">
                                <h6>Description:</h6>
                                <textarea class="form-control" placeholder="Hotel description leave a comment here" name="country_des" rows="20" cols="30" value="{{old('country_des')}}"></textarea>
                                {{-- <img src="..." class="img-fluid rounded-start" alt="..."> --}}
                            </div>
                            {{-- <h6 class="card-title text-muted">Additional info:</h6>
                                <p class="card-text"><small class="text-muted">Last updated 3 mins ago</small></p> --}}
                            <div class="list-table__buttons m-3">
                                <button type="submit" class="btn btn-secondary mt-1">CREATE</button>
                            </div>
                        </div>
                        @csrf
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
</div>
@endsection

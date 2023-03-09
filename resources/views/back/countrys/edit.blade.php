@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <h1>Edit hotel info of the Country</h1>
                </div>
            </div>
            <form action="{{route('countrys-update',$country)}}" method="post" enctype="multipart/form-data">
                <div class="card mt-2" style="max-width: 1wm;">
                    <div class="row g-0 shadow p-3 bg-body-tertiary rounded">
                        <div class="col-md-3">
                            <div class="card-body">
                                <h6>Hotel</h6>
                                <select class="form-select" name="hotel_id">
                                    @foreach($hotels as $hotel)
                                    <option value="{{$hotel->id}}" @if($hotel->id == old('hotel_id',$country->hotel_id)) selected @endif>{{$hotel->title}}</option>
                                    @endforeach
                                </select>
                                <h6 class="mt-2">Country</h6>
                                <input type="text" class="form-control" name="country_title" value="{{old('country_title', $country->title)}}">
                                <h6 class="mt-2">City</h6>
                                <input type="text" class="form-control" name="country_city" value="{{old('country_city', $country->city)}}">
                            </div>
                        </div>
                        <div class="col-md-2">
                            <div class="card-body">
                                <h6>Start season</h6>
                                <input type="date" class="form-control" name="country_start" value="{{old('country_start', $country->start)}}">
                                <h6 class="mt-2">End season</h6>
                                <input type="date" class="form-control" name="country_end" value="{{old('country_end', $country->end)}}">
                                <h6 class="mt-2">Chekin</h6>
                                <input type="date" class="form-control" name="country_book" value="{{old('country_book', $country->bookDate)}}" min="{{$country->start}}" max="{{$country->end}}">
                                <h6 class="mt-2">Lenght</h6>
                                <input type="text" class="form-control" name="country_lenght" value="{{old('country_lenght', $country->lenght)}}" placeholder="Day" min="0">
                                <h6 class="mt-2">Price</h6>
                                <input type="text" class="form-control" name="country_price" value="{{old('country_price', $country->price)}}" placeholder="0.00 &euro;" min="0.01">
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="card-body">
                                <h6>Description:</h6>
                                <textarea class="form-control" placeholder="Hotel description leave a comment here" name="country_des" rows="18" cols="auto">{{old('country_des',$country->des)}}</textarea>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="card-body">
                                <h6>Change Photo</h6>
                                <img src="{{asset($country->photo)}}" class="img-fluid rounded-start" alt="img">
                            </div>
                            <div class="card-body">
                                <input type="file" class="form-control" name="photo">
                            </div>
                            <div class=" card-body">
                            </div>
                            <div class="flex align-items-end float-end">
                                <a href="{{route('countrys-index', $country)}}">
                                    <button type="submit" class="btn btn-danger" name="delet_photo" value="1">DELET PHOTO</button></a>
                                <button type="submit" class="btn btn-secondary m-3">SAVE</button>
                            </div>
                        </div>
                    </div>
                </div>
                <a href="{{route('countrys-index', $country)}}" class="btn btn-secondary m-3">BACK</a>
                @csrf
                @method('put')
            </form>
        </div>
    </div>
</div>
@endsection

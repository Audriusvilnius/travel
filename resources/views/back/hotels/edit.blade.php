@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <h1>Edit hotel</h1>
                </div>
            </div>
            <div class="card-body">
                <ul class="list-group shadow bg-body-tertiary rounded mt-2 d-flex">
                    <li class="list-group-item">
                        <form action="{{route('hotels-update', $hotel)}}" method="post">
                            <div class="mb-3">
                                <label class="form-label">Hotel title</label>
                                <input type="text" class="form-control" name="hotel_title" value="{{old('hotel_title', $hotel->title)}}">
                                <button type="submit" class="btn btn-primary mt-4 float-end">SAVE</button>
                            </div>
                            @csrf
                            @method('put')
                        </form>
                    </li>
                </ul>
            </div>
        </div>
    </div>
</div>
@endsection

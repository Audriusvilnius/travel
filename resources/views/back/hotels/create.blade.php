@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card shadow bg-body-tertiary rounded mt-2 d-flex">
                <div class="card-header">
                    <h1>Add new hotel</h1>
                </div>
                <div class="card-body ">
                    <form action="{{route('hotels-store')}}" method="post">
                        <div class="mb-3">
                            <h6>Hotel title</h6>
                            <input type="text" class="form-control" name="hotels_title" value="{{old('hotels_title')}}">
                        </div>
                        <div class="list-table__buttons m-3">
                            <button type="submit" class="btn btn-primary">ADD</button>
                        </div>
                        @csrf
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

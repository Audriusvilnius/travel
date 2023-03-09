@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header justify-content-center">

                    <h1>All hotels and offer qty.</h1>
                </div>
            </div>
            <div class="col-md-12 mt-3 shadow bg-body-tertiary rounded">
                @if(Session::has('ok'))
                <h6 class=" alert alert-success alert-dismissible fade show" role="alert">{{Session::get('ok')}}
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button></h6>
                @endif
            </div>
            <div class="col-md-12 mt-3 shadow bg-body-tertiary rounded">
                @if(Session::has('not'))
                <h6 class=" alert alert-danger alert-dismissible fade show" role="alert">{{Session::get('not')}}
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button></h6>
                @endif
            </div>

            <div class="card-body">
                <ul class="list-group ">
                    @forelse($hotels as $hotel)
                    <li id="{{ $hotel['id'] }}" class="list-group-item mt-2 row g-0 shadow bg-body-tertiary rounded">

                        <div class="list-table ">
                            <div class="list-table__content">
                                <h5>{{$hotel->title}}&ensp;<sup>({{$hotel->hotel_Country()->count()}})</sup></h5>

                            </div>
                            <div class="list-table__buttons">
                                <a href="{{route('hotels-edit', $hotel)}}" name="edit" value="{{$hotel->id}}" class="btn btn-success m-1">EDIT</a>

                                <form action="{{route('hotels-delete', $hotel)}}" method="post">
                                    <button type="submit" class="btn btn-danger mr-3">DELET</button>
                                    @csrf
                                    @method('delete')
                                </form>
                            </div>
                        </div>
                    </li>
                    @empty
                    <li class="list-group-item">No types yet</li>
                    @endforelse
                </ul>
            </div>
        </div>
    </div>
</div>
@endsection

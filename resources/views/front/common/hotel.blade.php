@inject('hotel', 'App\Services\HotelService')

<ul class="navbar-nav me-auto ">

    <div class="container ">
        <div class="row ">
            <li class="nav-item">

                <a id="navbarDropdown" class="btn btn-secondary dropdown-toggle bg-dark text-white container-fluid " href="#" role="button" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                    Hotels
                </a>
                <div class="dropdown-menu dropdown-menu-end bg-dark text-white container-fluid " aria-labelledby="navbarDropdown">

                    @forelse($hotel->get() as $hotel)
                    <div class="col-md-12 ">
                        <div class="card-body align-content-center">
                            <div class="modal-body align-items-center d-flex justify-content-center px-5">

                                <a class="list-group-item list-group-item-action " href="{{route('show-hotel-countrys',$hotel)}}">{{$hotel->title}} </a>
                            </div>
                        </div>
                    </div>

                    @empty
                    <h3 class="list-group-item">Hotel list empty</h3>
                    @endforelse
            </li>
        </div>
    </div>
</ul>

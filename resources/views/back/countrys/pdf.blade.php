<!DOCTYPE html>
<html lang="en">


<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">

    <title>Document</title>
    {{-- <style>
        img {
            height: 400px;
            width: auto;
        }

    </style> --}}
</head>

<body>
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card mt-2" style="max-width: 1wm;">
                <div class="row g-0 shadow p-3 bg-body-tertiary rounded">
                    <div class="col-md-12">
                        <div class="card-body">
                            <h1>{{$country->countryHotel_name->title}} information</h1>
                        </div>
                    </div>
                    <hr>
                    <div class="col-md-12">
                        <div class="card-body">
                            <h2>{{url()->previous()}}</h2>
                        </div>
                    </div>
                    <hr>
                    <div class="col-md-12">
                        <div class="card-body">
                            <h3>Hotel: <b><i>{{$country->countryHotel_name->title}}</b></i></h3>
                            <h3>Country: <b><i>{{$country->title}}</b></i></h3>
                            <h3>City: <b><i>{{$country->city}}</b></i></h3>
                            <h3>Season: <b><i>{{$country->start}}</b> to <b>{{$country->end}}</b></i></h3>
                            <h3>Time: <b><i>{{$country->lenght}} day</b></i></h3>
                            <h3>Price: <b><i>{{$country->price}} &euro;</b></i></h3>
                        </div>
                    </div>
                    <hr>
                    <div class="col-md-12">
                        <div class="card-body">
                            <p>{{$country->des}}</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>

</html>

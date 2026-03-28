<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>
        {{ Auth::user()->name }} - Communities
    </title>
    <link rel="icon" type="image/png" href="{{ asset('images/favicon.png') }}">

    <link href="{{ asset('css/bootstrap-5.3.8-dist/css/bootstrap.min.css') }}" rel="stylesheet">

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link
        href="https://fonts.googleapis.com/css2?family=Sansation:ital,wght@0,300;0,400;0,700;1,300;1,400;1,700&family=Zain:ital,wght@0,200;0,300;0,400;0,700;0,800;0,900;1,300;1,400&display=swap"
        rel="stylesheet">
    
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Audiowide&display=swap" rel="stylesheet">

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Oxanium:wght@200..800&display=swap" rel="stylesheet">

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">

    <link rel="stylesheet" href="{{ asset('css/user_wishlist.css') }}">
</head>

<body onload="showGarage()">
    @include("loader")
    <nav class="redirect_dashboard">
        <a href="/user">
            <span>Dashboard</span>
        </a>
        <a href="/cars/list">
            <span>Garage</span>
        </a>
        <a href="/">
            <span>Home</span>
        </a>
    </nav>

    <div class="garage">
        <div class="d-flex justify-content-center page-title">
            <h1>
                Communities
            </h1>
        </div>

        <section class="filter-review-brand">
            <div class="container d-flex justify-content-center">
                <h3 style="font-family: Audiowide;">Filter by brand</h3>
            </div>
            <div class="container d-flex">
                <form action="/communities/filter" method="GET">
                    @csrf
                    <div class="row g-3 mb-4">
                        <div class="mb-5">
                                <label class="mb-1" for="car_id">Select brand</label>
                                <select name="brand" id="car_id" class="form-control" required>
                                        @foreach($brands as $x)
                                            <option value="{{ $x->brand }}">
                                                    {{ $x->brand }}
                                            </option>
                                        @endforeach
                                </select>
                        </div>

                        <div class="d-flex justify-content-center mt-3">
                            <button type="submit" class="btn pt-2 pb-2 ps-3 pe-3 class submit_button">
                                Filter
                            </button>
                        </div>
                    </div>
                </form>
            </div>
        </section>

        <section class="cars">
            <div class="garage-container gap-5">
                @foreach($cars as $x)
                    <div class="card service_card span_card">
                        <img src="{{ asset($x->highlight->image_path) }}" class="card-img-top" alt="...">
                        <div class="card-body">
                            <h5 class="card-title fs-4">{{ $x->brand }} {{ $x->model }} </h5>
                        </div>

                        <div class="d-flex align-items-center p-3">
                            @if($rentedCarsID->contains($x->id))
                                <a href="/communities/{{ $x->slug }}" class="add_rent">
                                    <span>
                                        <i class="fa-solid fa-car"></i> Join room
                                    </span>
                                </a>
                            @else
                                    <h6>
                                        Please rent this vehicle or complete your tenure to unlock community facilities
                                    </h6>
                            @endif    
                        </div>
                    </div>
                @endforeach
            </div>
        </section>
    </div>

    <div class="d-flex justify-content-center pagination_container mt-5 mb-5">
        {{ $cars->links() }}
    </div>

    <script src="{{ asset('js/garage.js') }}"></script>
</body>
</html>
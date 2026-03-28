<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>
        {{ Auth::user()->name }}'s Garage
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
    <nav class="redirect_dashboard gap-5">
        <a href="/user">
            <span>Dashboard</span>
        </a>
        <a href="/communities">
            <span>Communities</span>
        </a>
        <a href="/">
            <span>Home</span>
        </a>
    </nav>

    <div class="garage">
        <div class="d-flex justify-content-center page-title">
            <h1>
                Garage
            </h1>
        </div>

        <section class="filter-review-brand">
            <div class="container d-flex justify-content-center">
                <h3 style="font-family: Audiowide;">Filter by brand</h3>
            </div>
            <div class="container d-flex">
                <form action="/cars/list/filter" method="GET">
                    @csrf
                    <div class="row g-3 mb-4">
                        <div class="mb-5">
                                <label class="mb-1" for="car_id">Select brand</label>
                                <select name="brand" id="car_id" class="form-control border-3" required>
                                        @foreach($allBrands as $x)
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
                @foreach($car as $x)
                    <div class="card service_card span_card">
                        <img src="{{ asset($x->highlight->image_path) }}" class="card-img-top" alt="...">
                        <div class="card-body">
                            <h5 class="card-title fs-4">{{ $x->brand }} {{ $x->model }} </h5>
                            <a href="#" class="d-inline-flex align-items-center gap-2">
                                ₹{{ $x->rent_price }} / day
                            </a>
                        </div>

                        <div class="specs-container">
                            <div>
                                <div class="card-body" style="background-color:inherit;">
                                    <p>
                                        Number of seats : {{ $x->seating }}
                                        <br><br>
                                        Boot space, seats up : {{ $x->bootspace }}
                                        <br><br>
                                        Exterior dimensions (L x W x H) : {{ $x->exterior_dimensions }}
                                        <br><br>
                                        Available fuel types : {{ $x->fuel_type }}
                                        <br><br>
                                        Fuel economy : {{ $x->fuel_economy }}
                                    </p>
                                </div>
                            </div>
                        </div>

                        <div class="d-flex align-items-center">
                            @if($rentedCars->contains($x->id))
                                <!--<form action="/my-orders" method="POST">
                                    @csrf
                                    <input type="hidden" value="{{ $x->id }}" name="car_id_number">
                                    <button class="return_car">
                                        <span>
                                            <i class="fa-solid fa-rotate-left"></i> Cancel
                                        </span>
                                    </button>
                                </form>-->
                                <a href="/my-orders" class="ps-3">
                                    <span>
                                        <i class="fa-solid fa-car"></i> Check in Orders
                                    </span>
                                </a>
                            @else
                                <form action="/rent-vehicle" method="GET">
                                    @csrf
                                    <input type="hidden" value="{{ $x->id }}" name="car_id_number">
                                    <button class="add_rent">
                                        <span>
                                            <i class="fa-solid fa-receipt"></i> Rent
                                        </span>
                                    </button>
                                </form>
                            @endif
                            
                            @if($wishlistedCars->contains($x->id))
                                <form action="/remove-user-wishlist" method="POST">
                                    @csrf
                                    <input type="hidden" value="{{ $x->id }}" name="car_id_number">
                                    <button class="remove_wishlist">
                                        <span>
                                            <i class="fa-solid fa-heart-circle-minus text-danger"></i> Remove from wishlist
                                        </span>
                                    </button>   
                                </form>
                            @else
                                <form action="/add-user-wishlist" method="POST">
                                    @csrf
                                    <input type="hidden" value="{{ $x->id }}" name="car_id_number">
                                    <button class="add_wishlist">
                                        <span>
                                            <i class="fa-solid fa-heart-circle-plus"></i> Add to wishlist
                                        </span>
                                    </button>
                                </form>
                            @endif  
                        </div>
                    </div>
                @endforeach
            </div>
        </section>
    </div>

    <div class="d-flex justify-content-center pagination_container mt-5 mb-5">
        {{ $car->links() }}
    </div>

    <script src="{{ asset('js/garage.js') }}"></script>
</body>
</html>
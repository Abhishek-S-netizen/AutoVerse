<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $car->brand }} {{ $car->model }} Review</title>
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

    <link rel="stylesheet" href="{{ asset('css/car_review.css') }}">
</head>

<body>
    @include("loader")
    <header>
        <div id="title_container" class="container d-flex title_container">
            <h1 id="title">
                <span class="fs-6 d-flex gap-5 p-0 redirect_links">
                    <a href="/">Home</a>
                    <a href="/reviews">All Reviews</a>
                    <a href="/electric-cars">EVs</a>
                    <a href="/comparisons">Comparisons</a>

                    @guest
                        <a href="/signup">Login</a>
                    @endguest

                    @auth
                        <a href="/user">Dashboard</a>
                    @endauth
                </span>
                <span style="color:#38C498;" class="fs-2">AutoVerse</span>
                <br>
                {{ $car->brand }} {{ $car->model }}
            </h1>
        </div>
    </header>

    <section id="hero_image_section">
        <div id="hero_image_container" class="container d-flex justify-content-around gap-5">
            <div>
                <img id="hero_image" src="{{ asset($carDetail->hero_image) }}" alt="{{ $car->brand }} {{ $car->model }}">
            </div>

            <div id="car_meta_info" class="container d-flex flex-column gap-4">
                <div id="car_rating" class="card meta_card" style="width: 18rem;">
                    <div class="card-body">
                        <p class="card-text">
                            @for($i = 0; $i < $carDetail->rating; $i++)
                                <i style="color:#38C498" class="fa-solid fa-star"></i>
                            @endfor
                            <br><br><br>
                            Rent Price : ₹{{ $car->rent_price }}
                        </p>
                    </div>
                </div>

                <div class="card meta_card">
                        <div class="card-body">
                        @guest
                            <a href="/signup" class="login_link">
                                <span>Login to add to wishlist</span>
                            </a>
                        @endguest

                        @auth 
                            @if($wishlistID->contains($car->id))
                                <form action="/remove-user-wishlist" method="POST">
                                    @csrf
                                    <input type="hidden" value="{{ $car->id }}" name="car_id_number">
                                    <button class="remove_wishlist">
                                        <span>
                                            <i class="fa-solid fa-heart text-danger"></i> Remove from wishlist
                                        </span>
                                    </button>   
                                </form>
                            @else
                                <form action="/add-user-wishlist" method="POST">
                                    @csrf
                                    <input type="hidden" value="{{ $car->id }}" name="car_id_number">
                                    <button class="add_wishlist">
                                        <span>
                                            <i class="fa-solid fa-heart-circle-plus"></i> Add to wishlist
                                        </span>
                                    </button>
                                </form>
                            @endif
                        @endauth  
                    </div>
                    <div class="specs-container ms-3 mt-5">
                        <p class="d-inline-flex gap-3">
                            <a class="btn spec_button feature_spec_button" data-bs-toggle="collapse" href="#collapseExample" role="button" aria-expanded="false" aria-controls="collapseExample">
                            <span>Show specifications</span>
                            </a>
                        </p>
                        <div class="collapse" id="collapseExample">
                            <div class="card card-body" style="background-color:inherit;">
                                <p>
                                    Number of seats : {{ $car->seating }}
                                    <br><br>
                                    Boot space, seats up : {{ $car->bootspace }}
                                    <br><br>
                                    Exterior dimensions (L x W x H) : {{ $car->exterior_dimensions }}
                                    <br><br>
                                    Available fuel types : {{ $car->fuel_type }}
                                    <br><br>
                                    Fuel economy : {{ $car->fuel_economy }}
                                </p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <section id="intro" class="">
        <div class="container d-flex">
            <h1 id="intro_title" style="font-family: Audiowide;">
                Is the {{ $car->brand }} {{ $car->model }} a good car?
            </h1>
        </div>
        
        <div class="container d-flex">
            <p class="fs-5" style="font-family: Oxanium;">
                {!! nl2br(e($carDetail->intro_text)) !!}
            </p>
        </div>
    </section>

    <section id="interior" class="">
        <div class="container d-flex">
            <h1 style="font-family: Audiowide;">
                Interior style and infotainment 
            </h1>
        </div>

        <div id="infotainment_image" class="container d-flex mt-3   ">
            <img src="{{ asset($carDetail->interior_image) }}" alt="Interior">
        </div>
        
        <div class="container d-flex mt-5">
            <p class="fs-5">
                {!! nl2br(e($carDetail->interior_text)) !!}
            </p>
        </div>
    </section>

    <section id="drive" class="">
        <div class="container d-flex">
            <h1 id="intro_title" style="font-family: Audiowide;">
                Performance and drive comfort
            </h1>
        </div>

        <div id="infotainment_image" class="container d-flex mt-3   ">
            <img src="{{ asset($carDetail->drive_image) }}" alt="Drive">
        </div>
        
        <div class="container d-flex mt-5">
            <p class="fs-5">
                {!! nl2br(e($carDetail->drive_text)) !!}.
            </p>
        </div>
    </section>

    <section id="safety" class="">
        <div class="container d-flex">
            <h1 id="intro_title" style="font-family: Audiowide;">
                Safety and security
            </h1>
        </div>
        
        <div class="container d-flex">
            <p class="fs-5">
                {!! nl2br(e($carDetail->safety_text)) !!}
            </p>
        </div>
    </section>

    <footer>
        <div class="d-flex gap-4 mt-3 justify-content-between">
            <div class="d-flex gap-4">
                <a href="/reviews">Reviews</a>
                <a href="/electric-cars">EVs</a>
                <a href="/comparisons">Comparisons</a>
                <a href="/signup">Login</a>
                <a href="#" class="text-decoration-none">
                    Back to top
                </a>
            </div>
        </div>

        <div class="mt-5 justify-content-between">
            <div class="d-flex gap-5">
                <a href="#">Privacy Policy</a>
                <a href="#">Terms of Service</a>
                <a href="#">Cookie Policy</a>
            </div>
        </div>

        <div class='d-flex flex-wrap mt-5 justify-content-between'>
            <div>
                <h6><strong>Contact and follow us : </strong></h6>
                <div class="d-flex flex-wrap gap-5">
                    <h6><i class="fa-solid fa-envelope"></i> Email : autoverse@gmail.com</h6>
                    <h6><i class="fa-solid fa-phone"></i> Phone : 8756438902</h6>
                    <a href="https://www.instagram.com/"><i class="fa-brands fa-instagram"></i> Instagram</a>
                    <a href="https://in.linkedin.com/"><i class="fa-brands fa-linkedin"></i> LinkedIn</a>
                    <a href="https://www.youtube.com/"><i class="fa-brands fa-youtube"></i> YouTube</a>
                </div>
            </div>
        </div>

        <div class="d-flex justify-content-between mt-5">
            <h6>
                 <i class="fa-solid fa-copyright"></i> AutoVerse Ltd. All Rights Reserved | Developed by Abhishek Subramanian</h6>
        </div>
    </footer>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.min.js"
        integrity="sha384-G/EV+4j2dNv+tEPo3++6LCgdCROaejBqfUeNjuKAiuXbjrxilcCdDz6ZAVfHWe1Y"
        crossorigin="anonymous"></script>
</body>

</html>
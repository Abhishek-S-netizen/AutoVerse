<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>
        Rent {{ $car->brand }} {{ $car->model}}
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

    <link rel="stylesheet" href="{{ asset('css/rent_car.css') }}">
</head>

<body>
    @if(session('success'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            {{ session('success') }}
        <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        </div>
    @endif

    <header>
        <div id="title_container" class="container d-flex">
            <h1 id="title">
                <span class="fs-6 d-flex gap-5 p-0 redirect_links">
                    <a href="/user">Back to dashboard</a>
                </span>
                <span style="color:#38C498;" class="fs-2">AutoVerse</span>
                <br>
                Rent {{ $car->brand }} {{ $car->model }}
            </h1>
        </div>
    </header>

    <section class="comparison">
        <div class="container d-flex flex-column gap-5 comparison_card">

            <div class="d-flex gap-5 introduction">
                <div class="container d-flex">
                    <img src="{{ asset($car->highlight->image_path) }}" alt="">
                </div>
                <div class="container d-flex flex-column pros_and_cons gap-4">
                    <div>
                        <h5 class="text-white">What's good</h5>
                        <p style="color:#16A34A;">
                            <i class="fa-solid fa-circle-plus"></i> {{ $car->highlight->pro_1 }}
                            <br>
                            <i class="fa-solid fa-circle-plus"></i> {{ $car->highlight->pro_2 }}
                            <br>
                            <i class="fa-solid fa-circle-plus"></i> {{ $car->highlight->pro_3 }}
                        </p>
                    </div>
                    <div>
                        <h5 class="text-white">What's bad</h5>
                        <p class="text-danger">
                            <i class="fa-solid fa-circle-minus"></i> {{ $car->highlight->con_1 }}
                            <br>
                            <i class="fa-solid fa-circle-minus"></i> {{ $car->highlight->con_2 }}
                            <br>
                            <i class="fa-solid fa-circle-minus"></i> {{ $car->highlight->con_3 }}
                        </p>
                    </div>
                </div>
            </div>
            <hr>
            <div class="d-flex flex-column gap-5 compare_content">
                <div class="container d-flex flex-column">
                    <h2 class="ms-5">{{ $car->brand }} {{ $car->model }}</h2>
                    <a href="/reviews/{{ $car->slug }}" class="ms-5 review-links">
                    Check out the review <i class="fa-solid fa-arrow-up-right-from-square fs-6"></i>
                </a>
                </div>

                <div class="container d-flex content">
                    <h5 class="ms-5">
                        <strong>Best for : </strong> {{ $car->highlight->best_for }}
                        <br><br>
                        {{ $car->highlight->key_features }}
                    </h5>
                </div>
            </div>

            <div class="container d-flex">
                <div class="specs-container">
                    <p class="d-inline-flex gap-3">
                        <a class="btn spec_button feature_spec_button" data-bs-toggle="collapse" href="#collapseSpecsOne" role="button" aria-expanded="false" aria-controls="collapseSpecsOne">
                        <span>Show specifications</span>
                        </a>
                    </p>
                    <div class="collapse" id="collapseSpecsOne">
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

                <div class="specs-container">
                    <p class="d-inline-flex gap-3">
                        <a class="btn spec_button feature_spec_button" data-bs-toggle="collapse" href="#collapseFeaturesOne" role="button" aria-expanded="false" aria-controls="collapseFeaturesOne">
                        <span>Show key features</span>
                        </a>
                    </p>
                    <div class="collapse" id="collapseFeaturesOne">
                        <div class="card card-body" style="background-color:inherit;">
                            <p>
                                {{ $car->highlight->feature_1 }}
                                <br><br>
                                {{ $car->highlight->feature_2 }}
                                <br><br>
                                {{ $car->highlight->feature_3 }}
                                <br><br>
                                {{ $car->highlight->feature_4 }}
                                <br><br>
                                {{ $car->highlight->feature_5 }}
                                <br><br>
                                {{ $car->highlight->feature_6 }}
                                <br><br>
                                {{ $car->highlight->feature_7 }}
                                <br><br>
                                {{ $car->highlight->feature_8 }}
                                <br><br>
                                {{ $car->highlight->feature_9 }}
                                <br><br>
                                {{ $car->highlight->feature_10 }}
                            </p>
                        </div>
                    </div>
                </div>
            </div>

            <div class="container d-flex flex-column gap-5 review-links">
                 @if(session('error'))
                    <div class="alert alert-danger alert-dismissible fade show">
                        {{ session('error') }}
                        <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                    </div>
                @endif
                <form action="/confirm-rent" method="POST" class="ms-5 confirm-rent-vehicle">
                    @csrf
                    <input name="car_id_rent" type="hidden" value="{{ $car->id }}">
                    <div>
                    <label for="start">Start date</label>
                    <br>
                    <input type="date" name="start_date" id="start">
                    </div>

                    <div>
                    <label for="end">End date</label>
                    <br>
                    <input type="date" name="end_date" id="end">
                    </div>

                    <div>
                        <label for="delivery_point">Enter delivery point</label>
                        <br>
                        <input type="text" id="delivery_point" name="delivery_location" placeholder="Eg: Bangalore">
                    </div>
                    <button class="p-2">
                        <span>Confirm and proceed</span>
                    </button>
                </form>
            </div>
        </div>
    </section>

    <footer>
       <!--- <div class="container d-flex logo">
            <img src="{{ asset('images/AutoVerse_Logo.png') }}" alt="">
        </div> 
        <div class="container d-flex name_logo">
            <img src="{{ asset('images/AutoVerse_Logo.png') }}" alt="">
            <h3>
                AutoVerse
            </h3>
        </div> -->

        <div class="container d-flex gap-4 mt-3 justify-content-between">
            <div class="d-flex gap-4">
                <a href="/">Home</a>
                <a href="/reviews">Reviews</a>
                <a href="/electric-cars">EVs</a>
                <a href="/comparisons">Comparisons</a>
                <a href="/signup">Login</a>
                <a href="#" class="text-decoration-none">
                    Back to top
                </a>
            </div>
            <div class="d-flex gap-5">
                <a href="#">Privacy Policy</a>
                <a href="#">Terms of Service</a>
                <a href="#">Cookie Policy</a>
            </div>
        </div>

        <div class='container d-flex mt-5 justify-content-between'>
            <div>
                <h6><strong>Contact us : </strong></h6>
                <div class="d-flex gap-5">
                    <h6><i class="fa-solid fa-envelope"></i> Email : autoverse@gmail.com</h6>
                    <h6><i class="fa-solid fa-phone"></i> Phone : 8756438902</h6>
                </div>
            </div>

            <div>
                <h6><strong>Follow us on : </strong></h6>
                <div class="d-flex gap-5">
                    <a href="#"><i class="fa-brands fa-instagram"></i> Instagram</a>
                    <a href="#"><i class="fa-brands fa-linkedin"></i> LinkedIn</a>
                    <a href="#"><i class="fa-brands fa-youtube"></i> YouTube</a>
                </div>
            </div>
        </div>

        <div class="container d-flex justify-content-between mt-5">
            <h6>Developed by Abhishek Subramanian</h6>
            <h6>
                <i class="fa-solid fa-copyright"></i> AutoVerse Ltd. All Rights Reserved
            </h6>
        </div>
    </footer>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.min.js"
        integrity="sha384-G/EV+4j2dNv+tEPo3++6LCgdCROaejBqfUeNjuKAiuXbjrxilcCdDz6ZAVfHWe1Y"
        crossorigin="anonymous"></script>
</body>

</html>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>
        {{ $carOne->brand }} {{ $carOne->model}} vs {{ $carTwo->brand }} {{ $carTwo->model }}
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

    <link rel="stylesheet" href="{{ asset('css/compare_car.css') }}">
</head>

<body>
    @include("loader")
    <header>
        <div id="title_container" class="container d-flex">
            <h1 id="title">
                <span class="fs-6 d-flex gap-5 p-0 mb-4 redirect_links">
                    <a href="/">Home</a>
                    <a href="/reviews">All Reviews</a>
                    <a href="/electric-cars">EVs</a>
                    <a href="/comparisons">Comparisons</a>
                    @guest 
                        <a href="/signup">
                            <span>Login / Sign Up</span>
                        </a>
                    @endguest

                    @auth
                        <a href="/user">
                            <span>Dashboard</span>
                        </a>
                    @endauth
                </span>
                <span style="color:#38C498;" class="fs-2">AutoVerse</span>
                <br>
                <span>{{ $comparison->name }}</span>
            </h1>
        </div>
    </header>

    <section class="comparison">
        <div class="container d-flex flex-column gap-5 comparison_card">

            <div class="d-flex gap-5 introduction">
                <div class="container d-flex">
                    <img src="{{ asset($carOne->highlight->image_path) }}" alt="">
                </div>
                <div class="container d-flex flex-column pros_and_cons gap-4">
                    <div>
                        <h5 class="text-white">What's good</h5>
                        <p style="color:#16A34A;">
                            <i class="fa-solid fa-circle-plus"></i> {{ $carOne->highlight->pro_1 }}
                            <br>
                            <i class="fa-solid fa-circle-plus"></i> {{ $carOne->highlight->pro_2 }}
                            <br>
                            <i class="fa-solid fa-circle-plus"></i> {{ $carOne->highlight->pro_3 }}
                        </p>
                    </div>
                    <div>
                        <h5 class="text-white">What's bad</h5>
                        <p class="text-danger">
                            <i class="fa-solid fa-circle-minus"></i> {{ $carOne->highlight->con_1 }}
                            <br>
                            <i class="fa-solid fa-circle-minus"></i> {{ $carOne->highlight->con_2 }}
                            <br>
                            <i class="fa-solid fa-circle-minus"></i> {{ $carOne->highlight->con_3 }}
                        </p>
                    </div>
                </div>
            </div>
            <hr>
            <div class="d-flex flex-column gap-5 compare_content">
                <div class="container d-flex">
                    <h2 class="ms-5">{{ $carOne->brand }} {{ $carOne->model }}</h2>
                </div>

                <div class="container d-flex content">
                    <h5 class="ms-5">
                        <strong>Rating : </strong>{{ $carOne->carDetail->rating }} / 5
                        <br><br>
                        <strong>Best for : </strong> {{ $carOne->highlight->best_for }}
                        <br><br>
                        {{ $carOne->highlight->key_features }}
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
                                Number of seats : {{ $carOne->seating }}
                                <br><br>
                                Boot space, seats up : {{ $carOne->bootspace }}
                                <br><br>
                                Exterior dimensions (L x W x H) : {{ $carOne->exterior_dimensions }}
                                <br><br>
                                Available fuel types : {{ $carOne->fuel_type }}
                                <br><br>
                                Fuel economy : {{ $carOne->fuel_economy }}
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
                                {{ $carOne->highlight->feature_1 }}
                                <br><br>
                                {{ $carOne->highlight->feature_2 }}
                                <br><br>
                                {{ $carOne->highlight->feature_3 }}
                                <br><br>
                                {{ $carOne->highlight->feature_4 }}
                                <br><br>
                                {{ $carOne->highlight->feature_5 }}
                                <br><br>
                                {{ $carOne->highlight->feature_6 }}
                                <br><br>
                                {{ $carOne->highlight->feature_7 }}
                                <br><br>
                                {{ $carOne->highlight->feature_8 }}
                                <br><br>
                                {{ $carOne->highlight->feature_9 }}
                                <br><br>
                                {{ $carOne->highlight->feature_10 }}
                            </p>
                        </div>
                    </div>
                </div>
            </div>
        </div>


        <div class="container d-flex flex-column gap-5 comparison_card">

            <div class="d-flex gap-5 introduction">
                <div class="container d-flex">
                    <img src="{{ asset($carTwo->highlight->image_path) }}" alt="">
                </div>
                <div class="container d-flex flex-column pros_and_cons gap-4">
                    <div>
                        <h5 class="text-white">What's good</h5>
                        <p style="color:#16A34A;">
                            <i class="fa-solid fa-circle-plus"></i> {{ $carTwo->highlight->pro_1 }}
                            <br>
                            <i class="fa-solid fa-circle-plus"></i> {{ $carTwo->highlight->pro_2 }}
                            <br>
                            <i class="fa-solid fa-circle-plus"></i> {{ $carTwo->highlight->pro_3 }}
                        </p>
                    </div>
                    <div>
                        <h5 class="text-white">What's bad</h5>
                        <p class="text-danger">
                            <i class="fa-solid fa-circle-minus"></i> {{ $carTwo->highlight->con_1 }}
                            <br>
                            <i class="fa-solid fa-circle-minus"></i> {{ $carTwo->highlight->con_2 }}
                            <br>
                            <i class="fa-solid fa-circle-minus"></i> {{ $carTwo->highlight->con_3 }}
                        </p>
                    </div>
                </div>
            </div>
            <hr>
            <div class="d-flex flex-column gap-5 compare_content">
                <div class="container d-flex">
                    <h2 class="ms-5">{{ $carTwo->brand }} {{ $carTwo->model }}</h2>
                </div>

                <div class="container d-flex content">
                    <h5 class="ms-5">
                        <strong>Rating : </strong>{{ $carTwo->carDetail->rating }} / 5
                        <br><br>
                        <strong>Best for : </strong> {{ $carTwo->highlight->best_for }}
                        <br><br>
                        {{ $carTwo->highlight->key_features }}
                    </h5>
                </div>
            </div>

            

            <div class="container d-flex">
                <div class="specs-container">
                    <p class="d-inline-flex gap-3">
                        <a class="btn spec_button feature_spec_button" data-bs-toggle="collapse" href="#collapseSpecsTwo" role="button" aria-expanded="false" aria-controls="collapseSpecsTwo">
                        <span>Show specifications</span>
                        </a>
                    </p>
                    <div class="collapse" id="collapseSpecsTwo">
                        <div class="card card-body" style="background-color:inherit;">
                            <p>
                                Number of seats : {{ $carTwo->seating }}
                                <br><br>
                                Boot space, seats up : {{ $carTwo->bootspace }}
                                <br><br>
                                Exterior dimensions (L x W x H) : {{ $carTwo->exterior_dimensions }}
                                <br><br>
                                Available fuel types : {{ $carTwo->fuel_type }}
                                <br><br>
                                Fuel economy : {{ $carTwo->fuel_economy }}
                            </p>
                        </div>
                    </div>
                </div>

                <div class="specs-container">
                    <p class="d-inline-flex gap-3">
                        <a class="btn spec_button feature_spec_button" data-bs-toggle="collapse" href="#collapseFeaturesTwo" role="button" aria-expanded="false" aria-controls="collapseFeaturesTwo">
                        <span>Show key features</span>
                        </a>
                    </p>
                    <div class="collapse" id="collapseFeaturesTwo">
                        <div class="card card-body" style="background-color:inherit;">
                            <p>
                                {{ $carTwo->highlight->feature_1 }}
                                <br><br>
                                {{ $carTwo->highlight->feature_2 }}
                                <br><br>
                                {{ $carTwo->highlight->feature_3 }}
                                <br><br>
                                {{ $carTwo->highlight->feature_4 }}
                                <br><br>
                                {{ $carTwo->highlight->feature_5 }}
                                <br><br>
                                {{ $carTwo->highlight->feature_6 }}
                                <br><br>
                                {{ $carTwo->highlight->feature_7 }}
                                <br><br>
                                {{ $carTwo->highlight->feature_8 }}
                                <br><br>
                                {{ $carTwo->highlight->feature_9 }}
                                <br><br>
                                {{ $carTwo->highlight->feature_10 }}
                            </p>
                        </div>
                    </div>
                </div>
            </div>
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
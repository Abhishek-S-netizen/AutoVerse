<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>AutoVerse - Comparisons</title>
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

    <link rel="stylesheet" href="{{ asset('css/all_comparisons.css') }}">
</head>

<body onload="animateIntro()">
    <nav class="justify-content-center navbar_custom" data-bs-theme="dark">
        <a href="/">
            <span>Home</span>
        </a>
        <a href="/signup">
            <span>Rent a car</span>
        </a>
        <a href="/reviews">
            <span>All reviews</span>
        </a>
    </nav>

    <header id="home">
        <div class="landing_page" style="background-image: url('{{ asset('images/mountain_electric.jpg') }}')">
            <img class="one" src="{{ asset('images\BMW.png') }}" alt="">
            <img class="two" src="{{ asset('images\Volvo.png') }}" alt="">
            <img class="three" src="{{ asset('images\VQ.png') }}" alt="">

            <div class="d-flex landing_title">
                <h1 style="color:#38C498">
                    COMPARE CARS
                </h1>
            </div>
        </div>

        <div class="tagline d-flex justify-content-center">
            <a href="/reviews" class="text-center">
                <h3>
                    <i class="fa-solid fa-layer-group"></i> Click to browse all reviews
                </h3>
            </a>
        </div>
    </header>

    <section class="select_custom_comparison">
        <div class="d-flex title_phone justify-content-center">
            <h1 style="font-family: Audiowide;">Custom comparison</h1>
        </div>
        <div class="d-flex justify-content-center">
            <form action="/custom-comparison" method="GET">
                                @csrf

                <div class="row g-3 mb-4">
                    <div class="mb-5">
                            <label for="car_id">Select first car</label>
                            <select name="firstCar" id="car_id" class="form-control" required>
                                    @foreach($car as $x)
                                        <option value="{{ $x->id }}">
                                                {{ $x->brand }} {{ $x->model }} ({{ $x->year }})
                                        </option>
                                    @endforeach
                            </select>
                    </div>

                    <div class="mb-5">
                            <label for="car_id">Select second car</label>
                            <select name="secondCar" id="car_id" class="form-control" required>
                                    @foreach($car as $x)
                                        <option value="{{ $x->id }}">
                                                {{ $x->brand }} {{ $x->model }} ({{ $x->year }})
                                        </option>
                                    @endforeach
                            </select>
                    </div>

                    <div class="d-flex justify-content-center mt-3">
                        <button type="submit" class="btn px-4 class submit_button">
                            Compare
                        </button>
                    </div>
                </div>
            </form>
        </div>
    </section>

    <section class="comparison_section">
        <div class="d-flex flex-wrap justify-content-center gap-5">

        @foreach($comparison as $element)    
            <a href="{{ url('/comparisons/'.$element->slug) }}" class="comparison_card_link mt-5 mb-5">
                <div class="container d-flex comparison_card">
                    <div class="d-flex flex-column compare_car">
                        <div class="d-flex">
                            <img src="{{ asset($element->car1->highlight->image_path) }}" alt="">
                        </div>

                        <div class="container d-flex car_name">
                            <h5>{{ $element->car1->brand }} {{ $element->car1->model }}</h5>
                        </div>
                    </div>

                    <div class="d-flex flex-column compare_car">
                        <div class="d-flex">
                            <img src="{{ asset($element->car2->highlight->image_path) }}" alt="">
                        </div>

                        <div class="container d-flex car_name">
                            <h5>{{ $element->car2->brand }} {{ $element->car2->model }}</h5>
                        </div>
                    </div>
                </div>
            </a>
        @endforeach
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

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js" integrity="sha384-FKyoEForCGlyvwx9Hj09JcYn3nv7wiPVlz7YYwJrWVcXK/BmnVDxM+D2scQbITxI" crossorigin="anonymous"></script>

    <script src="{{ asset('js\all_comparisons.js') }}"></script>
</body>
</html>
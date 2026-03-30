<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Autoverse - Reviews</title>
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

    <link rel="stylesheet" href="{{ asset('css/reviews.css') }}">
</head>

<body onload="showReviews()">
    <nav class="all-reviews-navbar">
        <a href="/">Home</a>
        <a href="/electric-cars">EVs</a>
        <a href="/comparisons">Comparisons</a>
        <a href="/user">Rent a car</a>
    </nav>
    <div class="filter-form-wrapper pt-5">
        <section class="filter-review-brand">
            <div class="d-flex justify-content-center">
                <h1 style="font-family: Audiowide;">Filter reviews by brand</h1>
            </div>
            <div class="d-flex justify-content-center">
                <form action="/filter-reviews" method="GET">
                    @csrf

                    <div class="row g-3 mb-4">
                        <div class="mb-3">
                                <select name="brand" id="car_id" class="form-control mt-4" required>
                                        @foreach($allBrands as $x)
                                            <option value="{{ $x->brand }}">
                                                    {{ $x->brand }}
                                            </option>
                                        @endforeach
                                </select>
                        </div>

                        <div class="d-flex justify-content-center">
                            <button type="submit" class="btn pt-2 pb-2 ps-3 pe-3 class submit_button">
                                Filter
                            </button>
                        </div>
                    </div>
                </form>
            </div>
        </section>
    </div>

    <div class="all-reviews-wrapper">
        <section class="reviews">
            <div class="reviews-container gap-5">

                @foreach($cars as $x)
                    <div class="card service_card mb-4">

                        <img src="{{ asset($x->carDetail->hero_image) }}" class="card-img-top" alt="{{ $x->brand }} {{ $x->model }}">

                        <div class="card-body">
                            <h5 class="card-title fs-4">{{ $x->brand }} {{ $x->model }}</h5>

                            <a href="{{ url('/reviews/'.$x->slug) }}" class="d-inline-flex align-items-center gap-2">
                                Review <i class="fa-solid fa-arrow-right-long"></i>
                            </a>
                        </div>
                    </div>
                @endforeach
            </div>
        </section>

        <div class="d-flex justify-content-center pagination_container">
            {{ $cars->links() }}
        </div>
    </div>
    
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

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js" integrity="sha384-FKyoEForCGlyvwx9Hj09JcYn3nv7wiPVlz7YYwJrWVcXK/BmnVDxM+D2scQbITxI" crossorigin="anonymous"></script>

    <script src="{{ asset('js\all_reviews.js') }}"></script>
</body>
</html>
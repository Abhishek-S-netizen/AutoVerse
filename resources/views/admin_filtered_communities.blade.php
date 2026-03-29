<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>
        {{ $brand }} - Communities
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
        <a href="/admin">
            <span>Dashboard</span>
        </a>
        <a href="/admin-all-communities">
            <span>All communties</span>
        </a>
    </nav>

    <div class="garage">
        <div class="d-flex justify-content-center page-title">
            <h1>
                {{ $brand }} - Communities
            </h1>
        </div>

        <section class="cars">
            <div class="garage-container gap-5">
                @foreach($cars as $x)
                    <div class="card service_card span_card">
                        <img src="{{ asset($x->highlight->image_path) }}" class="card-img-top" alt="...">
                        <div class="card-body">
                            <h5 class="card-title fs-4">{{ $x->brand }} {{ $x->model }} </h5>
                            <a href="/admin-all-communities/{{ $x->slug }}" class="mt-5">
                                <span>
                                    <i class="fa-solid fa-car"></i> Join room
                                </span>
                            </a>
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
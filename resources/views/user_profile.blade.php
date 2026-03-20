<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>
        {{ $user->name }}'s Profile
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

    <link rel="stylesheet" href="{{ asset('css/user_profile.css') }}">
</head>
<body onload="showGarage()">
    @include("loader")
    <nav class="redirect_dashboard">
        <a href="/user">
            <span>Back to dashboard</span>
        </a>
    </nav>

    <div class="garage">
        <div class="d-flex justify-content-center align-items-center page-title flex-column gap-3">
            <h1>
                {{ $user->name }} 
            </h1>
            <a href="mailto:{{ $user->email }}" style="font-family:Oxanium;">{{ $user->email }}</a>
        </div>

        <div class='container mt-5' style="font-family:Oxanium">
            <h2>{{ $user->name }} has driven</h2>
        </div>

        <section class="cars">
            <div class="container d-flex flex-wrap gap-5">
                @foreach($cars as $x)
                    <div class="card service_card span_card">
                        <img src="{{ asset($x->highlight->image_path) }}" class="card-img-top w-75" alt="...">
                        <div class="card-body">
                            <h5 class="card-title fs-4">{{ $x->brand }} {{ $x->model }} </h5>
                            <a href="#" class="d-inline-flex align-items-center gap-2">
                                ₹{{ $x->rent_price }} / day
                            </a>
                        </div>
                    </div>
                @endforeach
            </div>
        </section>
    </div>

    <script src="{{ asset('js/garage.js') }}"></script>
</body>
</html>
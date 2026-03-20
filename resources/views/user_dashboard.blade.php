<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>
        {{ Auth::user()->name }}'s Dashboard
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

    <link rel="stylesheet" href="{{ asset('css/user.css') }}">
</head>
<body data-userid="{{ Auth::user()->id }}">
    @if(session('success'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            {{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        </div>
    @endif

    @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <div class="page-loader">
        <div class="parallax" style="background-image:url('{{ asset('user_dashboard_parallax.jpg') }}')">
        </div>
        <div class="loading-page">
            <div class="page-loader-wrapper">
                <div class="page-loader-container">
                    <img id="loading-image" src="{{ asset('images/Porsche_911.avif') }}" alt="">
                </div>
            </div>

            <div class="d-flex justify-content-center">
                <h1 id="loading-title">
                    Hello {{ Auth::user()->name }}
                </h1>
            </div>

            <div class="d-flex justify-content-center mt-5">
                <h5 id="loading-message">
                    Loading dashboard...
                </h5>
            </div>
        </div>
    </div>

    <div class="dashboard-content">
        <div class="nav_custom">
            <nav class="navbar_custom">
                <h2>AutoVerse</h2>
                <span id="clock" class="fs-5"></span>
                <a href="/">
                    <span><i class="fa-solid fa-house fs-6"></i> Home</span>
                </a>
                <a href="/cars/list">
                    <span><i class="fa-solid fa-warehouse"></i> Garage</span>
                </a>    
                <a href="/communities">
                    <span><i class="fa-solid fa-comments"></i> Communities</span>
                </a>
                <form method="POST" action="{{ route('logout') }}">
                    @csrf
                    <button type="submit">
                        <span>
                            <i class="fa-solid fa-right-from-bracket"></i> Logout
                        </span>
                    </button>
                </form>
            </nav>

            <nav class="welcome_nav">
                <h2>
                    Welcome, {{ Auth::user()->name }}
                </h2>
            </nav>
        </div>

        <section class="user_functions_section">
            <div class="user_functions_div">
                <div class="container d-flex flex-column gap-5 wishlist_card">
                    <div class="container d-flex">
                        <h2 class="card_title"> <i class="fa-solid fa-heart"></i> Wishlist</h2>
                    </div>

                    <div class="container d-flex flex-column">
                        <h3>
                            {{ $wishlistCount }} <span class="fs-5">car(s) wishlisted</span>
                        </h3>
                        
                        <a class="icon-link icon-link-hover" href="/my-wishlist">
                            View wishlisted cars
                            <svg xmlns="http://www.w3.org/2000/svg" class="bi" viewBox="0 0 16 16" aria-hidden="true">
                                <path d="M1 8a.5.5 0 0 1 .5-.5h11.793l-3.147-3.146a.5.5 0 0 1 .708-.708l4 4a.5.5 0 0 1 0 .708l-4 4a.5.5 0 0 1-.708-.708L13.293 8.5H1.5A.5.5 0 0 1 1 8z"/>
                            </svg>
                        </a>
                    </div>
                </div>

                <div class="container d-flex flex-column gap-5 order_card">
                    <div class="container d-flex">
                        <h2 class="card_title"> <i class="fa-solid fa-hourglass-half"></i> Orders</h2>
                    </div>

                    <div class="container d-flex flex-column">
                        <h3>
                            {{ $rentedCountCurrent }} <span class="fs-5"> current order(s)</span>,    {{ $rentedCountPast }} <span class="fs-5">past order(s)</span>
                        </h3>

                        <div class="d-flex gap-5">
                            <a class="icon-link icon-link-hover" href="my-orders">
                                View current
                                <svg xmlns="http://www.w3.org/2000/svg" class="bi" viewBox="0 0 16 16" aria-hidden="true">
                                    <path d="M1 8a.5.5 0 0 1 .5-.5h11.793l-3.147-3.146a.5.5 0 0 1 .708-.708l4 4a.5.5 0 0 1 0 .708l-4 4a.5.5 0 0 1-.708-.708L13.293 8.5H1.5A.5.5 0 0 1 1 8z"/>
                                </svg>
                            </a>
                            <a class="icon-link icon-link-hover" href="my-past-orders">
                                View past
                                <svg xmlns="http://www.w3.org/2000/svg" class="bi" viewBox="0 0 16 16" aria-hidden="true">
                                    <path d="M1 8a.5.5 0 0 1 .5-.5h11.793l-3.147-3.146a.5.5 0 0 1 .708-.708l4 4a.5.5 0 0 1 0 .708l-4 4a.5.5 0 0 1-.708-.708L13.293 8.5H1.5A.5.5 0 0 1 1 8z"/>
                                </svg>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <section class="profile_section">
            <div class="container d-flex ">
                <div class="container d-flex flex-column gap-5 profile_card">
                    <div class="container d-flex">
                        <h2 class="card_title">
                            <i class="fa-solid fa-address-card"></i> Profile
                        </h2>
                    </div>

                    <div class="container d-flex flex-column">
                        <div class="credentials d-flex">
                            <h3>
                                {{ Auth::user()->name }} <br>
                                <span class="fs-5">Name</span>
                            </h3>

                            <h3>
                                {{ Auth::user()->email }} <br>
                                <span class="fs-5">Email</span>
                            </h3>
                        </div>
        
                        <label class="form-check-label mt-3" for="switchCheckChecked">
                            Dark Mode <span class="beta-tag">BETA</span>
                        </label>
                        <div class="form-check form-switch">
                            <input class="form-check-input" type="checkbox" role="switch" id="darkModeChecked">
                        </div>

                        <div class="d-flex gap-5 mt-5">
                            <form action="/edit-profile-form" method="GET" class="edit-profile-form">
                                @csrf
                                <button class="fs-6">
                                    <span>
                                        <i class="fa-solid fa-user-pen"></i> Edit credentials
                                    </span>
                                </button>
                            </form>

                            <form action="/delete-user-account" method="POST" class="edit-profile-form" onsubmit="return confirmDelete()">
                                @csrf
                                <button>
                                    <span>
                                        <i class="fa-solid fa-user-slash"></i> Delete account
                                    </span>
                                </button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </div>

    <script src="{{ asset('js/user.js') }}"></script>
</body>
</html>
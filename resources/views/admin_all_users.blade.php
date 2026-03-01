<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>
        All users
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
    <nav class="redirect_dashboard">
        <a href="/admin">
            <span>Back to dashboard</span>
        </a>
    </nav>

    <div class="garage">
        <div class="d-flex justify-content-center page-title">
            <h1>All Users</h1>
        </div>

        <section class="cars">
            <div class="container d-flex flex-wrap gap-5">
                @foreach($users as $x)
                    <div class="card service_card span_card">
                        <div class="card-body">
                            <h5 class="card-title fs-4">
                                <i class="fa-solid fa-user"></i> {{ $x->name }}
                            </h5>
                        </div>

                        <div class="specs-container">
                            <div>
                                <div class="card-body" style="background-color:inherit;">
                                    <p>
                                        <strong>Email : </strong>{{ $x->email }}
                                    </p>
                                </div>
                            </div>
                        </div>

                        <div class="d-flex align-items-center">
                            <form action="/remove-user" method="POST">
                                @csrf
                                <input type="hidden" value="{{ $x->id }}" name="user_id_number">
                                <button type="submit" class="return_car">
                                    <span>
                                        <i class="fa-solid fa-circle-xmark"></i> Remove user
                                    </span>
                                </button>
                            </form>

                            <a href="/user-rental-history/{{ $x->id }}" class="add_rent">
                                <span>Check rental history</span>
                            </a>
                        </div>
                    </div>
                @endforeach
            </div>
        </section>

        <div class="d-flex justify-content-center pagination_container mt-5 mb-5">
            {{ $users->links() }}
        </div>
    </div>
    
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js" integrity="sha384-FKyoEForCGlyvwx9Hj09JcYn3nv7wiPVlz7YYwJrWVcXK/BmnVDxM+D2scQbITxI" crossorigin="anonymous"></script>

    <script src="{{ asset('js/garage.js') }}"></script>
</body>
</html>
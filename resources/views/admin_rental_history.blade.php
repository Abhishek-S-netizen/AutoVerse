<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>
        {{ $user->name }}'s rental history
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
    <nav class="redirect_dashboard">
        <a href="/admin">
            <span>Dashboard</span>
        </a>

        <a href="/all-admin-users">
            <span>All Users</span>
        </a>

        <a href="/all-admin-orders">
            <span>Live Orders</span>
        </a>

        <a href="/all-admin-past-orders">
            <span>Past Orders</span>
        </a>

        <a href="/admin-all-communities">
            <span>Communities</span>
        </a>
    </nav>

    <div class="garage">
        <div class="d-flex align-items-center justify-content-center page-title flex-column gap-2">
            <span class="fs-5">{{ $user->name }}</span>
            <h1>Rental history</h1>
            <span class="fs-6">Latest on top</span>
        </div>

        <section class="cars">
            <div class="container d-flex flex-wrap gap-5">
                <table class="table table-hover rental-history-table" style="font-family:Oxanium;">
                    <thead>
                        <tr>
                        <th scope="col">Rental ID</th>
                        <th scope="col">Car</th>
                        <th scope="col">Start date</th>
                        <th scope="col">End date</th>
                        <th scope="col">Delivery location</th>
                        <th scope="col">Status</th>
                        <th scope="col">Total price</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($rentals as $x)
                            <tr>
                                <th scope="row">{{ $x->id }}</th>
                                <td> {{ $x->car->brand }}  {{ $x->car->model }} </td>
                                <td> {{ $x->start_date }} </td>
                                <td> {{ $x->end_date }} </td>
                                <td> {{ $x->delivery_location }} </td>
                                <td>{{ $x->status }}</td>
                                <td> ₹{{ $x->total_price }} </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </section>
    </div>
    
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js" integrity="sha384-FKyoEForCGlyvwx9Hj09JcYn3nv7wiPVlz7YYwJrWVcXK/BmnVDxM+D2scQbITxI" crossorigin="anonymous"></script>

    <script src="{{ asset('js/garage.js') }}"></script>
</body>
</html>
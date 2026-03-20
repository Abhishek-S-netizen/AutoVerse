<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>
        Invoice - {{ $rental->car->brand }} {{ $rental->car->model }}
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

    <link rel="stylesheet" href="{{ asset('css/invoice.css') }}">
</head>

<body>
    @include("loader")
     <header>
        <div id="title_container" class="container d-flex">
            <h1 id="title">
                <span class="fs-6 d-flex gap-5 p-0 redirect_links">
                    <a href="/cars/list">Back to garage</a>
                </span>
            </h1>
        </div>
    </header>

    <section class="comparison" id="invoice">
        <div class="container d-flex flex-column gap-5 comparison_card">
            <div class="container d-flex">
                <img src="{{ asset('images\AutoVerse_Logo.png') }}" alt="">
            </div>

            <div class="container d-flex">
                <h2>Rental Invoice</h2>
            </div>
            <hr>
            <div>
                <p>
                    <strong>Invoice : </strong> #{{ $rental->id }}00R
                </p>
                <p>
                    <strong>Customer name : </strong> {{ $rental->user->name }}
                </p>
                <p>
                    <strong>Email : </strong> {{ $rental->user->email }}
                </p>
                <p>
                    <strong>Vehicle : </strong> {{ $rental->car->brand }} {{ $rental->car->model }}
                </p>
                <p>
                    <strong>Duration : </strong> {{ $rental->start_date }} to {{ $rental->end_date }}
                </p>
                <p>
                    <strong>Delivery location : </strong> {{ $rental->delivery_location }}
                </p>
                <p>
                    <strong>Status : </strong> {{ $rental->status }}
                </p>
                <hr>
                <h3>
                    <strong>Total price : </strong> {{ $rental->total_price }}
                </h3>
                <hr>
                <button onclick="window.print()">Print Invoice</button>
            </div>
        </div>
    </section>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.min.js"
        integrity="sha384-G/EV+4j2dNv+tEPo3++6LCgdCROaejBqfUeNjuKAiuXbjrxilcCdDz6ZAVfHWe1Y"
        crossorigin="anonymous"></script>
</body>

</html>
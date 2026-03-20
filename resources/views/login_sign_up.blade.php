<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>AutoVerse - Sign Up</title>
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

    <link rel="stylesheet" href="{{ asset('css/login_register.css') }}">
</head>

<body>
    @include("loader")
    <div class="parallax" style="background-image: url('{{ asset('images/polestar_2.jpg') }}')">
    @if($errors->any())
        <div class="alert alert-danger">
            <ul>
            @foreach($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
            </ul>
        </div>
    @endif
    
    <form method="POST" action="{{ route('register') }}">
        @csrf

        <div class="container mb-5 d-flex justify-content-center">
            <h1 style="font-family:Audiowide;">Sign Up</h1>
        </div>

        <div class="row mb-3 justify-content-center">
            <div class="col-sm-10">
                <input type="text" class="form-control" id="inputName" name="name" placeholder="Name" required>
            </div>
        </div>

        <div class="row mb-3 justify-content-center">
            <div class="col-sm-10">
                <input type="email" class="form-control" id="inputEmail3" name="email" placeholder="Email" required>
            </div>
        </div>

        <div class="row mb-3 justify-content-center">
            <div class="col-sm-10">
                <input type="password" class="form-control" id="inputPassword3" name="password" placeholder="Enter password" required>
            </div>
        </div>

        <div class="row mb-3 justify-content-center">
            <div class="col-sm-10">
                <input type="password" class="form-control" id="inputPassword3" placeholder="Re-enter password" name="password_confirmation" required>
            </div>
        </div>

        <button type="submit" class="btn mt-5 fw-bolder">Register</button>

        <div class="container d-flex flex-column text-center justify-content-center mt-5 login_redirect">
            <p>Already have an account?
                <a href="/login">Login</a>
            </p>
            <a href="/">Home</a>
        </div>
    </form>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.min.js"
        integrity="sha384-G/EV+4j2dNv+tEPo3++6LCgdCROaejBqfUeNjuKAiuXbjrxilcCdDz6ZAVfHWe1Y"
        crossorigin="anonymous"></script>
</body>

</html>
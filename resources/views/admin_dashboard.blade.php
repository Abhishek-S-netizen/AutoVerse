    <!DOCTYPE html>
    <html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Admin Dashboard</title>
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

        <link rel="stylesheet" href="{{ asset('css/admin.css') }}">
    </head>
    <body>
        @include("loader")
        @if(session('success'))
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                {{ session('success') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
            </div>
        @endif
        
        <div class="nav_custom">
            <nav class="navbar_custom">
                <h2>AutoVerse</h2>
                <span id="clock" class="fs-5 ps-1"></span>
                <a href="#add-review">
                    <span><i class="fa-solid fa-pen-to-square"></i> Post review</span>
                </a>
                <a href="#add-highlight">
                    <span><i class="fa-solid fa-star"></i> Add highlights</span>
                </a>
                <a href="#add-comparison">
                    <span><i class="fa-solid fa-scale-balanced"></i> Add comparison</span>
                </a>
                <a href="#edit-details">
                    <span><i class="fa-solid fa-file-pen"></i> Edit details</span>
                </a>
                <a href="#delete-details">
                    <span><i class="fa-solid fa-trash"></i> Delete details</span>
                </a>
                <a href="/admin-all-communities">
                    <span><i class="fa-solid fa-comments"></i> Communities</span>
                </a>
                <form method="POST" action="{{ route('admin.logout') }}" class="logout_form">
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
                    Welcome, {{ session("admin_id")->name }}
                </h2>
            </nav>
        </div>

        <section class="orders">
            <div class="orders_div">
                <div class="d-flex flex-column gap-3 order_card">
                    <div class="container d-flex">
                        <h2 class="card_title"> <i class="fa-solid fa-hourglass-half"></i> Orders</h2>
                    </div>

                    <div class="container d-flex flex-column">
                        <h3>
                            {{ $orderCountCurrent }} <span class="fs-5">live order(s)</span>, 
                            {{ $orderCountPast }} <span class="fs-5">past order(s)</span>
                        </h3>

                        <div class="d-flex gap-5">
                            <a class="icon-link icon-link-hover" href="all-admin-orders">
                                View live orders
                                <svg xmlns="http://www.w3.org/2000/svg" class="bi" viewBox="0 0 16 16" aria-hidden="true">
                                    <path d="M1 8a.5.5 0 0 1 .5-.5h11.793l-3.147-3.146a.5.5 0 0 1 .708-.708l4 4a.5.5 0 0 1 0 .708l-4 4a.5.5 0 0 1-.708-.708L13.293 8.5H1.5A.5.5 0 0 1 1 8z"/>
                                </svg>
                            </a>

                            <a class="icon-link icon-link-hover" href="all-admin-past-orders">
                                View past orders
                                <svg xmlns="http://www.w3.org/2000/svg" class="bi" viewBox="0 0 16 16" aria-hidden="true">
                                    <path d="M1 8a.5.5 0 0 1 .5-.5h11.793l-3.147-3.146a.5.5 0 0 1 .708-.708l4 4a.5.5 0 0 1 0 .708l-4 4a.5.5 0 0 1-.708-.708L13.293 8.5H1.5A.5.5 0 0 1 1 8z"/>
                                </svg>
                            </a>
                        </div>
                    </div>
                </div>

                <div class="d-flex flex-column gap-3 order_card">
                    <div class="container d-flex">
                        <h2 class="card_title"> <i class="fa-solid fa-users"></i> Users</h2>
                    </div>

                    <div class="container d-flex flex-column">
                        <h3>
                            {{ $users }} <span class="fs-5">user(s)</span>
                        </h3>

                        <a class="icon-link icon-link-hover" href="all-admin-users">
                            View current users
                            <svg xmlns="http://www.w3.org/2000/svg" class="bi" viewBox="0 0 16 16" aria-hidden="true">
                                <path d="M1 8a.5.5 0 0 1 .5-.5h11.793l-3.147-3.146a.5.5 0 0 1 .708-.708l4 4a.5.5 0 0 1 0 .708l-4 4a.5.5 0 0 1-.708-.708L13.293 8.5H1.5A.5.5 0 0 1 1 8z"/>
                            </svg>
                        </a>
                    </div>
                </div>
            </div>
        </section>

        <section id="add-review" class="add_review_section">
            <div class="post_review_form my-5">
                <div class="card shadow-lg border-0">
                    <div class="card-header text-white p-4" 
                    style="background-color:#333333;">
                        <h2 class="mb-0">Add New Car Review</h2>
                    </div>

                    <div class="card-body p-4">
                        @if ($errors->any())
                            <div class="alert alert-danger">
                                <ul>
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                                </ul>
                            </div>
                        @endif

                        <form action="{{ route('admin.storeReview') }}" method="POST" enctype="multipart/form-data" class="admin_form">
                            @csrf

                            <!-- BASIC INFO -->
                            <h5 class="mb-3 text-secondary">Basic Info</h5>

                            <div class="row g-3 mb-4">
                                <div class="col-md-6">
                                    <label class="form-label" for="brand">Brand</label>
                                    <input type="text" id="brand" class="form-control" name="brand" placeholder="Hyundai" required>
                                </div>

                                <div class="col-md-6">
                                    <label class="form-label" for="model">Model</label>
                                    <input type="text" id="model" class="form-control" name="model" placeholder="Tucson" required>
                                </div>

                                <div class="col-md-6">
                                    <label class="form-label">Rating (1–5)</label>
                                    <input type="number" class="form-control" name="rating" min="1" max="5">
                                </div>

                                <div class="col-md-6">
                                    <label class="form-label">Rent price</label>
                                    <input type="number" class="form-control" name="rent">
                                </div>

                                <div class="col-md-6">
                                    <label class="form-label">Year</label>
                                    <input type="number" class="form-control" name="year">
                                </div>

                                <div class="col-md-6">
                                    <label class="form-label">Seating</label>
                                    <input type="number" class="form-control" name="seating">
                                </div>

                                <div class="col-md-6">
                                    <label class="form-label">Bootspace</label>
                                    <input type="text" class="form-control" name="bootspace">
                                </div>

                                <div class="col-md-6">
                                    <label class="form-label">Exterior Dimensions</label>
                                    <input type="text" class="form-control" name="ext_dimen">
                                </div>

                                <div class="col-md-6">
                                    <label class="form-label">Fuel Type</label>
                                    <input type="text" class="form-control" name="fuel_type">
                                </div>

                                <div class="col-md-6">
                                    <label class="form-label">Fuel Economy</label>
                                    <input type="text" class="form-control" name="fuel_economy">
                                </div>

                                <div class="col-md-12">
                                    <label class="form-label">Review Title</label>
                                    <input type="text" class="form-control" name="title" placeholder="Hyundai Tucson Review">
                                </div>
                            </div>

                            <!-- HERO IMAGE -->
                            <h5 class="mt-5 mb-3 text-secondary">Hero Section</h5>

                            <div class="mb-4">
                                <label class="form-label">Hero Image</label>
                                <input type="file" class="form-control" name="hero_image">
                            </div>

                            <div class="mb-4">
                                <label class="form-label">Introduction</label>
                                <textarea class="form-control" rows="5" name="intro_text"></textarea>
                            </div>

                            <!-- INTERIOR -->
                            <h5 class="mt-5 mb-3 text-secondary">Interior</h5>

                            <div class="row g-3 mb-4">
                                <div class="col-md-6">
                                    <label class="form-label">Interior Image</label>
                                    <input type="file" class="form-control" name="interior_image">
                                </div>
                                <div class="col-md-6">
                                    <label class="form-label">Interior Description</label>
                                    <textarea class="form-control" rows="4" name="interior_text"></textarea>
                                </div>
                            </div>

                            <!-- DRIVE -->
                            <h5 class="mt-5 mb-3 text-secondary">Drive Experience</h5>

                            <div class="row g-3 mb-4">
                                <div class="col-md-6">
                                    <label class="form-label">Drive Image</label>
                                    <input type="file" class="form-control" name="drive_image">
                                </div>
                                <div class="col-md-6">
                                    <label class="form-label">Drive Description</label>
                                    <textarea class="form-control" rows="4" name="drive_text"></textarea>
                                </div>
                            </div>

                            <!-- SAFETY -->
                            <h5 class="mt-5 mb-3 text-secondary">Safety</h5>

                            <div class="mb-4">
                                <label class="form-label">Safety Description</label>
                                <textarea class="form-control" rows="5" name="safety_text"></textarea>
                            </div>

                            <!-- SUBMIT -->
                            <div class="d-flex justify-content-end">
                                <button class="btn px-4" type="submit">
                                    <span>
                                        <i class="fa-solid fa-square-plus me-2"></i> Add Review
                                    </span>
                                </button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </section>

        <section id="add-highlight" class="add_highlight_section">
            <div class="post_review_form my-5">
                <div class="card shadow-lg border-0">
                    <div class="card-header text-white p-4" style="background-color:#333333;">
                        <h2 class="mb-0">Add Highlights</h2>
                    </div>

                    <div class="card-body p-4">
                        @if ($errors->any())
                            <div class="alert alert-danger">
                                <ul>
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                                </ul>
                            </div>
                        @endif

                        <form action="{{ route('admin.storeHighlight') }}" method="POST" enctype="multipart/form-data" class="admin_form">
                            @csrf

                            <div class="row g-3 mb-4">
                                <div class="mb-5">
                                    <label for="car_id">Select Car</label>
                                    <select name="car_id" id="car_id" class="form-control" required>
                                        @foreach($carsWithoutHighlights as $car)
                                            <option value="{{ $car->id }}">
                                                {{ $car->brand }} {{ $car->model }} ({{ $car->year }})
                                            </option>
                                        @endforeach
                                    </select>
                                </div>

                                <div class="mb-3">
                                    <label>Pro 1</label>
                                    <input type="text" name="pro_1" class="form-control mb-5">
                                    <label>Pro 2</label>
                                    <input type="text" name="pro_2" class="form-control mb-5">
                                    <label>Pro 3</label>
                                    <input type="text" name="pro_3" class="form-control mb-5">
                                </div>

                                <div class="mb-3">
                                    <label>Con 1</label>
                                    <input type="text" name="con_1" class="form-control mb-5">
                                    <label>Con 2</label>
                                    <input type="text" name="con_2" class="form-control mb-5">
                                    <label>Con 3</label>
                                    <input type="text" name="con_3" class="form-control mb-5">
                                </div>

                                <div class="mb-3">
                                    <label>Feature 1</label>
                                    <input type="text" name="feature_1" class="form-control mb-5">
                                    <label>Feature 2</label>
                                    <input type="text" name="feature_2" class="form-control mb-5">
                                    <label>Feature 3</label>
                                    <input type="text" name="feature_3" class="form-control mb-5">
                                    <label>Feature 4</label>
                                    <input type="text" name="feature_4" class="form-control mb-5">
                                    <label>Feature 5</label>
                                    <input type="text" name="feature_5" class="form-control mb-5">
                                    <label>Feature 6</label>
                                    <input type="text" name="feature_6" class="form-control mb-5">
                                    <label>Feature 7</label>
                                    <input type="text" name="feature_7" class="form-control mb-5">
                                    <label>Feature 8</label>
                                    <input type="text" name="feature_8" class="form-control mb-5">
                                    <label>Feature 9</label>
                                    <input type="text" name="feature_9" class="form-control mb-5">
                                    <label>Feature 10</label>
                                    <input type="text" name="feature_10" class="form-control mb-5">
                                </div>

                                <div class="mb-3">
                                    <label>Best For</label>
                                    <input type="text" name="best_for" class="form-control">
                                </div>

                                <div class="mb-3">
                                    <label>Key Features</label>
                                    <textarea name="key_features" class="form-control"></textarea>
                                </div>

                                <div class="mb-4">
                                    <label class="form-label">Hero Image</label>
                                    <input type="file" class="form-control" name="highlight_image">
                                </div>
                            </div>

                            <div class="d-flex justify-content-end mt-3">
                                <button type="submit" class="btn px-4">
                                    <span>
                                        <i class="fa-solid fa-square-plus me-2"></i> Add Highlights
                                    </span>
                                </button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </section>

        <section id="add-comparison" class="add_comparison_section">
            <div class="post_review_form my-5">
                <div class="card shadow-lg border-0">
                    <div class="card-header text-white p-4" style="background-color:#333333;">
                        <h2 class="mb-0">Add Comparison</h2>
                    </div>

                    <div class="card-body p-4">
                        @if ($errors->any())
                            <div class="alert alert-danger">
                                <ul>
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                                </ul>
                            </div>
                        @endif

                        <form action="{{ route('admin.storeComparison') }}" method="POST" enctype="multipart/form-data" class="admin_form">
                            @csrf

                            <div class="mb-5">
                                <label>Car 1</label>
                                <select name="car_1_id" class="form-control" required>
                                    @foreach($allCars as $car)
                                        <option value="{{ $car->id }}">{{ $car->brand }} {{ $car->model }} ({{ $car->year }})</option>
                                    @endforeach
                                </select>
                            </div>

                            <div class="mb-5">
                                <label>Car 2</label>
                                <select name="car_2_id" class="form-control" required>
                                    @foreach($allCars as $car)
                                        <option value="{{ $car->id }}">{{ $car->brand }} {{ $car->model }} ({{ $car->year }})</option>
                                    @endforeach
                                </select>
                            </div>

                            <div class="mb-5">
                                <label>Comparison Name</label>
                                <input type="text" name="name" class="form-control">
                            </div>

                            <div class="d-flex justify-content-end mt-3">
                                <button type="submit" class="btn px-4">
                                    <span>
                                        <i class="fa-solid fa-square-plus me-2"></i>Add Comparison
                                    </span>
                                </button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </section>

        <section id="edit-details" class="edit_car_details">
            <div class="post_review_form my-5">
                <div class="card shadow-lg border-0">
                    <div class="card-header text-white p-4" 
                    style="background-color:#333333;">
                        <h2 class="mb-0">Edit Car Details</h2>
                    </div>

                    <div class="card-body p-4">
                        @if ($errors->any())
                            <div class="alert alert-danger">
                                <ul>
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                                </ul>
                            </div>
                        @endif

                        <form action="/admin-edit-details" method="GET" class="admin_form">
                            @csrf
                            <div class="mb-5">
                                <label>Select a car</label>
                                <select name="car_edit_id" class="form-control" required>
                                    @foreach($allCars as $x)
                                        <option value="{{ $x->id }}">{{ $x->brand }} {{ $x->model }} ({{ $x->year }})</option>
                                    @endforeach
                                </select>
                            </div>

                            <div class="d-flex justify-content-end mt-3">
                                <button type="submit" class="btn px-4">
                                    <span>
                                        <i class="fa-solid fa-pen me-2"></i> Edit
                                    </span>
                                </button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </section>

        <section id="delete-details" class="delete_car_details">
            <div class="post_review_form my-5">
                <div class="card shadow-lg border-0">
                    <div class="card-header text-white p-4" 
                    style="background-color:#333333;">
                        <h2 class="mb-0">Delete Car Details</h2>
                    </div>

                    <div class="card-body p-4">
                        @if ($errors->any())
                            <div class="alert alert-danger">
                                <ul>
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                                </ul>
                            </div>
                        @endif

                        <form action="/admin-delete-details" method="POST" class="admin_form" onsubmit="return confirmDelete()">
                            @csrf
                            <div class="mb-5">
                                <label>Select a car</label>
                                <select name="car_delete_id" class="form-control" required>
                                    @foreach($allCars as $x)
                                        <option value="{{ $x->id }}">{{ $x->brand }} {{ $x->model }} ({{ $x->year }})</option>
                                    @endforeach
                                </select>
                            </div>

                            <div class="d-flex justify-content-end mt-3">
                                <button type="submit" class="btn px-4">
                                    <span>
                                        <i class="fa-solid fa-trash me-2"></i> Delete
                                    </span>
                                </button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </section>

        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js" integrity="sha384-FKyoEForCGlyvwx9Hj09JcYn3nv7wiPVlz7YYwJrWVcXK/BmnVDxM+D2scQbITxI" crossorigin="anonymous"></script>

        <script src="{{ asset('js/admin.js') }}"></script>
    </body>
    </html>
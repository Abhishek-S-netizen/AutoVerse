<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin - edit car details</title>
    <link rel="icon" type="image/png" href="{{ asset('images/favicon.png') }}">

    <link href="{{ asset('css/bootstrap-5.3.8-dist/css/bootstrap.min.css') }}" rel="stylesheet">

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link
        href="https://fonts.googleapis.com/css2?family=Sansation:ital,wght@0,300;0,400;0,700;1,300;1,400;1,700&family=Zain:ital,wght@0,200;0,300;0,400;0,700;0,800;0,900;1,300;1,400&display=swap"
        rel="stylesheet">

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">

    <link rel="stylesheet" href="{{ asset('css/admin_edit_details.css') }}">
</head>

<body>
    <nav>
        <a href="/admin">
            <span>Back to dashboard</span>
        </a>
    </nav>

    <section class="edit_review_section">
        <div class="container edit_review_form my-5">
                <div class="card shadow-lg border-0">
                    <div class="card-header text-white p-4" 
                    style="background-color:#333333;">
                        <h2 class="mb-0">Edit Car Review</h2>
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

                        <form action="/admin-edit-review" method="POST" enctype="multipart/form-data">
                            @csrf

                            <!-- BASIC INFO -->
                            <h5 class="mb-3 text-secondary">Basic Info</h5>

                            <div class="row g-3 mb-4">
                                <div class="col-md-6">
                                    <label class="form-label" for="brand">ID</label>
                                    <input type="hidden" id="brand" class="form-control" name="id_number" value="{{ $car->id }}" required>
                                </div>

                                <div class="col-md-6">
                                    <label class="form-label" for="brand">Brand</label>
                                    <input type="text" id="brand" class="form-control" name="brand" value="{{ $car->brand }}" required>
                                </div>

                                <div class="col-md-6">
                                    <label class="form-label" for="model">Model</label>
                                    <input type="text" id="model" class="form-control" name="model"  value="{{ $car->model }}" required>
                                </div>

                                <div class="col-md-6">
                                    <label class="form-label">Rating (1–5)</label>
                                    <input type="number" class="form-control" name="rating" min="1" max="5" value="{{ $car->carDetail->rating }}">
                                </div>

                                <div class="col-md-6">
                                    <label class="form-label">Rent price</label>
                                    <input type="number" class="form-control" name="rent" value="{{ $car->rent_price }}">
                                </div>

                                <div class="col-md-6">
                                    <label class="form-label">Year</label>
                                    <input type="number" class="form-control" name="year" value="{{ $car->year }}">
                                </div>

                                <div class="col-md-6">
                                    <label class="form-label">Seating</label>
                                    <input type="number" class="form-control" name="seating" value="{{ $car->seating }}">
                                </div>

                                <div class="col-md-6">
                                    <label class="form-label">Bootspace</label>
                                    <input type="text" class="form-control" name="bootspace" value="{{ $car->bootspace }}">
                                </div>

                                <div class="col-md-6">
                                    <label class="form-label">Exterior Dimensions</label>
                                    <input type="text" class="form-control" name="ext_dimen" value="{{ $car->exterior_dimensions }}">
                                </div>

                                <div class="col-md-6">
                                    <label class="form-label">Fuel Type</label>
                                    <input type="text" class="form-control" name="fuel_type" value="{{ $car->fuel_type }}">
                                </div>

                                <div class="col-md-6">
                                    <label class="form-label">Fuel Economy</label>
                                    <input type="text" class="form-control" name="fuel_economy" 
                                    value="{{ $car->fuel_economy }}">
                                </div>

                                <div class="col-md-12">
                                    <label class="form-label">Review Title</label>
                                    <input type="text" class="form-control" name="title" value="{{ $car->carDetail->title }}">
                                </div>
                            </div>

                            <!-- HERO IMAGE -->
                            <h5 class="mt-5 mb-3 text-secondary">Hero Section</h5>

                            <div class="mb-4">
                                <label class="form-label">Introduction</label>
                                <textarea class="form-control" rows="5" name="intro_text">{{ $car->carDetail->intro_text }}</textarea>
                            </div>

                            <!-- INTERIOR -->
                            <h5 class="mt-5 mb-3 text-secondary">Interior</h5>

                            <div class="row g-3 mb-4">
                                <div class="col-md-6">
                                    <label class="form-label">Interior Description</label>
                                    <textarea class="form-control" rows="4" name="interior_text">{{ $car->carDetail->interior_text }}</textarea>
                                </div>
                            </div>

                            <!-- DRIVE -->
                            <h5 class="mt-5 mb-3 text-secondary">Drive Experience</h5>

                            <div class="row g-3 mb-4">
                                <div class="col-md-6">
                                    <label class="form-label">Drive Description</label>
                                    <textarea class="form-control" rows="4" name="drive_text">{{ $car->carDetail->drive_text }}</textarea>
                                </div>
                            </div>

                            <!-- SAFETY -->
                            <h5 class="mt-5 mb-3 text-secondary">Safety</h5>

                            <div class="mb-4">
                                <label class="form-label">Safety Description</label>
                                <textarea class="form-control" rows="5" name="safety_text" >{{ $car->carDetail->safety_text }}</textarea>
                            </div>

                            <!-- SUBMIT -->
                            <div class="d-flex justify-content-end">
                                <button class="btn px-4" type="submit">
                                    <span>Update Review</span>
                                </button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
    </section>

    <section class="edit_highlight_section pt-5">
        <div class="container edit_highlight_form my-5">
            <div class="card shadow-lg border-0">
                <div class="card-header text-white p-4" style="background-color:#333333;">
                    <h2 class="mb-0">Edit Highlights</h2>
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

                    <form action="/admin-edit-highlight" method="POST" enctype="multipart/form-data">
                        @csrf

                        <div class="row g-3 mb-4">

                            <div class="col-md-6">
                                <label class="form-label" for="brand">ID</label>
                                <input type="hidden" id="brand" class="form-control" name="id_number_highlight" value="{{ $car->id }}" required>
                            </div>

                            <div class="mb-3">
                                <label>Pro 1</label>
                                <input type="text" name="pro_1" class="form-control mb-5" value="{{ $car->highlight->pro_1 }}">
                                <label>Pro 2</label>
                                <input type="text" name="pro_2" class="form-control mb-5" value="{{ $car->highlight->pro_2 }}">
                                <label>Pro 3</label>
                                <input type="text" name="pro_3" class="form-control mb-5" value="{{ $car->highlight->pro_3 }}">
                            </div>

                            <div class="mb-3">
                                <label>Con 1</label>
                                <input type="text" name="con_1" class="form-control mb-5" value="{{ $car->highlight->con_1 }}">
                                <label>Con 2</label>
                                <input type="text" name="con_2" class="form-control mb-5" value="{{ $car->highlight->con_2 }}">
                                <label>Con 3</label>
                                <input type="text" name="con_3" class="form-control mb-5" value="{{ $car->highlight->con_3 }}">
                            </div>

                            <div class="mb-3">
                                <label>Feature 1</label>
                                <input type="text" name="feature_1" class="form-control mb-5" value="{{ $car->highlight->feature_1 }}">
                                <label>Feature 2</label>
                                <input type="text" name="feature_2" class="form-control mb-5" value="{{ $car->highlight->feature_2 }}">
                                <label>Feature 3</label>
                                <input type="text" name="feature_3" class="form-control mb-5" value="{{ $car->highlight->feature_3 }}">
                                <label>Feature 4</label>
                                <input type="text" name="feature_4" class="form-control mb-5" value="{{ $car->highlight->feature_4 }}">
                                <label>Feature 5</label>
                                <input type="text" name="feature_5" class="form-control mb-5" value="{{ $car->highlight->feature_5 }}">
                                <label>Feature 6</label>
                                <input type="text" name="feature_6" class="form-control mb-5" value="{{ $car->highlight->feature_6 }}">
                                <label>Feature 7</label>
                                <input type="text" name="feature_7" class="form-control mb-5" value="{{ $car->highlight->feature_7 }}">
                                <label>Feature 8</label>
                                <input type="text" name="feature_8" class="form-control mb-5" value="{{ $car->highlight->feature_8 }}">
                                <label>Feature 9</label>
                                <input type="text" name="feature_9" class="form-control mb-5" value="{{ $car->highlight->feature_9 }}">
                                <label>Feature 10</label>
                                <input type="text" name="feature_10" class="form-control mb-5" value="{{ $car->highlight->feature_10 }}">
                            </div>

                            <div class="mb-3">
                                <label>Best For</label>
                                <input type="text" name="best_for" class="form-control" value="{{ $car->highlight->best_for }}">
                            </div>

                            <div class="mb-3">
                                <label>Key Features</label>
                                <textarea name="key_features" class="form-control">{{ $car->highlight->key_features }}</textarea>
                            </div>
                        </div>

                        <div class="d-flex justify-content-end mt-3">
                            <button type="submit" class="btn px-4">
                                <span>Update Highlights</span>
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </section>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js" integrity="sha384-FKyoEForCGlyvwx9Hj09JcYn3nv7wiPVlz7YYwJrWVcXK/BmnVDxM+D2scQbITxI" crossorigin="anonymous"></script>
</body>
</html>
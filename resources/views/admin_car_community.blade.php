<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>
        {{ $car->brand }} {{ $car->model }} - Community
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

        <a href="/admin-all-communities">
            <span>All communities</span>
        </a>

        <a href="/all-admin-orders">
            <span>Live Orders</span>
        </a>

        <a href="/all-admin-past-orders">
            <span>Past Orders</span>
        </a>

        <a href="/all-admin-users">
            <span>Users</span>
        </a>
    </nav>

    <div class="garage">
        <div class="d-flex justify-content-center page-title">
            <h1>
                {{ $car->brand }} {{ $car->model }} - Community
            </h1>
        </div>

        <section class="cars mt-5">
            <div class="garage-container gap-5">
                @foreach($posts as $x)
                    <div class="card service_card span_card">
                        <div class="card-body rounded-0">
                            <h3 class="card-title fs-4">{{ $x->post_title }}</h3>
                            <h5 class="card-title fs-6">{{ $x->user->name }} </h5>
                            <a href="/user-profile/{{ $x->user->id }}" target="_blank">Check out {{ $x->user->name }}'s profile</a>
                            <p class="mt-3">
                                {{ $x->post }}
                            </p>
                            <form action="/delete-admin-post" method="POST" class="p-0" onsubmit="return confirmDeletePost()">
                                @csrf
                                <input type="hidden" value="{{ $x->id }}" name="post_id">
                                <button type="submit" class="add_rent">
                                    <span>Delete post</span>
                                </button>
                            </form>
                        </div>
                        <div class="ps-3 border-start">
                            @foreach($x->replies as $reply)
                                <div class="mb-4">
                                    <strong>{{ $reply->user->name }}</strong>
                                    <p class="mb-1">{{ $reply->reply }}</p>
                                    <form action="/delete-admin-reply" method="POST" class="p-0" onsubmit="return confirmDeleteReply()">
                                        @csrf
                                        <input type="hidden" value="{{ $reply->id }}" name="reply_id">
                                        <button type="submit" class="delete_reply p-0">Delete reply</button>
                                    </form>
                                </div>
                            @endforeach
                        </div>
                    </div>
                @endforeach
            </div>
        </section>
    </div>
    
    <div class="d-flex justify-content-center pagination_container mt-5 mb-5">
        {{ $posts->links() }}
    </div>

    <script src="{{ asset('js/garage.js') }}"></script>
</body>
</html>
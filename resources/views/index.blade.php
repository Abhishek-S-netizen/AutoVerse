<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>AutoVerse</title>
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

    <link rel="stylesheet" href="{{ asset('css\index.css') }}">
</head>

<body onload="animateIntro()">
    @include("loader")
    <nav class="justify-content-around" data-bs-theme="dark">
        <a href="#home">
            <span>Home</span>
        </a>
        <a href="#about">
            <span>About</span>
        </a>
        <a href="#cta_services">
            <span>Services</span>
        </a>

        @guest 
            <a href="/signup">
                <span>Login</span>
            </a>
        @endguest

        @auth
            <a href="/user">
                <span>Hi, {{ Auth::user()->name }}</span>
            </a>
        @endauth
    </nav>
    <header id="home">
        <div class="landing_page" style="background-image: url('{{ asset('images/user_dashboard_parallax.jpg') }}')";>
            <div class="landing_img_superwrapper">
                <div class="landing_img_wrapper">
                    <img id='landing_page_img' src="{{ asset('images/Porsche_911_Carrera.avif') }}" alt="">
                </div>
            </div>

            <div class="d-flex landing_title">
                <h1 style="color:#38C498">
                    AutoVerse
                </h1>
            </div>
        </div>

        <div class="tagline container">
            <h2 class="text-center">
                Explore. Compare. Decide.
            </h2>
        </div>
    </header>

    <div id="about" class="about_parallax" style="background-image:url('{{ asset('images/Cupra_Logo.avif') }}')">
        <div>
            <p class="fs-5">
                Finding the right car shouldn’t feel complicated—it should feel exciting. That’s why AutoVerse brings everything you need into one sleek, easy-to-use platform. From detailed specs and verified reviews to powerful side‑by‑side comparisons, AutoVerse makes car shopping smarter, faster, and more enjoyable.
                <br><br>
                No barriers, no hassle—jump right in and explore without creating an account. Want more? Registered users can build personalized wishlists, manage their profiles, and even rent vehicles. Every addition is carefully reviewed by our team, so you can trust that the information you see is accurate, reliable, and relevant.
                <br><br>
                Built on modern web technologies, AutoVerse is designed to be lightning‑fast, scalable, and ready for the future. Whether you’re a casual driver, a car enthusiast, or someone making a big purchase decision, AutoVerse delivers a clean, user‑friendly experience that puts you in control.
                <br><br>
                <strong>
                    AutoVerse isn’t just another car site — it’s your ultimate hub for smarter car decisions.
                </strong>
            </p>
        </div>
    </div>

    <section id="cta_services" class="cta_buttons_section">
        <div class="cta_buttons d-flex container justify-content-between">
            <a href="/electric-cars">
                <span><i class="fa-solid fa-bolt"></i> EVs</span>
            </a>

            <a href="/reviews">
                <span><i class="fa-solid fa-car"></i> Reviews</span>
            </a>

            <a href="/comparisons">
                <span><i class="fa-solid fa-scale-balanced"></i> Comparisons</span>
            </a>

            <a href="/signup">
                <span><i class="fa-solid fa-circle-check"></i> Rent</span>
            </a>
        </div>
    </section>

    <section class="top-picks-wrapper">
        <div class="section_title" style="background-color:#DEDCD9;">
            <h1 style="font-family: Audiowide;">
                <i class="fa-solid fa-trophy"></i> Top Picks  <i class="fa-solid fa-trophy"></i>
            </h1>
        </div>

        <section class="top_picks d-flex">
            <div class="top_picks_container">
                <div class="image_container">
                    <img src="{{ asset('images/BMW_2_series_Gran_Coupe.jpg') }}" alt="">
                    <h5 class="car_name">BMW 2 Series Gran Coupe</h5>
                </div>
                <div>
                    <p>
                        Sleek, sporty, and undeniably premium, the BMW 2 Series Gran Coupe blends dynamic performance with elegant design. Its four-door coupe silhouette hides a nimble chassis and a driver-focused interior, making every commute feel like a thrill. Perfect for those who want style and agility in equal measure.
                    </p>
                    <a href="/reviews/bmw-2-series-gran-coupe">
                        <span>Read the full review</span> <i class="fa-solid fa-arrow-right-long"></i></a>
                </div>

                <div class="right-aligned">
                    <p>
                        Bold, practical, and packed with modern tech, the Hyundai Tucson stands out as a family-friendly SUV with undeniable flair. Its spacious, comfortable interior and advanced features make every journey enjoyable. With a confident ride, striking design, and thoughtful touches throughout, the Tucson combines style, versatility, and performance into one sophisticated package.
                    </p>
                    <a href="/reviews/hyundai-tucson">
                        <span>Read the full review</span> <i class="fa-solid fa-arrow-right-long"></i></a>
                </div>
                <div class="image_container">
                    <img src="{{ asset('images/Hyundai_Tucson.jpg') }}" alt="">
                    <h5 class="car_name">Hyundai Tucson</h5>
                </div>


                <div class="image_container">
                    <img src="{{ asset('images/Kia_EV3.jpg') }}" alt="">
                    <h5 class="car_name">Kia EV3</h5>
                </div>
                <div class="right-aligned">
                    <p>
                        The Kia EV3 is a compact electric SUV that proves going green doesn’t mean sacrificing style or performance. With its sleek, modern design, advanced tech features, and nimble handling, it’s perfect for urban streets or weekend adventures. Efficient yet powerful, the EV3 offers a smooth, quiet ride while turning heads at every corner.
                    </p>
                    <a href="/reviews/kia-ev3">
                        <span>Read the full review</span> <i class="fa-solid fa-arrow-right-long"></i></a>
                </div>
            </div>
        </section>
    </section>

    <section class="popular-reviews-wrapper">
        <section class="popular_review">
            <div class="section_title" style="background-color:#DEDCD9;">
                <h1 style="font-family: Audiowide;">
                    <i class="fa-solid fa-chart-line"></i> Popular Car Reviews
                </h1>
            </div>

            <!-- <div class="container p-0">
                <div class="d-flex flex-wrap justify-content-around gap-5">
                    <div class="card service_card span_card">
                        <img src="{{ asset('images\kiaEV3.jpg') }}" class="card-img-top" alt="...">
                        <div class="card-body">
                            <h5 class="card-title fs-4">Kia EV3</h5>
                            <a href="/reviews/kia-ev3" class="d-inline-flex align-items-center gap-2">
                                Review <i class="fa-solid fa-arrow-right-long"></i>
                            </a>
                        </div>
                    </div>


                    <div class="card service_card span_card">
                        <img src="{{ asset('images\HyundaiSantaFe.jpg') }}" class="card-img-top" alt="...">
                        <div class="card-body">
                            <h5 class="card-title fs-4">Hyundai Santa Fe</h5>
                            <a href="/reviews/hyundai-santa-fe" class="d-inline-flex align-items-center gap-2">
                                Review <i class="fa-solid fa-arrow-right-long"></i>
                            </a>
                        </div>
                    </div>

                    <div class="card service_card span_card">
                        <img src="{{ asset('images\AlpineA290.jpg') }}" class="card-img-top" alt="...">
                        <div class="card-body">
                            <h5 class="card-title fs-4">Alpine A290</h5>
                            <a href="/reviews/alpine-a290" class="d-inline-flex align-items-center gap-2">
                                Review <i class="fa-solid fa-arrow-right-long"></i>
                            </a>
                        </div>
                    </div>
                </div>
            </div> -->

            <div class="container popular-reviews-container gap-5">

                        <div class="card service_card span_card">
                            <img src="{{ asset('images/kiaEV3.jpg') }}" class="card-img-top" alt="">
                            <div class="card-body">
                                <h5 class="card-title fs-4">Kia EV3</h5>
                                <a href="/reviews/kia-ev3" class="d-inline-flex align-items-center gap-2">
                                    Review <i class="fa-solid fa-arrow-right-long"></i>
                                </a>
                            </div>
                        </div>

                        <div class="card service_card span_card">
                            <img src="{{ asset('images/HyundaiSantaFe.jpg') }}" class="card-img-top" alt="">
                            <div class="card-body">
                                <h5 class="card-title fs-4">Hyundai Santa Fe</h5>
                                <a href="/reviews/hyundai-santa-fe" class="d-inline-flex align-items-center gap-2">
                                    Review <i class="fa-solid fa-arrow-right-long"></i>
                                </a>
                            </div>
                        </div>


                        <div class="card service_card span_card">
                            <img src="{{ asset('images/AlpineA290.jpg') }}" class="card-img-top" alt="">
                            <div class="card-body">
                                <h5 class="card-title fs-4">Alpine A290</h5>
                                <a href="/reviews/alpine-a290" class="d-inline-flex align-items-center gap-2">
                                    Review <i class="fa-solid fa-arrow-right-long"></i>
                                </a>
                            </div>
                        </div>

                </div>
            </div>

            <div class="container d-flex reviews_cta title_phone">
                <a class="fs-3" href="/reviews" style="font-family: Audiowide;">
                    <span>More reviews</span>
                </a>
            </div>
        </section>
    </section>
    
    <section class="featured-rentals-wrapper">
        <div class="section_title" style="background-color:#DEDCD9;">
            <h1 style="font-family: Audiowide;">
                <i class="fa-solid fa-road"></i> Featured Rentals
            </h1>
        </div>
        
        <section class="featured-rentals">
            <div class="featured_rentals_container">
                <div class="image_container">
                    <img src="{{ asset('images/Hyundai_Ioniq_5.jpg') }}" alt="">
                    <h5 class="car_name">Hyundai Ioniq 5</h5>
                </div>
                <div>
                    <p>
                        The Hyundai Ioniq 5 is a strikingly modern electric crossover that reinvents what an EV can be. With its bold, angular design, spacious interior, and advanced tech features, the Ioniq 5 delivers a refined ride without sacrificing performance. Its long-range battery and rapid charging capability make it ideal for both everyday commuting and long-distance travel.
                    </p>
                    <a href="#">
                        <span>Read the full review</span> <i class="fa-solid fa-arrow-right-long"></i>
                    </a>
                    <a href="#">
                        <span>Rent </span> <i class="fa-solid fa-arrow-right-long"></i>
                    </a>
                </div>

                <div class="right-aligned">
                    <p>
                        The Volkswagen Golf is the benchmark hatchback that blends everyday usability with refined performance. Known for its solid build quality, comfortable ride, and well-balanced handling, the Golf is perfect for both busy city roads and open highways. With a thoughtfully designed interior, modern tech features, and a reputation for reliability, the Golf delivers a premium driving experience without losing its practical edge.
                    </p>
                    <a href="#">
                        <span>Read the full review</span> <i class="fa-solid fa-arrow-right-long"></i>
                    </a>
                    <a href="#">
                    <span>Rent </span> <i class="fa-solid fa-arrow-right-long"></i>
                    </a>
                </div>
                <div class="image_container">
                    <img src="{{ asset('images/VW_golf.jpg') }}" alt="">
                    <h5 class="car_name">Volkswagon Golf</h5>
                </div>


                <div class="image_container">
                    <img src="{{ asset('images/Alpine_A290.jpg') }}" alt="">
                    <h5 class="car_name">Alpine A290</h5>
                </div>
                <div class="right-aligned">
                    <p>
                        The Alpine A290 is a compact electric hot hatch that channels pure motorsport spirit into a modern, urban-friendly package. With its aggressive styling, sharp handling, and instant electric torque, it delivers an engaging drive that feels lively and responsive at every turn. Inside, a sporty cabin and advanced tech complete the experience with a futuristic edge. 
                    </p>
                    <a href="#">
                        <span>Read the full review</span> <i class="fa-solid fa-arrow-right-long"></i>
                    </a>
                    <a href="#">
                        <span>Rent</span> <i class="fa-solid fa-arrow-right-long"></i>
                    </a>
                </div>
            </div>
        </section>
    </section>

    <footer>
        <div class="container d-flex gap-4 mt-3 justify-content-between">
            <div class="d-flex gap-4">
                <a href="/reviews">Reviews</a>
                <a href="/electric-cars">EVs</a>
                <a href="/comparisons">Comparisons</a>
                <a href="/signup">Login</a>
                <a href="#" class="text-decoration-none">
                    Back to top
                </a>
            </div>
        </div>

        <div class="container mt-5 justify-content-between">
            <div class="d-flex gap-5">
                <a href="#">Privacy Policy</a>
                <a href="#">Terms of Service</a>
                <a href="#">Cookie Policy</a>
            </div>
        </div>

        <div class='container d-flex mt-5 justify-content-between'>
            <div>
                <h6><strong>Contact and follow us : </strong></h6>
                <div class="d-flex gap-5">
                    <h6><i class="fa-solid fa-envelope"></i> Email : autoverse@gmail.com</h6>
                    <h6><i class="fa-solid fa-phone"></i> Phone : 8756438902</h6>
                    <a href="https://www.instagram.com/"><i class="fa-brands fa-instagram"></i> Instagram</a>
                    <a href="https://in.linkedin.com/"><i class="fa-brands fa-linkedin"></i> LinkedIn</a>
                    <a href="https://www.youtube.com/"><i class="fa-brands fa-youtube"></i> YouTube</a>
                </div>
            </div>
        </div>

        <div class="container d-flex justify-content-between mt-5">
            <h6>
                 <i class="fa-solid fa-copyright"></i> AutoVerse Ltd. All Rights Reserved | Developed by Abhishek Subramanian</h6>
        </div>
    </footer>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.min.js"
        integrity="sha384-G/EV+4j2dNv+tEPo3++6LCgdCROaejBqfUeNjuKAiuXbjrxilcCdDz6ZAVfHWe1Y"
        crossorigin="anonymous"></script>

    <script src="{{ asset('js\index.js') }}"></script>
</body>

</html>
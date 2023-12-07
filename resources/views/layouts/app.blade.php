<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}" defer></script>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">

    <!-- Imported css files -->
    <link rel="stylesheet"
        href="https://fonts.googleapis.com/css?family=Nunito+Sans:200,300,400,700,900|Roboto+Mono:300,400,500">
    <link rel="stylesheet" href="{{ asset('assets/fonts/icomoon/style.css') }}">

    <link rel="stylesheet" href="{{ asset('assets/css/bootstrap.min.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/magnific-popup.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/jquery-ui.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/owl.carousel.min.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/owl.theme.default.min.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/bootstrap-datepicker.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/mediaelementplayer.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/animate.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/fonts/flaticon/font/flaticon.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/fl-bigmug-line.css') }}">


    <link rel="stylesheet" href="{{ asset('assets/css/aos.css') }}">

    <link rel="stylesheet" href="{{ asset('assets/css/style.css') }}">

    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
</head>

<body>
    <div id="app" style="margin-top:-25px">

        <div class="site-navbar mt-4">
            <div class="container py-1">
                <div class="row align-items-center">
                    <div class="col-8 col-md-8 col-lg-4">
                        <h1 class="mb-0"><a href="{{ url('/') }}"
                                class="text-white h2 mb-0"><strong>Homeland<span
                                        class="text-danger">.</span></strong></a></h1>
                    </div>
                    <div class="col-4 col-md-4 col-lg-8">
                        <nav class="site-navigation text-right text-md-right" role="navigation">

                            <div class="d-inline-block d-lg-none ml-md-0 mr-auto py-3"><a href="#"
                                    class="site-menu-toggle js-menu-toggle text-white"><span
                                        class="icon-menu h3"></span></a></div>

                            <ul class="site-menu js-clone-nav d-none d-lg-block">
                                <li class="active">
                                    <a href="{{ route('home') }}">Home</a>
                                </li>
                                <li><a href="{{ route('props.buy') }}">Buy</a></li>
                                <li><a href="{{ route('props.rent') }}">Rent</a></li>
                                <li class="has-children">
                                    <a href="properties.html">Properties</a>
                                    <ul class="dropdown arrow-top">
                                        @foreach ($homeTypes as $homeType)
                                            <li><a
                                                    href="{{ route('home.types', $homeType->home_type) }}">{{ $homeType->home_type }}</a>
                                            </li>
                                        @endforeach
                                    </ul>
                                </li>
                                <li><a href="{{ route('about.page') }}">About</a></li>
                                <li><a href="{{ route('contact.page') }}">Contact</a></li>
                                @guest
                                    @if (Route::has('login'))
                                        <li><a href="{{ route('login') }}">Login</a></li>
                                    @endif
                                    @if (Route::has('register'))
                                        <li><a href="{{ route('register') }}">Register</a></li>
                                    @endif
                                @else
                                    <li class="nav-item dropdown">
                                        <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#"
                                            role="button" data-bs-toggle="dropdown" aria-haspopup="true"
                                            aria-expanded="false" v-pre>
                                            {{ Auth::user()->name }}
                                        </a>

                                        <div class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdown">
                                            <a class="dropdown-item" href="{{ route('users.all.requests') }}">
                                                All Requests
                                            </a>
                                            <a class="dropdown-item" href="{{ route('users.saved.properties') }}">
                                                Saved Properties
                                            </a>
                                            <a class="dropdown-item" href="{{ route('logout') }}"
                                                onclick="event.preventDefault();
                                                             document.getElementById('logout-form').submit();">
                                                {{ __('Logout') }}
                                            </a>


                                            <form id="logout-form" action="{{ route('logout') }}" method="POST"
                                                class="d-none">
                                                @csrf
                                            </form>
                                        </div>
                                    </li>
                                @endguest
                            </ul>
                        </nav>
                    </div>


                </div>
            </div>
        </div>
    </div>

    <main class="py-4">
        @yield('content')
    </main>
    </div>

    <footer class="site-footer">
        <div class="container">
            <div class="row">
                <div class="col-lg-4">
                    <div class="mb-5">
                        <h3 class="footer-heading mb-4">About Homeland</h3>
                        <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Saepe pariatur reprehenderit vero
                            atque, consequatur id ratione, et non dignissimos culpa? Ut veritatis, quos illum totam quis
                            blanditiis, minima minus odio!</p>
                    </div>



                </div>
                <div class="col-lg-4 mb-5 mb-lg-0">
                    <div class="row mb-5">
                        <div class="col-md-12">
                            <h3 class="footer-heading mb-4">Navigations</h3>
                        </div>
                        <div class="col-md-6 col-lg-6">
                            <ul class="list-unstyled">
                                <li><a href="#">Home</a></li>
                                <li><a href="#">Buy</a></li>
                                <li><a href="#">Rent</a></li>
                                <li><a href="#">Properties</a></li>
                            </ul>
                        </div>
                        <div class="col-md-6 col-lg-6">
                            <ul class="list-unstyled">
                                <li><a href="#">About Us</a></li>
                                <li><a href="#">Privacy Policy</a></li>
                                <li><a href="#">Contact Us</a></li>
                                <li><a href="#">Terms</a></li>
                            </ul>
                        </div>
                    </div>


                </div>

                <div class="col-lg-4 mb-5 mb-lg-0">
                    <h3 class="footer-heading mb-4">Follow Us</h3>

                    <div>
                        <a href="#" class="pl-0 pr-3"><span class="icon-facebook"></span></a>
                        <a href="#" class="pl-3 pr-3"><span class="icon-twitter"></span></a>
                        <a href="#" class="pl-3 pr-3"><span class="icon-instagram"></span></a>
                        <a href="#" class="pl-3 pr-3"><span class="icon-linkedin"></span></a>
                    </div>



                </div>

            </div>
            <div class="row pt-5 mt-5 text-center">
                <div class="col-md-12">
                    <p>
                        <!-- Link back to Colorlib can't be removed. Template is licensed under CC BY 3.0. -->
                        Copyright &copy;
                        <script data-cfasync="false" src="/cdn-cgi/scripts/5c5dd728/cloudflare-static/email-decode.min.js"></script>
                        <script>
                            document.write(new Date().getFullYear());
                        </script> All rights reserved | This template is made with <i
                            class="icon-heart text-danger" aria-hidden="true"></i> by <a href="https://colorlib.com"
                            target="_blank">Colorlib</a>
                        <!-- Link back to Colorlib can't be removed. Template is licensed under CC BY 3.0. -->
                    </p>
                </div>

            </div>
        </div>
    </footer>

    <script src="{{ asset('assets/js/jquery-3.3.1.min.js') }}"></script>
    <script src="{{ asset('assets/js/jquery-migrate-3.0.1.min.js') }}"></script>
    <script src="{{ asset('assets/js/jquery-ui.js') }}"></script>
    <script src="{{ asset('assets/js/popper.min.js') }}"></script>
    <script src="{{ asset('assets/js/bootstrap.min.js') }}"></script>
    <script src="{{ asset('assets/js/owl.carousel.min.js') }}"></script>
    <script src="{{ asset('assets/js/mediaelement-and-player.min.js') }}"></script>
    <script src="{{ asset('assets/js/jquery.stellar.min.js') }}"></script>
    <script src="{{ asset('assets/js/jquery.countdown.min.js') }}"></script>
    <script src="{{ asset('assets/js/jquery.magnific-popup.min.js') }}"></script>
    <script src="{{ asset('assets/js/bootstrap-datepicker.min.js') }}"></script>
    <script src="{{ asset('assets/js/aos.js') }}"></script>

    <script src="{{ asset('assets/js/main.js') }}"></script>

    <script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>

    <script>
        $(document).ready(function() {
            // Function to fetch prices via AJAX
            function fetchPrices(selectedOption) {
                console.log(selectedOption);
                $.ajax({
                    url: selectedOption === 'asc' ? '{{ route('home.orderByPriceAsc') }}' :
                        '{{ route('home.orderByPriceDesc') }}',

                    method: 'GET',
                    success: function(data) {
                        // Clear previous content
                        $('#housesList').empty();

                        // console.log(data.prices);
                        var routeNumber = 1;
                        // Loop through prices and append to the container
                        data.prices.forEach(function(price) {

                            var propertyHtml = `
                            <div id="prices-container" class="col-md-6 col-lg-4 mb-4">
        <div class="property-entry h-100">
            <a id="routeInsert` + routeNumber + `" class="property-thumbnail">
                <div class="offer-type-wrap">
                    <span class="offer-type bg-success">` + price.home_type + `</span>
                </div>
                <img src="{{ asset('assets/images/' . '` + price.image + `') }}" alt="Image" class="img-fluid">
            </a>
            <div class="p-4 property-body">
                <h2 class="property-title"><a href="property-details.html">` + price.title + `</a></h2>
                <span class="property-location d-block mb-3"><span class="property-icon icon-room"></span>` + price
                                .location + `</span>
                <strong class="property-price text-primary mb-3 d-block text-success">$` + price.price + `</strong>
                <ul class="property-specs-wrap mb-3 mb-lg-0">
                    <li>
                        <span class="property-specs">Beds</span>
                        <span class="property-specs-number">` + price.beds + `<sup>+</sup></span>
                    </li>
                    <li>
                        <span class="property-specs">Baths</span>
                        <span class="property-specs-number">` + price.baths + `</span>
                    </li>
                    <li>
                        <span class="property-specs">SQ FT</span>
                        <span class="property-specs-number">` + price.sq_ft + `</span>
                    </li>
                </ul>
            </div>
        </div>
    </div>
`;


                            console.log(routeNumber);


                            // Append the HTML to the prices-container
                            $('#housesList').append(propertyHtml);
                            document.getElementById('routeInsert' + routeNumber).href =
                                "{{ route('single.prop', '') }}" + '/' + price.id;
                            // $('#prices-container').addClass('col-md-6 col-lg-4 mb-4');
                            // $('#prices-container').append('<div>' + price.title + '</div>');
                            $('#questo-container').empty();
                            $("#questo-container").remove();
                            routeNumber++;
                        });
                    },
                    error: function(error) {
                        console.error('Error fetching prices:', error);
                    }
                });
            }

            // Fetch prices on page load
            // fetchPrices();

            // Example: Trigger fetching prices on a button click
            // $('#fetch-prices-btn').on('click', function() {
            //     fetchPrices();
            // });
            $('#price-selector').on('change', function() {
                // Get the selected option value
                var selectedOption = $(this).val();

                // Trigger fetching prices when the specified option is clicked
                fetchPrices(selectedOption);

            });
        });
    </script>

</body>

</html>

<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Completed - NewsFlash | Home</title>
    <!-- Favicon -->
    <link rel="icon" type="image/png" sizes="32x32" href="{{ asset('/assets/images/favicon.png') }}">
    <!-- Remix icons -->
    <link href="https://cdn.jsdelivr.net/npm/remixicon@2.5.0/fonts/remixicon.css" rel="stylesheet">
    <!-- Swiper.js styles -->
    <link rel="stylesheet" href="{{ asset('/assets/css/swiper-bundle.min.css') }}"/>
    <!-- Custom styles -->
    <link rel="stylesheet" href="{{ asset('/assets/css/main.css') }}">

    @stack('styles')
</head>
<body>
    <!-- Header -->
    <header class="header" id="header">

        <nav class="navbar container">
            <a href="./index.html">
                <h2 class="logo">NewsFlash</h2>
            </a>

            <div class="menu" id="menu">
                <ul class="list">
                    <li class="list-item">
                        <a href="#" class="list-link current">Home</a>
                    </li>
                    <li class="list-item">
                        <a href="#" class="list-link">Categories</a>
                    </li>
                    <li class="list-item">
                        <a href="#" class="list-link">Reviews</a>
                    </li>
                    <li class="list-item">
                        <a href="#" class="list-link">News</a>
                    </li>
                    <li class="list-item">
                        <a href="#" class="list-link">Membership</a>
                    </li>
                    <li class="list-item">
                        <a href="#" class="list-link">Contact</a>
                    </li>
                    @auth
                        <li class="list-item screen-lg-hidden">
                            <a href="{{ route('dashboard.index') }}" class="list-link">Dashboard</a>
                        </li>
                    @endauth

                    @guest
                        <li class="list-item screen-lg-hidden">
                            <a href="{{ route('login') }}" class="list-link">Sign in</a>
                        </li>
                        <li class="list-item screen-lg-hidden">
                            <a href="{{ route('register') }}" class="list-link">Sign up</a>
                        </li>
                    @endguest
                </ul>
            </div>

            <div class="list list-right">
                <button class="btn place-items-center" id="theme-toggle-btn">
                    <i class="ri-sun-line sun-icon"></i>
                    <i class="ri-moon-line moon-icon"></i>
                </button>

                <button class="btn place-items-center" id="search-icon">
                    <i class="ri-search-line"></i>
                </button>

                <button class="btn place-items-center screen-lg-hidden menu-toggle-icon" id="menu-toggle-icon">
                    <i class="ri-menu-3-line open-menu-icon"></i>
                    <i class="ri-close-line close-menu-icon"></i>
                </button>
                @auth
                    <a href="{{ route('dashboard.index') }}" class="btn sign-up-btn fancy-border screen-sm-hidden">
                        <span>Dashboard</span>
                    </a>
                @endauth
                @guest
                    <a href="{{ route('login') }}" class="list-link screen-sm-hidden">Sign in</a>
                    <a href="{{ route('register') }}" class="btn sign-up-btn fancy-border screen-sm-hidden">
                        <span>Sign up</span>
                    </a>
                @endguest
            </div>

        </nav>

    </header>

    <!-- Search -->
    <div class="search-form-container container" id="search-form-container">

        <div class="form-container-inner">

            <form action="" class="form">
                <input class="form-input" type="text" placeholder="What are you looking for?">
                <button class="btn form-btn" type="submit">
                    <i class="ri-search-line"></i>
                </button>
            </form>
            <span class="form-note">Or press ESC to close.</span>

        </div>

        <button class="btn form-close-btn place-items-center" id="form-close-btn">
            <i class="ri-close-line"></i>
        </button>

    </div>

    @yield('content')

    <!-- Swiper.js -->
    <script src="{{ asset('/assets/js/swiper-bundle.min.js') }}"></script>
    <!-- Custom script -->
    <script src="{{ asset('/assets/js/main.js') }}"></script>

    @stack('scripts')
</body>
</html>
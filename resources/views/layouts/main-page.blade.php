<!DOCTYPE html>

<html>

<head>

    <!-- meta -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">

    <title>Theme Blog - Web Template Design</title>

    <!-- stylesheets -->
    <link rel="stylesheet" href="{{ asset('assets/css/bootstrap.min.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/font-awesome.min.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/animate.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/style.css') }}">
    @stack('style')
</head>

<body>

    <nav class="navbar navbar-default navbar-fixed-top">
        <div class="container">
            <!-- Brand and toggle get grouped for better mobile display -->
            <div class="navbar-header">
                <button type="button" class="navbar-toggle collapsed" data-toggle="collapse"
                    data-target="#bs-example-navbar-collapse-1" aria-expanded="false">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
                <a class="navbar-brand" href="{{ route('blogs.index') }}">
                    <img src="{{ asset('assets/img/logo.png') }}" alt="Site Logo">
                </a>
            </div>

            <!-- Collect the nav links, forms, and other content for toggling -->
            <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
                <ul class="nav navbar-nav navbar-right">
                    <li class="@if($active == 'latest') active @endif"><a href="{{ route('blogs.index') }}">Home</a></li>
                    <li class="@if($active == 'top-rated') active @endif"><a href="{{ route('blogs.top-rated') }}"> Top Rated Blogs </a></li>
                    <li><a href="#">Tags</a></li>
                    @auth
                    <li><a href="{{ route('dashboard.index') }}">Dashboard</a></li>
                    @endif
                    
                    <form id="logout" hidden action="{{ route('logout') }}" method="post">
                        @csrf
                    </form>

                    @auth
                        <li><a onclick="event.preventDefault(); $('#logout').submit();" href="#">Sign Out</a></li>
                    @else
                        <li><a href="{{ route('login') }}">Log In</a></li>
                    @endauth
                </ul>
            </div><!-- end of /.navbar-collapse -->
        </div><!-- end of /.container -->
    </nav>

    <main>
        <div class="container">
            <div class="row">
                <section class="col-md-8">

                    @yield('content')


                </section>
                <!-- end of blog-contents -->
                
                <!-- sidebar -->
                <aside class="col-md-4 col-sm-8 col-xs-8">
                    <div class="sidebar">
                        <form id="search" action="{{ route('blogs.search') }}" method="post">
                            @csrf
                            <!-- search option -->
                            <div class="search-widget">
                                <div class="input-group margin-bottom-sm">
                                    <input class="form-control" name="search" type="text" placeholder="Search here" value="{{ $search }}">
                                    <a onclick="event.preventDefault(); $('#search').submit();" class="input-group-addon">
                                        <i class="fa fa-search fa-fw"></i>
                                    </a>
                                </div>
                            </div>
                        </form>

                        <a href="http://themewagon.com/" class="template-images">
                            <img class="img-responsive" src="{{ asset('assets/img/store1.png') }}" alt="Template Store">
                            <div class="overlay"></div>
                        </a>

                        <!-- subscribe form -->
                        <div class="subscribe-widget">
                            <h4 class="text-capitalize text-center">
                                get recent update by email
                            </h4>
                            <div class="input-group margin-bottom-sm">
                                <input class="form-control" type="text" placeholder="Your Email">
                                <a href="#" class="input-group-addon">
                                    <i class="fa fa-paper-plane fa-fw"></i>
                                </a>
                            </div>
                        </div>

                        <!-- sidebar share button -->
                        <div class="share-widget hidden-xs hidden-sm">
                            <ul class="social-share text-center">
                                <li><a href="#"><i class="fa fa-twitter"></i></a></li>
                                <li><a href="#"><i class="fa fa-google-plus"></i></a></li>
                                <li><a href="#"><i class="fa fa-facebook"></i></a></li>
                                <li><a href="#"><i class="fa fa-pinterest"></i></a></li>
                                <li><a href="#"><i class="fa fa-instagram"></i></a></li>
                            </ul> <!-- /.sidebar-share-button -->
                        </div> <!-- /.share-widget -->

                    </div>
                </aside>
                <!-- end of sidebar -->
            </div>
        </div> <!-- end of /.container -->
    </main>

    <footer>
        <div class="container">
            <div class="row">
                <!-- copyright -->
                <div class="col-md-4 col-sm-4">
                    copyright &copy; 2015 <a href="#" style="margin-left: 4px;">Your website Link</a>
                    <br>
                    Theme by <a href="https://themewagon.com/" target="_blank">ThemeWagon</a>
                </div>

                <!-- footer share button -->
                <div class="col-md-4 col-sm-4">
                    <ul class="social-share text-center">
                        <li><a href="#"><i class="fa fa-twitter"></i></a></li>
                        <li><a href="#"><i class="fa fa-google-plus"></i></a></li>
                        <li><a href="#"><i class="fa fa-facebook"></i></a></li>
                        <li><a href="#"><i class="fa fa-pinterest"></i></a></li>
                        <li><a href="#"><i class="fa fa-instagram"></i></a></li>
                    </ul> <!-- /.social-share -->
                </div>

                <!-- footer-nav -->
                <div class="col-md-4 col-sm-4">
                    <ul class="footer-nav">
                        <li><a href="#">About</a></li>
                        <li><a href="#">Privacy</a></li>
                        <li><a href="#">Contact</a></li>
                    </ul> <!-- /.footer-nav -->
                </div>
            </div>
        </div>
    </footer>

    <!--  Necessary scripts  -->
    <script type="text/javascript" src="{{ asset('assets/js/jquery-2.1.3.min.js') }}"></script>
    <script type="text/javascript" src="{{ asset('assets/js/bootstrap.min.js') }}"></script>
    <script type="text/javascript" src="{{ asset('assets/js/jQuery.scrollSpeed.js') }}"></script>
    @stack('script')
</body>

</html>
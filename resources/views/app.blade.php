<!DOCTYPE html>
<html lang="fa">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta keywords="آزمون آنلاین">
    <meta description="سامانه برگزاری آزمون آنلاین">

    <meta name="csrf-token" content="{{ csrf_token() }}">

    {{-- favicon --}}
    <link rel="icon" href="{{asset("assets/images/Quiz.png")}}">
    {{-- end favicon --}}

    <title>آزمون آنلاین</title>

    {{-- styles --}}
    <link rel="stylesheet" href="{{asset("assets/styles/font-awesome.css")}}">
    <link rel="stylesheet" href="{{asset("assets/styles/bootstrap.css")}}">
    <link rel="stylesheet" href="{{asset("assets/styles/styles.css")}}">
    {{-- end styles --}}

</head>

<body id="app-layout">

    <nav class="navbar navbar-default navbar-static-top">
        <div class="container">
            <div class="navbar-header navbar-right">
                <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#app-navbar-collapse">
                    <span class="sr-only">Toggle Navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
                <a class="navbar-brand" href="{{url('/')}}">آزمون آنلاین</a>
            </div>
            <div id="app-navbar-collapse" class="collapse navbar-collapse">
                <ul class="nav navbar-nav navbar-right">
                    {{--<li><a href="{{url('/contact')}}"><i class="fa fa-phone-square" aria-hidden="true"></i> تماس با ما (پشتیبانی)</a></li>--}}
                    <li><a href="{{url('/guide')}}"><i class="fa fa-info-circle" aria-hidden="true"></i> راهنمای کاربر</a></li>
                </ul>
                <ul class="nav navbar-nav navbar-left">
                    @if (Sentinel::guest())
                        <li><a href="{{url('login')}}"><i class="fa fa-user" aria-hidden="true"></i> ورود</a></li>
                        <li><a href="{{url('signup')}}"> <i class="fa fa-user-plus" aria-hidden="true"></i> ثبت نام</a></li>
                    @else
                        <li class="dropdown">
                            <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">
                                {{ Sentinel::getUser()->username }} <span class="caret"></span>
                            </a>
                            <ul class="dropdown-menu" role="menu">
                                @if(Sentinel::getUser()->inRole('examiner'))
                                    <li><a href="{{url('/examiner')}}"><i class="fa fa-tachometer" aria-hidden="true"></i> آزمون</a></li>
                                @else
                                    <li><a href="{{url('/profile')}}"><i class="fa fa-tachometer" aria-hidden="true"></i> مشاهده پروفایل</a></li>
                                @endif
                                <div class="divider"></div>
                                <li><a href="{{url('/logout')}}"><i class="fa fa-btn fa-sign-out"></i> خروج</a></li>
                            </ul>
                        </li>
                    @endif
                </ul>
                {{--<form class="form-inline my-2 my-lg-0 search-form">--}}
                    {{--<input class="form-control mr-sm-2" type="text" placeholder="جستجو">--}}
                    {{--<button class="btn btn-outline-success my-2 my-sm-0" type="submit"><i class="fa fa-search"></i></button>--}}
                {{--</form>--}}
            </div>
        </div>
    </nav>

    @yield('content')

    <footer>
        <div class="container-fluid footer-fluid">
            <div class="container">
                <p class="footer-text">آزمون آنلاین &copy; 1396</p>
            </div>
        </div>
    </footer>

    {{-- scripts --}}
    <script src="{{asset("assets/scripts/jquery.js")}}"></script>
    <script src="{{asset("assets/scripts/bootstrap.js")}}"></script>
    <script src="{{asset("assets/scripts/toastr.js")}}"></script>
    <script src="{{asset("assets/scripts/scripts.js")}}"></script>
    {{-- end scripts --}}

</body>
</html>

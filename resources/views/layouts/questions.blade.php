<!DOCTYPE html>
<html lang="fa">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link rel="icon" href="{{asset("assets/images/Quiz.png")}}">
    <title>آزمون آنلاین</title>
    <link rel="stylesheet" href="{{asset("assets/styles/font-awesome.css")}}">
    <link rel="stylesheet" href="{{asset("assets/styles/bootstrap.css")}}">
    <link rel="stylesheet" href="{{asset("assets/styles/toastr.css")}}">
    <link rel="stylesheet" href="{{asset("assets/styles/styles.css")}}">
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
                <ul class="nav navbar-nav navbar-left">
                    <li class="dropdown">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">
                            {{ Sentinel::getUser()->username }} <span class="caret"></span>
                        </a>
                        <ul class="dropdown-menu" role="menu">
                            <li><a href="{{url('profile')}}"><i class="fa fa-tachometer" aria-hidden="true"></i> مشاهده پروفایل</a></li>
                            <div class="divider"></div>
                            <li><a href="{{url('logout')}}"><i class="fa fa-btn fa-sign-out"></i> خروج</a></li>
                        </ul>
                    </li>
                </ul>
            </div>
        </div>
    </nav>
    <div id="special-features" class="hide">
        <div id="options" class="options-list">
            <ul>
                <li><a href="{{url('#')}}">آپشن اول</a></li>
                <li><a href="{{url('#')}}">آپشن دوم</a></li>
                <li><a href="{{url('#')}}">آپشن سوم</a></li>
                <li><a href="{{url('#')}}">آپشن چهارم</a></li>
                <li>
                    <div class="coins coin-score"> تعداد سکه ها :
                        &nbsp;<span id="coins">0</span>&nbsp;
                        <img src="{{asset('assets/images/coin_euro.png')}}" alt="سکه">
                    </div>
                </li>
                <li>
                    <div class="quiz_score coin-score">جمع امتیاز (همین آزمون) :
                        &nbsp;<span id="quiz_score">0</span>&nbsp;
                        <img src="{{asset('assets/images/cup.png')}}" alt="امتیاز">
                    </div>
                </li>
            </ul>
        </div>
    </div>
    <div id="questions-numbers" class="questions-numbers-list hide">
        <div class="numbers-guide">
            <ul>
                <li id="right" class="numbers-guide-border-left"><i class="fa fa-circle" aria-hidden="true"></i>&nbsp;صحیح</li>
                <li id="wrong" class="numbers-guide-border-left"><i class="fa fa-circle" aria-hidden="true"></i>&nbsp;غلط</li>
                <li id="timeUp"><i class="fa fa-circle" aria-hidden="true"></i>&nbsp;بی پاسخ</li>
            </ul>
        </div>
        <div id="numbers" class="numbers-list">
            <ul>
                <li>شماره سوال</li>
                <li><a href="#number_15">15</a></li>
                <li><a href="#number_14">14</a></li>
                <li><a href="#number_13">13</a></li>
                <li><a href="#number_12">12</a></li>
                <li><a href="#number_11">11</a></li>
                <li><a href="#number_10">10</a></li>
                <li><a href="#number_9">9</a></li>
                <li><a href="#number_8">8</a></li>
                <li><a href="#number_7">7</a></li>
                <li><a href="#number_6">6</a></li>
                <li><a href="#number_5">5</a></li>
                <li><a href="#number_4">4</a></li>
                <li><a href="#number_3">3</a></li>
                <li><a href="#number_2">2</a></li>
                <li><a href="#number_1">1</a></li>
            </ul>
        </div>
        <div id="score_per_question" class="numbers-list">
            <ul>
                <li>امتیاز</li>
                <li><a>155</a></li>
                <li><a>144</a></li>
                <li><a>133</a></li>
                <li><a>122</a></li>
                <li><a>111</a></li>
                <li><a>100</a></li>
                <li><a>99</a></li>
                <li><a>88</a></li>
                <li><a>77</a></li>
                <li><a>66</a></li>
                <li><a>55</a></li>
                <li><a>44</a></li>
                <li><a>33</a></li>
                <li><a>22</a></li>
                <li><a>11</a></li>
            </ul>
        </div>
    </div>
    <div id="questions-show" class="container hide">
        <div class="main">
            <ul id="clockdiv" class="cbp_tmtimeline"></ul>
        </div>
    </div>
    <div class="modal fade modal-btn-font-size" id="correct_modal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title" id="exampleModalLabel">پاسخ آزمون گیرنده: </h4>
                </div>
                <div id="correct_modal_body" class="modal-body">
                    <div id="answer_check"></div>
                    <div id="answer_description"><h4>توضیحات:</h4><p id="answer_description_p"></p></div>
                </div>
                <div class="modal-footer">
                    <div id='next-question' class='form-group'>
                        <button id='next-question-btn' class='btn btn-default btn-primary' type='button'>درخواست سوال بعدی <i class='fa fa-share' aria-hidden='true'></i></button>
                        <button id='finish-exam-btn' class='btn btn-default btn-primary' type='button'>خروج از آزمون <i class='fa fa-times' aria-hidden='true'></i></button>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div id="start-exam-container" class="container-fluid">
        <div class="container">
            <div id="start-exam">
                <button id="start-exam-btn" class="btn btn-primary btn-large" data-toggle="tooltip" title="با کلیک بر روی این دکمه، آزمون شما شروع می شود." disabled>درخواست شروع آزمون</button>
            </div>
        </div>
    </div>
    <footer>
        <div class="container-fluid footer-fluid">
            <div class="container">
                <p class="footer-text">آزمون آنلاین &copy; 1396</p>
            </div>
        </div>
    </footer>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/socket.io/2.0.3/socket.io.js"></script>
    <script src="{{asset("assets/scripts/jquery.js")}}"></script>
    <script src="{{asset("assets/scripts/bootstrap.js")}}"></script>
    <script src="{{asset("assets/scripts/toastr.js")}}"></script>
    <script src="{{asset("assets/scripts/loadingoverlay.js")}}"></script>
    <script src="{{asset("assets/scripts/scripts.js")}}"></script>
    <script src="{{asset("assets/scripts/questions.js")}}"></script>
</body>
</html>

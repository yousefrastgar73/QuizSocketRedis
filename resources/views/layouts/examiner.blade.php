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
    <link rel="stylesheet" href="{{asset("assets/styles/fancybox.css")}}">
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
                        <li><a href="{{url('logout')}}"><i class="fa fa-btn fa-sign-out"></i> خروج</a></li>
                    </ul>
                </li>
            </ul>
        </div>
    </div>
</nav>
<div class="container-fluid">
    <div class="container">
        <div id="exam-numbers" class="questions-numbers-list">
            <div id="numbers" class="numbers-list">
                <ul>
                    <li><a>15</a></li>
                    <li><a>14</a></li>
                    <li><a>13</a></li>
                    <li><a>12</a></li>
                    <li><a>11</a></li>
                    <li><a>10</a></li>
                    <li><a>9</a></li>
                    <li><a>8</a></li>
                    <li><a>7</a></li>
                    <li><a>6</a></li>
                    <li><a>5</a></li>
                    <li><a>4</a></li>
                    <li><a>3</a></li>
                    <li><a>2</a></li>
                    <li><a>1</a></li>
                </ul>
            </div>
        </div>
        <form id="questions-form" action="{{route('examiner.send')}}" method="post" class="form-horizontal">
            <input type="hidden" name="_token" value="{{ csrf_token() }}">
            <div class="row form-group examiner-form margin-top-bottom" style="margin-top: 30px;">
                <div class="col-md-12 col-xs-12 pull-right">
                    <div class="form-group">
                        <div class="col-md-1 pull-right qnum">
                            <label class="control-label question-number-label" for="question_number">1)</label>
                        </div>
                        <div class="col-md-10 margin-top-bottom pull-right">
                            <input type="text" name="question_text" class="form-control" placeholder="متن سوال" disabled>
                            <span class="help-block"><strong></strong></span>
                        </div>
                    </div>
                </div>
                <div class="col-md-6 col-xs-12 pull-right margin-top-bottom">
                    <div class="form-group">
                        <div class="col-md-1 pull-right qnum">
                            <label class="control-label question-option-label" for="option1">1.</label>
                        </div>
                        <div class="col-md-9 pull-right">
                            <input type="text" name="option1" class="form-control" placeholder="گزینه 1" disabled>
                            <span class="help-block"><strong></strong></span>
                        </div>
                    </div>
                </div>
                <div class="col-md-6 col-xs-12 margin-top-bottom">
                    <div class="form-group">
                        <div class="col-md-1 pull-right qnum">
                            <label class="control-label question-option-label" for="option2">2.</label>
                        </div>
                        <div class="col-md-9 pull-right">
                            <input type="text" name="option2" class="form-control" placeholder="گزینه 2" disabled>
                            <span class="help-block"><strong></strong></span>
                        </div>
                    </div>
                </div>
                <div class="col-md-6 col-xs-12 pull-right margin-top-bottom">
                    <div class="form-group">
                        <div class="col-md-1 pull-right qnum">
                            <label class="control-label question-option-label" for="option3">3.</label>
                        </div>
                        <div class="col-md-9 pull-right">
                            <input type="text" name="option3" class="form-control" placeholder="گزینه 3" disabled>
                            <span class="help-block"><strong></strong></span>
                        </div>
                    </div>
                </div>
                <div class="col-md-6 col-xs-12 pull-right margin-top-bottom">
                    <div class="form-group">
                        <div class="col-md-1 pull-right qnum">
                            <label class="control-label question-option-label" for="option4">4.</label>
                        </div>
                        <div class="col-md-9 pull-right">
                            <input type="text" name="option4" class="form-control" placeholder="گزینه 4" disabled>
                            <span class="help-block"><strong></strong></span>
                        </div>
                    </div>
                </div>
                <div class="col-md-6 col-xs-12 pull-right margin-top-bottom"></div>
                <div class="col-md-6 col-xs-12 pull-right margin-top-bottom">
                    <div class="form-group col-md-4 pull-right send-question">
                        <button type="submit" id="send-question" class="btn btn-default btn-primary btn-large" disabled>
                            <i class="fa fa-paper-plane"></i> ارسال سوال
                        </button>
                    </div>
                </div>
            </div>
        </form>
    </div>
</div>
<div class="modal fade modal-btn-font-size" id="answer_modal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div id="time-difference"><i class="fa fa-clock-o"></i> زمان پاسخگویی : <span></span> ثانیه </div>
            <div class="modal-header">
                <h4 class="modal-title" id="exampleModalLabel">سوال&nbsp;<span id="questions_id"></span>&nbsp;پاسخ آزمون دهنده: <span id="student_answer"></span></h4>
            </div>
            <div class="modal-body">
                <div class="form-group">
                    <label class="control-label score-label" for="correct_number">گزینه صحیح:</label>
                    <input id="correct_number" name="correct_number" class="form-control" placeholder="شماره گزینه صحیح را وارد کنید">
                    <span class="help-block"><strong></strong></span>
                    <br>
                    <br>
                    <label class="control-label score-label" for="correct_answer">توضیحات:</label>
                    <textarea id="correct_answer" name="correct_answer" class="form-control" placeholder="پاسخ صحیح را اینجا بنویسید..."></textarea>
                    <span class="help-block"><strong></strong></span>
                </div>
            </div>
            <div class="modal-footer">
                <button id="correct_answer_btn" type="button" class="btn btn-primary"><i class="fa fa-paper-plane" aria-hidden="true"></i> ارسال پاسخ صحیح</button>
            </div>
        </div>
    </div>
</div>
<footer>
    <div class="container-fluid footer-fluid">
        <div class="container">
            <p class="footer-text">آزمون آنلاین &copy 1396</p>
        </div>
    </div>
</footer>
<script src="https://cdnjs.cloudflare.com/ajax/libs/socket.io/2.0.3/socket.io.js"></script>
<script src="{{asset("assets/scripts/jquery.js")}}"></script>
<script src="{{asset("assets/scripts/bootstrap.js")}}"></script>
<script src="{{asset("assets/scripts/fancybox.js")}}"></script>
<script src="{{asset("assets/scripts/toastr.js")}}"></script>
<script src="{{asset("assets/scripts/loadingoverlay.js")}}"></script>
<script src="{{asset("assets/scripts/scripts.js")}}"></script>
<script src="{{asset("assets/scripts/examiner.js")}}"></script>
</body>
</html>

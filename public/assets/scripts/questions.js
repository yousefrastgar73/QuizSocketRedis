var socket = io(':6001');
window.onbeforeunload = function() {
    // return "Do you really want to leave our brilliant application?";
    clearCache();
};
$(document).ready(function () {
    toastr.clear();
    toastr.info('لطفا تا آنلاین شدن آزمون گیرنده منتظر بمانید...');
    setTimeout(function () {
        $.ajax({
            url: 'questions/status',
            type: 'POST',
            dataType: 'JSON',
            success: function (res) {
                if (res == 'examinerOnline')
                {
                    $('#start-exam-btn').removeAttr('disabled');
                    toastr.clear();
                    toastr.success('آزمون گیرنده آنلاین است. میتوانید درخواست شروع آزمون را ارسال کنید.');
                }
                else {}
            }
        });
    }, 1000);
});
var questionHtml = "<li class='active'><time class='cbp_tmtime'><span class='seconds'><span>30</span><div class='smalltext'><i class='fa fa-clock-o fa-2x'></i></div></span></time><div id='question-number' class='cbp_tmicon'>1</div><div class='cbp_tmlabel'><p class='question-text'><span style='float:left'>(<span class='score'></span>امتیاز)</span></p><ul class='question-options'><li class='option1'><input name='option' value='option1' type='radio'>&nbsp;&nbsp;</li><li class='option2'><input name='option' value='option2' type='radio'>&nbsp;&nbsp;</li><li class='option3'><input name='option' value='option3' type='radio'>&nbsp;&nbsp;</li><li class='option4'><input name='option' value='option4' type='radio'>&nbsp;&nbsp;</li></ul><div id='time-out' class='alert alert-warning hide'><i class='fa fa-warning'></i>&nbsp;زمان شما به پایان رسید </div><div id='selected_answer' class='form-group'><button id='selected_answer-btn' class='btn btn-default btn-primary'>ارسال پاسخ <i class='fa fa-paper-plane' aria-hidden='true'></i></button><button id='view_answer_btn' class='btn btn-default btn-primary hide'>مشاهده پاسخ سوال <i class='fa fa-eye' aria-hidden='true'></i></button></div></div></li>";
var true_answer = "<div id='true-answer' class='alert alert-success'><i class='fa fa-check'></i>&nbsp;پاسخ شما صحیح است </div>";
var false_answer = "<div id='false-answer' class='alert alert-danger'><i class='fa fa-close'></i>&nbsp;پاسخ شما نادرست است </div>";
var not_answered = "<div id='null-answer' class='alert alert-warning'><i class='fa fa-warning'></i>&nbsp;پاسخی به سوال نداده بودید</div>";
var id = 0;
var numbers = $('#numbers a');
var numberString = '#numbers a';
var number = [];
var scores = $('#score_per_question a');
var scoreString = '#score_per_question a';
var score = [];
var question_score = 0;
var selected_answer = '';
var correct_answer = '';
var totalScore = 0;
function initializeClock (id, counter) {
    var interval = setInterval(function() {
        var q_timer = $('li.active .q_' + id);
        counter--;
        q_timer.text(counter);
        if (counter <= 0) {
            if (q_timer.text() == 0) {
                $.ajax({
                    url: 'questions/time-out',
                    type: 'POST',
                    dataType: 'JSON',
                    success: function () {}
                });
            }
            clearInterval(interval);
        }
    }, 1000);
}
function postToProfile(totalScore) {
    $.ajax({
        url: 'profile',
        type: 'POST',
        dataType: 'JSON',
        data: {totalScore: totalScore},
        success: function () {
            toastr.clear();
            toastr.info('آزمون به پایان رسید');
            clearCache();
            setTimeout(function () {
                location.replace(BASE_URL + 'profile');
            }, 3000);
        }
    });
}
function questionStatusNext() {
    $.ajax({
        url        : 'questions/next-question',
        method     : 'POST',
        dataType   : 'JSON',
        beforeSend : function () {
            $.LoadingOverlay("show");
        },
        success    : function () {
            $.LoadingOverlay("hide");
            toastr.clear();
            toastr.info('درخواست شما ارسال شد. لطفا منتظر دریافت سوال بعد باشید...');
            $('li.active').removeClass('active');
        }
    });
}
function fetchQuestion(id, totalScore) {
    $.ajax({
        url:  'questions/fetch-question',
        type: 'POST',
        dataType: 'JSON',
        data: {id: id},
        beforeSend: function () {
            var firstQuestionLoader = $("<div>", {
                id: "firstQuestionLoader",
                css:
                {
                    "font-size": "24px",
                    "color": "#AA5555",
                    "position": "absolute",
                    "top": "32%",
                    "left": "36%"
                },
                text: "لطفا منتظر دریافت سوال باشید..."
            });
            $.LoadingOverlay("show", {
                custom: firstQuestionLoader
            });
        },
        success: function (data) {
            $.LoadingOverlay("hide");
            if (data == false) {
                fetchQuestion(id);
            }
            else {
                $("#clockdiv").fadeIn().prepend(questionHtml);
                $("li.active .cbp_tmlabel").attr('id', 'number_' + id);
                $("li.active span.seconds span").addClass('q_' + id);
                $("li.active #question-number").text(id);
                $("li.active p.question-text").prepend(data.question_text);
                $("li.active span.score").append(data.score);
                $("li.active li.option1").append(data.option1);
                $("li.active li.option2").append(data.option2);
                $("li.active li.option3").append(data.option3);
                $("li.active li.option4").append(data.option4);
                question_score = parseInt(data.score);
                numbers.each(function () {
                    number.push(parseInt($(this).text()));
                });
                number.push('ignored');
                number.reverse();
                scores.each(function () {
                    score.push(parseInt($(this).text()));
                });
                score.push('ignored');
                score.reverse();
                initializeClock(id, 30);
                $('#view_answer_btn').on('click', function () {
                    selected_answer = null;
                    $.ajax({
                        url: 'questions/send-answer',
                        type: 'POST',
                        dataType: 'JSON',
                        data: { option: selected_answer},
                        beforeSend: function () {
                            $.LoadingOverlay("show");
                        },
                        success: function () {
                            $.LoadingOverlay("hide");
                            toastr.clear();
                            toastr.info('درخواست شما ارسال شد. لطفا منتظر پاسخ آزمون گیرنده باشید...');
                            $('#selected_answer').fadeOut('slow', function () {
                                $(this).remove();
                            });
                            $('li.active #time-out').fadeOut('slow', function () {
                                $(this).remove();
                            });
                        }
                    });
                });
                $('li.active #selected_answer-btn').on('click', function (e) {
                    e.preventDefault();
                    $('li.active #time-out').remove();
                    var o = $('li.active input[name=option]:checked').val();
                    switch (o) {
                        case 'option1':
                            selected_answer = 'گزینه 1';
                            break;
                        case 'option2':
                            selected_answer = 'گزینه 2';
                            break;
                        case 'option3':
                            selected_answer = 'گزینه 3';
                            break;
                        case 'option4':
                            selected_answer = 'گزینه 4';
                            break;
                        default:
                            selected_answer = null;
                    }
                    $.ajax({
                        url: 'questions/send-answer',
                        type: 'POST',
                        dataType: 'JSON',
                        data: {option: selected_answer},
                        beforeSend: function () {
                            $.LoadingOverlay("show");
                        },
                        success: function () {
                            $.LoadingOverlay("hide");
                            $('li.active time.cbp_tmtime').fadeOut('slow', function () {
                                $(this).remove();
                            });
                            $('li.active input[name=option]').attr('disabled', 'disabled');
                            $('li.active #selected_answer').fadeOut('slow', function () {
                                $(this).remove();
                            });
                            toastr.clear();
                            toastr.info('پاسخ شما ارسال شد. لطفا منتظر پاسخ آزمون گیرنده باشید...');
                        }
                    });
                });
                $('#next-question-btn').on('click', function () {
                    $('#null-answer').fadeOut('slow', function () {
                        $(this).remove();
                    });
                    $('#true-answer').fadeOut('slow', function () {
                        $(this).remove();
                    });
                    $('#false-answer').fadeOut('slow', function () {
                        $(this).remove();
                    });
                    $('#answer_description_p').text('');
                    $('#correct_modal').modal("hide");
                    if (id == 15) {
                        postToProfile(totalScore);
                    }
                    else {
                        questionStatusNext();
                    }
                });
                $('#finish-exam-btn').on('click', function () {
                    postToProfile(totalScore);
                });
            }
        }
    });
}
$('#start-exam-btn').on('click', function () {
    $('.tooltip').hide();
    toastr.clear();
    $.ajax({
        url        : 'questions/set-status',
        method     : 'POST',
        dataType   : 'JSON',
        beforeSend : function () {
            var startExamCounter = $("<div>", {
                id      : "startExamCounter",
                css     :
                {
                    "font-size": "24px",
                    "color": "#AA5555",
                    "position": "absolute",
                    "top": "32%",
                    "left": "36%"
                },
                text    : "لطفا منتظر دریافت سوال اول باشید..."
            });
            $.LoadingOverlay("show", {
                custom  : startExamCounter
            });
        },
        success    : function (data) {
            if (data == 'online') {
                $('#start-exam-container').fadeOut('slow', function () {
                    $(this).remove();
                });
                $('#special-features').fadeIn('slow', function () {
                    $(this).removeClass('hide');
                });
                $('#questions-numbers').fadeIn('slow', function () {
                    $(this).removeClass('hide');
                });
                $('#questions-show').fadeIn('slow', function () {
                    $(this).removeClass('hide');
                });
            }
        }
    });
});
socket.on('message', function (data) {
    var e = data.event;
    switch(e)
    {
        case 'examinerOnline':
        {
            $('#start-exam-btn').removeAttr('disabled');
            toastr.clear();
            toastr.success('آزمون گیرنده آنلاین است. میتوانید درخواست شروع آزمون را ارسال کنید.');
        }
        break;
        case 'sent':
        {
            $.LoadingOverlay("hide");
            fetchQuestion(++id, totalScore);
        }
        break;
        case 'timeOut':
        {
            $('li.active time.cbp_tmtime').fadeOut('slow', function () {
                $(this).remove();
            });
            $('li.active #time-out').slideDown().removeClass('hide');
            $('li.active input[name=option]').attr('disabled', 'disabled');
            $('li.active #selected_answer-btn').slideUp().remove();
            $('li.active #view_answer_btn').fadeIn('slow', function () {
                $(this).removeClass('hide');
            });
        }
        break;
        case 'correct':
        {
            $.ajax({
                url: 'questions/fetch-answer',
                type: 'POST',
                dataType: 'JSON',
                data: {id: id},
                beforeSend: function () {
                    $.LoadingOverlay("show");
                },
                success: function (res) {
                    $.LoadingOverlay("hide");
                    $('#correct_modal').modal({
                        backdrop: 'static',
                        keyboard: false
                    });
                    correct_answer = 'گزینه ' + res.correctNumber;
                    if (res.notAnswered == 'true' && selected_answer !== correct_answer)
                    {
                        $('#answer_check').html(not_answered).fadeIn('slow');
                        $('#question-number').css({'box-shadow': '0 0 0 8px #FF7E00'});
                        $(numberString).filter(function() {
                            return $(this).text() == number[id];
                        }).css({'color': '#FEFEFE', 'background': '#FF7E00'});
                        $(scoreString).filter(function() {
                            return $(this).text() == score[id];
                        }).css({'color': '#FF7E00'});
                    }
                    else
                    {
                        if (selected_answer === correct_answer && res.notAnswered == 'false')
                        {
                            totalScore += question_score;
                            $('#answer_check').html(true_answer).fadeIn('slow');
                            $('#question-number').css({'box-shadow': '0 0 0 8px #4CAF50'});
                            $(numberString).filter(function() {
                                return $(this).text() == number[id];
                            }).css({'color': '#FEFEFE', 'background': '#4CAF50'});
                            $(scoreString).filter(function() {
                                return $(this).text() == score[id];
                            }).css({'color': '#4CAF50'});
                            $('#quiz_score').text(totalScore);
                        }
                        else
                        {
                            if (selected_answer !== correct_answer && res.notAnswered == 'false')
                            {
                                $('#answer_check').html(false_answer).fadeIn('slow');
                                $('#question-number').css({'box-shadow': '0 0 0 8px #FF311F'});
                                $(numberString).filter(function() {
                                    return $(this).text() == number[id];
                                }).css({'color': '#FEFEFE', 'background': '#FF311F'});
                                $(scoreString).filter(function() {
                                    return $(this).text() == score[id];
                                }).css({'color': '#FF311F'});
                            }
                        }
                    }
                    $('#answer_description_p').text(res.correctAnswer);
                }
            });
        }
        break;
    }
});

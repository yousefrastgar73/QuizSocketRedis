var socket = io(':6001');
window.onbeforeunload = function() {
    return "Do you really want to leave our brilliant application?";
};
$(document).ready(function(){
    $.ajax({
        url: 'examiner/set-online',
        type: 'POST',
        dataType: 'JSON',
        success: function (res) {},
    });
    toastr.clear();
    toastr.info('لطفا منتظر آزمون دهنده باشید...');
});
var id = Math.min(Math.max(parseInt($('.question-number-label').text()), 1), 15);
var notAnswered = false;
var student_answer = '';
var correct_number;
var correct_answer;
var numbers = $('#numbers a');
var numberString = '#numbers a';
var number = [];
var scores = ['ignored', 11, 22, 33, 44, 55, 66, 77, 88, 99, 100, 111, 122, 133, 144, 155];
var sentDate;
var getDate;
var totalTime;
socket.on('message', function (res) {
    var e = res.event;
    switch(e)
    {
        case 'online':
        {
            toastr.clear();
            toastr.success('آزمون دهنده آنلاین است. لطفا سوالات را برای او ارسال کنید.');
            $('input[name=question_text]').removeAttr('disabled');
            $('input[name=option1]').removeAttr('disabled');
            $('input[name=option2]').removeAttr('disabled');
            $('input[name=option3]').removeAttr('disabled');
            $('input[name=option4]').removeAttr('disabled');
            $('input[name=score]').removeAttr('disabled');
            $('button#send-question').removeAttr('disabled');
        }
        break;
        case 'answered':
        {
            $('#answer_modal').modal({
                backdrop: 'static',
                keyboard: false
            });
            getDate = new Date();
            totalTime = parseInt((getDate - sentDate) / 1000);
            $('#time-difference span').text(totalTime);
            student_answer = res.data.answer;
            $('#questions_id').text(id + ')');
            if (student_answer == null || totalTime > 35) {
                $('#student_answer').text('بی پاسخ');
                notAnswered = true;
            }
            else {
                $('#student_answer').text(student_answer);
                notAnswered = false;
            }
        }
        break;
        case 'next':
        {
            $('.question-number-label').text(id + ')');
            toastr.clear();
            toastr.error('لطفا سوال بعدی را برای آزمون دهنده ارسال کنید !');
            $('input[name=question_text]').removeAttr('disabled');
            $('input[name=option1]').removeAttr('disabled');
            $('input[name=option2]').removeAttr('disabled');
            $('input[name=option3]').removeAttr('disabled');
            $('input[name=option4]').removeAttr('disabled');
            $('input[name=score]').removeAttr('disabled');
            $('button#send-question').removeAttr('disabled');
        }
        break;
        case 'finish':
        {
            toastr.clear();
            toastr.warning('آزمون دهنده آفلاین شد !');
            clearCache();
            setTimeout(function () {
                location.replace(BASE_URL);
            }, 3000);
        }
        break;
    }
});
$('#questions-form').on('submit', function (e) {
    e.preventDefault();
    var formData = {
        id            : id,
        question_text : $('input[name=question_text]').val(),
        option1       : $('input[name=option1]').val(),
        option2       : $('input[name=option2]').val(),
        option3       : $('input[name=option3]').val(),
        option4       : $('input[name=option4]').val(),
        score         : scores[id]
    };
    $.ajax({
        url        : 'examiner/send-question',
        type       : 'POST',
        dataType   : 'JSON',
        data       : formData,
        beforeSend : function () {
            $.LoadingOverlay("show");
        },
        success    : function () {
            $.LoadingOverlay("hide");
            $('input[name=question_text]').attr('disabled', 'disabled');
            $('input[name=option1]').attr('disabled', 'disabled');
            $('input[name=option2]').attr('disabled', 'disabled');
            $('input[name=option3]').attr('disabled', 'disabled');
            $('input[name=option4]').attr('disabled', 'disabled');
            $('input[name=score]').attr('disabled', 'disabled');
            $('button#send-question').attr('disabled', 'disabled');
            toastr.clear();
            toastr.success("سوال با موفقیت ارسال شد . لطفا منتظر دریافت پاسخ باشید ...");
            $('.help-block').hide();
            $('.form-group').parent().removeClass('has-error');
            sentDate = new Date();
        },
        error: function (res) {
            $.LoadingOverlay("hide");
            $.each(res.responseJSON, function (key, value) {
                var input = '#questions-form input[name=' + key + ']';
                $(input + '+span.help-block>strong').text(value);
                $('.form-group').parent().addClass('has-error');
                $('.help-block').show();
            });
        }
    });
});
$('#correct_answer_btn').on('click', function (e) {
    e.preventDefault();
    correct_number = $('input[name=correct_number]').val();
    correct_answer = $('textarea[name=correct_answer]').val();
    $.ajax({
        url: 'examiner/send-correct',
        type: 'POST',
        dataType: 'JSON',
        data: {
            id: id,
            correct_answer: correct_answer,
            correct_number: correct_number,
            not_answered: notAnswered
        },
        beforeSend: function () {
            $.LoadingOverlay("show");
        },
        success: function () {
            $.LoadingOverlay("hide");
            $('#answer_modal').modal("hide");
            toastr.clear();
            if (id == 15)
            {
                toastr.info('امتحان به پایان رسید');
                setTimeout(function () {
                    clearCache();
                    location.replace(BASE_URL);
                }, 3000);
            }
            else
            {
                toastr.info('پاسخ صحیح ارسال شد. لطفا منتظر درخواست آزمون دهنده برای سوال بعدی باشید...');
                numbers.each(function () {
                    number.push(parseInt($(this).text()));
                });
                number.push('ignored');
                number.reverse();
                var student_correct = 'گزینه ' + correct_number;
                if (notAnswered == true)
                {
                    $(numberString).filter(function() {
                        return $(this).text() == number[id];
                    }).css({'color': '#FEFEFE', 'background': '#FF7E00'});
                }
                else
                {
                    if (student_answer === student_correct && notAnswered == false)
                    {
                        $(numberString).filter(function() {
                            return $(this).text() == number[id];
                        }).css({'color': '#FEFEFE', 'background': '#4CAF50'});
                    }
                    else
                    {
                        if (student_answer !== student_correct && notAnswered == false)
                        {
                            $(numberString).filter(function() {
                                return $(this).text() == number[id];
                            }).css({'color': '#FEFEFE', 'background': '#FF311F'});
                        }
                    }
                }
                $('#questions_id').text('');
                $('#student_answer').text('');
                $('#correct_number').val('');
                $('#correct_answer').val('');
                $('.help-block').hide();
                $('.form-group').parent().removeClass('has-error');
                id = id + 1;
            }
        },
        error: function (res) {
            $.LoadingOverlay("hide");
            $.each(res.responseJSON, function (key, value) {
                var textarea = '#answer_modal textarea[name=' + key + ']';
                $(textarea + '+span.help-block>strong').text(value);
                var input = '#answer_modal input[name=' + key + ']';
                $(input + '+span.help-block>strong').text(value);
                $('.form-group').parent().addClass('has-error');
                $('.help-block').show();
            });
        }
    });
    if (id <= 15)
    {
        $('#questions-form').each(function() {
            this.reset();
        });
    }
});

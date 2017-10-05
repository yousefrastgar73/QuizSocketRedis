var item = $('#start');
var wHeight = $(window).height();
var navHeight = $('.navbar').height();
var footHeight = $('.footer-fluid').height();
var navFoot = navHeight + footHeight;
var itemHeight = wHeight - navFoot;
item.height(itemHeight);
$(window).on('resize', function (){
    wHeight = $(window).height();
    itemHeight = wHeight - navFoot;
    item.height(itemHeight);
});
$('.toast-close-button').on('click', function () {
   $('#toast-container').hide();
});
$(document).ready(function(){
    $('[data-toggle="tooltip"]').tooltip();
});
const BASE_URL = 'http://127.0.0.1:8000/';
$.ajaxSetup({
    headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content'),
    },
    cache: false
});
$(document).ready(function(){
	$('a[href^="#"]').on('click',function (e) {
	    e.preventDefault();
	    var target = this.hash;
	    var $target = $(target);
	    $('html, body').stop().animate({
	        'scrollTop': $target.offset().top
	    }, 500, 'swing', function () {
	        window.location.hash = target;
	    });
	});
});
$('.start-btn').on('click', function (e) {
    e.preventDefault();
    $('#startModal').modal({
        backdrop: 'static',
        keyboard: false
    });
});
toastr.options = {
    "rtl"              : true,
    "closeButton"      : true,
    "debug"            : false,
    "newestOnTop"      : true,
    "progressBar"      : false,
    "positionClass"    : "toast-top-center",
    "preventDuplicates": true,
    "onclick"          : null,
    "showDuration"     : "7000",
    "hideDuration"     : "7000",
    "timeOut"          : "7000",
    "extendedTimeOut"  : "7000",
    "showEasing"       : "swing",
    "hideEasing"       : "linear",
    "showMethod"       : "fadeIn",
    "hideMethod"       : "fadeOut"
};
function clearCache() {
    $.ajax({
        url: 'clear-cache',
        type: 'POST',
        success: function () {}
    });
}

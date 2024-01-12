"use strict"
var coderesult = '';
var userinfo = '';
const DOMAIN_URL = "https://quiz.top10contest.com";

// get jwt token
function get_token() {
    $.ajaxSetup({async: false, dataType: 'json'});
    var returnUserData = null;
    $.post("assets/verify-token.php", function (data) {
        returnUserData = data;
    });
    $.ajaxSetup({async: true});
    return returnUserData;
}
const JWT_TOKEN = get_token();

$(window).scroll(function () {
    if ($(this).scrollTop() >= 200) {
        $('#return-to-top').fadeIn(200);
    } else {
        $('#return-to-top').fadeOut(200);
    }
});

function topReturn() {
    $('body,html').animate({
        scrollTop: 0
    }, 500);
}

var scroll = new SmoothScroll('a[href*="#"]');

new WOW().init();

$(document).ready(function () {

    var url = window.location.href;
    var index = url.lastIndexOf("/") + 1;
    var page = url.substr(index);

    if (page === '') {
        $('#home').addClass("active");
    }
    $(".navbar-nav li a").each(function () {
        if (url.indexOf(this.href) >= 0) {
            $(this).addClass("active");
            $(this).parent().parent().closest('a').addClass("active");
        }
    });
     //share app
    var temp = fetch_systemConfiguration();
    var app_link = temp['data']['app_link'];
    var ios_app_link = temp['data']['ios_app_link'];
    $('#android_url').attr("href", app_link);
    $('#ios_url').attr("href", ios_app_link);
});


//system_configurations
function fetch_systemConfiguration() {
    $.ajaxSetup({async: false, headers: {Authorization: 'Bearer ' + JWT_TOKEN}});
    var returnSystemData = null;
    $.post(DOMAIN_URL + '/api-v2.php', {access_key: '6808', get_system_configurations: '1'}, function (data) {
        returnSystemData = data;
    });
    $.ajaxSetup({async: true});
    return returnSystemData;
}

function readMoreFunction(string) {
    var showChar = 25;
    var ellipsestext = "...";
    //Number of characters to show  
    if (string.length > showChar) {

        // truncate string
        var stringCut = string.substr(0, showChar);
        var endPoint = string.substr(showChar - 1, string.length - showChar);

        //if the string doesn't contain any space then it will cut without word basis.
        var string = stringCut + '<span class="moreellipses">' + ellipsestext + '&nbsp;</span>&nbsp;&nbsp;</span>';

    }
    return string;
}


function spanText(textStr, textClasses) {
    var classNames = textClasses.map(c => 'text-' + c).join(' ');
    return '<span class="' + classNames + '">' + textStr + '</span>';
}

function progress_bar() {
    var startColor = '#02102B';
    var endColor = '#f9a31a';
    $('.progress').each(function (i) {
        var circle = new ProgressBar.Circle(this, {
            color: startColor,
            easing: 'linear',
            strokeWidth: 8,
            duration: 1500,
            text: {value: '0'}
        });
        var value = ($(this).attr('value') / 100);
        circle.animate(value, {
            from: {color: startColor},
            to: {color: endColor},
            step: function (state, circle, bar) {
                circle.path.setAttribute('stroke', state.color);
                circle.setText((circle.value() * 100).toFixed(0) + '%');
            }
        });
    });
}

function convertFromMilitaryToStandard(time) {
    var hour = time.slice(0, 2),
            pm = hour > 12,
            hour12 = hour - (pm ? 12 : 0);

    //Per the request of the OP, we keep them seperate:  
    var a = (hour12 < 10 ? "0" : "") + hour12 + time.slice(2, 5);
    var b = (pm ? "PM" : "AM");
    return a + ' ' + b;
}

function randomIntFromInterval(min, max) // min and max included
{
    return Math.floor(Math.random() * (max - min + 1) + min);
}

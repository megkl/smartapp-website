"use strict"

var temp = fetch_systemConfiguration();
window.time = temp['data']['total_time'];
var value = 0;
var total_timer = 0;
var myTime = 0;
let mousedownTime;

window.onbeforeunload = function () {
    if (window.exit == false) {
        return "Do you really want to leave our brilliant application?";
    }
};

$(document).ready(function () {
    $.ajax({
        url: DOMAIN_URL + '/api-v2.php',
        type: "POST",
        data: 'access_key=6808&get_practice_questions=1',
        dataTpe: 'json',
        headers: {Authorization: 'Bearer ' + JWT_TOKEN},
        success: function (result) {
            window.res = result['data'];
            loadQuestions(window.res);
        }
    });

    $("input[type='radio']").click(function () {
        myTime = getTimer();

        var radioValue = $("input[name='sample-radio']:checked").val();

        $("input[name='sample-radio']").prop("disabled", true);
        if (radioValue == res[window.count]['answer'].toLowerCase()) {
            document.getElementById('wrong').pause();
            document.getElementById('Right').play();

            $("input[name='sample-radio'][value=" + radioValue + "]").parent().addClass('bg-success-green');
            window.correct = window.correct + 1;

            var correct_percentage = window.correct * 100 / window.total_question_percentage;
        } else {
            document.getElementById('Right').pause();
            document.getElementById('wrong').play();

            $("input[name='sample-radio'][value=" + radioValue + "]").parent().addClass('bg-danger-red');
            window.incorrect = window.incorrect + 1;

            var incorrect_percentage = window.incorrect * 100 / window.total_question_percentage;

            $("input[name='sample-radio'][value=" + res[window.count]['answer'].toLowerCase() + "]").parent().addClass('bg-success-green');
        }

    });
});

var bar = new ProgressBar.Circle('#counter', {
    color: '#ffffff',
    strokeWidth: 4,
    trailWidth: 1,
    easing: 'linear',
    duration: (window.time * 1000),
    text: {autoStyleContainer: false},
    from: {color: '#ffffff', width: 5},
    to: {color: '#ffffff', width: 5},
// Set default step function for all animate calls
    step: function (state, circle) {
        circle.path.setAttribute('stroke', state.color);
        circle.path.setAttribute('stroke-width', state.width);
        value = Math.round(circle.value() * window.time);

        if (value == 0) {
            circle.setText('');
            document.getElementById('FirstLooped').pause();
        } else {
            circle.setText(value);
            var ten = document.getElementById('FirstLooped');

            ten.play();
            ten.volume = 0.2;
        }
    }
});
bar.text.style.fontFamily = '"Raleway", Helvetica, sans-serif';
bar.text.style.fontSize = '2rem';
bar.set(1);
bar.animate(0);
function loop(cb) {
    if (value == 0) {
        var user_time = (myTime == 0) ? getTimer() : myTime;
        total_timer = total_timer + user_time;
        window.current_question = window.current_question + 1;
        $("input[name='sample-radio']").parent().removeClass('bg-danger-red');
        $("input[name='sample-radio']").parent().removeClass('bg-success-green');

        $("input[name='sample-radio']").prop("disabled", false).parent().removeClass('r_on').removeAttr("style");
        window.count += 1;
        window.attempt = window.attempt + 1;

        var radioValue = $("input[name='sample-radio']:checked").val();

        if (radioValue == undefined) {
            window.incorrect = window.incorrect + 1;
            var incorrect_percentage = window.incorrect * 100 / window.total_question_percentage;
        }

        bar.set(1);
        bar.animate(0);
        loadQuestions(window.res);
        setTimeout(loop, (window.time * 1000));
    }
}
setTimeout(loop, (window.time * 1000));

function loadQuestions(res) {
    setTimer();
    myTime = 0;
    if (window.current_question > window.total_question_percentage) {
        document.getElementById('endtime').pause();
        var ply = document.getElementById('FirstLooped');
        ply.src = '';
        ply.loop = false;

        setTimeout(function () {
            bar.stop();
        }, 10);
        window.exit = true;
        // Pad to 2 or 3 digits, default is 2
        var Timems = msToTime(total_timer);
        $.redirect('practice-resulting.php', {
            'total_question': window.total_question_percentage,
            'attempt_question': window.attempt,
            'currect_ans': window.correct,
            'wrong_ans': window.incorrect,
            'time': Timems
        });
    } else {
        $("input[name='sample-radio']").prop("checked", false);

        $("#questionsimg img:last-child").remove();
        window.total_question_percentage = res.length;
        $('#my-fonts-questions').html(res[window.count]['question']);
        $('#option_a').html(res[window.count]['optiona']);
        $('#option_b').html(res[window.count]['optionb']);
        $('#option_c').html(res[window.count]['optionc']);
        $('#option_d').html(res[window.count]['optiond']);
        if (res[window.count]['image'] != '') {
            var html = "<img class='my-questions-img' src='" + res[window.count]['image'] + "' width='100px'>";
            $('#questionsimg').html(html);
        }
    }
}

function setTimer() {
    mousedownTime = new Date().getTime();
}

function getTimer() {
    const mouseupTime = new Date().getTime(),
            timeDifference = mouseupTime - mousedownTime;
    return timeDifference;
}

function msToTime(s) {
    // Pad to 2 or 3 digits, default is 2
    function pad(n, z) {
        z = z || 2;
        return ('00' + n).slice(-z);
    }
    var ms = s % 1000;
    s = (s - ms) / 1000;
    var secs = s % 60;
    s = (s - secs) / 60;
    var mins = s % 60;
    var hrs = (s - mins) / 60;
    return pad(hrs) + ':' + pad(mins) + ':' + pad(secs) + '.' + pad(ms, 3);
}
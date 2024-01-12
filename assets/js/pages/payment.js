"use strict"

function dailyContestPayment() {
    $.ajax({
        url: domain_url + '/api-v2.php',
        type: "POST",
        data: 'access_key=6808&set_user_paid_main_event=1&user_id=' + user_id + '&main_event_id=' + event_id + '&transaction_id=' + transaction_id + '&type=' + payment_method + '&amount=' + amount,
        dataTpe: 'json',
        success: function (result) {

        }
    });
};

function groupEventPayment() {
    $.ajax({
        url: domain_url + '/api-v2.php',
        type: "POST",
        data: 'access_key=6808&set_user_paid_group_event=1&user_id=' + user_id + '&group_event_id=' + event_id + '&transaction_id=' + transaction_id + '&type=' + payment_method + '&amount=' + amount,
        dataTpe: 'json',
        success: function (result) {

        }
    });
};

function oneEventPayment() {
    $.ajax({
        url: domain_url + '/api-v2.php',
        type: "POST",
        data: 'access_key=6808&set_user_paid_one_on_one_event=1&user_id=' + user_id + '&event_id=' + event_id + '&transaction_id=' + transaction_id + '&type=' + payment_method + '&amount=' + amount + '&is_add=true',
        dataTpe: 'json',
        success: function (result) {

        }
    });
};

function mainEventPayment() {
    $.ajax({
        url: domain_url + '/api-v2.php',
        type: "POST",
        data: 'access_key=6808&set_user_paid_mainevent_new=1&user_id=' + user_id + '&event_id=' + event_id + '&transaction_id=' + transaction_id + '&type=' + payment_method + '&amount=' + amount,
        dataTpe: 'json',
        success: function (result) {

        }
    });
};

$(document).ready(function () {
    var url = 'get_user_by_id=1&user_id=' + session_user_id + '';
    $.ajax({
        url: domain_url + '/api-v2.php',
        type: "POST",
        data: 'access_key=6808&' + url,
        dataTpe: 'json',
        success: function (result) {
            var name = result['data'].name;
            var mobile = result['data'].mobile;
            var email = result['data'].email;

        }
    });
});
$(document).ready(function ($) {
    'use strict';
    var screenRes = $(window).width(), screenHeight = $(window).height(), html = $('html');
    $('select, input[type="text"], input[type="email"], input[type="url"], input[type="password"], input[type="search"], textarea').each(function () {
        $(this).addClass('form-control');
    })
    $('#primary input[type="submit"]').each(function () {
        $(this).addClass('btn');
    })

});
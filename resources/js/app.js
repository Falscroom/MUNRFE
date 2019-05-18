/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

require('./bootstrap');

var $ = require("jquery");




var breakdown_point = '991.98px';

// Add slideDown animation to Bootstrap dropdown when expanding.
$('.dropdown').on('show.bs.dropdown', function() {
    if(window.matchMedia('(max-width: ' + breakdown_point + ')').matches)
        $(this).find('.dropdown-menu').first().stop(true, true).slideDown();
    else
        $(this).find('.dropdown-menu').first().show();
});

// Add slideUp animation to Bootstrap dropdown when collapsing.
$('.dropdown').on('hide.bs.dropdown', function() {
    if(window.matchMedia('(max-width: ' + breakdown_point + ')').matches)
        $(this).find('.dropdown-menu').first().stop(true, true).slideUp();
    else
        $(this).find('.dropdown-menu').first().hide();
});
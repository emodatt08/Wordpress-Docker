<?php


function we_get_scripts(){
    wp_enqueue_style('we-main-style', plugins_url().'/weather/css/style.css');
    wp_enqueue_script('we-main-script', plugins_url().'/weather/scripts/script.js', ['jquery']);
}

add_action('wp_enqueue_scripts', 'we_get_scripts');
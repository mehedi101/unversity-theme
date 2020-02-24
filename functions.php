<?php
function unversity_files()
{
    wp_enqueue_script('university-main-js', get_theme_file_uri('/js/scripts-bundled.js'), null, microtime(), true);
    wp_enqueue_style('google-custom-font', '//fonts.googleapis.com/css?family=Roboto+Condensed:300,300i,400,400i,700,700i|Roboto:100,300,400,400i,700,700i');
    wp_enqueue_style('font-awesome', '//maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css');
    wp_enqueue_style('fu_main_css', get_stylesheet_uri(), null, microtime());
}

add_action('wp_enqueue_scripts', 'unversity_files');

function university_features(){
    register_nav_menus(['mainHeaderMenu' => 'Main Header Menu', 'footerOneMenu' =>'Footer One Menu', 'footerTwoMenu' => 'Footer Two Menu']);
    add_theme_support('title-tag');

}
add_action('after_setup_theme', 'university_features');


/*
function university_post_types(){
    register_post_type('events', [
        'public' => true,
        'labels' => [
            'name' => 'Events'
        ],
        'menu_icon' => 'dashicons-calendar'
    ]);
}
add_action('init', 'university_post_types');
*/
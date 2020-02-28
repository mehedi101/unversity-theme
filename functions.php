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

function university_events_query_adjustments($query){
    $today = date('Y-m-d');
    if(!is_admin() AND is_post_type_archive('event') AND $query->is_main_query()){
       // $query->set('posts_per_page',1);
        $query->set('meta_key','event_date');
        $query->set('orderby','meta_value');
        $query->set('order','ASC');
        $query->set('meta_query',[
            'key' => 'event_date',
            'compare' => '>=',
            'value' => $today,
            'type' => 'date'
        ]);

    }
}
add_action('pre_get_posts', 'university_events_query_adjustments');
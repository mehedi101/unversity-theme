<?php

function pagePanner($args = NULL ){ ?>

    <div class="page-banner">
        <div class="page-banner__bg-image"
             style="background-image: url(

             <?php
            echo ($args['bgImage'])?:
                 (get_field('page_banner_background_image')['sizes']['bannerImage'])?:
                     get_theme_file_uri('/images/ocean.jpg');?>

                     );"></div>
        <div class="page-banner__content container container--narrow">
            <h1 class="page-banner__title"> <?php echo ($args['title'])?: get_the_title() ?>      </h1>
            <div class="page-banner__intro">
                <p> <?php echo ($args['subtitle'])?: get_field('page_banner_subtitle') ?></p>
            </div>
        </div>
    </div>
<?php
}
function unversity_files()
{
    wp_enqueue_script('googleMap-js', '//maps.googleapis.com/maps/api/js?key=AIzaSyAWxcFCWIvr09az56KG84fEp0_J5B74gAc', null, microtime(), true);
    wp_enqueue_script('university-main-js', get_theme_file_uri('/js/scripts-bundled.js'), null, microtime(), true);
    wp_enqueue_style('google-custom-font', '//fonts.googleapis.com/css?family=Roboto+Condensed:300,300i,400,400i,700,700i|Roboto:100,300,400,400i,700,700i');
    wp_enqueue_style('font-awesome', '//maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css');
    wp_enqueue_style('fu_main_css', get_stylesheet_uri(), null, microtime());
}

add_action('wp_enqueue_scripts', 'unversity_files');

function university_features(){
    register_nav_menus(['mainHeaderMenu' => 'Main Header Menu', 'footerOneMenu' =>'Footer One Menu', 'footerTwoMenu' => 'Footer Two Menu']);
    add_theme_support('title-tag');
    add_theme_support('post-thumbnails');
    add_image_size('professorsLandscapes', 480, 300, true);
    add_image_size('professorsPortrait', 480, 650, true);
    add_image_size('bannerImage', 1920,350, true);

}
add_action('after_setup_theme', 'university_features');

function university_events_query_adjustments($query){

    if(!is_admin() AND is_post_type_archive('campus') AND $query->is_main_query()){
        $query->set('posts_per_page', -1);

    }



    if(!is_admin() AND is_post_type_archive('program') AND $query->is_main_query()){
        $query->set('orderby', 'title');
        $query->set('order', 'asc');
        $query->set('posts_per_page', -1);

    }


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

function university_map_api($api){
    $api['key']= 'AIzaSyAWxcFCWIvr09az56KG84fEp0_J5B74gAc';
    return $api;
}
add_filter('acf/fields/google_map/api', 'university_map_api');

<?php
get_header();
while (have_posts()) :
    the_post();
pagePanner();
?>


    <div class="container container--narrow page-section">

        <div class="metabox metabox--position-up metabox--with-home-link">
            <p><a class="metabox__blog-home-link" href="<?php echo get_post_type_archive_link('press'); ?>">
                    <i class="fa fa-home" aria-hidden="true"></i> Press Home
                </a>
                <span class="metabox__main">
                  <?php the_title() ?>
                </span></p>
        </div>

        <div class="generic-content">
            <?php the_content(); ?>


        </div>

    </div>


<?php

    # code...
endwhile;
wp_reset_postdata();


//$terms = get_the_terms( $post->ID, 'press_category' );
$terms = get_the_term_list($post->ID,'press_category');

$args = array(
    'post_type' => 'press',
    'tax_query' => array(
        array(
            'taxonomy' => 'press_category',
            'field' => 'slug',
            'terms' => $terms
        )
    )
);


$presses = new WP_Query( $args );
if( $presses->have_posts() ) {
    echo '<ul>';
    while( $presses->have_posts() ) {
        $presses->the_post();
        ?>
        <li><a href="<?php the_permalink() ?>" > <?php the_title() ?></a></li>
        <?php
    }
    echo '</ul>';
}
else {
    echo 'Oh ohm no press!';
}


//print_r($terms);
get_footer();

?>


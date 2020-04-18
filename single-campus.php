<?php
get_header();
while (have_posts()) :
    the_post();
pagePanner()?>

    <div class="container container--narrow page-section">

        <div class="metabox metabox--position-up metabox--with-home-link">
            <p><a class="metabox__blog-home-link" href="<?php echo get_post_type_archive_link('campus'); ?>">
                    <i class="fa fa-home" aria-hidden="true"></i> Our Campuses
                </a>
                <span class="metabox__main">
                  <?php the_title() ?>
                </span></p>
        </div>

        <div class="generic-content">
            <?php the_content(); ?>
        </div>

        <div class="acf-map">
            <?php
            $mapLocation = get_field('location_map');
            // print_r($mapLocation);
            ?>

            <div class="marker" data-lat="<?php echo $mapLocation['lat']?>" data-lng="<?php echo $mapLocation['lng']?>">
                <h3> <?php the_title() ?></h3>
                <?php echo $mapLocation['address'] ;?>
            </div>



        </div>
        <div class="related--programs">
            <?php
            $relatedPrograms = new WP_Query([
                'posts_per_page' => -1,
                'post_type' => 'program',
                'orderby' => 'title',
                'order' => 'Asc',
                'meta_query' => [
                    [
                        'key' => 'related_campuses',
                        'compare' => 'LIKE',
                        'value' => '"'.get_the_ID().'"'

                    ]
                ]

            ]);
             //   print_r($relatedPrograms);
            if($relatedPrograms->have_posts()){
                echo '<hr class="section-break"/>';
                echo '<h3 class="headline headline--medium">Program available at this campus </h3>';

                echo '<ul class="min-list link-list">';
                while ($relatedPrograms->have_posts()): $relatedPrograms->the_post() ?>

                    <li >
                        <a href="<?php the_permalink(); ?>">
                            <?php the_title() ;?>
                        </a>
                    </li>

                <?php
                endwhile;
                echo '</ul>';
            }

            wp_reset_postdata();
            ?>

        </div>
    </div>


<?php

    # code...
endwhile;
get_footer();

?>


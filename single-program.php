<?php
get_header();
while (have_posts()) :
    the_post(); ?>


    <div class="page-banner">
        <div class="page-banner__bg-image"
             style="background-image: url(<?= get_theme_file_uri('images/ocean.jpg') ?>);"></div>
        <div class="page-banner__content container container--narrow">
            <h1 class="page-banner__title"> <?php the_title(); ?>      </h1>
            <div class="page-banner__intro">
                <p> <?php echo "DON'T FORGET TO CHAGNE ME LATER"; ?></p>
            </div>
        </div>
    </div>

    <div class="container container--narrow page-section">

        <div class="metabox metabox--position-up metabox--with-home-link">
            <p><a class="metabox__blog-home-link" href="<?php echo get_post_type_archive_link('program'); ?>">
                    <i class="fa fa-home" aria-hidden="true"></i> All Program
                </a>
                <span class="metabox__main">
                  <?php the_title() ?>
                </span></p>
        </div>

        <div class="generic-content">
            <?php the_content(); ?>
        </div>
        <div class="related--events">
            <?php
            $today = date('Y-m-d');
            $homepageEvents = new WP_Query([
                'posts_per_page' => 2,
                'post_type' => 'event',
                'meta_query' => [[
                    'key' => 'event_date',
                    'compare' => '>=',
                    'value' => $today,
                    'type' => 'date'
                ],
                    [
                            'key' => 'related_programs',
                            'compare' => 'LIKE',
                            'value' => '"'.get_the_ID().'"'

                    ]
                ],
                'meta_key' => 'event_date',
                'orderby' => 'meta_value',
                'order' => 'Asc'
            ]);
            while ($homepageEvents->have_posts()): $homepageEvents->the_post() ?>
                <hr class="section-break"/>
                <h3 class="headline headline--medium">Related Event(s) </h3>
                <div class="event-summary">
                    <a class="event-summary__date t-center" href="#">
                            <span class="event-summary__month">
                                <?php
                                $eventDate = new DateTime(get_field('event_date'));
                                echo $eventDate->format('M') ?>
                            </span>
                        <span class="event-summary__day"><?php echo $eventDate->format('d'); ?></span>
                    </a>
                    <div class="event-summary__content">
                        <h5 class="event-summary__title headline headline--tiny"><a
                                    href="<?php the_permalink() ?>"><?php the_title() ?></a></h5>
                        <p> <?php echo (has_excerpt()) ? get_the_excerpt() : wp_trim_words(get_the_content(),
                                18); ?>
                            <a href="<?php the_permalink() ?>" class="nu gray">Learn more</a></p>
                    </div>
                </div>

            <?php
            endwhile;

            wp_reset_postdata();
            ?>

        </div>

    </div>


<?php

    # code...
endwhile;
get_footer();

?>


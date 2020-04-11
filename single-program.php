<?php
get_header();
while (have_posts()) :
    the_post();
pagePanner()?>

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
        <div class="related--professors">
            <?php
            $relatedProfessors = new WP_Query([
                'posts_per_page' => -1,
                'post_type' => 'professor',
                  'orderby' => 'title',
                'order' => 'Asc',
                'meta_query' => [
                    [
                        'key' => 'related_programs',
                        'compare' => 'LIKE',
                        'value' => '"'.get_the_ID().'"'

                    ]
                ]

            ]);
       //     print_r($relatedProfessors);
            if($relatedProfessors->have_posts()){
                echo '<hr class="section-break"/>';
                echo '<h3 class="headline headline--medium">'. get_the_title() . ' Professors </h3>';

                echo '<ul class="professor-cards">';
                while ($relatedProfessors->have_posts()): $relatedProfessors->the_post() ?>

                  <li class="professor-card__list-item">
                      <a class="professor-card" href="<?php the_permalink(); ?>">
                            <img src="<?php the_post_thumbnail_url() ?>" class="professor-card__image">
                            <span class="professor-card__name t-center"><?php the_title() ;?> </span>

                      </a> </li>

                <?php
                endwhile;
                echo '</ul>';
            }

            wp_reset_postdata();



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
            if($homepageEvents->have_posts()){
                echo '<hr class="section-break"/>';
                echo '<h3 class="headline headline--medium">Upcoming '. get_the_title() . ' Events </h3>';


                while ($homepageEvents->have_posts()): $homepageEvents->the_post() ?>

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


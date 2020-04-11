<?php get_header();
pagePanner([
        'title' => 'Past Events',
        'A recap of our past events'
])?>


    <div class="container container--narrow page-section">
        <?php
        $today= date('Y-m-d');
        $pastEvents = new WP_Query([
                'paged' => get_query_var('paged', 1),
                'post_type' => 'event',
             //   'posts_per_page' => 1,
                'meta_key' => 'event_date',
                'orderby' => 'meta_value',
                'order' => 'DESC',
                'meta_query' => [[
                        'key' => 'event_date',
                        'compare' => '<',
                        'value' => $today,
                        'type' => 'date'
                ]]

        ]);


        while ($pastEvents->have_posts()){
            $pastEvents->the_post();
            get_template_part('template-parts/event','loop');
            }

            ?>

       <div class="post--pagination"> <?php echo paginate_links(['total' =>$pastEvents->max_num_pages])  ; ?></div>


    </div>

<?php
wp_reset_postdata();
get_footer(); ?>
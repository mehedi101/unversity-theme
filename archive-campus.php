<?php get_header();
pagePanner([
    'title' => 'Our campuses',
    'subtitle' => 'We have several convenient located campuses'
])?>


    <div class="container container--narrow page-section">
        <div class="acf-map">
            <?php while (have_posts()): the_post();
                       $mapLocation = get_field('location_map');
                      // print_r($mapLocation);
                ?>

                <div class="marker" data-lat="<?php echo $mapLocation['lat']?>" data-lng="<?php echo $mapLocation['lng']?>">
                    <h3> <a href="<?php the_permalink() ?>"> <?php the_title() ?></a></h3>
                   <?php echo $mapLocation['address'] ;?>
                </div>


            <?php endwhile; ?>
        </div>
    </div>

<?php get_footer(); ?>
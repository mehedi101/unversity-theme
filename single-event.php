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
            <p><a class="metabox__blog-home-link" href="<?php echo get_post_type_archive_link('event'); ?>">
                    <i class="fa fa-home" aria-hidden="true"></i> Event Home
                </a>
                <span class="metabox__main">
                  <?php the_title() ?>
                </span></p>
        </div>

        <div class="generic-content">
            <?php the_content(); ?>

            <div class="related--program">
                <?php
                    $relatedPrograms= get_field('related_programs');

                    if($relatedPrograms){
                   echo '<hr class="section-break"/>';
                        echo "<h3 class='headline headline--medium'> 
                            Related Program(s)   
                            </h3> 
                            <ul class='link-list min-list'>";

                        foreach ($relatedPrograms as $program){

                            echo
                                '<li><a href="'.get_the_permalink($program).'">'
                                .get_the_title($program)
                                .'</a> </li>';
                        }




                        echo "</ul>";

                    }

                ?>

            </div>

        </div>

    </div>


<?php

    # code...
endwhile;
get_footer();

?>


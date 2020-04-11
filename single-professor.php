<?php
get_header();
while (have_posts()) :
    the_post();
    pagePanner();
?>



    <div class="container container--narrow page-section">

        <div class="generic-content">
            <div class="row group">
                <div class="one-third"><?php the_post_thumbnail() ?></div>
                <div class="two-thirds"><?php the_content(); ?></div>
            </div>
        </div>

            <div class="related--program">
                <?php
                    $relatedPrograms= get_field('related_programs');

                    if($relatedPrograms){
                   echo '<hr class="section-break"/>';
                        echo "<h3 class='headline headline--medium'> 
                            Subject(s) Taught
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


<?php

    # code...
endwhile;
get_footer();

?>


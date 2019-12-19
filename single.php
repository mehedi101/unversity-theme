<?php
get_header();
while (have_posts()) {
    the_post(); ?>

    <h2><?= the_title() ?></h2>
    <p><?= the_content() ?></p>
<?php

    # code...
}

get_footer();
?>
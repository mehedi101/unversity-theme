<?php get_header();
pagePanner([
        'title' => get_the_archive_title(),
        'subtitle' => get_the_archive_description()
])
?>

    <div class="container container--narrow page-section">
        <?php while (have_posts()): the_post() ?>
            <div class="post-item">
                <h2 class="headline headline--medium headline--post-title">
                    <a href=" <?php the_permalink(); ?>"><?php the_title(); ?></a>
                </h2>

                <div class="metabox">
                    <span class="post--author"> Posted by <?php  the_author_posts_link() ; ?></span>
                    <span class="post--date"> on <?php the_time('d.m.y')  ; ?> </span>
                    <span class="post--category"> in  <?php echo get_the_category_list(', ')  ; ?></span>
                </div>
                <div class="generic-content">
                    <?php
                    the_excerpt();

                    ?>
                    <p><a class="btn btn--blue" href="<?php the_permalink(); ?>"> Continue Reading &raquo;</a></p>
                </div>

            </div>

        <?php endwhile; ?>

       <div class="post--pagination"> <?php echo paginate_links()  ; ?></div>


    </div>

<?php get_footer(); ?>
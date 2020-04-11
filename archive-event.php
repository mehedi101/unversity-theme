<?php get_header();
pagePanner([
    'title' => 'All Events',
    'subtitle' => 'See what is going on in our world!'
])?>


    <div class="container container--narrow page-section">
        <?php while (have_posts()){
            the_post();
            get_template_part('template-parts/event','loop');
        } ?>

       <div class="post--pagination"> <?php echo paginate_links()  ; ?></div>

        <hr class="section-break"/>
        <p>Looking for a recap of pasts events?
            <a href="<?php echo site_url('past-events');  ?>"> Check out our past events archives</a>
        </p>


    </div>

<?php get_footer(); ?>
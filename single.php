<?php get_header(); ?>



<main id="main" class="container single-post-container">

    <?php if( have_posts() ) {
        while ( have_posts() ) {
            the_post();
            themePageBanner(); ?>
            <p>
            <a class="metabox" href="<?php echo site_url('/blog'); ?>"
                ><i class="fa fa-home" aria-hidden="true"></i> Blog Home</a
            ><br>
            <span>By <?php the_author(); ?> on <?php the_time('M Y'); ?> in <?php echo get_the_category_list(', '); ?></span>
            </p>
            <?php the_content();
        }
    }
    ?>

    <?php comments_template(); ?>

</main> 



<?php get_footer(); ?>
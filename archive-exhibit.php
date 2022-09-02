<?php get_header(); ?>



<main id="main" class="container">

    <div class="exhibit-item-grid">
    <?php if( have_posts() ) {
        while ( have_posts() ) {
            the_post(); ?>
            
            <a href="<?php the_permalink(); ?>">
                <div class="exhibit-item" style="background-image: url(<?php echo get_the_post_thumbnail_url(get_the_ID()); ?>); background-size: cover;">
                    <p class="exhibit-title"><?php the_title(); ?></p>
                </div>
            </a>
        <?php 
        }
    } ?></div>
    

</main> 



<?php get_footer(); ?>
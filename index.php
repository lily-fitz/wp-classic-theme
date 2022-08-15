<?php get_header(); ?>



<main id="main" class="container">
    <?php
    themePageBanner(array(
        'title' => 'Welcome To Our Blog!',
        'subtitle' => 'Keep up with our latest news...'
    ));
    ?>
    <div class="blog-posts">
    <?php if( have_posts() ) {
        while ( have_posts() ) {
            the_post(); ?>
            <div class="blog-item">
                <div class="blog-image">
                    <?php the_post_thumbnail(); ?>
                    <!-- img src="php the_post_thumbnail_url('thumbnail'); ?"-->
                </div>
                <div class="blog-info">
                    <a href="<?php the_permalink(); ?>"><?php the_title(); ?></a>
                        
                    <p>By <?php the_author_posts_link(); ?> on <?php the_time('M Y'); ?> <?php the_time('n.j.y'); ?> in <?php echo get_the_category_list(', '); ?></p>
                    
                    <p><?php the_tags('<span class="tag">', '</span><span class="tag">', '</span>'); ?></p>                        
                        
                    <?php if (have_comments() !== null) {
                        echo get_comments_number();
                    }
                    ?> Comments
                    <p><?php the_excerpt(); ?></p>
                    <a href="<?php the_permalink(); ?>">Keep Reading...</a>
                </div>
            </div>
            <?php
        } 
    } the_posts_pagination(); 
    ?>
    </div>
</main> 



<?php get_footer(); ?>
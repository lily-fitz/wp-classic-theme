<?php get_header(); ?>



<main id="main" class="container">
            <?php 
                themePageBanner(array(
                    'title' => 'Search Results!!!',
                    'subtitle' => 'Search results for &ldquo;' . esc_html(get_search_query(false)) . '&rdquo;',
                ));
            ?>

    <div class="archive-posts">
    <?php if( have_posts() ) {
        while ( have_posts() ) {
            the_post(); ?>

            <div class="archive-item">
                <a href="<?php the_permalink(); ?>"><?php the_title(); ?></a>
                <div class="metabox">
                    <p>By <?php the_author_posts_link(); ?> on <?php the_time('M Y'); ?> <?php the_time('n.j.y'); ?> in <?php echo get_the_category_list(', '); ?></p>
                </div>
                <div class="content">
                    <p><?php echo wp_trim_words(get_the_content(), 24); ?>
                    <a href="<?php the_permalink(); ?>">Learn more</a></p>
                </div>
            </div>
        <?php 
        }
    } else {
        echo ':\ Nothin';
    } get_search_form();
    ?></div> <?php echo paginate_links();
    ?>

</main> 



<?php get_footer(); ?>
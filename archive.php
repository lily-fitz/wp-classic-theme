<?php get_header(); ?>



<main id="main" class="container">
    <div class="page-banner">
        <h1>
            <?php 
                if(is_category()) {
                single_cat_title();
                } 
                if(is_author()) {
                echo "Posts by "; the_author();
                }
            ?></h1>
        <h1><?php the_archive_title(); ?></h1>
        <p><?php the_archive_description(); ?></p>
    </div>

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
    } ?></div> <?php echo paginate_links(); ?> 
    
    <?php
    $eventArchive = get_the_ID();
    $pastEvents = site_url('/pastevents');

    
    if ($eventArchive == 64 ) {
        echo '<p><a href=" ' . $pastEvents . ' ">Past Events</a></p>';
    }
    ?>

</main> 



<?php get_footer(); ?>
<?php get_header(); ?>



<main id="main" class="container">

    <?php if( have_posts() ) {
        while ( have_posts() ) {
            the_post();
            themePageBanner(); ?>
            <p>
            <a class="metabox" href="<?php echo get_post_type_archive_link('event'); ?>"
                >All Events</a
            ><span> > <?php the_title(); ?></span><br>
            <span>By <?php the_author(); ?> on <?php the_time('M Y'); ?> in <?php echo get_the_category_list(', '); ?></span>
            </p><br>
            <?php the_content();
        }
    }
    ?>

    <div class="related">
        <?php
        $guestSpeakers = get_field('guest_speakers');

        if ($guestSpeakers) {
            echo '<h2 class="event-speakers">Guest Speaker(s)</h2>';
            echo '<ul class="event-speaker-list">';
            foreach ($guestSpeakers as $speaker) { ?>
                <li><a href="<?php echo get_the_permalink($speaker); ?>">
                <img class="event-speaker-img" 
                src="<?php echo get_the_post_thumbnail_url($speaker); ?>">
                <?php echo get_the_title($speaker); the_post_thumbnail($speaker); ?>
                </a></li>
            <?php }
            echo '</ul>';  
        }  
        
        ?>
    </div>
</main> 



<?php get_footer(); ?>
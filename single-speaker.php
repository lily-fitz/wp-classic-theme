<?php get_header(); ?>



<main id="main" class="container">

    <?php if( have_posts() ) {
        while ( have_posts() ) {
            the_post();
            themePageBanner(); ?>
            
            <p>
            <a class="metabox" href="<?php echo get_post_type_archive_link('speaker'); ?>"
                >All Speakers</a
            ><span> > <?php the_title(); ?></span><br>
            <span>By <?php the_author(); ?> on <?php the_time('M Y'); ?> in <?php echo get_the_category_list(', '); ?></span>
            </p><br>
            <?php the_content();
        }
    }
    ?>
    

    <?php
    $guestSpeakers = get_field('guest_speakers');

    if ($guestSpeakers) {
        echo '<h2 class="speakers">Guest Speaker(s)</h2>';
        echo '<ul class="speaker-list">';
        foreach ($guestSpeakers as $speaker) { ?>
            <li><a href="<?php echo get_the_permalink($speaker); ?>"><?php echo get_the_title($speaker); ?></a></li>
        <?php }
        echo '</ul>';  
    }  
    
    ?>

    
    <div class="related">
        <?php
        $today = date('Ymd');
        $upcomingEvents = new WP_Query(array(
            'posts_per_page' => 3,
            'post_type' => 'event',
            'meta_key' => 'event_date',
            'orderby' => 'meta_value_num',
            'order' => 'ASC',
            'meta_query' => array(
                array(
                    'key' => 'event_date',
                    'compare' => '>=',
                    'value' => $today,
                    'type' => 'numeric'
                ),
                array(
                    'key' => 'guest_speakers',
                    'compare' => 'LIKE',
                    'value' => '"' . get_the_ID() . '"'
                )
            )
        ));

        if( $upcomingEvents->have_posts() ) {
            echo '<h2 class="speaker-upcoming-events">Upcoming Events</h2>';
            while($upcomingEvents->have_posts()){
                $upcomingEvents->the_post(); 
                get_template_part('/template-parts/content', 'event');
            } wp_reset_postdata();
            }
        ?>

    </div>
</main> 



<?php get_footer(); ?>

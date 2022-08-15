<?php 
get_header(); 
?>

<main id="main" class="container">
    <div class="archive-posts_past">
        <?php
            themePageBanner(array(
                'title' => 'Past Events',
                'subtitle' => 'I can&#8217;t believe you missed it!!'
            ));
            
            $pastEvents = new WP_Query(array(
                'paged' => get_query_var('paged', 1),
                'posts_per_page' => 1,
                'post_type' => 'event',
                'meta_key' => 'event_date',
                'orderby' => 'meta_value_num',
                'order' => 'ASC',
                'meta_query' => array(
                array(
                    'key' => 'event_date',
                    'compare' => '<',
                    'value' => date('Ymd'),
                    'type' => 'numeric'
                )
              )
            ));

            while($pastEvents->have_posts()) {
                $pastEvents->the_post(); 
                get_template_part('template-parts/content-event');
            }
            echo paginate_links(array(
                'total' => $pastEvents->max_num_pages
            ));
        ?>
    </div>
    <p><a href="<?php echo site_url('/events'); ?>">Upcoming Events</a></p>
    
</main>

<?php get_footer(); ?>
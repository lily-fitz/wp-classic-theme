<?php get_header(); ?>



<main id="main"
style="background-image: url(<?php echo get_theme_file_uri('/images/plant-whitebg-tol11.png'); ?>); background-size: cover;"
>
<div class="container">

    <?php if( have_posts() ) {
        while ( have_posts() ) {
            the_post(); 
            the_content();
        }
    }
    ?>

    <br>
    <br>
    <br>
    <div>
        <h2>Upcoming Events</h2>
        <?php
        $today = date('Ymd');
        $homepageEvents = new WP_Query(array(
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
                )
            )
        ));

        while($homepageEvents->have_posts()){
            $homepageEvents->the_post(); 
            get_template_part('/template-parts/content', 'event');
        } wp_reset_postdata();
        ?>

        <br><br>
        <p><a href="<?php echo site_url('/events'); ?>">All Upcoming Events</a></p>
        <p><a href="<?php echo site_url('/pastevents'); ?>">Past Events</a></p>
        <br><br>
        <br><br>
    </div>
    </div>  
</main> 



<?php get_footer(); ?>


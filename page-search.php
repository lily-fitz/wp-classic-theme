<?php get_header();

while(have_posts()) {
    the_post(); ?>

<main id="main">
    <div class="page-banner">
        <div class="container">
            <h1><?php the_title(); ?></h1>
        </div>
    </div>
    <?php get_search_form(); ?>
</main>


<?php } get_footer(); ?>
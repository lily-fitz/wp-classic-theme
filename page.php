<?php get_header();

while(have_posts()) {
    the_post(); ?>

<main id="main">
    <div class="page-banner" style="background-image: url(<?php $pageBannerImage = get_field('page_banner_background_image'); echo $pageBannerImage['sizes']['themePageBanner']; ?>); background-position: bottom center; border-bottom: solid black 3px;">
        <div class="container">
            <h1><?php the_title(); ?></h1>
            <p class="page-banner-subtitle about-subtitle"><?php the_field('page_banner_subtitle'); ?></p>
        </div>
    </div>
    <br>
    <br>
    <div class="container">
        <?php the_content(); ?>
    </div>
</main>


<?php } get_footer(); ?>


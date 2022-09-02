<!DOCTYPE html>
<html <?php language_attributes(); ?>> 
    <head>
        <meta charset="<?php bloginfo('charset'); ?>">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta name="description" content="myTheme">
        <meta name="Fitzmeyer" content="lilyfitz.com/22portfolio">    
        <?php wp_head(); ?>
    </head>
    <body <?php body_class(); ?>>
    <?php wp_body_open(); ?>
    <a href="#main" class="skip-to-content">Skip to Content</a>

<header>
    <nav>
        <div>
            <?php
                if(function_exists('the_custom_logo')) {
                    // the_custom_logo();
                    $myThemeLogoID = get_theme_mod('custom_logo');
                    $myThemeLogo = wp_get_attachment_image_src($myThemeLogoID);
                }
            ?>
            <a href="<?= get_site_url(); ?>"  class="logo">
                <img src="<?= $myThemeLogo[0] ?>" alt="myTheme Homepage">
            </a>
        </div>
    <nav>
</header>

<main id="main" class="single-exhibit-pagebody">
   

    <?php if( have_posts() ) {
        while ( have_posts() ) {
            the_post();
             ?>
            <div class="single-exhibit-container">
                <h4 class="single-exhibit-title"><?php the_title(); ?></h4>
            
                <div class="single-exhibit-image" style="background-image: url(<?php echo get_the_post_thumbnail_url(get_the_ID()); ?>)"></div>
                <div class="single-exhibit-content">
                    <a class="single-exhibit-close" href="<?php echo site_url('/exhibits'); ?>"
                    >&times;</a
                    >
                    <?php the_content();?>
                    <div class="exhibit-controls">
                        <div>
                        <?php previous_post_link('<i class="fa fa-arrow-left"></i>&nbsp;%link'); ?>
                        </div>
                        <div><?php next_post_link('%link <i class="fa fa-arrow-right"></i>'); ?>
                        
                        </div>
                    </div>
                </div>
            </div>
            
        <?php }
    }
    ?>


</main> 


<?php wp_footer(); ?>
</body>
</html>
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
        <div>
            <?php
              if(function_exists('the_custom_logo')) {
                  // the_custom_logo();
                  $myThemeLogoID = get_theme_mod('custom_logo');
                  $myThemeLogo = wp_get_attachment_image_src($myThemeLogoID);
              }
            ?>
            <a href="<?= get_site_url(); ?>"  class="logo">
                <img src="<?= $myThemeLogo[0] ?>" alt="myTheme">
                <p><?php bloginfo('name') ?></p>
            </a>
        </div>
        <nav class="nav">
          <?php            
            wp_nav_menu(
                array(
                    'menu' => 'Primary Menu',
                    'theme_location' => 'primary',
                    'items_wrap' => '<ul data-visible="false" class="primary-nav">%3$s</ul>'
                )
            );
          ?>
          <div class="mobile-menu-wrapper">
            <button type="button" class="menu-toggle" aria-expanded="false">
            <span></span>
          </button>
        </div>
        <button type="button" onClick="openSearch()" class="search-overlay__open"><i class="fa fa-search search-overlay__icon-full" aria-hidden="true"></i></button>
      </nav>
    </header>
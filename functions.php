<?php

// require get_theme_file_path('/inc/search-route.php');

// Register Styles

function mytheme_styles() {

    $version = wp_get_theme() -> get('Version');

    wp_enqueue_style('theme-style', get_stylesheet_uri(), array('google-fonts'), $version, 'all');

    wp_enqueue_style('theme-sass', get_theme_file_uri('/build/index.css'), null, $version, 'all');

    wp_enqueue_style('font-awesome', '//maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css');

    wp_enqueue_style('google-fonts', '//fonts.googleapis.com/css?family=Montserrat:300,300i,400,400i,500,600,700,700i|Roboto:100,300,400,400i,700,700i');

    wp_enqueue_style( 'dashicons' );
}

add_action('wp_enqueue_scripts', 'mytheme_styles');





// Register Scripts

function mytheme_scripts() {

    $version = wp_get_theme() -> get('Version');

    wp_enqueue_script('theme-script', get_theme_file_uri('/src/script.js'), array('jquery'), $version, true);

    wp_enqueue_script('theme-src-script', get_theme_file_uri('/build/index.js'), array('jquery'), $version, true);

    wp_localize_script('theme-script', 'myThemeData', array(
        'root_url' => get_site_url(),
        'nonce' => wp_create_nonce('wp_rest')
    ));
}

add_action('wp_enqueue_scripts', 'mytheme_scripts');



// Register menus

function mytheme_menus() {

    $locations = array(
        'primary' => 'Primary Menu',
        'footerone' => 'First Footer Menu',
        'footertwo' => 'Second Footer Menu'
    );

    register_nav_menus($locations);
}

add_action('init', 'mytheme_menus');




// Enqueue styles for block editor
// Enqueue google fonts to reference in editor-styles

add_action( 'enqueue_block_editor_assets', function() {
    wp_enqueue_style('custom-google-fonts', '//fonts.googleapis.com/css?family=Montserrat:300,300i,400,400i,500,600,700,700i|Roboto:100,300,400,400i,700,700i');
} );




// Add title tags, featured images, custom images sizes

function mytheme_features () {

    // $logoSpecs = array(
    //     'height'               => 32,
    //     'width'                => 32
    // );

    add_theme_support( 'editor-styles' );
    add_editor_style( 'style-editor.css' );

    // add_theme_support( 'disable-custom-colors' );
    // add_theme_support( 'disable-custom-gradients' );

    add_theme_support( 'editor-color-palette', array(
        array(
            'name'  => esc_attr__( 'stunning dream purple', 'themeLangDomain' ),
            'slug'  => 'stunning-dream-purple',
            'color' => '#7f00fe',
        ),
        array(
            'name'  => esc_attr__( 'very bright white', 'themeLangDomain' ),
            'slug'  => 'very-bright-white',
            'color' => '#fff',
        )
    ) );

    add_theme_support('title-tag');
    add_theme_support('custom-logo');

    add_theme_support('post-thumbnails');
    add_theme_support( 'responsive-embeds' );
    add_theme_support( 'align-wide' );
    
    add_image_size('themeLandscape', 400, 260, array('left', 'top'));
    add_image_size('themePortrait', 300, 460, true);
    add_image_size('themePageBanner', 1000, 350, array('center', 'center'));
}

add_action('after_setup_theme', 'mytheme_features');



// Register widget

function mytheme_widgetareas() {
    register_sidebar(
        array(
            'before_title' => '<h2>',
            'after_title' => '</h2>',
            'before_widget' => '<div>',
            'after_widget' => '</div>',
            'name' => 'Footer Paragraph',
            'id' => 'footer-paragraph',
            'description' => 'Footer Paragraph',
            'class' => 'footer-paragraph',
        )
    );
}

add_action('widgets_init', 'mytheme_widgetareas');



// Dynamic Banner

function themePageBanner($args = NULL) {
    
    if(!$args['title']) {
        $args['title'] = get_the_title();
    }
    if(!$args['subtitle']) {
        $args['subtitle'] = get_field('page_banner_subtitle');
    }

    ?>
    <div class="page-banner">
        <h1><?php echo $args['title'] ?></h1>
        <p class="page-banner-subtitle"><?php echo $args['subtitle'] ?></p>
    </div>

<?php
}



// Adjust queries

function mytheme_adjust_queries($query) {

    if (!is_admin() AND is_home() AND $query->is_main_query()) {
        $query->set('posts_per_page', 2);
    }

    if (!is_admin() AND is_post_type_archive('speakers') AND $query->is_main_query()) {
        $query->set('order_by', 'title');
        $query->set('order', 'ASC');
        $query->set('posts_per_page', -1);
    }

    if (!is_admin() AND is_post_type_archive('event') AND $query->is_main_query()) {
        $query->set('meta_key', 'event_date');
        $query->set('orderby', 'meta_value_num');
        $query->set('order', 'ASC');
        $query->set('meta_query', array(
            array(
                'key' => 'event_date',
                'compare' => '>=',
                'value' => date('Ymd'),
                'type' => 'numeric'
            )
        ));
    }
}

add_action('pre_get_posts', 'mytheme_adjust_queries');




// Remove author link

add_filter( 'get_comment_author_link', 'remove_comment_author_link', 10, 3 );
function remove_comment_author_link( $return, $author, $comment_ID ) {
	return $author;
}

// Remove comment time
function wpb_remove_comment_time($date, $d, $comment) { 
    if ( !is_admin() ) {
            return;
    } else { 
            return $date;
    }
}
add_filter( 'get_comment_time', 'wpb_remove_comment_time', 10, 3);


// Remove comment date
// function wpb_remove_comment_date($date, $d, $comment) { 
//     if ( !is_admin() ) {
//         return;
//     } else { 
//         return $date;
//     }
// }
// add_filter( 'get_comment_date', 'wpb_remove_comment_date', 10, 3);
 


//Redirect subscribers to Homepage

function redirectHome(){
    $currentUser = wp_get_current_user();

    if(count($currentUser->roles) == 1 AND $currentUser->roles[0] == 'subscriber') {
        wp_redirect(site_url('/'));
        exit;
    }
}

add_action('admin_init', 'redirectHome');



//Remove admin bar for subscribers

function hideAdminBar(){
    $currentUser = wp_get_current_user();

    if(count($currentUser->roles) == 1 AND $currentUser->roles[0] == 'subscriber') {
        show_admin_bar(false);
    }
}

add_action('wp_loaded', 'hideAdminBar');



// Sign In/Sign Out

add_filter( 'wp_nav_menu_items', 'add_to_nav_menu', 10, 2 );

function add_to_nav_menu( $nav, $args ) {

    $logoutUrl = wp_logout_url(); 
    $userAvatar = get_avatar(get_current_user_id(), 60);
    $signUpUrl = esc_url(site_url('/wp-signup.php'));
    $signInUrl = esc_url(site_url('/wp-login.php'));
    $myNotesUrl = esc_url(site_url('/notes'));


    if( is_user_logged_in() AND $args->theme_location == 'primary') {
    
        $nav .= "<li><a href='$logoutUrl'>Logout</a></li><span>$userAvatar</span>";
        return $nav;
    } elseif ( ! is_user_logged_in() AND $args->theme_location == 'primary') {
        $nav .= "<li><a href='$signInUrl'>Sign In</a></li><li><a href=' $signUpUrl'>Register</a></li>";
        return $nav;
    }
}


// Sign In Logo Links To Our Site

function signInLogoLink() {
    return esc_url(site_url('/'));
}

add_filter('login_headerurl', 'signInLogoLink');




// Enqueue styles on sign up/sign in

function custom_login_styles() {
    wp_enqueue_style('theme-style', get_stylesheet_uri(), array('google-fonts'), $version, 'all');

    wp_enqueue_style('theme-sass', get_theme_file_uri('/build/index.css'), null, $version, 'all');

    wp_enqueue_style('font-awesome', '//maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css');

    wp_enqueue_style('google-fonts', '//fonts.googleapis.com/css?family=Montserrat:300,300i,400,400i,500,600,700,700i|Roboto:100,300,400,400i,700,700i');
}

add_action('login_enqueue_scripts', 'custom_login_styles');



// Change 'powered by wordpress' on login

function loginTitle() {
    return get_bloginfo('name');
}

add_filter('login_headertext', 'loginTitle');




// add_filter( 'wp_nav_menu_items', 'add_to_nav_menu', 10, 2 );

// function add_to_nav_menu( $items, $args ) {
//     $currentUser = wp_get_current_user();


//     if (is_user_logged_in() && $currentUser->roles[0] == 'subscriber' && $args->menu == 5) {
//         $items .= '<li>Logout</li>';
//     }
//     elseif (!is_user_logged_in() && $args->menu == 5) {
//         $items .= '<li>Sign In</li>';
//     }
//     return $items;
// }



// $user = wp_get_current_user();
// $allowed_roles = array('subscriber');

// if ( array_intersect( $allowed_roles, $user->roles ) AND is_user_logged_in()) {
//     echo 'it works!!!';
// }


// add_filter( 'wp_nav_menu_items', 'add_to_nav_menu', 10, 2 );

// function add_to_nav_menu( $nav, $args ) {
//     $user = wp_get_current_user();
//     $allowed_roles = array('subscriber');

//     if( array_intersect( $allowed_roles, $user->roles ) AND is_user_logged_in() AND $args->theme_location == 'primary') {
        
//         $logoutUrl = wp_logout_url(); 
    
//         $nav .= "<li><a href='$logoutUrl'>Logout</a></li>";
//         return $nav;
//     } else {
//         $nav = $nav;
//         return $nav;
//     }
// }

// add_filter('wp_nav_menu_items','search_box_function');
//   function search_box_function ($nav){
//   return $nav."<li class='menu-header-search'><form action='http://example.com/' id='searchform' method='get'><input type='text' name='s' id='s' placeholder='Search'></form></li>";
// }


// add_filter( 'wp_nav_menu_items', 'add_main_nav_menu', 10, 2 );

// function add_main_nav_menu( $nav, $args ) {

//     if( $args->theme_location == 'primary') {
//     $nav .= "<li>123</li>";
//     return $nav;
//     } else {
//         $nav = $nav;
//     return $nav;
//     }
// }


//add_filter( 'wp_nav_menu_items', 'prefix_add_menu_item', 10, 2 );
// /**
//  * Add Menu Item to end of menu
//  */
// function prefix_add_menu_item ( $items, $args ) {
//    if( $args->theme_location == 'footerone' ) {
//        $items .=  '<li class="menu-item">...</li>';
//       } 
//        return $items;
// }



function custom_rest_info() {
    register_rest_field('post', 'authorName', array(
        'get_callback' => function() { return get_the_author(); }
    ));

    register_rest_field('event', 'guestSpeaker', array(
        'get_callback' => function() { return get_field('guest_speakers'); }
    ));
}

add_action('rest_api_init', 'custom_rest_info');
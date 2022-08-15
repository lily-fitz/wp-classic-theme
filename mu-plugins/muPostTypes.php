<?php 

function theme_custom_post_type() {
    //Event Post Type
    register_post_type('event', array(
        'rewrite' => array('slug' => 'events'),
        'public' => true,
        'labels' => array(
            'name' => 'Events',
            'add_new_item' => 'Add New Event',
            'edit_item' => 'Edit Event',
            'all_items' => 'All Events',
            'singular_name' => 'Event'
        ),
        'menu_icon' => 'dashicons-calendar',
        'show_in_rest' => true,
        'has_archive' => true,
        'supports' => array(
            'title',
            'editor',
            'excerpt'
        )
    ));

    //Speakers
    register_post_type('speaker', array(
        'capability_type' => 'event',
        'map_meta_cap' => true,
        'rewrite' => array('slug' => 'speakers'),
        'public' => true,
        'labels' => array(
            'name' => 'Speakers',
            'add_new_item' => 'Add New Speaker',
            'edit_item' => 'Edit Speaker',
            'all_items' => 'All Speakers',
            'singular_name' => 'Speaker'
        ),
        'menu_icon' => 'dashicons-testimonial',
        'show_in_rest' => true,
        'has_archive' => true,
        'supports' => array(
            'title',
            'editor',
            'thumbnail'
        )
    ));

    //Notes
    // register_post_type('note', array(
    //     'rewrite' => array('slug' => 'notes'),
    //     'public' => false,
    //     'show_ui' => true,
    //     'labels' => array(
    //         'name' => 'Notes',
    //         'add_new_item' => 'Add New Note',
    //         'edit_item' => 'Edit Note',
    //         'all_items' => 'All Notes',
    //         'singular_name' => 'Note'
    //     ),
    //     'menu_icon' => 'dashicons-welcome-write-blog',
    //     'show_in_rest' => true,
    //     'has_archive' => true,
    //     'supports' => array(
    //         'title',
    //         'editor'
    //     )
    // ));
}

add_action('init', 'theme_custom_post_type');




// function remove_custom_post_comment() {
//     remove_post_type_support( 'event', 'comments' );
// }
// add_action( 'init', 'remove_custom_post_comment' );
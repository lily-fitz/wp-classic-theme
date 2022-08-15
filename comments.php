<?php if ( post_password_required() ) {
	return;
} ?>

<div id="comments">
    <h2><?php
        if( ! have_comments()) {
            echo "Leave a Comment";
        } else {
            echo get_comments_number(). " Comments";
        }

    ?></h2>

    <ol class="comment-list">
    <?php
    wp_list_comments(
        array(
            'avatar_size' => 40,
            'style' => 'ol'
        )
    );
    ?>
    </ol>

    
    <?php

    if (comments_open()) {
        comment_form(
            array(
                'class_form' => '',
                'title_reply_before' => '<h2>',
                'title_reply_after' => '</h2>'

            )
        );
    }
    ?>
</div>
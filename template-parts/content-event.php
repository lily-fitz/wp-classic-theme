<div class="event-item">
        <span class="event-month">
            <?php
                $eventMonth = new DateTime(get_field('event_date'));
                echo $eventMonth->format('M');
            ?>
        </span>
        <span class="event-day">
            <?php
            $eventDay = new DateTime(get_field('event_date'));
            echo $eventDay->format('d');
            ?>
        </span>
    <div class="event-content">
        <h5><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h5>
        <p><?php echo wp_trim_words(get_the_content(), 14); ?> <a href="<?php the_permalink(); ?>">Learn more!!!!!</a></p>
    </div>
</div>
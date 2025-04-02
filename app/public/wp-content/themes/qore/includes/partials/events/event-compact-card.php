<?php
/**
 * Template part for displaying event cards in a compact format (past events)
 *
 * @param WP_Post $post The post object
 */

// Get event data
$event_data = get_field('date_time_group');
$start_date = $event_data['start_date'];
$end_date = $event_data['end_date'];

// Format dates for display
$formatted_start_date = date_i18n('j F Y', strtotime($start_date));
$formatted_end_date = date_i18n('j F Y', strtotime($end_date));

// Determine if it's a multi-day event
$is_multi_day = ($start_date != $end_date);
?>

<div class="bg-gray-100 rounded-lg overflow-hidden hover:shadow-md transition-shadow duration-300">
    <?php if (has_post_thumbnail()) : ?>
        <div class="relative h-48 overflow-hidden opacity-75">
            <?php the_post_thumbnail('medium_large', ['class' => 'w-full h-full object-cover']); ?>
            <div class="absolute inset-0 bg-black bg-opacity-20"></div>
        </div>
    <?php endif; ?>
    
    <div class="p-6">
        <div class="text-sm text-gray-600 mb-2">
            <?php if ($is_multi_day) : ?>
                <?php echo $formatted_start_date; ?> - <?php echo $formatted_end_date; ?>
            <?php else : ?>
                <?php echo $formatted_start_date; ?>
            <?php endif; ?>
        </div>
        
        <h3 class="text-lg font-bold mb-2">
            <a href="<?php the_permalink(); ?>" class="text-gray-700 hover:text-primary transition-colors duration-200">
                <?php the_title(); ?>
            </a>
        </h3>
        
        <a href="<?php the_permalink(); ?>" class="text-primary hover:text-primary-dark text-sm font-medium transition-colors duration-200">
            Bekijk terugblik
        </a>
    </div>
</div>
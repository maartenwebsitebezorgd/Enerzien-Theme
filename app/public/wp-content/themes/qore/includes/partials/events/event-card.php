<?php
/**
 * Template part for displaying event cards
 *
 * @param WP_Post $post The post object
 */

// Get event data
$event_data = get_field('date_time_group');
$start_date = $event_data['start_date'];
$start_time = $event_data['start_time'];
$end_date = $event_data['end_date'];
$end_time = $event_data['end_time'];
$location = get_field('location');
$location_url = get_field('location_url');

// Format dates for display
$formatted_start_date = date_i18n('j F Y', strtotime($start_date));
$formatted_end_date = date_i18n('j F Y', strtotime($end_date));
$formatted_start_time = !empty($start_time) ? date_i18n('H:i', strtotime($start_time)) : '';
$formatted_end_time = !empty($end_time) ? date_i18n('H:i', strtotime($end_time)) : '';

// Determine if it's a multi-day event
$is_multi_day = ($start_date != $end_date);

// Get today's date for comparison
$today = date('Y-m-d');

// Check if this is a past event
$is_past_event = ($end_date < $today);

// Additional CSS classes based on event status
$card_classes = $is_past_event ? 'bg-gray-100' : 'bg-white shadow-lg hover:shadow-xl';
$image_classes = $is_past_event ? 'opacity-75' : '';
?>

<div class="<?php echo $card_classes; ?> rounded-lg overflow-hidden transition-shadow duration-300">
    <?php if (has_post_thumbnail()): ?>
        <div class="relative aspect-[3/2] overflow-hidden">
            <?php the_post_thumbnail('medium_large', ['class' => 'w-full h-full object-cover ' . $image_classes]); ?>
            <?php if ($is_past_event): ?>
                <div class="absolute inset-0 bg-black bg-opacity-10"></div>
            <?php endif; ?>
        </div>
    <?php endif; ?>

    <div class="p-6">
        <h3 class="text-xl font-bold mb-1">
            <a href="<?php the_permalink(); ?>"
                class="text-primary hover:text-primary-dark transition-colors duration-200">
                <?php the_title(); ?>
            </a>
        </h3>

        <div class="text-gray-700 mb-6">
            <?php echo wp_trim_words(get_the_excerpt(), 20); ?>
        </div>
        <div class="text-sm text-gray-600 mb-3 flex items-center">
            <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 mr-1" fill="none" viewBox="0 0 24 24"
                stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                    d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z" />
            </svg>
            <?php if ($is_multi_day): ?>
                <span>
                    <?php echo $formatted_start_date; ?> -
                    <?php echo $formatted_end_date; ?>
                </span>
            <?php else: ?>
                <span>
                    <?php echo $formatted_start_date; ?>
                </span>
            <?php endif; ?>
        </div>

        <?php if (!empty($formatted_start_time) || !empty($formatted_end_time)): ?>
            <div class="text-sm text-gray-600 mb-3 flex items-center">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 mr-1" fill="none" viewBox="0 0 24 24"
                    stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" />
                </svg>
                <span>
                    <?php
                    if (!empty($formatted_start_time) && !empty($formatted_end_time)) {
                        echo $formatted_start_time . ' - ' . $formatted_end_time;
                    } elseif (!empty($formatted_start_time)) {
                        echo 'Vanaf ' . $formatted_start_time;
                    } elseif (!empty($formatted_end_time)) {
                        echo 'Tot ' . $formatted_end_time;
                    }
                    ?>
                </span>
            </div>
        <?php endif; ?>

        <?php if ($location): ?>
            <div class="text-sm text-gray-600 mb-4 flex items-start">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 mr-1 mt-0.5" fill="none" viewBox="0 0 24 24"
                    stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z" />
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M15 11a3 3 0 11-6 0 3 3 0 016 0z" />
                </svg>
                <?php if ($location_url): ?>
                    <a href="<?php echo esc_url($location_url); ?>" target="_blank"
                        class="hover:text-primary transition-colors duration-200">
                        <?php echo esc_html($location); ?>
                    </a>
                <?php else: ?>
                    <span>
                        <?php echo esc_html($location); ?>
                    </span>
                <?php endif; ?>
            </div>
        <?php endif; ?>

        <a href="<?php the_permalink(); ?>"
            class="inline-block bg-primary hover:bg-primary-dark text-white font-bold py-2 px-4 rounded transition-colors duration-200">
            <?php echo $is_past_event ? 'Bekijk terugblik' : 'Meer informatie'; ?>
        </a>
    </div>
</div>
<?php
/**
 * The template for displaying single event posts
 */

get_header(); ?>

<main class="site-main">
    <?php while (have_posts()) : the_post(); 
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
        
        // Check if event is in the past
        $today = date('Y-m-d');
        $is_past_event = ($end_date < $today);
    ?>

    <div class="bg-base-100 py-12">
        <div class="container mx-auto px-4">
            <div class="flex flex-wrap -mx-4">
                <div class="w-full lg:w-8/12 px-4 mb-8 lg:mb-0">
                <h1 class="text-3xl md:text-4xl font-heading font-bold mb-6"><?php the_title(); ?></h1>
                    <?php 
                    // Check if there's a main image in ACF field
                    $main_image = get_field('main_image');
                    
                    if ($main_image) : ?>
                        <div class="mb-8 rounded-lg overflow-hidden">
                            <img src="<?php echo esc_url($main_image['url']); ?>" 
                                 alt="<?php echo esc_attr($main_image['alt']); ?>" 
                                 class="w-full h-auto" />
                        </div>
                    <?php elseif (has_post_thumbnail()) : ?>
                        <div class="mb-8 rounded-lg overflow-hidden">
                            <?php the_post_thumbnail('large', ['class' => 'w-full h-auto']); ?>
                        </div>
                    <?php endif; ?>
                    
                    
                    
                    <div class="prose max-w-none mb-8">
                        <?php the_content(); ?>
                    </div>
                </div>
                
                <div class="w-full lg:w-4/12 px-4">
                    <div class="bg-white rounded-lg shadow-md p-6 mb-8 sticky top-24">
                        <h3 class="text-xl font-bold mb-4">Evenement details</h3>
                        
                        <div class="border-t border-gray-200 pt-4">
                            <div class="mb-4">
                                <div class="flex items-start">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2 text-primary mt-0.5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z" />
                                    </svg>
                                    <div>
                                        <span class="font-bold block">Datum</span>
                                        <?php if ($is_multi_day) : ?>
                                            <span><?php echo $formatted_start_date; ?> - <?php echo $formatted_end_date; ?></span>
                                        <?php else : ?>
                                            <span><?php echo $formatted_start_date; ?></span>
                                        <?php endif; ?>
                                    </div>
                                </div>
                            </div>
                            
                            <?php if (!empty($formatted_start_time) || !empty($formatted_end_time)): ?>
                            <div class="mb-4">
                                <div class="flex items-start">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2 text-primary mt-0.5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" />
                                    </svg>
                                    <div>
                                        <span class="font-bold block">Tijd</span>
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
                                </div>
                            </div>
                            <?php endif; ?>
                            
                            <?php if ($location) : ?>
                                <div class="mb-4">
                                    <div class="flex items-start">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2 text-primary mt-0.5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z" />
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z" />
                                        </svg>
                                        <div>
                                            <span class="font-bold block">Locatie</span>
                                            <?php if ($location_url) : ?>
                                                <a href="<?php echo esc_url($location_url); ?>" target="_blank" class="text-primary hover:underline">
                                                    <?php echo esc_html($location); ?> <span class="text-xs">(Maps)</span>
                                                </a>
                                            <?php else : ?>
                                                <span><?php echo esc_html($location); ?></span>
                                            <?php endif; ?>
                                        </div>
                                    </div>
                                </div>
                            <?php endif; ?>

                            <?php 
                            $organisator = get_field('organisator');
                            if ($organisator) : ?>
                                <div class="mb-4">
                                    <div class="flex items-start">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2 text-primary mt-0.5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" />
                                        </svg>
                                        <div>
                                            <span class="font-bold block">Organisator</span>
                                            <span><?php echo esc_html($organisator); ?></span>
                                        </div>
                                    </div>
                                </div>
                            <?php endif; ?>
                        </div>
                        
                        <?php
                        // Get registration data if available
                        $registration_data = get_field('registration');
                        $registration_url = !empty($registration_data['url']) ? $registration_data['url'] : '';
                        $registration_label = !empty($registration_data['label']) ? $registration_data['label'] : 'Aanmelden voor dit evenement';
                        
                        // Only show registration button if there's a URL and the event is not in the past
                        if (!$is_past_event && !empty($registration_url)) : ?>
                            <div class="mt-6">
                                <a href="<?php echo esc_url($registration_url); ?>" 
                                   target="<?php echo strpos($registration_url, get_site_url()) === 0 ? '_self' : '_blank'; ?>"
                                   class="block w-full bg-primary hover:bg-primary-dark text-white text-center font-bold py-3 px-4 rounded transition-colors duration-200">
                                    <?php echo esc_html($registration_label); ?>
                                </a>
                            </div>
                        <?php endif; ?>
                        
                        <div class="mt-6">
                            <a href="<?php echo get_post_type_archive_link('event'); ?>" class="block text-center text-primary hover:text-primary-dark font-medium">
                                ← Terug naar alle evenementen
                            </a>
                        </div>
                    </div>
                    
                    <?php
                    // Get related events
                    $related_args = array(
                        'post_type' => 'event',
                        'posts_per_page' => 3,
                        'post__not_in' => array(get_the_ID()),
                        'orderby' => 'rand',
                    );
                    
                    $related_events = new WP_Query($related_args);
                    
                    if ($related_events->have_posts()) : ?>
                        <div class="bg-white rounded-lg shadow-md p-6">
                            <h3 class="text-xl font-bold mb-4">Andere evenementen</h3>
                            
                            <?php while ($related_events->have_posts()) : $related_events->the_post(); 
                                $event_data = get_field('date_time_group');
                                $start_date = $event_data['start_date'];
                                $formatted_date = date_i18n('j F Y', strtotime($start_date));
                            ?>
                                <div class="border-t border-gray-200 py-4">
                                    <div class="text-sm text-gray-600 mb-1"><?php echo $formatted_date; ?></div>
                                    <h4 class="font-bold mb-1">
                                        <a href="<?php the_permalink(); ?>" class="hover:text-primary transition-colors duration-200">
                                            <?php the_title(); ?>
                                        </a>
                                    </h4>
                                </div>
                            <?php endwhile; ?>
                            
                            <?php wp_reset_postdata(); ?>
                        </div>
                    <?php endif; ?>
                </div>
            </div>
        </div>
    </div>

    <?php endwhile; ?>
</main>

<?php get_footer(); ?>
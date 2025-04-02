<?php
/**
 * The template for displaying event archive pages
 */

get_header(); ?>

<!-- Hero Heading Section -->
<section class="py-20 md:py-24 bg-base-200">
    <div class="container">
        <h1 class="h1 leading-[1.1] font-bold max-w-[90%] md:max-w-[80%]">
            Onze evenementen
        </h1>
        <p class="text-lg text-gray-600 max-w-xl mt-4">
            Ontdek onze evenementen en bijeenkomsten over duurzame energie, klimaattransitie en innovatie.
        </p>
    </div>
</section>

<section class="py-12">
    <div class="container">
        <?php
        // Get current date in Y-m-d format for comparison
        $today = date('Y-m-d');

        // Query for upcoming events (start date >= today OR today is between start and end date)
        $upcoming_args = array(
            'post_type' => 'event',
            'posts_per_page' => -1,
            'meta_query' => array(
                'relation' => 'OR',
                // Start date is in the future
                array(
                    'key' => 'date_time_group_start_date',
                    'value' => $today,
                    'compare' => '>=',
                    'type' => 'DATE'
                ),
                // Event is currently happening (between start and end)
                array(
                    'relation' => 'AND',
                    array(
                        'key' => 'date_time_group_start_date',
                        'value' => $today,
                        'compare' => '<=',
                        'type' => 'DATE'
                    ),
                    array(
                        'key' => 'date_time_group_end_date',
                        'value' => $today,
                        'compare' => '>=',
                        'type' => 'DATE'
                    )
                )
            ),
            'meta_key' => 'date_time_group_start_date',
            'orderby' => 'meta_value',
            'order' => 'ASC',
        );

        $upcoming_events = new WP_Query($upcoming_args);
        ?>

        <!-- Upcoming Events Section -->
        <div class="mb-16">
            <div class="flex justify-between items-center mb-8">
                <h2 class="text-3xl font-heading font-bold">Aankomende Evenementen</h2>
            </div>

            <?php if ($upcoming_events->have_posts()): ?>
                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
                    <?php
                    while ($upcoming_events->have_posts()):
                        $upcoming_events->the_post();
                        get_template_part('includes/partials/events/event', 'card');
                    endwhile;
                    wp_reset_postdata();
                    ?>
                </div>
            <?php else: ?>
                <div class="text-center py-12 bg-gray-50 rounded-lg">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-16 w-16 mx-auto text-gray-400 mb-4" fill="none"
                        viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5"
                            d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z" />
                    </svg>
                    <p class="text-lg text-gray-600">Er zijn momenteel geen aankomende evenementen gepland.</p>
                    <p class="text-sm text-gray-500 mt-2">Bekijk onze eerdere evenementen of kom later terug.</p>
                </div>
            <?php endif; ?>
        </div>

        <?php
        // Query for past events (end date < today)
        $past_args = array(
            'post_type' => 'event',
            'posts_per_page' => isset($_GET['show_all_past']) ? -1 : 6,
            'meta_query' => array(
                array(
                    'key' => 'date_time_group_end_date',
                    'value' => $today,
                    'compare' => '<',
                    'type' => 'DATE'
                )
            ),
            'meta_key' => 'date_time_group_start_date',
            'orderby' => 'meta_value',
            'order' => 'DESC',
        );

        $past_events = new WP_Query($past_args);
        $past_count = $past_events->found_posts;
        ?>

        <!-- Past Events Section -->
        <div>
            <div class="flex justify-between items-center mb-8">
                <h2 class="text-3xl font-heading font-bold">Eerdere Evenementen</h2>

                <?php if ($past_count > 6 && !isset($_GET['show_all_past'])): ?>
                    <a href="?show_all_past=1"
                        class="text-primary hover:text-primary-dark font-medium inline-flex items-center">
                        Bekijk alle
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 ml-1" fill="none" viewBox="0 0 24 24"
                            stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7" />
                        </svg>
                    </a>
                <?php endif; ?>
            </div>

            <?php if ($past_events->have_posts()): ?>
                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
                    <?php
                    while ($past_events->have_posts()):
                        $past_events->the_post();
                        get_template_part('includes/partials/events/event', 'compact-card');
                    endwhile;
                    wp_reset_postdata();
                    ?>
                </div>

                <?php if (isset($_GET['show_all_past'])): ?>
                    <div class="text-center mt-10">
                        <a href="<?php echo get_post_type_archive_link('event'); ?>"
                            class="inline-block border border-primary text-primary hover:bg-primary hover:text-white font-bold py-2 px-6 rounded transition-colors duration-200">
                            Toon minder
                        </a>
                    </div>
                <?php endif; ?>

            <?php else: ?>
                <div class="text-center py-10 bg-gray-50 rounded-lg">
                    <p class="text-gray-600">Er zijn nog geen eerdere evenementen.</p>
                </div>
            <?php endif; ?>
        </div>
    </div>
</section>

<?php get_footer(); ?>
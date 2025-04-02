<?php

$register_post_type_events = function () {
    $post_type_name = 'event';

    register_post_type(
        $post_type_name,
        [
            'labels' => [
                'name' => __("Evenementen", 'qore'),
                'singular_name' => __("Evenement", 'qore'),
                'all_items' => __('Overzicht', 'qore'),
                'add_new' => __('Nieuw evenement', 'qore'),
                'add_new_item' => __('Evenement toevoegen', 'qore'),
                'edit' => __('Wijzig', 'qore'),
                'edit_item' => __('Wijzig evenement', 'qore'),
                'new_item' => __('Voeg nieuw evenement toe', 'qore'),
                'view_item' => __('Toon evenement', 'qore'),
                'search_items' => __('Zoeken naar evenement(en)', 'qore'),
                'not_found' => __('Niks gevonden in de database.', 'qore'),
                'not_found_in_trash' => __('Niks gevonden in de prullenbak.', 'qore'),
                'parent_item_colon' => '',
            ],
            'description' => __('Custom post type voor ' . $post_type_name, 'qore'),
            'public' => true,
            'publicly_queryable' => true,
            'exclude_from_search' => false,
            'show_in_nav_menus' => true,
            'show_ui' => true,
            'query_var' => true,
            'menu_position' => 10,
            'menu_icon' => 'dashicons-calendar-alt',
            'rewrite' => [
                'slug' => 'evenement',
                'with_front' => false,
            ],
            'has_archive' => true,
            'hierarchical' => false,
            'show_in_rest' => true,
            'capability_type' => 'post',
            'supports' => ['title', 'excerpt', 'editor', 'thumbnail', 'revisions'],
        ]
    );

    // Register ACF fields for events
    if (function_exists('acf_add_local_field_group')) {
        acf_add_local_field_group(array(
            'key' => 'group_event_details',
            'title' => 'Event Details',
            'fields' => array(
                array(
                    'key' => 'field_event_opening_times',
                    'label' => 'Opening Times',
                    'name' => 'opening_times',
                    'type' => 'text',
                    'instructions' => 'Enter the opening times (e.g. "9:00 - 17:00")',
                    'required' => 0,
                ),
                array(
                    'key' => 'field_event_start_date',
                    'label' => 'Start Date & Time',
                    'name' => 'start_date_time',
                    'type' => 'date_time_picker',
                    'instructions' => 'Select the start date and time',
                    'required' => 1,
                    'display_format' => 'd/m/Y g:i a',
                    'return_format' => 'Y-m-d H:i:s',
                ),
                array(
                    'key' => 'field_event_end_date',
                    'label' => 'End Date & Time',
                    'name' => 'end_date_time',
                    'type' => 'date_time_picker',
                    'instructions' => 'Select the end date and time',
                    'required' => 1,
                    'display_format' => 'd/m/Y g:i a',
                    'return_format' => 'Y-m-d H:i:s',
                ),
            ),
            'location' => array(
                array(
                    array(
                        'param' => 'post_type',
                        'operator' => '==',
                        'value' => 'event',
                    ),
                ),
            ),
            'menu_order' => 0,
            'position' => 'normal',
            'style' => 'default',
            'label_placement' => 'top',
            'instruction_placement' => 'label',
            'hide_on_screen' => '',
        ));
    }
};

add_action('init', $register_post_type_post_type);
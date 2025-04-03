<?php

$register_post_type_post_type = function () {
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
                'slug' => 'evenementen',
                'with_front' => false,
            ],
            'has_archive' => 'evenementen',
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
                    'label' => 'Openingstijden',
                    'name' => 'opening_times',
                    'type' => 'text',
                    'instructions' => 'Vul de openingstijden in (e.g. "9:00 - 17:00 of elke vrij. 17:00")',
                    'required' => 0,
                ),
                array(
                    'key' => 'field_event_date_time_group',
                    'label' => 'Datum en tijd',
                    'name' => 'date_time_group',
                    'type' => 'group',
                    'layout' => 'table',
                    'sub_fields' => array(
                        array(
                            'key' => 'field_event_start_date',
                            'label' => 'Start Datum',
                            'name' => 'start_date',
                            'type' => 'date_picker',
                            'instructions' => '',
                            'required' => 1,
                            'display_format' => 'd/m/Y',
                            'return_format' => 'Y-m-d',
                            'wrapper' => array(
                                'width' => '25',
                                'class' => '',
                                'id' => '',
                            ),
                        ),
                        array(
                            'key' => 'field_event_start_time',
                            'label' => 'Start Tijd',
                            'name' => 'start_time',
                            'type' => 'time_picker',
                            'instructions' => '',
                            'required' => 0,
                            'display_format' => 'H:i',
                            'return_format' => 'H:i:s',
                            'wrapper' => array(
                                'width' => '25',
                                'class' => '',
                                'id' => '',
                            ),
                        ),
                        array(
                            'key' => 'field_event_end_date',
                            'label' => 'Eind Datum',
                            'name' => 'end_date',
                            'type' => 'date_picker',
                            'instructions' => '',
                            'required' => 1,
                            'display_format' => 'd/m/Y',
                            'return_format' => 'Y-m-d',
                            'wrapper' => array(
                                'width' => '25',
                                'class' => '',
                                'id' => '',
                            ),
                        ),
                        array(
                            'key' => 'field_event_end_time',
                            'label' => 'Eind Tijd',
                            'name' => 'end_time',
                            'type' => 'time_picker',
                            'instructions' => '',
                            'required' => 0,
                            'display_format' => 'H:i',
                            'return_format' => 'H:i:s',
                            'wrapper' => array(
                                'width' => '25',
                                'class' => '',
                                'id' => '',
                            ),
                        ),
                    ),
                ),
                array(
                    'key' => 'field_event_location',
                    'label' => 'Locatie',
                    'name' => 'location',
                    'type' => 'text',
                    'instructions' => 'Vul de locatie van het evenement in',
                    'required' => 0,
                ),
                array(
                    'key' => 'field_event_location_url',
                    'label' => 'Locatie URL',
                    'name' => 'location_url',
                    'type' => 'url',
                    'instructions' => 'Voer een Google Maps URL in voor deze locatie',
                    'required' => 0,
                ),
                array(
                    'key' => 'field_event_organisator',
                    'label' => 'Organisator',
                    'name' => 'organisator',
                    'type' => 'text',
                    'instructions' => 'Organisator(s) van het evenement',
                    'required' => 0,
                ),
                array(
                    'key' => 'field_event_main_image',
                    'label' => 'Hoofdafbeelding',
                    'name' => 'main_image',
                    'type' => 'image',
                    'instructions' => 'Deze afbeelding wordt gebruikt op de detailpagina van het evenement. Als niet ingevuld, wordt de uitgelichte afbeelding gebruikt.',
                    'required' => 0,
                    'return_format' => 'array',
                    'preview_size' => 'medium',
                    'library' => 'all',
                ),
                array(
                    'key' => 'field_event_registration',
                    'label' => 'Aanmeldingsgegevens',
                    'name' => 'registration',
                    'type' => 'group',
                    'instructions' => 'Optionele instellingen voor aanmelding bij het evenement',
                    'required' => 0,
                    'layout' => 'block',
                    'sub_fields' => array(
                        array(
                            'key' => 'field_event_registration_url',
                            'label' => 'Aanmeld URL',
                            'name' => 'url',
                            'type' => 'url',
                            'instructions' => 'Externe URL of interne pagina waar bezoekers zich kunnen aanmelden',
                            'required' => 0,
                        ),
                        array(
                            'key' => 'field_event_registration_label',
                            'label' => 'Aanmeld Knoptekst',
                            'name' => 'label',
                            'type' => 'text',
                            'instructions' => 'Tekst voor de aanmeldknop (standaard: "Aanmelden voor dit evenement")',
                            'required' => 0,
                            'default_value' => 'Aanmelden voor dit evenement',
                            'placeholder' => 'Aanmelden voor dit evenement',
                        ),
                    ),
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
    };

    register_taxonomy_for_object_type('category', $post_type_name, );
    register_taxonomy_for_object_type('post_tag', $post_type_name, );
};

add_action('init', $register_post_type_post_type);

// Make sure our custom archive template is used
function event_archive_template($template) {
    if (is_post_type_archive('event')) {
        $theme_files = array('archive-event.php', 'archive.php');
        $exists_in_theme = locate_template($theme_files, false);
        if ($exists_in_theme != '') {
            return $exists_in_theme;
        }
    }
    return $template;
}
add_filter('template_include', 'event_archive_template', 99);
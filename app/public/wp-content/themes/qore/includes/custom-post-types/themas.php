<?php

$register_post_type_post_type = function () {
    $post_type_name = 'themas'; // Wat wordt de naam van de post type?

    register_post_type(
        $post_type_name,
        [
            'labels' => [
                'name' => __("Thema's", 'qore'),
                'singular_name' => __("Thema's", 'qore'),
                'all_items' => __('Overzicht', 'qore'),
                'add_new' => __('Nieuw item', 'qore'),
                'add_new_item' => __('Item toevoegen', 'qore'),
                'edit' => __('Wijzig', 'qore'),
                'edit_item' => __('Wijzig item', 'qore'),
                'new_item' => __('Voeg nieuw item toe', 'qore'),
                'view_item' => __('Toon item', 'qore'),
                'search_items' => __('Zoeken naar item(s)', 'qore'),
                'not_found' => __('Niks gevonden in de database.', 'qore'),
                'not_found_in_trash' => __('Niks gevonden en de prullenbak.', 'qore'),
                'parent_item_colon' => '',
            ],
            'description' => __('Custom post type voor '.$post_type_name, 'qore'),
            'public' => true,
            'publicly_queryable' => true,
            'exclude_from_search' => true,
            'show_in_nav_menus' => true,
            'show_ui' => true,
            'query_var' => true,
            'menu_position' => 7,
            'menu_icon' => 'dashicons-art',
            'rewrite' => [
                'slug' => 'thema',
                'with_front' => false,
            ],
            'has_archive' => false,
            'capability_type' => 'post',
            'hierarchical' => true,
            'show_in_rest' => false,
            'supports' => ['title', 'excerpt', 'thumbnail', 'page-attributes', 'revisions'],
        ]
    );

    // register_taxonomy_for_object_type('category', $post_type_name, ); // Voeg categorieën toe -> Uit 'committen' om niet te gebruiken
    // register_taxonomy_for_object_type('post_tag', $post_type_name, ); // Voeg tags toe -> Uit 'committen' om niet te gebruiken
};

add_action('init', $register_post_type_post_type);

<?php

/**
 * For more info: https://developer.wordpress.org/themes/basics/theme-functions/
 */

// Theme support options
include_once get_template_directory() . '/includes/functions/theme-support.php';

// Register scripts and stylesheets
include_once get_template_directory() . '/includes/functions/enqueue-scripts.php';

// Shortcodes
include_once get_template_directory() . '/includes/shortcodes/shortcodes.php';

// Register custom menus and menu walkers
include_once get_template_directory() . '/includes/functions/menu.php';

// Register sidebars/widget areas
include_once get_template_directory() . '/includes/functions/sidebar.php';

// Replace 'older/newer' post links with numbered navigation
include_once get_template_directory() . '/includes/functions/pagination.php';

// Makes WordPress comments suck less
// include_once(get_template_directory().'/includes/functions/comments.php');

// Adds site styles to the WordPress editor
// include_once(get_template_directory().'/includes/functions/editor-styles.php');

// Remove Emoji Support
include_once get_template_directory() . '/includes/functions/disable-emoji.php';

// Custom Post Types
include_once get_template_directory() . '/includes/custom-post-types/reviews.php';
include_once get_template_directory() . '/includes/custom-post-types/projecten.php';
include_once get_template_directory() . '/includes/custom-post-types/themas.php';
include_once get_template_directory() . '/includes/custom-post-types/partners.php';
include_once get_template_directory() . '/includes/custom-post-types/vacatures.php';
include_once get_template_directory() . '/includes/custom-post-types/events.php';

// Taxonomies
// include_once get_template_directory() . '/includes/taxonomies/taxonomy-sample.php';

// Add custom functions here!
include_once get_template_directory() . '/includes/functions/custom.php';

// Set plugin data and improvements
include_once get_template_directory() . '/includes/functions/plugins.php';

function add_vacancy_templates($post_templates, $wp_theme, $post, $post_type)
{
    // Only add this template to vacancies post type
    if ($post_type === 'vacatures') {
        $post_templates['_pagebuilder.php'] = 'Page Builder';
    }
    return $post_templates;
}
add_filter('theme_templates', 'add_vacancy_templates', 10, 4);

function add_project_templates($post_templates, $wp_theme, $post, $post_type)
{
    // Only add this template to vacancies post type
    if ($post_type === 'project') {
        $post_templates['_pagebuilder.php'] = 'Page Builder';
    }
    return $post_templates;
}
add_filter('theme_templates', 'add_project_templates', 10, 4);

add_filter('wp_calculate_image_sizes', 'customize_image_sizes', 10, 5);
function customize_image_sizes($sizes, $size, $image_src, $image_meta, $attachment_id)
{
    return '(max-width: 1200px) 100vw, 1200px';
}

function enqueue_archive_scripts()
{
    if (is_home() || is_archive()) {
        wp_enqueue_script(
            'category-filter',
            get_template_directory_uri() . '/src/assets/js/category-filter.js',
            array('jquery'),
            '1.0',
            true
        );

        wp_localize_script('category-filter', 'categoryFilter', array(
            'ajaxurl' => admin_url('admin-ajax.php'),
            'nonce' => wp_create_nonce('category_filter_nonce')
        ));
    }
}
add_action('wp_enqueue_scripts', 'enqueue_archive_scripts');

// AJAX handler for filtered posts
function load_filtered_posts()
{
    check_ajax_referer('category_filter_nonce', 'nonce');

    $paged = $_POST['page'] ?? 1;
    $category = $_POST['category'] ?? '';

    $args = array(
        'post_type' => 'post',
        'post_status' => 'publish',
        'posts_per_page' => get_option('posts_per_page'),
        'paged' => $paged,
        // Add language parameter if you're using WPML or Polylang
        'lang' => 'nl', // For Dutch
    );

    if ($category && $category !== 'all') {
        $args['tax_query'] = array(
            array(
                'taxonomy' => 'category',
                'field' => 'slug',
                'terms' => $category
            )
        );
    }

    $query = new WP_Query($args);

    ob_start();
    if ($query->have_posts()):
        while ($query->have_posts()):
            $query->the_post();
            get_template_part('includes/partials/articles/article', 'main');
        endwhile;
    else:
        echo '<p class="text-center text-gray-600">' . __('Geen berichten gevonden.', 'your-theme-textdomain') . '</p>';
    endif;

    $posts = ob_get_clean();

    // Dutch translations for pagination
    $pagination = paginate_links(array(
        'total' => $query->max_num_pages,
        'current' => $paged,
        'format' => '?paged=%#%',
        'prev_text' => __('&laquo; Vorige', 'your-theme-textdomain'),
        'next_text' => __('Volgende &raquo;', 'your-theme-textdomain'),
        'type' => 'array'
    ));

    wp_reset_postdata();

    wp_send_json_success(array(
        'posts' => $posts,
        'pagination' => $pagination,
        'max_pages' => $query->max_num_pages
    ));
}

// Add Dutch translations for the "All Posts" filter
function modify_archive_header()
{
    if (is_home() || is_archive()): ?>
        <div class="filter">
            <input data-filter="all" value="all" type="radio" name="cat" id="all" class="peer hidden" <?php echo (!is_category()) ? 'checked' : ''; ?> />
            <label for="all"
                class="min-h-[53px] cursor-pointer transition-all hover:bg-base-300 bg-base-200 inline-flex items-center justify-center rounded-md leading-none font-bold font-heading pt-5 pb-4 px-8 text-primary capitalize mr-4 mb-4 peer-checked:bg-primary peer-checked:text-white">
                <span class="text-inherit">
                    <?php _e('Alle berichten', 'your-theme-textdomain'); ?>
                </span>
            </label>
        </div>
    <?php endif;
}
add_action('wp_ajax_load_filtered_posts', 'load_filtered_posts');
add_action('wp_ajax_nopriv_load_filtered_posts', 'load_filtered_posts');

// Add featured post option
function add_featured_post_meta()
{
    add_meta_box(
        'featured_post',           // ID
        'Featured Post',           // Title
        'featured_post_callback',  // Callback function
        'post',                    // Post type
        'side',                    // Context
        'high'                     // Priority
    );
}
add_action('add_meta_boxes', 'add_featured_post_meta');

// Callback function for the meta box
function featured_post_callback($post)
{
    $featured = get_post_meta($post->ID, 'featured_post', true);
    wp_nonce_field('featured_post_nonce', 'featured_post_nonce');
    ?>
    <label>
        <input type="checkbox" name="featured_post" value="1" <?php checked($featured, '1'); ?>>
        Mark as featured post
    </label>
    <?php
}

// Save featured post status
function save_featured_post($post_id)
{
    if (!isset($_POST['featured_post_nonce']) || !wp_verify_nonce($_POST['featured_post_nonce'], 'featured_post_nonce')) {
        return;
    }

    if (defined('DOING_AUTOSAVE') && DOING_AUTOSAVE) {
        return;
    }

    if (!current_user_can('edit_post', $post_id)) {
        return;
    }

    $featured = isset($_POST['featured_post']) ? '1' : '0';
    update_post_meta($post_id, 'featured_post', $featured);
}
add_action('save_post', 'save_featured_post');

// Add this to your functions.php

// Add Featured column to posts list
function add_featured_column($columns)
{
    $new_columns = array();
    foreach ($columns as $key => $title) {
        if ($key == 'title') { // Add after title column
            $new_columns[$key] = $title;
            $new_columns['featured'] = 'Featured';
        } else {
            $new_columns[$key] = $title;
        }
    }
    return $new_columns;
}
add_filter('manage_posts_columns', 'add_featured_column');

// Add Featured status to column
function show_featured_column($column_name, $post_id)
{
    if ($column_name == 'featured') {
        $featured = get_post_meta($post_id, 'featured_post', true);
        echo '<div class="featured-status">';
        if ($featured == '1') {
            echo '★';
        }
        echo '</div>';
    }
}
add_action('manage_posts_custom_column', 'show_featured_column', 10, 2);

// Add Featured checkbox to Quick Edit
function add_quick_edit_featured()
{
    global $typenow;
    if ($typenow == 'post') {
        // Add custom styling for the featured column
        ?>
        <style>
            .column-featured {
                width: 60px;
                text-align: center;
            }

            .featured-status {
                color: #f1c40f;
                font-size: 18px;
            }
        </style>
        <script type="text/javascript">
            jQuery(document).ready(function ($) {
                // Add the field to Quick Edit
                $('#bulk-edit').find('.inline-edit-col-right-wide')
                    .before($('#featured-template').html());

                // Add the field to Bulk Edit
                $('.inline-edit-col').find('.inline-edit-group')
                    .before($('#featured-template').html());

                // Handle population of our custom field
                $('body').on('click', '#the-list .editinline', function () {
                    var post_id = $(this).closest('tr').attr('id');
                    post_id = post_id.replace('post-', '');

                    var $featured = $('#edit-' + post_id).find('.featured-status').text();
                    var $editRow = $('#edit-' + post_id);

                    $editRow.find(':input[name="featured_post"]')
                        .prop('checked', $featured === '★');
                });
            });
        </script>
        <script type="text/template" id="featured-template">
                                                                                                                                                    <div class="inline-edit-group wp-clearfix">
                                                                                                                                                        <label class="alignleft">
                                                                                                                                                            <input type="checkbox" name="featured_post" value="1">
                                                                                                                                                            <span class="checkbox-title">Featured</span>
                                                                                                                                                        </label>
                                                                                                                                                    </div>
                                                                                                                                                </script>
        <?php
    }
}
add_action('admin_footer', 'add_quick_edit_featured');

// Save Featured status from Quick Edit
function save_quick_edit_featured($post_id)
{
    if (defined('DOING_AUTOSAVE') && DOING_AUTOSAVE) {
        return $post_id;
    }

    if (!current_user_can('edit_post', $post_id)) {
        return $post_id;
    }

    // Only update if the field was sent (handles quick edit case)
    if (isset($_REQUEST['featured_post'])) {
        update_post_meta($post_id, 'featured_post', $_REQUEST['featured_post']);
    }
}
add_action('save_post', 'save_quick_edit_featured');

function use_archive_template($template)
{
    // First check if this is an event post type archive
    if (is_post_type_archive('event')) {
        $event_template = locate_template(['archive-event.php']);
        if (!empty($event_template)) {
            return $event_template;
        }
    }

    // Then check for regular archives
    if (is_home() || is_archive() || is_category()) {
        $new_template = locate_template(['archive.php', 'index.php']);
        if (!empty($new_template)) {
            return $new_template;
        }
    }
    return $template;
}
add_filter('template_include', 'use_archive_template', 99);

function add_kennisbank_rewrite_rules()
{
    add_rewrite_rule(
        '^kennisbank/([^/]+)/?$',
        'index.php?category_name=$matches[1]',
        'top'
    );

    // Ondersteuning voor paginering
    add_rewrite_rule(
        '^kennisbank/([^/]+)/page/?([0-9]{1,})/?$',
        'index.php?category_name=$matches[1]&paged=$matches[2]',
        'top'
    );
}
add_action('init', 'add_kennisbank_rewrite_rules');

function remove_category_base()
{
    global $wp_rewrite;
    $wp_rewrite->category_base = '';
}
add_action('init', 'remove_category_base');


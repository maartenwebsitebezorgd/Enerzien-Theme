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

// Taxonomies
// include_once get_template_directory() . '/includes/taxonomies/taxonomy-sample.php';

// Add custom functions here!
include_once get_template_directory() . '/includes/functions/custom.php';

// Set plugin data and improvements
include_once get_template_directory() . '/includes/functions/plugins.php';

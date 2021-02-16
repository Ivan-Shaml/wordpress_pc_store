<?php

/**
 * Implement the Core feature of theme.
 */
require get_template_directory() . '/inc/theme-core.php';

/**
 * Implement the Custom Header feature.
 */
require get_template_directory() . '/inc/class/class-header.php';


/**
 * Implement the Custom Header feature.
 */
require get_template_directory() . '/inc/class/class-body.php';


/**
 * Implement the Post Related Hook.
 */
require get_template_directory() . '/inc/class/class-template-tags.php';
require get_template_directory() . '/inc/class/class-post-related.php';

/**
 * Implement the Footer Hook.
 */
require get_template_directory() . '/inc/class/class-footer.php';

/**
 * Functions which enhance the theme by hooking into WordPress.
 */
require get_template_directory() . '/inc/template-functions.php';

/**
 * Implement Theme Options.
 */
require get_template_directory() . '/inc/customizer/customizer.php';

/**
 * Load WooCommerce compatibility file.
 */
if ( class_exists( 'WooCommerce' ) ) {
	require get_template_directory() . '/inc/woocommerce.php';
}

/**
* Implement pro features.
*/
require get_template_directory() . '/inc/admin/admin-page.php';

require get_template_directory() . '/inc/tgm/recommended-plugins.php';

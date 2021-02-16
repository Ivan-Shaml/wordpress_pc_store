<?php
/*This file is part of GroceryShop, grocery-store child theme.

All functions of this file will be loaded before of parent theme functions.
Learn more at https://codex.wordpress.org/Child_Themes.

Note: this function loads the parent stylesheet before, then child theme stylesheet
(leave it in place unless you know what you are doing.)
*/


function grocery_shop_theme_setup(){

	// Make theme available for translation.
	load_theme_textdomain( 'grocery-shop', get_stylesheet_directory_uri() . '/languages' );
	
	add_theme_support( 'custom-header', apply_filters( 'grocery_shop_custom_header_args', array(
		'default-image' => get_stylesheet_directory_uri() . '/image/custom-header.jpg',
		'default-text-color'     => '000000',
		'width'                  => 1000,
		'height'                 => 350,
		'flex-height'            => true,
		'wp-head-callback'       => 'grocery_store_header_style',
	) ) );
	
	register_default_headers( array(
		'default-image' => array(
		'url' => '%s/image/custom-header.jpg',
		'thumbnail_url' => '%s/image/custom-header.jpg',
		'description' => esc_html__( 'Default header image', 'grocery-shop' ),
		),
	));

}
add_action( 'after_setup_theme', 'grocery_shop_theme_setup' );



/**
 * Register our scripts (js/css)
 */
function grocery_shop_enqueue_child_styles() {
	
	$parent_style = 'grocery-store-style-parente';

    wp_enqueue_style( $parent_style, get_template_directory_uri() . '/style.css' );
    wp_enqueue_style( 'grocery-shop-css', get_stylesheet_directory_uri() . '/style.css', array( $parent_style ) );
	
	$custom_css = ':root{--nav-bg:'.esc_attr( get_theme_mod('__quaternary_color','#7fba00') ).'!important; --secondary-color-deep:'.esc_attr( get_theme_mod('__quaternary_color','#557c00') ).'!important; }';
		

	wp_add_inline_style( 'grocery-shop-css', $custom_css );
	
	
	}
add_action( 'wp_enqueue_scripts', 'grocery_shop_enqueue_child_styles',999 );

/**
 * Customize the core theme hook.
 */
require get_stylesheet_directory() . '/hook.php';



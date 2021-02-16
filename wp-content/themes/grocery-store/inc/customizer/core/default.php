<?php
/**
 * Default theme options.
 *
 * @package Grocery Store
 */

if ( ! function_exists( 'grocery_store_default_theme_options' ) ) :

	/**
	 * Get default theme options
	 *
	 * @since 1.0.0
	 *
	 * @return array Default theme options.
	 */
	function grocery_store_default_theme_options() {

		$defaults = array();
		
		
		$defaults['__primary_color']     		= '#777777';
		$defaults['__secondary_color']     		= '#7fba00';
		
		$defaults['__quaternary_color']     	= '#557c00';
		
		/*Posts Layout*/
		$defaults['blog_layout']     				= 'content-sidebar';
		$defaults['single_post_layout']     		= 'no-sidebar';
		
		$defaults['blog_loop_content_type']     	= 'excerpt';
		
		$defaults['blog_meta_hide']     			= false;
		
		
		/*Posts Layout*/
		$defaults['page_layout']     				= 'content-sidebar';
		
		/*layout*/
		$defaults['copyright_text']					= esc_html__( 'Copyright All right reserved', 'grocery-store' );
		$defaults['read_more_text']					= esc_html__( 'Read More', 'grocery-store' );
		$defaults['index_hide_thumb']     			= false;
		$defaults['topbar_text']					= esc_html__( 'Our Trusted. 24 x 7 hours free delivery! ', 'grocery-store' );
		
	

		// Pass through filter.
		$defaults = apply_filters( 'grocery_store_default_theme_options_filter', $defaults );

		return $defaults;

	}

endif;

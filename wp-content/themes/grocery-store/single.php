<?php
/**
 * The template for displaying all single posts
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/#single-post
 *
 * @package Grocery_Store
 */

get_header();
$layout = grocery_store_get_option('single_post_layout');
/**
* Hook - grocery_store_container_wrap_start 	
*
* @hooked grocery_store_container_wrap_start	- 5
*/
 do_action( 'grocery_store_container_wrap_start',  esc_attr( $layout ) );
?>

	

		<?php
		while ( have_posts() ) :
			the_post();

			get_template_part( 'template-parts/content', get_post_type() );

			/**
			* Hook - inx_game_site_footer
			*
			* @hooked inx_game_container_wrap_start    -10
			* @hooked related_post 					   -20
			*/
			do_action( 'grocery_store_single_post_navigation');

			// If comments are open or we have at least one comment, load up the comment template.
			if ( comments_open() || get_comments_number() ) :
				comments_template();
			endif;

		endwhile; // End of the loop.
		?>

<?php
/**
* Hook - grocery_store_container_wrap_end	
*
* @hooked container_wrap_end - 999
*/
 do_action( 'grocery_store_container_wrap_end',  esc_attr( $layout ) );
get_footer();

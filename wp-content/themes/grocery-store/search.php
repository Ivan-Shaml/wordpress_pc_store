<?php
/**
 * The template for displaying search results pages
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/#search-result
 *
 * @package Grocery_Store
 */

get_header();
$layout = grocery_store_get_option('blog_layout');
/**
* Hook - grocery_store_container_wrap_start 	
*
* @hooked grocery_store_container_wrap_start	- 5
*/
 do_action( 'grocery_store_container_wrap_start',  esc_attr( $layout ) );
?>

	

		<?php if ( have_posts() ) : 
			/* Start the Loop */
			while ( have_posts() ) :
				the_post();

				/**
				 * Run the loop for the search to output the results.
				 * If you want to overload this in a child theme then include a file
				 * called content-search.php and that will be used instead.
				 */
				get_template_part( 'template-parts/content', 'search' );

			endwhile;
			/*
			* Hook - grocery_store_loop_navigation 	
			*
			* @hooked site_loop_navigation	- 10
			*/
			 do_action( 'grocery_store_loop_navigation');

		else :

			get_template_part( 'template-parts/content', 'none' );

		endif;
		?>

<?php
/**
* Hook - grocery_store_container_wrap_end	
*
* @hooked container_wrap_end - 999
*/
 do_action( 'grocery_store_container_wrap_end',  esc_attr( $layout ) );
get_footer();
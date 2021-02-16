<?php
/**
 * Template part for displaying page content in page.php
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package Grocery_Store
 */

?>

<?php
/**
 * Template part for displaying posts
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package grocery_store
 */

$thumbnail_style  = ( has_post_thumbnail( get_the_ID() ) ) ? 'grocery-shop-blog-loop'  : '';

?>

<article id="post-<?php the_ID(); ?>" <?php post_class( array('gs-content-wrap','aos-animate',esc_attr( $thumbnail_style )) ); ?> data-aos="fade-up">

 	 <?php
    /**
    * Hook - grocery-store_posts_blog_media.
    *
    * @hooked grocery-store_posts_formats_thumbnail - 10
    */
    do_action( 'grocery_store_posts_blog_media' );
    ?>
    <div class="post">
               
		<?php
        /**
        * Hook - grocery_store_site_content_type.
        *
		* @hooked site_loop_heading - 10
        * @hooked render_meta_list	- 20
		* @hooked site_content_type - 30
        */
		
		the_content();
        ?>
      <?php if ( get_edit_post_link() ) : ?>
		<div class="entry-footer">
			<?php
			edit_post_link(
				sprintf(
					wp_kses(
						/* translators: %s: Name of current post. Only visible to screen readers */
						__( 'Edit <span class="screen-reader-text">%s</span>', 'grocery-store' ),
						array(
							'span' => array(
								'class' => array(),
							),
						)
					),
					wp_kses_post( get_the_title() )
				),
				'<span class="edit-link">',
				'</span>'
			);
			?>
		</div><!-- .entry-footer -->
	<?php endif; ?>
       
    </div>
    
</article><!-- #post-<?php the_ID(); ?> -->

<!-- #post-<?php the_ID(); ?> -->

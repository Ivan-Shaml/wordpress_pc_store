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
		
		$meta = array();
		
		if( grocery_store_get_option('blog_meta_hide') != true ){
			
			$meta = array( 'author', 'date', 'category', 'comments' );
		}
		 
		
		
		 do_action( 'grocery_store_site_content_type', $meta  );
        ?>
      
       
    </div>
    
</article><!-- #post-<?php the_ID(); ?> -->

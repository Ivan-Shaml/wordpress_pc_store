<?php
/**
 * Template part for displaying results in search pages
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package Grocery_Store
 */

?>

<article id="post-<?php the_ID(); ?>" <?php post_class( array('gs-content-wrap') ); ?>>

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
        
        if( grocery_store_get_option('blog_meta_hide') != true && 'post' == get_post_type() ){
            
            $meta = array( 'author', 'date', 'category', 'comments' );
        }
		
		 do_action( 'grocery_store_site_content_type', $meta  );
        ?>
      
       
    </div>
    
</article><!-- #post-<?php the_ID(); ?> -->

<?php


function grocery_store_default_options( $defaults ) {
	
   		$defaults['__primary_color']     		= '#777777';
		$defaults['__secondary_color']     		= '#dd3333';
		
		$defaults['__quaternary_color']     	= '#44494e';
		
		/*Posts Layout*/
		$defaults['blog_layout']     				= 'no-sidebar';
		$defaults['single_post_layout']     		= 'no-sidebar';
		
		$defaults['blog_loop_content_type']     	= 'excerpt';
		
		$defaults['blog_meta_hide']     			= false;
		
		
		/*Posts Layout*/
		$defaults['page_layout']     				= 'full-container';
		
	
	
    return $defaults;
}
add_filter( 'grocery_store_default_theme_options_filter', 'grocery_store_default_options' );





add_action('init','grocery_shop_disable_from_parent',50);
function grocery_shop_disable_from_parent(){
	
	global $grocery_store_header;
	remove_action( 'grocery_store_site_header', array( $grocery_store_header, 'site_header_layout_1' ), 20 );
	
	
}



/**
* Get the Site logo
*
* @return HTML
*/

add_action('grocery_store_site_header','grocery_shop_header_layout', 20 );
function grocery_shop_header_layout(){
	
?>
<div class="grocery-shop-header-wrap">
<header id="masthead" class="site-header site-header-2">
	<div class="container">
	<div class="row align-self-center">
		<div class="site-branding col-md-3 my-auto header-angel-style">
			<?php 

				if ( function_exists( 'the_custom_logo' ) && has_custom_logo() ) {
				 	echo get_custom_logo();
				}
				if (display_header_text()==true){
					echo '<h4><a href="'.esc_url( home_url( '/' ) ).'" rel="home" class="site-title">';
					echo get_bloginfo( 'name' );
					echo '</a></h4>';
					$description = get_bloginfo( 'description', 'display' );
					if ( $description ) :
						echo  '<div class="site-description">'.esc_html($description).'</div>';
					endif;
				}
            ?>
			 <button class="grocery-store-rd-navbar-toggle" tabindex="0" autofocus="true"><i class="icofont-navigation-menu"></i></button>
		</div><!-- .site-branding -->
		
		<div class="col-md-9 header-angel-style header-angel-style my-auto">
				<div class="nav-padding"> 
				<nav class="rd-navbar <?php echo ( grocery_store_get_option('__sticky_menu') != true ) ? 'sticky_disable':'';?>" data-rd-navbar-lg="rd-navbar-static">
				
				<div class="rd-navbar-outer">
					<div class="rd-navbar-inner">
					
						<div class="rd-navbar-subpanel">

							 <div class="rd-navbar-nav-wrap nav-1-space">
							  <button class="rd-navbar-toggle toggle-original" data-rd-navbar-toggle=".rd-navbar-nav-wrap"><i class="icofont-ui-close"></i></button>
							
								<?php
									wp_nav_menu( array(
										'theme_location'    => 'primary',
										'depth'             => 3,
										'menu_class'  		=> 'inx-main-menu rd-navbar-nav',
										'container'			=> 'ul',
										'walker' 			=> new grocery_store_navwalker(),
										'fallback_cb'       => 'grocery_store_navwalker::fallback',
									) );
								?>

							</div>
						</div>
					</div>
				</div>
			</nav>
			</div>
			<div class="clearfix"></div>
			</div>

		</div>
	</div>
</header>
<div class="header-style-element container"> 
	<div class="row align-self-center">

		<div class="col-md-3 my-auto">
			
			<?php if( class_exists( 'WooCommerce' ) ) : ?>	
			<div class="menu-category-list" tabindex="0" autofocus="true">
				<i class="icofont-navigation-menu"></i>
				
				<?php echo esc_html__('Shop By Department','grocery-shop')?>
				<?php 
					$instance = array(
					'title' => '',
					);	
					the_widget( 'WC_Widget_Product_Categories', $instance );
				?>
			</div> 
			<?php endif;?>	
		</div>
		<div class="col-md-6 my-auto">
			<?php if ( is_active_sidebar( 'logo-sidebar' ) ) : 

					dynamic_sidebar( 'logo-sidebar' ); 
					else:
						if ( class_exists( 'WooCommerce' ) ) :	
							echo '<div class="aspw-widgets-wrap-class">';	
								do_action('apsw_search_bar_preview', 1 );
							echo '</div>';
						endif;
					endif;?>
		</div>	
		<div class="col-md-3 my-auto">
				
			<?php 
			if( function_exists( 'grocery_store_woocommerce_header_cart' ) && class_exists( 'WooCommerce' ) ):
				grocery_store_woocommerce_header_cart();
			endif;
			?>

			<?php if( grocery_store_get_option('__woo_header_wishlist') == true && class_exists( 'WooCommerce' ) ) : ?>		
		   <a href="<?php echo get_the_permalink( grocery_store_get_option('__woo_wishlist_page') );?>" class="header-icon gs-tooltip-act" title="<?php echo esc_attr( grocery_store_get_option('__loca_check_wishlist') );?>"><i class="icofont-ui-love-add"></i></a>
		   <?php endif;?>

			<?php if( grocery_store_get_option('__woo_header_compare') == true && class_exists( 'WooCommerce' ) ) : ?>	
			<a href="<?php echo get_the_permalink( grocery_store_get_option('__woo_compare_page') );?>" class="header-icon gs-tooltip-act" title="<?php echo esc_attr( grocery_store_get_option('__loca_check_compare') );?>"><i class="icofont-layers"></i></a>
			<?php endif;?>	

		</div>

	</div>
</div>
<div class="clearfix"></div>
</div>
<?php
	
}


<?php
/**
 * The Site Theme Header Class 
 *
 * Eventually, some of the functionality here could be replaced by core features.
 *
 * @package Grocery_Store
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}
class Grocery_Store_Header_Layout{
	/**
	 * Function that is run after instantiation.
	 *
	 * @return void
	 */
	public function __construct() {
		add_action('grocery_store_site_header', array( $this, 'site_skip_to_content' ), 5 );
		
		add_action('grocery_store_site_header', array( $this, 'site_top_bar' ), 10 );

		add_action('grocery_store_site_header', array( $this, 'site_header_layout_1' ), 20 );
		
		add_action('grocery_store_site_header', array( $this, 'site_hero_sections' ), 20 );
	}

	/**
	* Container before
	*
	* @return $html
	*/
	function site_skip_to_content(){
		
		echo '<a class="skip-link screen-reader-text" href="#primary">'. esc_html__( 'Skip to content', 'grocery-store' ) .'</a>';
	}

	/**
	* Get the Site Topbar
	*
	* @return HTML
	*/
	function site_top_bar(){
	?>
	<div class="topbar">
		<div class="container">
			<div class="row">
				<div class="col-md-5">
					
					<?php echo esc_html ( grocery_store_get_option('topbar_text') ); ?>
                    
		
				</div>
				<div class="col-md-7 text-right">
					
							<?php
                                wp_nav_menu( array(
                                    'theme_location'    => 'top-menu',
                                    'depth'             => 1,
                                    'menu_class'  		=> 'menu-top-header',
                                    'container'			=> 'ul',
                                    'fallback_cb'       => 'grocery_store_fallback_cb',
                                    
                                ) );
                            ?>
						
				</div>
			</div>
		</div>
	</div>

	<?php
	}

	/**
	* Get the Site logo
	*
	* @return HTML
	*/
	public function get_site_branding (){
		$html = '';
		if ( function_exists( 'the_custom_logo' ) && has_custom_logo() ) {
			$html .= get_custom_logo();
			
		}

		if (display_header_text()==true){
			$html .= '<h4><a href="'.esc_url( home_url( '/' ) ).'" rel="home" class="site-title">';
			$html .= get_bloginfo( 'name' );
			$html .= '</a></h4>';
		
			$description = get_bloginfo( 'description', 'display' );
			if ( $description ) :
			    $html .=  '<div class="site-description">'.esc_html($description).'</div>';
			endif;
		}
		
	
		$html = apply_filters( 'get_site_branding_filter', $html );
		
		return wp_kses( $html, $this->alowed_tags() );
		
	}


	
	/**
	* Get the Site logo
	*
	* @return HTML
	*/
	public function site_header_layout_1 (){
		
	?>
    
    <header id="masthead" class="site-header">
    	<div class="container">
        <div class="row align-items-center ">
            <div class="site-branding col-lg-5 col-sm-12">
                <?php echo wp_kses( $this->get_site_branding(), $this->alowed_tags() );?>
                <button class="grocery-store-rd-navbar-toggle" ><i class="icofont-navigation-menu"></i></button>
            </div><!-- .site-branding -->
            <div class="col-lg-7 col-sm-12 text-right"> 
				<?php 
				if ( is_active_sidebar( 'logo-sidebar' ) ) : 
					dynamic_sidebar( 'logo-sidebar' ); 
				else:
					if ( class_exists( 'WooCommerce' ) ) {
						echo '<div class="aspw-widgets-wrap-class">';	
						do_action('apsw_search_bar_preview', 1 );
						echo '</div>';
					}
				endif;
				?>
           </div>
        </div>
        </div>
	</header>
    <?php
		$this->site_main_menu();
	}

	function site_main_menu(){

		?>
		<div class="nav_wrap">
			<nav class="rd-navbar navbar-header-style-1" data-rd-navbar-lg="rd-navbar-static">
   
                <div class="rd-navbar-outer">
                    <div class="rd-navbar-inner">
                    
                        <div class="rd-navbar-subpanel">
						<?php if( class_exists( 'WooCommerce' ) ):?>
                    	<div class="menu-category-list" tabindex="0" autofocus="true">
                        
							<i class="icofont-navigation-menu"></i>
							<?php echo esc_html( 'Shop By Department','grocery-store' );?>
                            
							<?php 
								$instance = array(
								'title' => '',
								);	
							the_widget( 'WC_Widget_Product_Categories', $instance );
							?>
						</div>
                        <?php endif;?>
                         <div class="rd-navbar-nav-wrap">
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
                            
                           
								<?php if ( function_exists( 'grocery_store_woocommerce_header_cart' ) ) {
									grocery_store_woocommerce_header_cart();
								}?>
                          
                           
                        </div>
                    </div>
                </div>
            </nav>
           </div> 
		<?php
	}

	
	/**
	* Get the hero sections
	*
	* @return HTML
	*/
	public function site_hero_sections(){
		if ( is_front_page() && is_active_sidebar( 'slider' ) ) : 
		 dynamic_sidebar( 'slider' );
		else: ?>
			<div id="static_header_banner">
		    	<div class="content-text">
		            <div class="container">
		               	<?php echo wp_kses( $this->hero_block_heading(), $this->alowed_tags() ); ?>
		            </div>
		        </div>
		    </div>
		<?php
		endif;
	}

	/**
	 * Add Banner Title.
	 *
	 * @since 1.0.0
	 */
	function hero_block_heading() {
		 echo '<div class="site-header-text-wrap">';
		
			if ( is_home() ) {
					echo '<h1 class="page-title-text">';
					echo bloginfo( 'name' );
					echo '</h1>';
					echo '<p class="subtitle">';
					echo esc_html(get_bloginfo( 'description', 'display' ));
					echo '</p>';
			}else if ( function_exists('is_shop') && is_shop() ){
				if ( in_array( 'woocommerce/woocommerce.php', apply_filters( 'active_plugins', get_option( 'active_plugins' ) ) ) ) {
					echo '<h1 class="page-title-text">';
					echo esc_html( woocommerce_page_title() );
					echo '</h1>';
				}
			}else if( function_exists('is_product_category') && is_product_category() ){
				echo '<h1 class="page-title-text">';
				echo esc_html( woocommerce_page_title() );
				echo '</h1>';
				echo '<p class="subtitle">';
				do_action( 'woocommerce_archive_description' );
				echo '</p>';
				
			}elseif ( is_singular() ) {
				echo '<h1 class="page-title-text">';
					echo single_post_title( '', false );
				echo '</h1>';
			} elseif ( is_archive() ) {
				
				the_archive_title( '<h1 class="page-title-text">', '</h1>' );
				the_archive_description( '<p class="archive-description subtitle">', '</p>' );
				
			} elseif ( is_search() ) {
				echo '<h1 class="title">';
					printf( /* translators:straing */ esc_html__( 'Search Results for: %s', 'grocery-store' ),  get_search_query() );
				echo '</h1>';
			} elseif ( is_404() ) {
				echo '<h1 class="display-1">';
					esc_html_e( 'Oops! That page can&rsquo;t be found.', 'grocery-store' );
				echo '</h1>';
			}
		
		echo '</div>';
	}


	
	public function get_site_breadcrumb (){
		if( function_exists('bcn_display') && ( !is_home() || !is_front_page())  ):?>
        	<div class="grocery-store-breadcrumbs-wrap"><div class="container"><div class="row"><div class="col-md-12">
            <div class="grocery-store-breadcrumbs" typeof="BreadcrumbList" vocab="https://schema.org/">
                <?php bcn_display_list();?>
           </div></div></div></div>
            </div>
        <?php
		endif; 
	}
	private function alowed_tags(){
		
		if( function_exists('grocery_store_alowed_tags') ){ 
			return grocery_store_alowed_tags(); 
		}else{
			return array();	
		}
		
	}
}

$grocery_store_header = new Grocery_Store_Header_Layout();
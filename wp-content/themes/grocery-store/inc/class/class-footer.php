<?php
/**
 * The Site Theme Header Class 
 *
 * Eventually, some of the functionality here could be replaced by core features.
 *
 * @package grocery_store
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}
class Grocery_Store_Footer_Layout{
	/**
	 * Function that is run after instantiation.
	 *
	 * @return void
	 */
	public function __construct() {
		
		add_action('grocery_store_site_footer', array( $this, 'site_footer_container_before' ), 5);
		add_action('grocery_store_site_footer', array( $this, 'site_footer_widgets' ), 10);
		add_action('grocery_store_site_footer', array( $this, 'site_footer_info' ), 80);
		add_action('grocery_store_site_footer', array( $this, 'site_footer_container_after' ), 998);
		add_action('grocery_store_site_footer', array( $this, 'site_footer_back_top' ), 999);
	}
	
	/**
	* diet_shop foter conteinr before
	*
	* @return $html
	*/
	public function site_footer_container_before (){
		
		$html = ' <footer id="colophon" class="site-footer">';
						
		$html = apply_filters( 'grocery_store_footer_container_before_filter',$html);		
				
		echo wp_kses( $html, $this->alowed_tags() );
		
						
	}
	
	/**
	* Footer Container before
	*
	* @return $html
	*/
	function site_footer_widgets(){
		if ( is_active_sidebar( 'footer-1' ) ) { ?>
         <div class="footer_widget_wrap">
         <div class="container">
            <div class="row inx-flex">
                <?php dynamic_sidebar( 'footer-1' ); ?>
            </div>
         </div>  
         </div>
        <?php }
	}
	
	
	/**
	* diet_shop foter conteinr after
	*
	* @return $html
	*/
	public function site_footer_info (){
		$text = '';
		$html = '<div class="container site_info">
					<div class="row">';
		
		
			$html .= '<div class="col-12 col-md-6">';
			
			if( grocery_store_get_option('copyright_text') != '' ) 
			{
				$text .= esc_html( grocery_store_get_option('copyright_text') );
			}else{
				/* translators: 1: Current Year, 2: Blog Name  */
				$text = sprintf( esc_html__( 'Copyright &copy; %1$s %2$s. All Right Reserved.', 'grocery-store' ), date_i18n( _x( 'Y', 'copyright date format; check date() on php.net', 'grocery-store' ) ), esc_html( get_bloginfo( 'name' ) ) );
				
			}
			
			$html  .= apply_filters( 'grocery_store_footer_copywrite_filter', $text ).'<br/>';
				
			/* translators: 1: developer website, 2: WordPress url  */
			$html  .= '<span class="dev_credit">'.sprintf( esc_html__( 'Theme %1$s By aThemeArt - Proudly powered by %2$s .', 'grocery-store' ), '<a title="WordPress WooCommerce Theme" href="'. esc_url( 'https://athemeart.com/downloads/grocerystore-wordpress-woocommerce-theme/' ) .'" target="_blank" rel="nofollow">'.esc_html_x( 'grocery-store', 'credit - theme', 'grocery-store' ).'</a>', '<a href="'.esc_url( __( 'https://wordpress.org', 'grocery-store' ) ).'" target="_blank" rel="nofollow">'.esc_html_x( 'WordPress', 'credit to cms', 'grocery-store' ).'</a>' ).'</span>';
			
			$html .= '</div>';
			
			$html .= '<div class="col-12 col-md-6 text-right">';

			if( get_theme_mod( 'payment_method_img' ) !="" ){
				
				$html .= '<img src="'.esc_url( get_theme_mod( 'payment_method_img' ) ).'" alt="">';
			}
			
			
			
			$html .= '</div>';
			
			
		$html .= '	</div>
		  		</div>';
		
		
				
		echo wp_kses( $html, $this->alowed_tags() );
	
	}
	
	/**
	* diet_shop foter conteinr after
	*
	* @return $html
	*/
	public function site_footer_container_after (){
		
		$html = '</footer>';
						
		$html = apply_filters( 'grocery_store_footer_container_after_filter',$html);		
				
		echo wp_kses( $html, $this->alowed_tags() );
	
	}
	
	
	/**
	* diet_shop foter conteinr after
	*
	* @return $html
	*/
	public function site_footer_back_top (){
		
		$html = '<a id="backToTop" class="ui-to-top active"><i class="icofont-long-arrow-up"></i></a>';
						
		$html = apply_filters( 'grocery_store_site_footer_back_top_filter',$html);		
				
		echo wp_kses( $html, $this->alowed_tags() );
	
	}
	
	
	
	private function alowed_tags(){
		
		if( function_exists('grocery_store_alowed_tags') ){ 
			return grocery_store_alowed_tags(); 
		}else{
			return array();	
		}
		
	}
}



$grocery_store_footer = new Grocery_Store_Footer_Layout();
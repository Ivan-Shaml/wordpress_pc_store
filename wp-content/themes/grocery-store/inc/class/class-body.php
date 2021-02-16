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
class Grocery_Store_Body_Layout{
	/**
	 * Function that is run after instantiation.
	 *
	 * @return void
	 */
	public function __construct() {
		
		add_action('grocery_store_container_wrap_start', array( $this, 'container_wrap_start' ), 5 );
		add_action('grocery_store_container_wrap_start', array( $this, 'container_wrap_column_start' ), 10 );
		
		add_action('grocery_store_container_wrap_end', array( $this, 'container_wrap_column_end' ), 10 );
		add_action('grocery_store_container_wrap_end', array( $this, 'get_sidebar' ), 30 );
		add_action('grocery_store_container_wrap_end', array( $this, 'container_wrap_end' ), 999 );
		
	}
	/**
	* Container before
	*
	* @return $html
	*/
	function container_wrap_start(){
		
		$html  = '<div id="primary" class="content-area container">
        				<div class="row">';
						
   		$html  = apply_filters( 'grocery_store_container_wrap_start_filter', $html );	
		
		echo wp_kses( $html, $this->alowed_tags() );
    	
	}
	
	/**
	* Main Content Column before
	*
	* return $html
	*/
	function container_wrap_column_start ( $layout = '' ){
		
		switch ( $layout ) {
			case 'sidebar-content':
				$layout = 'col-xl-8 col-md-8 col-12 order-2';
				break;
			case 'no-sidebar':
				$layout = 'col-md-10 offset-md-1 bcf-main-content';
				break;
			default:
				$layout = 'col-xl-8 col-md-8 col-12 order-1';
		} 
	
	   $html 	 = '<main id="main" class="'.esc_attr( $layout ).' site-main">
	   					';
	   
	   $html  	 = apply_filters( 'grocery_store_container_wrap_column_start_filter', $html );	
		
		echo wp_kses( $html, $this->alowed_tags() );
		
   	
	}
	
	/**
	* Main Content Column before
	*
	* return $html
	*/
	function container_wrap_column_end ( $layout = '' ){
	
	  if( is_singular('product') ){
	   		
	   		 do_action( 'grocery_store_output_related_products' );
	    }		
	   $html 	 = '</main>';

	   
	   $html  	 = apply_filters( 'grocery_store_container_wrap_column_end_filter', $html );	
		
		echo wp_kses( $html, $this->alowed_tags() );

   	
	}
	
	/**
	* Main Content Column after
	*
	* return $html
	*/
	function get_sidebar( $layout = '' ){
		
		
	switch ( $layout ) {
	case 'sidebar-content':
		$layout = 'col-xl-4 col-md-4 col-12 order-1 grocery-store-sidebar';
		break;
	case 'no-sidebar':
		return false;
		break;
	default:
		$layout = 'col-xl-4 col-md-4 col-12 order-2 grocery-store-sidebar';
	} 	
	?>
	<div class="<?php echo esc_attr( $layout );?>">
		<?php get_sidebar();?>
	</div>
	<?php
   	
	}
	
	/**
	* Container before
	*
	* @return $html
	*/
	function container_wrap_end(){
		
		$html  = '</div></div>';
						
   		$html  = apply_filters( 'grocery_store_container_wrap_end_filter', $html );	
		
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



$grocery_store_body = new Grocery_Store_Body_Layout();
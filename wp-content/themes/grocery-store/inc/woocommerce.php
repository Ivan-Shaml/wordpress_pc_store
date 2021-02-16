<?php
/**
 * WooCommerce Compatibility File
 *
 * @link https://woocommerce.com/
 *
 * @package Grocery_Store
 */
/**
 *  Hook remove from WooCommerce archive
 */
remove_action( 'woocommerce_before_main_content','woocommerce_breadcrumb',20 );
add_filter( 'woocommerce_show_page_title', '__return_false' );
remove_action( 'woocommerce_before_shop_loop_item','woocommerce_template_loop_product_link_open',10 );
remove_action( 'woocommerce_after_shop_loop_item','woocommerce_template_loop_product_link_close',5 );
remove_action( 'woocommerce_before_shop_loop_item_title','woocommerce_template_loop_product_thumbnail',10 );
remove_action( 'woocommerce_shop_loop_item_title', 'woocommerce_template_loop_product_title', 10 );
remove_action( 'woocommerce_after_shop_loop_item_title','woocommerce_template_loop_rating',5 );
remove_action( 'woocommerce_before_main_content','woocommerce_breadcrumb',20 );
remove_action( 'woocommerce_sidebar','woocommerce_get_sidebar',10 );
/**
 *  Hook remove from Single Product page
 */
remove_action( 'woocommerce_after_single_product_summary','woocommerce_output_related_products',20 );
add_action( 'grocery_store_output_related_products','woocommerce_output_related_products',20 );

remove_action( 'woocommerce_after_single_product_summary','woocommerce_upsell_display',15 );
add_action( 'grocery_store_output_related_products','woocommerce_upsell_display',5 );

remove_action( 'woocommerce_cart_collaterals', 'woocommerce_cross_sell_display' );
add_action( 'woocommerce_after_cart', 'woocommerce_cross_sell_display',5 );


remove_action( 'woocommerce_widget_shopping_cart_buttons', 'woocommerce_widget_shopping_cart_button_view_cart', 10 );
remove_action( 'woocommerce_widget_shopping_cart_buttons', 'woocommerce_widget_shopping_cart_proceed_to_checkout', 20 );
/**
 * WooCommerce setup function.
 *
 * @link https://docs.woocommerce.com/document/third-party-custom-theme-compatibility/
 * @link https://github.com/woocommerce/woocommerce/wiki/Enabling-product-gallery-features-(zoom,-swipe,-lightbox)
 * @link https://github.com/woocommerce/woocommerce/wiki/Declaring-WooCommerce-support-in-themes
 *
 * @return void
 */
function grocery_store_woocommerce_setup() {
	add_theme_support(
		'woocommerce',
		array(
			'thumbnail_image_width' => 150,
			'single_image_width'    => 300,
			'product_grid'          => array(
				'default_rows'    => 3,
				'min_rows'        => 1,
				'default_columns' => 4,
				'min_columns'     => 1,
				'max_columns'     => 6,
			),
		)
	);
	add_theme_support( 'wc-product-gallery-zoom' );
	add_theme_support( 'wc-product-gallery-lightbox' );
	add_theme_support( 'wc-product-gallery-slider' );
}
add_action( 'after_setup_theme', 'grocery_store_woocommerce_setup' );

/**
 * WooCommerce specific scripts & stylesheets.
 *
 * @return void
 */
function grocery_store_woocommerce_scripts() {
	wp_enqueue_style( 'grocery-store-woocommerce-style', get_template_directory_uri() . '/woocommerce.css', array(), _S_VERSION );

	$font_path   = WC()->plugin_url() . '/assets/fonts/';
	$inline_font = '@font-face {
			font-family: "star";
			src: url("' . $font_path . 'star.eot");
			src: url("' . $font_path . 'star.eot?#iefix") format("embedded-opentype"),
				url("' . $font_path . 'star.woff") format("woff"),
				url("' . $font_path . 'star.ttf") format("truetype"),
				url("' . $font_path . 'star.svg#star") format("svg");
			font-weight: normal;
			font-style: normal;
		}';

	wp_add_inline_style( 'grocery-store-woocommerce-style', $inline_font );


	wp_enqueue_script( 'grocery-store-woocommerce', get_theme_file_uri( '/assets/js/grocery-store-woocommerce.js' ) , 0, '1.1', true );
}
add_action( 'wp_enqueue_scripts', 'grocery_store_woocommerce_scripts' );

/**
 * Disable the default WooCommerce stylesheet.
 *
 * Removing the default WooCommerce stylesheet and enqueing your own will
 * protect you during WooCommerce core updates.
 *
 * @link https://docs.woocommerce.com/document/disable-the-default-stylesheet/
 */
add_filter( 'woocommerce_enqueue_styles', '__return_empty_array' );

/**
 * Add 'woocommerce-active' class to the body tag.
 *
 * @param  array $classes CSS classes applied to the body tag.
 * @return array $classes modified to include 'woocommerce-active' class.
 */
function grocery_store_woocommerce_active_body_class( $classes ) {
	$classes[] = 'woocommerce-active';

	return $classes;
}
add_filter( 'body_class', 'grocery_store_woocommerce_active_body_class' );

/**
 * Related Products Args.
 *
 * @param array $args related products args.
 * @return array $args related products args.
 */
function grocery_store_woocommerce_related_products_args( $args ) {
	$defaults = array(
		'posts_per_page' => 3,
		'columns'        => 3,
	);

	$args = wp_parse_args( $defaults, $args );

	return $args;
}
add_filter( 'woocommerce_output_related_products_args', 'grocery_store_woocommerce_related_products_args' );

/**
 * Default loop columns on product archives.
 *
 * @return integer products per row.
 */
function grocery_store_woocommerce_loop_columns() {
	return 3;
}
add_filter( 'loop_shop_columns', 'grocery_store_woocommerce_loop_columns' );
/**
 * Remove default WooCommerce wrapper.
 */
remove_action( 'woocommerce_before_main_content', 'woocommerce_output_content_wrapper', 10 );
remove_action( 'woocommerce_after_main_content', 'woocommerce_output_content_wrapper_end', 10 );

if ( ! function_exists( 'grocery_store_woocommerce_wrapper_before' ) ) {
	/**
	 * Before Content.
	 *
	 * Wraps all WooCommerce content in wrappers which match the theme markup.
	 *
	 * @return void
	 */
	function grocery_store_woocommerce_wrapper_before() {
		$layout = grocery_store_get_option('page_layout');
		/**
		* Hook - grocery_store_container_wrap_start 	
		*
		* @hooked grocery_store_container_wrap_start	- 5
		*/
		do_action( 'grocery_store_container_wrap_start',  esc_attr( $layout ) );
	}
}
add_action( 'woocommerce_before_main_content', 'grocery_store_woocommerce_wrapper_before' );

if ( ! function_exists( 'grocery_store_woocommerce_wrapper_after' ) ) {
	/**
	 * After Content.
	 *
	 * Closes the wrapping divs.
	 *
	 * @return void
	 */
	function grocery_store_woocommerce_wrapper_after() {
		$layout = grocery_store_get_option('page_layout');
		/**
		* Hook - grocery_store_container_wrap_end	
		*
		* @hooked container_wrap_end - 999
		*/
		 do_action( 'grocery_store_container_wrap_end',  esc_attr( $layout ) );
	}
}
add_action( 'woocommerce_after_main_content', 'grocery_store_woocommerce_wrapper_after' );

/**
 * Sample implementation of the WooCommerce Mini Cart.
 *
 * You can add the WooCommerce Mini Cart to header.php like so ...
 *
	<?php
		if ( function_exists( 'grocery_store_woocommerce_header_cart' ) ) {
			grocery_store_woocommerce_header_cart();
		}
	?>
 */

if ( ! function_exists( 'grocery_store_woocommerce_cart_link_fragment' ) ) {
	/**
	 * Cart Fragments.
	 *
	 * Ensure cart contents update when products are added to the cart via AJAX.
	 *
	 * @param array $fragments Fragments to refresh via AJAX.
	 * @return array Fragments to refresh via AJAX.
	 */
	function grocery_store_woocommerce_cart_link_fragment( $fragments ) {
		ob_start();
		grocery_store_woocommerce_cart_link();
		$fragments['a.cart-contents'] = ob_get_clean();

		return $fragments;
	}
}
add_filter( 'woocommerce_add_to_cart_fragments', 'grocery_store_woocommerce_cart_link_fragment' );

if ( ! function_exists( 'grocery_store_woocommerce_cart_link' ) ) {
	/**
	 * Cart Link.
	 *
	 * Displayed a link to the cart including the number of items present and the cart total.
	 *
	 * @return void
	 */
	function grocery_store_woocommerce_cart_link() {
		?>
		<a class="cart-contents" href="<?php echo esc_url( wc_get_cart_url() ); ?>" title="<?php esc_attr_e( 'View your shopping cart', 'grocery-store' ); ?>">
			<?php
			$item_count_text = sprintf(
				/* translators: number of items in the mini cart. */
				_n( '%d item', '%d items', WC()->cart->get_cart_contents_count(), 'grocery-store' ),
				WC()->cart->get_cart_contents_count()
			);
			?>
			<span class="amount"><?php echo wp_kses_data( WC()->cart->get_cart_subtotal() ); ?></span> 
			<span class="count"><?php echo esc_html( $item_count_text ); ?></span>
			
		</a>
		<?php
	}
}

if ( ! function_exists( 'grocery_store_woocommerce_header_cart' ) ) {
	/**
	 * Display Header Cart.
	 *
	 * @return void
	 */
	function grocery_store_woocommerce_header_cart() {
	?>
    <div class="top-form-minicart box-icon-cart" tabindex="0" autofocus="true">
		<i class="icofont-cart"></i>
		<?php grocery_store_woocommerce_cart_link();
			  //grocery_store_woocommerce_min_cart_item();
			$instance = array(
					'title' => '',
				);
			echo '<div class="dropdown-box">';
			the_widget( 'WC_Widget_Cart', $instance );
			echo '</div>';
		 ?>
		
	</div>
	<?php
	}
}


/**--------------------------------------------
 *   WooCommerce  tool bar hook
 --------------------------------------------*/
remove_action('woocommerce_before_shop_loop','woocommerce_result_count',20);

if ( ! function_exists( 'grocery_store_header_toolbar_start' ) ) {
	/**
	 * Insert the opening anchor tag for products in the loop.
	 */
	function grocery_store_header_toolbar_start() {
		echo '<div class="bcf-shop-toolbar clearfix">';
	}
	
	add_action('woocommerce_before_shop_loop','grocery_store_header_toolbar_start',20);
}


function grocery_store_result_count() {
	get_template_part( 'woocommerce/result-count' );
}
add_action('woocommerce_before_shop_loop','grocery_store_result_count',30);

//remove_action( 'woocommerce_before_shop_loop', 'woocommerce_catalog_ordering', 30 );


if ( ! function_exists( 'grocery_store_header_toolbar_end' ) ) {
	/**
	 * Insert the opening anchor tag for products in the loop.
	 */
	function grocery_store_header_toolbar_end() {
		echo '<div class="clearfix"></div></div>';
	}
	
	add_action('woocommerce_before_shop_loop','grocery_store_header_toolbar_end',30);
}


if ( ! function_exists( 'grocery_store_loop_shop_per_page' ) ) :
	/**
	 * Returns correct posts per page for the shop
	 *
	 * @since 1.0.0
	 */
	function grocery_store_loop_shop_per_page() {
		
		$posts_per_page = ( isset( $_GET['products-per-page'] ) ) ? sanitize_text_field( wp_unslash( $_GET['products-per-page'] ) ) : get_theme_mod( 'shopstore_woo_shop_posts_per_page',12 );

		if ( $posts_per_page == 'all' ) {
			$posts_per_page = wp_count_posts( 'product' )->publish;
		}
		
		return $posts_per_page;
	}
	add_filter( 'loop_shop_per_page', 'grocery_store_loop_shop_per_page', 20 );
endif;


/**--------------------------------------------
 *  WooCommerce Product loop
 --------------------------------------------*/

/**
*  loop  product after div add.
*
* @return integer products per row.
*/

function grocery_store_loop_item_before() {
	echo '<div class="product-loop-wrp">';
}
add_action( 'woocommerce_before_shop_loop_item', 'grocery_store_loop_item_before',5 );

function grocery_store_content_padding() {
	echo '<div class="content-wrap">';
}
add_action( 'woocommerce_shop_loop_item_title', 'grocery_store_content_padding',5 );

function grocery_store_loop_item_after() {
		echo '</div>';

	echo '</div>';
}
add_action( 'woocommerce_after_shop_loop_item', 'grocery_store_loop_item_after',999 );


if ( ! function_exists( 'grocery_store_loop_product_thumbnail' ) ) {
	
	/**
	 * Get the product thumbnail for the loop.
	 */
	function grocery_store_loop_product_thumbnail() {
		global $product;
		$attachment_ids   = $product->get_gallery_image_ids();
		
		
		
		echo '<div class="product-image">';

		
			if( isset( $attachment_ids[0] ) && $attachment_ids[0] != "" ) {
			
				$img_tag = array(
				'class'         => 'woo-entry-image-secondary',
				'alt'           => get_the_title(),
				);
				
			
				echo '<figure class="hover_hide">'. wp_kses_post(woocommerce_get_product_thumbnail()) . wp_get_attachment_image( $attachment_ids[0], 'shop_catalog', '', $img_tag ) .'</figure>';

			}else{
				echo '<figure>'.wp_kses_post(woocommerce_get_product_thumbnail()).'</figure>';	
			}
		echo '</div>';	
	}
	
	add_action( 'woocommerce_before_shop_loop_item_title','woocommerce_template_loop_product_link_open',5 );
	add_action( 'woocommerce_before_shop_loop_item_title','woocommerce_show_product_loop_sale_flash',10 );
	add_action( 'woocommerce_before_shop_loop_item_title','grocery_store_loop_product_thumbnail',20 );
	add_action( 'woocommerce_before_shop_loop_item_title','woocommerce_template_loop_product_link_close',99 );
	
	

	
}

if ( ! function_exists( 'grocery_store_template_loop_product_title' ) ) {

	/**
	 * Show the product title in the product loop. By default this is an H2.
	 */
	function grocery_store_template_loop_product_title() {
		echo '<h4 class="' . esc_attr( apply_filters( 'woocommerce_product_loop_title_classes', 'woocommerce-loop-product__title' ) ) . '">' . esc_html( get_the_title() ) . '</h4>'; // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped
	}
	add_action( 'woocommerce_shop_loop_item_title', 'grocery_store_template_loop_product_title', 10 );
}





if ( ! function_exists( 'grocery_store_before_quantity_input_field' ) ) {
	/**
	 * before quantity.
	 *
	 *
	 * @return $html
	 */
	function grocery_store_before_quantity_input_field() {
		echo '<button type="button" class="plus"><i class="icofont-plus"></i></button>';
	}
	add_action( 'woocommerce_before_quantity_input_field','grocery_store_before_quantity_input_field',10);
	
	
}

if ( ! function_exists( 'grocery_store_after_quantity_input_field' ) ) {
	/**
	 * after quantity.
	 *
	 *
	 * @return $html
	 */
	function grocery_store_after_quantity_input_field() {
		echo '<button type="button" class="minus"><i class="icofont-minus"></i></button>';
	}
	add_action( 'woocommerce_after_quantity_input_field','grocery_store_after_quantity_input_field',10);
	
	
}

/**
 * after quantity.
 *
 *
 * @return $html
 */
function grocery_store_order_button_html(){

	return '<button type="submit" class="button alt place_order_btn theme-btn" name="woocommerce_checkout_place_order" id="place_order" value="' . esc_attr__('Place order','grocery-store') . '" data-value="' . esc_attr__( 'Place order','grocery-store' ) . '"><span>' . esc_html__( 'Place order','grocery-store' ) . '</span></button>';
	
}
add_action( 'woocommerce_order_button_html','grocery_store_order_button_html' );




if ( ! function_exists( 'grocery_store_widget_shopping_cart_button_view_cart' ) ) {

	/**
	 * Output the view cart button.
	 */
	function grocery_store_widget_shopping_cart_button_view_cart() {
		echo '<a href="' . esc_url( wc_get_cart_url() ) . '" class="button wc-forward theme-btn">' . esc_html__( 'View cart', 'grocery-store' ) . '</a>';
	}
}

if ( ! function_exists( 'grocery_store_widget_shopping_cart_proceed_to_checkout' ) ) {

	/**
	 * Output the proceed to checkout button.
	 */
	function grocery_store_widget_shopping_cart_proceed_to_checkout() {
		echo '<a href="' . esc_url( wc_get_checkout_url() ) . '" class="button checkout wc-forward theme-btn">' . esc_html__( 'Checkout', 'grocery-store' ) . '</a>';
	}
}

add_action( 'woocommerce_widget_shopping_cart_buttons', 'grocery_store_widget_shopping_cart_button_view_cart', 10 );
add_action( 'woocommerce_widget_shopping_cart_buttons', 'grocery_store_widget_shopping_cart_proceed_to_checkout', 20 );
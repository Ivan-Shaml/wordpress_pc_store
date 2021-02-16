<?php
/**
 * Grocery Store functions and definitions
 *
 * @link https://developer.wordpress.org/themes/basics/theme-functions/
 *
 * @package Grocery_Store
 */

if ( ! defined( '_S_VERSION' ) ) {
	// Replace the version number of the theme on each release.
	define( '_S_VERSION', '1.0.0' );
}

if ( ! function_exists( 'grocery_store_setup' ) ) :
	/**
	 * Sets up theme defaults and registers support for various WordPress features.
	 *
	 * Note that this function is hooked into the after_setup_theme hook, which
	 * runs before the init hook. The init hook is too late for some features, such
	 * as indicating support for post thumbnails.
	 */
	function grocery_store_setup() {
		/*
		 * Make theme available for translation.
		 * Translations can be filed in the /languages/ directory.
		 * If you're building a theme based on Grocery Store, use a find and replace
		 * to change 'grocery-store' to the name of your theme in all the template files.
		 */
		load_theme_textdomain( 'grocery-store', get_template_directory() . '/languages' );

		// Add default posts and comments RSS feed links to head.
		add_theme_support( 'automatic-feed-links' );

		/*
		 * Let WordPress manage the document title.
		 * By adding theme support, we declare that this theme does not use a
		 * hard-coded <title> tag in the document head, and expect WordPress to
		 * provide it for us.
		 */
		add_theme_support( 'title-tag' );

		/*
		 * Enable support for Post Thumbnails on posts and pages.
		 *
		 * @link https://developer.wordpress.org/themes/functionality/featured-images-post-thumbnails/
		 */
		add_theme_support( 'post-thumbnails' );

		// This theme uses wp_nav_menu() in one location.
		register_nav_menus(
			array(
				'primary' => esc_html__( 'Primary', 'grocery-store' ),
				'top-menu' => esc_html__( 'Top bar menu', 'grocery-store' ),
			)
		);

		/*
		 * Switch default core markup for search form, comment form, and comments
		 * to output valid HTML5.
		 */
		add_theme_support(
			'html5',
			array(
				'search-form',
				'comment-form',
				'comment-list',
				'gallery',
				'caption',
				'style',
				'script',
			)
		);

		// Set up the WordPress core custom background feature.
		add_theme_support(
			'custom-background',
			apply_filters(
				'grocery_store_custom_background_args',
				array(
					'default-color' => 'ffffff',
					'default-image' => '',
				)
			)
		);

		// Add theme support for selective refresh for widgets.
		add_theme_support( 'customize-selective-refresh-widgets' );

		/**
		 * Add support for core custom logo.
		 *
		 * @link https://codex.wordpress.org/Theme_Logo
		 */
		add_theme_support(
			'custom-logo',
			array(
				'height'      => 250,
				'width'       => 250,
				'flex-width'  => true,
				'flex-height' => true,
			)
		);
		/*
		* Enable support for Post Formats.
		* See https://developer.wordpress.org/themes/functionality/post-formats/
		*/
		add_theme_support( 'post-formats', array(
			'image',
			'video',
			'gallery',
			'audio',
			'quote'
		) );
		/**
		* Registers an editor stylesheet for the current theme.
		*/
		$font_url = str_replace( ',', '%2C', '//fonts.googleapis.com/css?family=K2D:300,400,500,600,700|Roboto:400,500,700|Poppins:400,500,700&display=swap' );
	add_editor_style( $font_url );
	}
endif;
add_action( 'after_setup_theme', 'grocery_store_setup' );

/**
 * Set the content width in pixels, based on the theme's design and stylesheet.
 *
 * Priority 0 to make it available to lower priority callbacks.
 *
 * @global int $content_width
 */
function grocery_store_content_width() {
	// This variable is intended to be overruled from themes.
	// Open WPCS issue: {@link https://github.com/WordPress-Coding-Standards/WordPress-Coding-Standards/issues/1043}.
	// phpcs:ignore WordPress.NamingConventions.PrefixAllGlobals.NonPrefixedVariableFound
	$GLOBALS['content_width'] = apply_filters( 'grocery_store_content_width', 640 );
}
add_action( 'after_setup_theme', 'grocery_store_content_width', 0 );

/**
 * Register widget area.
 *
 * @link https://developer.wordpress.org/themes/functionality/sidebars/#registering-a-sidebar
 */
function grocery_store_widgets_init() {
	register_sidebar(
		array(
			'name'          => esc_html__( 'Sidebar', 'grocery-store' ),
			'id'            => 'sidebar-1',
			'description'   => esc_html__( 'Add widgets here.', 'grocery-store' ),
			'before_widget' => '<section id="%1$s" class="widget %2$s">',
			'after_widget'  => '</section>',
			'before_title'  => '<h3 class="widget-title">',
			'after_title'   => '</h3>',
		)
	);
	register_sidebar(
		array(
			'name'          => esc_html__( 'Home Page Slider', 'grocery-store' ),
			'id'            => 'slider',
			'description'   => esc_html__( 'Add widgets here.', 'grocery-store' ),
			'before_widget' => '<section id="%1$s" class="widget  %2$s">',
			'after_widget'  => '</section>',
			'before_title'  => '<h3 class="widget-title screen-reader-text">',
			'after_title'   => '</h3>',
		)
	);
	register_sidebar(
		array(
			'name'          => esc_html__( 'Logo Sidebar', 'grocery-store' ),
			'id'            => 'logo-sidebar',
			'description'   => esc_html__( 'Add widgets here.', 'grocery-store' ),
			'before_widget' => '<section id="%1$s" class="widget  %2$s">',
			'after_widget'  => '</section>',
			'before_title'  => '<h3 class="widget-title screen-reader-text">',
			'after_title'   => '</h3>',
		)
	);
	register_sidebar(
		array(
			'name'          => esc_html__( 'Footer', 'grocery-store' ),
			'id'            => 'footer-1',
			'description'   => esc_html__( 'Add widgets here.', 'grocery-store' ),
			'before_widget' => '<section id="%1$s" class="widget %2$s col-lg-4 col-12">',
			'after_widget'  => '</section>',
			'before_title'  => '<h3 class="widget-title">',
			'after_title'   => '</h3>',
		)
	);

	
}
add_action( 'widgets_init', 'grocery_store_widgets_init' );

/**
 * Enqueue scripts and styles.
 */
function grocery_store_scripts() {
	
	wp_enqueue_style( 'inx-google-fonts', '//fonts.googleapis.com/css?family=K2D:300,400,500,600,700|Roboto:400,500,700|Poppins:400,500,700&display=swap' );
	
	/* PLUGIN CSS */
	wp_enqueue_style( 'bootstrap', get_theme_file_uri( '/vendors/bootstrap/css/bootstrap.css' ), array(), '4.0.0' );
	
	wp_enqueue_style( 'rd-navbar', get_theme_file_uri( '/vendors/rd-navbar/css/rd-navbar.css' ), array(), '2.2.5' );
	
	wp_enqueue_style( 'icofont', get_theme_file_uri( '/vendors/icofont/icofont.css' ), array(), '1.0.1' );
	wp_enqueue_style( 'owl-carousel', get_theme_file_uri( '/vendors/owl-carousel/assets/owl.carousel.css' ), array(), '2.3.4' );
	wp_enqueue_style( 'aos-next', get_theme_file_uri( '/vendors/aos-next/aos.css' ), array(), '2.0.0' );

	
	wp_enqueue_style( 'grocery-store-common', get_theme_file_uri( '/assets/css/grocery-store-common.css' ), array(), _S_VERSION );
	
	
	
	wp_enqueue_style( 'grocery-store-style', get_stylesheet_uri(), array(), _S_VERSION );
	wp_style_add_data( 'grocery-store-style', 'rtl', 'replace' );


	$custom_css = ':root{--primary-color:'.esc_attr( get_theme_mod('__primary_color','#777777') ).'!important; --secondary-color: '.esc_attr( get_theme_mod('__secondary_color','#7fba00') ).'!important; --nav-bg:'.esc_attr( get_theme_mod('__secondary_color','#7fba00') ).'!important; --secondary-color-deep:'.esc_attr( get_theme_mod('__quaternary_color','#557c00') ).'!important;  --nav-deep:'.esc_attr( get_theme_mod('__quaternary_color','#557c00') ).'!important;}';
		
	
	if( !empty(get_header_image()) ){
		$custom_css .= '#static_header_banner{ background:url('.esc_url( get_header_image() ).') no-repeat center center; background-size:cover; }';
	}
	wp_add_inline_style( 'grocery-store-style', $custom_css );
	
	
	wp_enqueue_script( 'bootstrap', get_theme_file_uri( '/vendors/bootstrap/js/bootstrap.js' ), 0, '3.3.7', true );
	
	
	wp_enqueue_script( 'rd-navbar-js', get_theme_file_uri( '/vendors/rd-navbar/js/jquery.rd-navbar.js' ), 0, '', true );
	wp_enqueue_script( 'customselect', get_theme_file_uri( '/vendors/customselect.js' ), 0, '', true );
	wp_enqueue_script( 'owl-carousel-js', get_theme_file_uri( '/vendors/owl-carousel/owl.carousel.js' ), 0, '', true );
	wp_enqueue_script( 'sticky-sidebar', get_theme_file_uri( '/vendors/sticky-sidebar/jquery.sticky-sidebar.js' ), 0, '', true );
	
	wp_enqueue_script( 'aos-next', get_theme_file_uri( '/vendors/aos-next/aos.js' ), 0, '', true );
	
	
	wp_enqueue_script( 'grocery-store-js',get_theme_file_uri( '/assets/js/grocery-store.js'), array('jquery'), _S_VERSION, true );
		
		

	if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
		wp_enqueue_script( 'comment-reply' );
	}
}
add_action( 'wp_enqueue_scripts', 'grocery_store_scripts' );



/**
 * Set up the WordPress core custom header feature.
 *
 * @uses grocery_store_header_style()
 */
function grocery_store_custom_header_setup() {
	
		$args = apply_filters(
			'grocery_store_custom_header_args',
			array(
				'default-image'      => '',
				'default-text-color' => '000000',
				'width'              => 1000,
				'height'             => 250,
				'flex-height'        => true,
				'wp-head-callback'   => 'grocery_store_header_style',
			)
		);
		add_theme_support( 'custom-header', $args  );
		
		$defaults =  apply_filters(
			'grocery_store_custom_background_args', array(
			'default-image'          => '',
			'default-preset'         => 'default', // 'default', 'fill', 'fit', 'repeat', 'custom'
			'default-position-x'     => 'left',    // 'left', 'center', 'right'
			'default-position-y'     => 'top',     // 'top', 'center', 'bottom'
			'default-size'           => 'auto',    // 'auto', 'contain', 'cover'
			'default-repeat'         => 'repeat',  // 'repeat-x', 'repeat-y', 'repeat', 'no-repeat'
			'default-attachment'     => 'scroll',  // 'scroll', 'fixed'
			'default-color'          => '',
			'wp-head-callback'       => '_custom_background_cb',
			'admin-head-callback'    => '',
			'admin-preview-callback' => '',
		));
		add_theme_support( 'custom-background', $defaults );
}
add_action( 'after_setup_theme', 'grocery_store_custom_header_setup' );

if ( ! function_exists( 'grocery_store_header_style' ) ) :
	/**
	 * Styles the header image and text displayed on the blog.
	 *
	 * @see grocery_store_custom_header_setup().
	 */
	function grocery_store_header_style() {
		$header_text_color = get_header_textcolor();

		/*
		 * If no custom options for text are set, let's bail.
		 * get_header_textcolor() options: Any hex value, 'blank' to hide text. Default: add_theme_support( 'custom-header' ).
		 */
		if ( get_theme_support( 'custom-header', 'default-text-color' ) === $header_text_color ) {
			return;
		}

		// If we get this far, we have custom styles. Let's do this.
		?>
		<style type="text/css">
		<?php
		// Has the text been hidden?
		if ( ! display_header_text() ) :
			?>
			.site-title,
			.site-description {
				position: absolute;
				clip: rect(1px, 1px, 1px, 1px);
				}
			<?php
			// If the user has set a custom color for the text use that.
		else :
			?>
			#static_header_banner .content-text h1{
				color: #<?php echo esc_attr( $header_text_color ); ?>;
			}
		<?php endif; ?>
		</style>
		<?php
	}
endif;

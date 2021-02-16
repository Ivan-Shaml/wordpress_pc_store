<?php 

/**
 * Theme Options Panel.
 *
 * @package Grocery Store
 */

$default = grocery_store_default_theme_options();
global $wp_customize;



// Styling Options.*/

$wp_customize->add_section( 'styling_section_settings',
	array(
		'title'      => esc_html__( 'Styling Options', 'grocery-store' ),
		'description'  => esc_html__( 'The theme comes with unlimited color schemes for your theme\'s styling. upgrade pro for color options & features', 'grocery-store' ),
		'priority'   => 100,
		'capability' => 'edit_theme_options',
		'panel'      => 'theme_option_panel',
	)
);


// Primary Color.
$wp_customize->add_setting( '__primary_color',
	array(
	'default'           => $default['__primary_color'],
	'capability'        => 'edit_theme_options',
	'sanitize_callback' => 'sanitize_text_field',
	)
);
$wp_customize->add_control( '__primary_color',
	array(
	'label'    	   => esc_html__( 'Primary Color:', 'grocery-store' ),
	'section'  	   => 'styling_section_settings',
	'type'     => 'color',
	'priority' => 120,
	)
);

$wp_customize->add_setting( '__secondary_color',
	array(
	'default'           => $default['__secondary_color'],
	'capability'        => 'edit_theme_options',
	'sanitize_callback' => 'sanitize_text_field',
	)
);
$wp_customize->add_control( '__secondary_color',
	array(
	'label'    	   => esc_html__( 'Secondary Color:', 'grocery-store' ),
	'section'  	   => 'styling_section_settings',
	'type'     => 'color',
	'priority' => 120,
	)
);

$wp_customize->add_setting( '__quaternary_color',
	array(
	'default'           => $default['__quaternary_color'],
	'capability'        => 'edit_theme_options',
	'sanitize_callback' => 'sanitize_text_field',
	)
);
$wp_customize->add_control( '__quaternary_color',
	array(
	'label'    	   => esc_html__( 'Quaternary Color:', 'grocery-store' ),
	'section'  	   => 'styling_section_settings',
	'type'     => 'color',
	'priority' => 120,
	)
);

// Add Theme Options Panel.
$wp_customize->add_panel( 'theme_option_panel',
	array(
		'title'      => esc_html__( 'Theme Options', 'grocery-store' ),
		'priority'   => 2,
		'capability' => 'edit_theme_options',
	)
);

	
/*Posts management section start */
$wp_customize->add_section( 'theme_option_section_settings',
	array(
		'title'      => esc_html__( 'Blog Management', 'grocery-store' ),
		'priority'   => 100,
		'capability' => 'edit_theme_options',
		'panel'      => 'theme_option_panel',
	)
);

		/*Posts Layout*/
		$wp_customize->add_setting( 'blog_layout',
			array(
				'default'           => $default['blog_layout'],
				'capability'        => 'edit_theme_options',
				'sanitize_callback' => 'grocery_store_sanitize_select',
			)
		);
		$wp_customize->add_control( 'blog_layout',
			array(
				'label'    => esc_html__( 'Blog Layout Options', 'grocery-store' ),
				'description' => esc_html__( 'Choose between different layout options to be used as default', 'grocery-store' ),
				'section'  => 'theme_option_section_settings',
				'choices'   => array(
					'sidebar-content'  => esc_html__( 'Primary Sidebar - Content', 'grocery-store' ),
					'content-sidebar' => esc_html__( 'Content - Primary Sidebar', 'grocery-store' ),
					'no-sidebar'    => esc_html__( 'No Sidebar', 'grocery-store' ),
					),
				'type'     => 'select',
				
			)
		);
		
		
		$wp_customize->add_setting( 'single_post_layout',
			array(
				'default'           => $default['single_post_layout'],
				'capability'        => 'edit_theme_options',
				'sanitize_callback' => 'grocery_store_sanitize_select',
			)
		);
		$wp_customize->add_control( 'single_post_layout',
			array(
				'label'    => esc_html__( 'Blog Layout Options', 'grocery-store' ),
				'description' => esc_html__( 'Choose between different layout options to be used as default', 'grocery-store' ),
				'section'  => 'theme_option_section_settings',
				'choices'   => array(
					'sidebar-content'  => esc_html__( 'Primary Sidebar - Content', 'grocery-store' ),
					'content-sidebar' => esc_html__( 'Content - Primary Sidebar', 'grocery-store' ),
					'no-sidebar'    => esc_html__( 'No Sidebar', 'grocery-store' ),
					),
				'type'     => 'select',
				
			)
		);
		
		
		/*Blog Loop Content*/
		$wp_customize->add_setting( 'blog_loop_content_type',
			array(
				'default'           => $default['blog_loop_content_type'],
				'capability'        => 'edit_theme_options',
				'sanitize_callback' => 'grocery_store_sanitize_select',
			)
		);
		$wp_customize->add_control( 'blog_loop_content_type',
			array(
				'label'    => esc_html__( 'Archive Content Type', 'grocery-store' ),
				'description' => esc_html__( 'Choose Archive, Blog Page Content type as default', 'grocery-store' ),
				'section'  => 'theme_option_section_settings',
				'choices'               => array(
					'excerpt' => __( 'Excerpt', 'grocery-store' ),
					'content' => __( 'Content', 'grocery-store' ),
					),
				'type'     => 'select',
				
			)
		);
		
		/*Social Profile*/
		$wp_customize->add_setting( 'read_more_text',
			array(
				'default'           => $default['read_more_text'],
				'capability'        => 'edit_theme_options',
				'sanitize_callback' => 'sanitize_text_field',
			)
		);
		$wp_customize->add_control( 'read_more_text',
			array(
				'label'    => esc_html__( 'Read more text', 'grocery-store' ),
				'description' => esc_html__( 'Leave empty to hide', 'grocery-store' ),
				'section'  => 'theme_option_section_settings',
				'type'     => 'text',
				
			)
		);
		
		
		$wp_customize->add_setting( 'blog_meta_hide',
			array(
				'default'           => $default['blog_meta_hide'],
				'capability'        => 'edit_theme_options',
				'sanitize_callback' => 'grocery_store_sanitize_checkbox',
			)
		);
		$wp_customize->add_control( 'blog_meta_hide',
			array(
				'label'    => esc_html__( 'Hide Blog Meta Info ?', 'grocery-store' ),
				'section'  => 'theme_option_section_settings',
				'type'     => 'checkbox',
				
			)
		);
		
		
/*Posts management section start */
$wp_customize->add_section( 'page_option_section_settings',
	array(
		'title'      => esc_html__( 'Page Management', 'grocery-store' ),
		'priority'   => 100,
		'capability' => 'edit_theme_options',
		'panel'      => 'theme_option_panel',
	)
);

	
		/*Home Page Layout*/
		$wp_customize->add_setting( 'page_layout',
			array(
				'default'           => $default['blog_layout'],
				'capability'        => 'edit_theme_options',
				'sanitize_callback' => 'grocery_store_sanitize_select',
			)
		);
		$wp_customize->add_control( 'page_layout',
			array(
				'label'    => esc_html__( 'Page Layout Options', 'grocery-store' ),
				'section'  => 'page_option_section_settings',
				'description' => esc_html__( 'Choose between different layout options to be used as default', 'grocery-store' ),
				'choices'   => array(
					'sidebar-content'  => esc_html__( 'Primary Sidebar - Content', 'grocery-store' ),
					'content-sidebar' => esc_html__( 'Content - Primary Sidebar', 'grocery-store' ),
					'no-sidebar'    => esc_html__( 'No Sidebar', 'grocery-store' ),
					),
				'type'     => 'select',
				'priority' => 170,
			)
		);


		// Footer Section.
		$wp_customize->add_section( 'footer_section',
			array(
			'title'      => esc_html__( 'Copyright & Topbar Text', 'grocery-store' ),
			'priority'   => 130,
			'capability' => 'edit_theme_options',
			'panel'      => 'theme_option_panel',
			)
		);
		
		// Setting copyright_text.
		$wp_customize->add_setting( 'copyright_text',
			array(
			'default'           => $default['copyright_text'],
			'capability'        => 'edit_theme_options',
			'sanitize_callback' => 'sanitize_text_field',
			)
		);
		$wp_customize->add_control( 'copyright_text',
			array(
			'label'    => esc_html__( 'Footer Copyright Text', 'grocery-store' ),
			'section'  => 'footer_section',
			'type'     => 'textarea',
			'priority' => 120,
			)
		);

		// Setting copyright_text.
		$wp_customize->add_setting( 'topbar_text',
			array(
			'default'           => $default['topbar_text'],
			'capability'        => 'edit_theme_options',
			'sanitize_callback' => 'sanitize_text_field',
			)
		);
		$wp_customize->add_control( 'topbar_text',
			array(
			'label'    => esc_html__( 'Top bar Text', 'grocery-store' ),
			'section'  => 'footer_section',
			'type'     => 'textarea',
			'priority' => 120,
			)
		);

		// Setting copyright_text.
		$wp_customize->add_setting( 'payment_method_img',
			array(
			'capability'        => 'edit_theme_options',
			'sanitize_callback' => 'grocery_store_sanitize_image',
			)
		);

		$wp_customize->add_control(
			new WP_Customize_Image_Control(
			   $wp_customize,
			   'payment_method_img',
			   array(
			       'label'      => esc_html__( 'Payment method', 'grocery-store' ),
			       'section'    => 'footer_section',
			       'settings'   => 'payment_method_img',
			       'context'    => 'payment_method_img',
			       'priority' 	=> 180,
			   )
			)
		); 
		

// Footer Section.
	

 


	
<?php
	if ( ! isset( $content_width ) ) $content_width = 1170;
	
	add_action( 'after_setup_theme', 'local_theme_setup' );
	function local_theme_setup(){
		
		add_theme_support( 'post-thumbnails' );
		add_image_size( 'img-1170-500', 1170, 500, true );
		add_image_size( 'img-1100-450', 1100, 450, true );
		add_image_size( 'img-840-430', 840, 430, true );
		add_image_size( 'img-840-400', 840, 400, true );
		add_image_size( 'img-770-300', 770, 300, true );
		add_image_size( 'img-480-380', 480, 380, true );
		add_image_size( 'img-370-193', 370, 193, true );
		add_image_size( 'img-300-225', 300, 225, true );
		add_image_size( 'img-270-283', 270, 283, true );
		add_image_size( 'img-270-180', 270, 180, true );
		add_image_size( 'img-270-153', 270, 153, true );
		add_image_size( 'img-129-129', 129, 129, true );
		add_image_size( 'img-122-120', 122, 120, true );
		add_image_size( 'img-75-75', 75, 75, true );
		add_image_size( 'img-69-69', 69, 69, true );
		add_image_size( 'img-63-50', 63, 50, true );
		add_image_size( 'img-50-56', 50, 56, true );
		add_image_size( 'img-50-50', 50, 50, true );
		
		add_theme_support( 'title-tag' );
		add_theme_support( 'automatic-feed-links' );
		add_theme_support( 'html5', array(
			'search-form',
			'comment-form',
			'comment-list',
			'gallery',
			'caption'
		) );
		
		
		load_theme_textdomain( 'stm_domain', get_template_directory() . '/languages' );
		
		register_nav_menus( array(
			'primary'   => __( 'Top primary menu', 'stm_domain' ),
			'secondary' => __( 'Secondary menu in the footer', 'stm_domain' ),
		) );

		register_sidebar( array(
			'name'          => __( 'Primary Sidebar', 'stm_domain' ),
			'id'            => 'default',
			'description'   => __( 'Main sidebar that appears on the right or left.', 'stm_domain' ),
			'before_widget' => '<aside id="%1$s" class="widget %2$s">',
			'after_widget'  => '</aside>',
			'before_title'  => '<div class="widget_title"><h3>',
			'after_title'   => '</h3></div>',
		) );
		
		register_sidebar( array(
			'name'          => __( 'Footer Top', 'stm_domain' ),
			'id'            => 'footer_top',
			'description'   => __( 'Footer Top Widgets Area', 'stm_domain' ),
			'before_widget' => '<aside id="%1$s" class="widget %2$s">',
			'after_widget'  => '</aside>',
			'before_title'  => '<div class="widget_title"><h3>',
			'after_title'   => '</h3></div>',
		) );
		
		register_sidebar( array(
			'name'          => __( 'Footer Bottom', 'stm_domain' ),
			'id'            => 'footer_bottom',
			'description'   => __( 'Footer Bottom Widgets Area', 'stm_domain' ),
			'before_widget' => '<aside id="%1$s" class="widget %2$s">',
			'after_widget'  => '</aside>',
			'before_title'  => '<div class="widget_title"><h3>',
			'after_title'   => '</h3></div>',
		) );
		
		if ( in_array( 'woocommerce/woocommerce.php', apply_filters( 'active_plugins', get_option( 'active_plugins' ) ) ) ) {
			register_sidebar( array(
				'name'          => __( 'Shop', 'stm_domain' ),
				'id'            => 'shop',
				'description'   => __( 'Woocommerce pages sidebar', 'stm_domain' ),
				'before_widget' => '<aside id="%1$s" class="widget %2$s">',
				'after_widget'  => '</aside>',
				'before_title'  => '<div class="widget_title"><h3>',
				'after_title'   => '</h3></div>',
			) );
		}
		
	}
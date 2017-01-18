<?php
	/*
		Scripts and Styles (SS)
	*/
	
	global $theme_info;
	$theme_info = wp_get_theme();
	define('STM_THEME_VERSION', ( WP_DEBUG ) ? time() : $theme_info->get( 'Version' ) );
	
	if( ! is_admin() ) {
		add_action( 'wp_enqueue_scripts', 'stm_load_theme_ss' );
	}
	function stm_load_theme_ss(){
		
		// Styles
		wp_enqueue_style( 'boostrap', get_stylesheet_directory_uri() . '/assets/css/bootstrap.min.css', NULL, STM_THEME_VERSION, 'all' ); 
		wp_enqueue_style( 'font-awesome-min', get_stylesheet_directory_uri() . '/assets/css/font-awesome.min.css', NULL, STM_THEME_VERSION, 'all' ); 
		wp_enqueue_style( 'font-icomoon', get_stylesheet_directory_uri() . '/assets/css/icomoon.fonts.css', NULL, STM_THEME_VERSION, 'all' ); 
        wp_enqueue_style( 'fancyboxcss', get_stylesheet_directory_uri() . '/assets/css/jquery.fancybox.css', NULL, STM_THEME_VERSION, 'all' );
        wp_enqueue_style( 'select2-min', get_stylesheet_directory_uri() . '/assets/css/select2.min.css', NULL, STM_THEME_VERSION, 'all' );
		wp_enqueue_style( 'theme-style-less', get_stylesheet_directory_uri() . '/assets/css/styles.css', NULL, STM_THEME_VERSION, 'all' );
		
		// Animations
		if ( !wp_is_mobile() ) {
			wp_enqueue_style( 'theme-style-animation', get_stylesheet_directory_uri() . '/assets/css/animation.css', NULL, STM_THEME_VERSION, 'all' );
		}
		
		// Theme main stylesheet
		wp_enqueue_style( 'theme-style', get_stylesheet_uri(), null, STM_THEME_VERSION, 'all' );
		
		// FrontEndCustomizer
		if(is_stm()){
			wp_enqueue_style( 'frontend-customizer', get_template_directory_uri() . '/assets/css/frontend_customizer.css', NULL, STM_THEME_VERSION, 'all' );
		}
		
		// Load the Internet Explorer specific stylesheet.
		//wp_enqueue_style( 'theme-ie-styles', get_template_directory_uri() . '/assets/css/ie.css', NULL, STM_THEME_VERSION, 'all' );
		//wp_style_add_data( 'theme-ie-styles', 'conditional', 'IE, IE 10' );
		
		wp_enqueue_style( 'skin_red_green', get_stylesheet_directory_uri() . '/assets/css/skins/skin_red_green.css', NULL, STM_THEME_VERSION, 'all' );
		wp_enqueue_style( 'skin_blue_green', get_stylesheet_directory_uri() . '/assets/css/skins/skin_blue_green.css', NULL, STM_THEME_VERSION, 'all' );
		wp_enqueue_style( 'skin_red_brown', get_stylesheet_directory_uri() . '/assets/css/skins/skin_red_brown.css', NULL, STM_THEME_VERSION, 'all' );
		wp_enqueue_style( 'skin_custom_color', get_stylesheet_directory_uri() . '/assets/css/skins/skin_custom_color.css', NULL, STM_THEME_VERSION, 'all' );

		// Scripts 
		if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
			wp_enqueue_script( 'comment-reply' );
		}
		
		wp_enqueue_script( 'jquerymigrate',   get_template_directory_uri() . '/assets/js/jquery-migrate-1.2.1.min.js',     'jquery', STM_THEME_VERSION, TRUE );
        wp_enqueue_script( 'bootstrap',   get_template_directory_uri() . '/assets/js/bootstrap.min.js', 'jquery', STM_THEME_VERSION, TRUE );
        wp_enqueue_script( 'fancyboxjs',   get_template_directory_uri() . '/assets/js/jquery.fancybox.js', 'jquery', STM_THEME_VERSION, TRUE );
        wp_enqueue_script( 'fredseljs',   get_template_directory_uri() . '/assets/js/jquery.carouFredSel-6.2.1.min.js', 'jquery', STM_THEME_VERSION, TRUE );
        wp_enqueue_script( 'countdown',   get_template_directory_uri() . '/assets/js/jquery.countdown.js', 'jquery', STM_THEME_VERSION, TRUE );
        wp_enqueue_script( 'select2-full-min',   get_template_directory_uri() . '/assets/js/select2.full.min.js', 'jquery', STM_THEME_VERSION, TRUE );
        wp_enqueue_script( 'imagesloaded',   get_template_directory_uri() . '/assets/js/imagesloaded.pkgd.min.js', 'jquery', STM_THEME_VERSION, TRUE );
		wp_enqueue_script( 'isotope',   get_template_directory_uri() . '/assets/js/isotope.pkgd.min.js', 'jquery', STM_THEME_VERSION, TRUE );
		wp_enqueue_script( 'jquery.touchSwipe.min',   get_template_directory_uri() . '/assets/js/jquery.touchSwipe.min.js', 'jquery', STM_THEME_VERSION, TRUE );
        wp_enqueue_script( 'custom',   get_template_directory_uri() . '/assets/js/custom.js', 'jquery', STM_THEME_VERSION, TRUE );
        if(is_stm()){
	        wp_enqueue_script( 'frontend-customizer-js',   get_template_directory_uri() . '/assets/js/frontend-customizer.js', 'jquery', STM_THEME_VERSION, TRUE );	        
	    }
        
        // These scripts are optional for vc
        wp_register_script( 'countUp.min.js', get_template_directory_uri() . '/assets/js/countUp.min.js', array( 'jquery' ), STM_THEME_VERSION, true );
        
	}
	
	// Admin styles
	function admin_styles() {
		wp_enqueue_style( 'theme-admin-styles', get_template_directory_uri() . '/assets/css/admin.css', null, STM_THEME_VERSION, 'all' );
		wp_enqueue_style( 'icomoon-mstudy', get_template_directory_uri() . '/assets/css/icomoon.fonts.css', null, STM_THEME_VERSION, 'all' );
		wp_enqueue_style( 'font-awesome-min', get_template_directory_uri() . '/assets/css/font-awesome.min.css', NULL, STM_THEME_VERSION, 'all' );
	}
	
	add_action( 'admin_enqueue_scripts', 'admin_styles' );
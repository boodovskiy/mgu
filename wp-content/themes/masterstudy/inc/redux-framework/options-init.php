<?php

/**
 * ReduxFramework Barebones Sample Config File
 * For full documentation, please visit: http://docs.reduxframework.com/
 *
 * For a more extensive sample-config file, you may look at:
 * https://github.com/reduxframework/redux-framework/blob/master/sample/sample-config.php
 *
 */

if ( ! class_exists( 'Redux' ) ) {
	return;
}

// This is your option name where all the Redux data is stored.
$opt_name = "stm_option";

/**
 * ---> SET ARGUMENTS
 * All the possible arguments for Redux.
 * For full documentation on arguments, please refer to: https://github.com/ReduxFramework/ReduxFramework/wiki/Arguments
 * */

$theme = wp_get_theme(); // For use with some settings. Not necessary.

$args = array(
	'opt_name'              => 'stm_option',
	'display_name'          => 'MasterStudy',
	'page_title'            => __( 'Theme Options', 'stm_domain' ),
	'menu_title'            => __( 'Theme Options', 'stm_domain' ),
	'update_notice'         => false,
	'admin_bar'             => true,
	'dev_mode'              => false,
	'menu_icon'             => 'dashicons-hammer',
	'menu_type'             => 'menu',
	'allow_sub_menu'        => true,
	'page_parent_post_type' => '',
	'default_mark'          => '',
	'hints'                 => array(
		'icon_position' => 'right',
		'icon_size'     => 'normal',
		'tip_style'     => array(
			'color' => 'light',
		),
		'tip_position'  => array(
			'my' => 'top left',
			'at' => 'bottom right',
		),
		'tip_effect'    => array(
			'show' => array(
				'duration' => '500',
				'event'    => 'mouseover',
			),
			'hide' => array(
				'duration' => '500',
				'event'    => 'mouseleave unfocus',
			),
		),
	),
	'output'                => true,
	'output_tag'            => true,
	'compiler'              => true,
	'page_permissions'      => 'manage_options',
	'save_defaults'         => true,
	'database'              => 'options',
	'transient_time'        => '3600',
	'show_import_export'    => true,
	'network_sites'         => true
);

Redux::setArgs( $opt_name, $args );

/*
 * ---> END ARGUMENTS
 */


/*
 *
 * ---> START SECTIONS
 *
 */

Redux::setSection( $opt_name, array(
	'title'   => __( 'General', 'stm_domain' ),
	'desc'    => '',
	'submenu' => true,
	'fields'  => array(
		array(
			'id'       => 'logo',
			'url'      => false,
			'type'     => 'media',
			'title'    => __( 'Site Logo', 'stm_domain' ),
			'default'  => array( 'url' => get_template_directory_uri() . '/assets/img/tmp/logo-colored.png' ),
			'subtitle' => __( 'Upload your logo file here.', 'stm_domain' ),
		),
		array(
			'id'       => 'logo_transparent',
			'url'      => false,
			'type'     => 'media',
			'title'    => __( 'White-text Logo', 'stm_domain' ),
			'default'  => array( 'url' => get_template_directory_uri() . '/assets/img/tmp/logo_transparent.png' ),
			'subtitle' => __( 'For our dark header options, we need your logo to be in white to stand out. Upload it here if you choose our dark or transparent header options', 'stm_domain' ),
		),
		array(
			'id'             => 'logo_text_font',
			'type'           => 'typography',
			'title'          => __( 'Logo Typography', 'stm_domain' ),
			'compiler'       => true,
			'google'         => true,
			'font-backup'    => false,
			'font-weight'    => false,
			'all_styles'     => true,
			'font-style'     => false,
			'subsets'        => true,
			'font-size'      => true,
			'line-height'    => false,
			'word-spacing'   => false,
			'letter-spacing' => false,
			'color'          => true,
			'preview'        => true,
			'output'         => array( '.logo-unit .logo' ),
			'units'          => 'px',
			'subtitle'       => __( 'Select custom font for your logo (choose these parametrs if you want to display Blogname instead of logo image).', 'stm_domain' ),
			'default'        => array(
				'color'       => "#fff",
				'font-family' => 'Montserrat',
				'font-size'   => '23px',
			)
		),
		array(
			'id'      => 'logo_width',
			'type'    => 'text',
			'title'   => __( 'Logo Width (px)', 'stm_domain' ),
			'default' => '253'
		),
		array(
			'id'      => 'menu_top_margin',
			'type'    => 'text',
			'title'   => __( 'Menu margin top (px)', 'stm_domain' ),
			'default' => '5'
		),
		array(
			'id'       => 'favicon',
			'url'      => false,
			'type'     => 'media',
			'title'    => __( 'Site Favicon', 'stm_domain' ),
			'default'  => '',
			'subtitle' => __( 'Upload a 16px x 16px .png or .gif image here', 'stm_domain' ),
		)
	)
) );

Redux::setSection( $opt_name, array(
	'title'   => __( 'Header', 'stm_domain' ),
	'desc'    => '',
	'icon'    => 'el-icon-file',
	'submenu' => true,
	'fields'  => array(
		/*
array(
			'id'       => 'header_style',
			'type'     => 'button_set',
			'title'    => __( 'Header Style Options', 'stm_domain' ),
			'subtitle' => __( 'Select your header style option', 'stm_domain' ),
			'options'  => array(
				'header_default'     => __( 'Default', 'stm_domain' ),
			),
			'default'  => 'header_default'
		),
*/
		array(
			'id'      => 'sticky_header',
			'type'    => 'switch',
			'title'   => __( 'Enable fixed header on scroll.', 'stm_domain' ),
			'default' => false
		),
	)
) );

Redux::setSection( $opt_name, array(
	'title'   => __( 'Top Bar', 'stm_domain' ),
	'desc'    => '',
	'icon'    => 'el el-website',
	'submenu' => true,
	'fields'  => array(
		array(
			'title'   => __( 'Enable Top Bar', 'stm_domain' ),
			'id'      => 'top_bar',
			'type'    => 'switch',
			'default' => true
		),
		array(
			'id'      => 'top_bar_login',
			'type'    => 'switch',
			'title'   => __( 'Show login url', 'stm_domain' ),
			'required' => array( 'top_bar', '=', true, ),
			'default' => true
		),
		array(
			'id'      => 'top_bar_social',
			'type'    => 'switch',
			'title'   => __( 'Enable Top Bar Social Media icons', 'stm_domain' ),
			'default' => true
		),
		array(
			'id'      => 'top_bar_wpml',
			'type'    => 'switch',
			'title'   => __( 'Enable Top Bar WPML switcher(if WPML Plugin installed)', 'stm_domain' ),
			'default' => true
		),
		array(
			'id'      => 'top_bar_color',
			'type'    => 'color',
			'title'   => __( 'Top Bar Background Color', 'stm_domain' ),
			'default' => '#333333'
		),
		array(
			'id'             => 'font_top_bar',
			'type'           => 'typography',
			'title'          => __( 'Top Bar', 'stm_domain' ),
			'compiler'       => true,
			'google'         => true,
			'font-backup'    => false,
			'font-weight'    => true,
			'all_styles'     => true,
			'font-style'     => true,
			'subsets'        => true,
			'font-size'      => true,
			'line-height'    => false,
			'word-spacing'   => false,
			'letter-spacing' => false,
			'color'          => true,
			'preview'        => true,
			'output'         => array( '.header_top_bar, .header_top_bar a' ),
			'units'          => 'px',
			'subtitle'       => __( 'Select custom font for your top bar text.', 'stm_domain' ),
			'default'        => array(
				'color'       => "#aaaaaa",
				'font-family' => 'Montserrat',
				'font-size'   => '12px',
			)
		),
		array(
			'id'       => 'top_bar_use_social',
			'type'     => 'sortable',
			'mode'     => 'checkbox',
			'title'    => __( 'Select Social Media Icons to display', 'stm_domain' ),
			'subtitle' => __( 'The urls for your social media icons will be taken from Social Media settings tab.', 'stm_domain' ),
			'required' => array(
				array( 'top_bar_social', '=', true, )
			),
			'options'  => array(
				'facebook'   => 'Facebook',
				'twitter'    => 'Twitter',
				'instagram'  => 'Instagram',
				'behance'    => 'Behance',
				'dribbble'   => 'Dribbble',
				'flickr'     => 'Flickr',
				'git'        => 'Git',
				'linkedin'   => 'Linkedin',
				'pinterest'  => 'Pinterest',
				'yahoo'      => 'Yahoo',
				'delicious'  => 'Delicious',
				'dropbox'    => 'Dropbox',
				'reddit'     => 'Reddit',
				'soundcloud' => 'Soundcloud',
				'google'     => 'Google',
				'google-plus'     => 'Google +',
				'skype'      => 'Skype',
				'youtube'    => 'Youtube',
				'youtube-play' => 'Youtube Play',
				'tumblr'     => 'Tumblr',
				'whatsapp'   => 'Whatsapp',
				'telegram'   => 'Telegram',
			),
			'default'  => array(
				'facebook'   => '0',
				'twitter'    => '0',
				'instagram'  => '0',
				'behance'    => '0',
				'dribbble'   => '0',
				'flickr'     => '0',
				'git'        => '0',
				'linkedin'   => '0',
				'pinterest'  => '0',
				'yahoo'      => '0',
				'delicious'  => '0',
				'dropbox'    => '0',
				'reddit'     => '0',
				'soundcloud' => '0',
				'google'     => '0',
				'google-plus'     => '0',
				'skype'      => '0',
				'youtube'    => '0',
				'youtube-play' => '0',
				'tumblr'     => '0',
				'whatsapp'   => '0',
				'telegram'   => '0',
			),
		),
		array(
			'id'      => 'top_bar_address',
			'type'    => 'text',
			'title'   => __( 'Address', 'stm_domain' ),
			'required' => array( 'top_bar', '=', true, ),
			'default' => __( '1010 Moon ave, New York, NY US', 'stm_domain' ),
		),
		array(
			'id'      => 'top_bar_address_mobile',
			'type'    => 'switch',
			'title'   => __( 'Show address on mobile', 'stm_domain' ),
			'required' => array( 'top_bar', '=', true, ),
		),
		array(
			'id'      => 'top_bar_working_hours',
			'type'    => 'text',
			'title'   => __( 'Working Hours', 'stm_domain' ),
			'default' => __( 'Mon - Sat 8.00 - 18.00', 'stm_domain' ),
		),
		array(
			'id'      => 'top_bar_working_hours_mobile',
			'type'    => 'switch',
			'title'   => __( 'Show Working hours on mobile', 'stm_domain' ),
			'required' => array( 'top_bar', '=', true, ),
		),
		array(
			'id'      => 'top_bar_phone',
			'type'    => 'text',
			'title'   => __( 'Phone number', 'stm_domain' ),
			'default' => __( '+1 212-226-3126', 'stm_domain' ),
		),
		array(
			'id'      => 'top_bar_phone_mobile',
			'type'    => 'switch',
			'title'   => __( 'Show Phone on mobile', 'stm_domain' ),
			'required' => array( 'top_bar', '=', true, ),
		),
	)
));

Redux::setSection( $opt_name, array(
	'title'   => __( 'Styling', 'stm_domain' ),
	'desc'    => '',
	'icon'    => 'el-icon-tint',
	'submenu' => true,
	'fields'  => array(
		array(
			'id'      => 'color_skin',
			'type'    => 'button_set',
			'title'   => __( 'Color Skin', 'stm_domain' ),
			'options' => array(
				''                  => __( 'Default', 'stm_domain' ),
				'skin_red_green'          => __( 'Red - Green', 'stm_domain' ),
				'skin_blue_green'       => __( 'Blue - Green', 'stm_domain' ),
				'skin_red_brown'       => __( 'Solid Red', 'stm_domain' ),
				'skin_custom_color' => __( 'Custom color', 'stm_domain' ),
			),
			'default' => ''
		),
		array(
			'id'       => 'primary_color',
			'type'     => 'color',
			'compiler' => true,
			'title'    => __( 'Primary Color', 'stm_domain' ),
			'default'  => '#eab830',
			'required' => array( 'color_skin', '=', 'skin_custom_color' ),
			'output' => array(
				'background-color' => '
body.skin_custom_color .blog_layout_grid .post_list_meta_unit .sticky_post,
body.skin_custom_color .blog_layout_list .post_list_meta_unit .sticky_post,
body.skin_custom_color .post_list_main_section_wrapper .post_list_meta_unit .sticky_post,
body.skin_custom_color .overflowed_content .wpb_column .icon_box,
body.skin_custom_color .stm_countdown_bg,
body.skin_custom_color #searchform-mobile .search-wrapper .search-submit,
body.skin_custom_color .header-menu-mobile .header-menu > li .arrow.active,
body.skin_custom_color .header-menu-mobile .header-menu > li.opened > a,
body.skin_custom_color mark,
body.skin_custom_color .woocommerce .cart-totals_wrap .shipping-calculator-button:hover,
body.skin_custom_color .detailed_rating .detail_rating_unit tr td.bar .full_bar .bar_filler,
body.skin_custom_color .product_status.new,
body.skin_custom_color .stm_woo_helpbar .woocommerce-product-search input[type="submit"],
body.skin_custom_color .stm_archive_product_inner_unit .stm_archive_product_inner_unit_centered .stm_featured_product_price .price.price_free,
body.skin_custom_color .sidebar-area .widget:after,
body.skin_custom_color .sidebar-area .socials_widget_wrapper .widget_socials li .back a,
body.skin_custom_color .socials_widget_wrapper .widget_socials li .back a,
body.skin_custom_color .widget_categories ul li a:hover:after,
body.skin_custom_color .event_date_info_table .event_btn .btn-default,
body.skin_custom_color .course_table tr td.stm_badge .badge_unit.quiz,
body.skin_custom_color div.multiseparator:after,
body.skin_custom_color .page-links span:hover,
body.skin_custom_color .page-links span:after,
body.skin_custom_color .page-links > span:after,
body.skin_custom_color .page-links > span,
body.skin_custom_color .stm_post_unit:after,
body.skin_custom_color .blog_layout_grid .post_list_content_unit:after,
body.skin_custom_color ul.page-numbers > li a.page-numbers:after,
body.skin_custom_color ul.page-numbers > li span.page-numbers:after,
body.skin_custom_color ul.page-numbers > li a.page-numbers:hover,
body.skin_custom_color ul.page-numbers > li span.page-numbers:hover,
body.skin_custom_color ul.page-numbers > li a.page-numbers.current:after,
body.skin_custom_color ul.page-numbers > li span.page-numbers.current:after,
body.skin_custom_color ul.page-numbers > li a.page-numbers.current,
body.skin_custom_color ul.page-numbers > li span.page-numbers.current,
body.skin_custom_color .triangled_colored_separator,
body.skin_custom_color .short_separator,
body.skin_custom_color .magic_line,
body.skin_custom_color .navbar-toggle .icon-bar,
body.skin_custom_color .navbar-toggle:hover .icon-bar,
body.skin_custom_color #searchform .search-submit,
body.skin_custom_color .header_main_menu_wrapper .header-menu > li > ul.sub-menu:before,
body.skin_custom_color .search-toggler:after,
body.skin_custom_color .modal .popup_title,
body.skin_custom_color .widget_pages ul.style_2 li a:hover:after,
body.skin_custom_color .sticky_post,
body.skin_custom_color .btn-carousel-control:after
',
				'border-color' => '
body.skin_custom_color ul.page-numbers > li a.page-numbers:hover,
body.skin_custom_color ul.page-numbers > li a.page-numbers.current,
body.skin_custom_color ul.page-numbers > li span.page-numbers.current,
body.skin_custom_color .custom-border textarea:active, 
body.skin_custom_color .custom-border input[type=text]:active, 
body.skin_custom_color .custom-border input[type=email]:active, 
body.skin_custom_color .custom-border input[type=number]:active, 
body.skin_custom_color .custom-border input[type=password]:active, 
body.skin_custom_color .custom-border input[type=tel]:active,
body.skin_custom_color .custom-border .form-control:active,
body.skin_custom_color .custom-border textarea:focus, 
body.skin_custom_color .custom-border input[type=text]:focus, 
body.skin_custom_color .custom-border input[type=email]:focus, 
body.skin_custom_color .custom-border input[type=number]:focus, 
body.skin_custom_color .custom-border input[type=password]:focus, 
body.skin_custom_color .custom-border input[type=tel]:focus,
body.skin_custom_color .custom-border .form-control:focus,
body.skin_custom_color .icon-btn:hover .icon_in_btn,
body.skin_custom_color .icon-btn:hover,
body.skin_custom_color .average_rating_unit,
body.skin_custom_color blockquote,
body.skin_custom_color .blog_layout_grid .post_list_meta_unit,
body.skin_custom_color .blog_layout_grid .post_list_meta_unit .post_list_comment_num,
body.skin_custom_color .blog_layout_list .post_list_meta_unit .post_list_comment_num,
body.skin_custom_color .blog_layout_list .post_list_meta_unit,
body.skin_custom_color .tp-caption .icon-btn:hover .icon_in_btn,
body.skin_custom_color .tp-caption .icon-btn:hover,
body.skin_custom_color .stm_theme_wpb_video_wrapper .stm_video_preview:after,
body.skin_custom_color .btn-carousel-control,
body.skin_custom_color .post_list_main_section_wrapper .post_list_meta_unit .post_list_comment_num,
body.skin_custom_color .post_list_main_section_wrapper .post_list_meta_unit,
body.skin_custom_color .search-toggler:hover,
body.skin_custom_color .search-toggler
',
				'color' => '
body.skin_custom_color .icon-btn:hover .icon_in_btn,
body.skin_custom_color .icon-btn:hover .link-title,
body.skin_custom_color .stats_counter .h1,
body.skin_custom_color .event_date_info .event_date_info_unit .event_labels,
body.skin_custom_color .event-col .event_archive_item .event_location i,
body.skin_custom_color .event-col .event_archive_item .event_start i,
body.skin_custom_color .gallery_terms_list li.active a,
body.skin_custom_color .blog_layout_grid .post_list_meta_unit .post_list_comment_num,
body.skin_custom_color .blog_layout_grid .post_list_meta_unit .date-m,
body.skin_custom_color .blog_layout_grid .post_list_meta_unit .date-d,
body.skin_custom_color .blog_layout_list .post_list_meta_unit .post_list_comment_num,
body.skin_custom_color .blog_layout_list .post_list_meta_unit .date-m,
body.skin_custom_color .blog_layout_list .post_list_meta_unit .date-d,
body.skin_custom_color .tp-caption .icon-btn:hover .icon_in_btn,
body.skin_custom_color .widget_pages ul.style_2 li a:hover .h6,
body.skin_custom_color .teacher_single_product_page>a:hover .title,
body.skin_custom_color .sidebar-area .widget ul li a:hover:after,
body.skin_custom_color div.pp_woocommerce .pp_gallery ul li a:hover,
body.skin_custom_color div.pp_woocommerce .pp_gallery ul li.selected a,
body.skin_custom_color .single_product_after_title .meta-unit.teacher:hover .value,
body.skin_custom_color .single_product_after_title .meta-unit i,
body.skin_custom_color .single_product_after_title .meta-unit .value a:hover,
body.skin_custom_color .woocommerce-breadcrumb a:hover,
body.skin_custom_color #footer_copyright .copyright_text a:hover,
body.skin_custom_color .widget_stm_recent_posts .widget_media .cats_w a:hover,
body.skin_custom_color .widget_pages ul.style_2 li a:hover,
body.skin_custom_color .sidebar-area .widget_categories ul li a:hover,
body.skin_custom_color .sidebar-area .widget ul li a:hover,
body.skin_custom_color .widget_categories ul li a:hover,
body.skin_custom_color .stm_product_list_widget li a:hover .title,
body.skin_custom_color .widget_contacts ul li .text a:hover,
body.skin_custom_color .sidebar-area .widget_pages ul.style_1 li a:focus .h6,
body.skin_custom_color .sidebar-area .widget_nav_menu ul.style_1 li a:focus .h6,
body.skin_custom_color .sidebar-area .widget_pages ul.style_1 li a:focus,
body.skin_custom_color .sidebar-area .widget_nav_menu ul.style_1 li a:focus,
body.skin_custom_color .sidebar-area .widget_pages ul.style_1 li a:active .h6,
body.skin_custom_color .sidebar-area .widget_nav_menu ul.style_1 li a:active .h6,
body.skin_custom_color .sidebar-area .widget_pages ul.style_1 li a:active,
body.skin_custom_color .sidebar-area .widget_nav_menu ul.style_1 li a:active,
body.skin_custom_color .sidebar-area .widget_pages ul.style_1 li a:hover .h6,
body.skin_custom_color .sidebar-area .widget_nav_menu ul.style_1 li a:hover .h6,
body.skin_custom_color .sidebar-area .widget_pages ul.style_1 li a:hover,
body.skin_custom_color .sidebar-area .widget_nav_menu ul.style_1 li a:hover,
body.skin_custom_color .widget_pages ul.style_1 li a:focus .h6,
body.skin_custom_color .widget_nav_menu ul.style_1 li a:focus .h6,
body.skin_custom_color .widget_pages ul.style_1 li a:focus,
body.skin_custom_color .widget_nav_menu ul.style_1 li a:focus,
body.skin_custom_color .widget_pages ul.style_1 li a:active .h6,
body.skin_custom_color .widget_nav_menu ul.style_1 li a:active .h6,
body.skin_custom_color .widget_pages ul.style_1 li a:active,
body.skin_custom_color .widget_nav_menu ul.style_1 li a:active,
body.skin_custom_color .widget_pages ul.style_1 li a:hover .h6,
body.skin_custom_color .widget_nav_menu ul.style_1 li a:hover .h6,
body.skin_custom_color .widget_pages ul.style_1 li a:hover,
body.skin_custom_color .widget_nav_menu ul.style_1 li a:hover,
body.skin_custom_color .see_more a:after,
body.skin_custom_color .see_more a,
body.skin_custom_color .transparent_header_off .header_main_menu_wrapper ul > li > ul.sub-menu > li a:hover,
body.skin_custom_color .stm_breadcrumbs_unit .navxtBreads > span a:hover,
body.skin_custom_color .btn-carousel-control,
body.skin_custom_color .post_list_main_section_wrapper .post_list_meta_unit .post_list_comment_num,
body.skin_custom_color .post_list_main_section_wrapper .post_list_meta_unit .date-m,
body.skin_custom_color .post_list_main_section_wrapper .post_list_meta_unit .date-d,
body.skin_custom_color .stats_counter h1,
body.skin_custom_color .yellow,
body.skin_custom_color ol li a:hover,
body.skin_custom_color ul li a:hover,
body.skin_custom_color a:hover,
body.skin_custom_color .search-toggler
',
				'border-bottom-color' => '
body.skin_custom_color .triangled_colored_separator .triangle,
body.skin_custom_color .magic_line:after
',
			)
		),
		array(
			'id'       => 'secondary_color',
			'type'     => 'color',
			'compiler' => true,
			'title'    => __( 'Secondary Color', 'stm_domain' ),
			'default'  => '#48a7d4',
			'required' => array( 'color_skin', '=', 'skin_custom_color' ),
			'output'   => array(
				'background-color' => '
body.skin_custom_color .product_status.special,
body.skin_custom_color .view_type_switcher a:hover,
body.skin_custom_color .view_type_switcher a.view_list.active_list,
body.skin_custom_color .view_type_switcher a.view_grid.active_grid,
body.skin_custom_color .stm_archive_product_inner_unit .stm_archive_product_inner_unit_centered .stm_featured_product_price .price,
body.skin_custom_color .sidebar-area .widget_text .btn,
body.skin_custom_color .stm_product_list_widget.widget_woo_stm_style_2 li a .meta .stm_featured_product_price .price,
body.skin_custom_color .widget_tag_cloud .tagcloud a:hover,
body.skin_custom_color .sidebar-area .widget ul li a:after,
body.skin_custom_color .sidebar-area .socials_widget_wrapper .widget_socials li a,
body.skin_custom_color .socials_widget_wrapper .widget_socials li a,
body.skin_custom_color .gallery_single_view .gallery_img a:after,
body.skin_custom_color .course_table tr td.stm_badge .badge_unit,
body.skin_custom_color .widget_mailchimp .stm_mailchimp_unit .button,
body.skin_custom_color .textwidget .btn:active,
body.skin_custom_color .textwidget .btn:focus,
body.skin_custom_color .form-submit .submit:active,
body.skin_custom_color .form-submit .submit:focus,
body.skin_custom_color .button:focus,
body.skin_custom_color .button:active,
body.skin_custom_color .btn-default:active,
body.skin_custom_color .btn-default:focus,
body.skin_custom_color .button:hover,
body.skin_custom_color .textwidget .btn:hover,
body.skin_custom_color .form-submit .submit,
body.skin_custom_color .button,
body.skin_custom_color .btn-default
',
				'border-color' => '
body.skin_custom_color .wpb_tabs .form-control:focus,
body.skin_custom_color .wpb_tabs .form-control:active,
body.skin_custom_color .woocommerce .cart-totals_wrap .shipping-calculator-button,
body.skin_custom_color .sidebar-area .widget_text .btn,
body.skin_custom_color .widget_tag_cloud .tagcloud a:hover,
body.skin_custom_color .icon_box.dark a:hover,
body.skin_custom_color .simple-carousel-bullets a.selected,
body.skin_custom_color .stm_sign_up_form .form-control:active,
body.skin_custom_color .stm_sign_up_form .form-control:focus,
body.skin_custom_color .form-submit .submit,
body.skin_custom_color .button,
body.skin_custom_color .btn-default
',
				'color' => '
body.skin_custom_color .icon_box .icon_text>h3>span,
body.skin_custom_color .stm_woo_archive_view_type_list .stm_featured_product_stock i,
body.skin_custom_color .stm_woo_archive_view_type_list .expert_unit_link:hover .expert,
body.skin_custom_color .stm_archive_product_inner_unit .stm_archive_product_inner_unit_centered .stm_featured_product_body a .title:hover,
body.skin_custom_color .stm_product_list_widget.widget_woo_stm_style_2 li a:hover .title,
body.skin_custom_color .widget_stm_recent_posts .widget_media a:hover .h6,
body.skin_custom_color .widget_product_search .woocommerce-product-search:after,
body.skin_custom_color .widget_search .search-form > label:after,
body.skin_custom_color .sidebar-area .widget ul li a,
body.skin_custom_color .sidebar-area .widget_categories ul li a,
body.skin_custom_color .widget_contacts ul li .text a,
body.skin_custom_color .event-col .event_archive_item > a:hover .title,
body.skin_custom_color .stm_contact_row a:hover,
body.skin_custom_color .comments-area .commentmetadata i,
body.skin_custom_color .stm_post_info .stm_post_details .comments_num .post_comments:hover,
body.skin_custom_color .stm_post_info .stm_post_details .comments_num .post_comments i,
body.skin_custom_color .stm_post_info .stm_post_details .post_meta li a:hover span,
body.skin_custom_color .stm_post_info .stm_post_details .post_meta li i,
body.skin_custom_color .blog_layout_list .post_list_item_tags .post_list_divider,
body.skin_custom_color .blog_layout_list .post_list_item_tags a,
body.skin_custom_color .blog_layout_list .post_list_cats .post_list_divider,
body.skin_custom_color .blog_layout_list .post_list_cats a,
body.skin_custom_color .blog_layout_list .post_list_item_title a:hover,
body.skin_custom_color .blog_layout_grid .post_list_item_tags .post_list_divider,
body.skin_custom_color .blog_layout_grid .post_list_item_tags a,
body.skin_custom_color .blog_layout_grid .post_list_cats .post_list_divider,
body.skin_custom_color .blog_layout_grid .post_list_cats a,
body.skin_custom_color .blog_layout_grid .post_list_item_title:focus,
body.skin_custom_color .blog_layout_grid .post_list_item_title:active,
body.skin_custom_color .blog_layout_grid .post_list_item_title:hover,
body.skin_custom_color .stm_featured_products_unit .stm_featured_product_single_unit .stm_featured_product_single_unit_centered .stm_featured_product_body a .title:hover,
body.skin_custom_color .icon_box.dark a:hover,
body.skin_custom_color .post_list_main_section_wrapper .post_list_item_tags .post_list_divider,
body.skin_custom_color .post_list_main_section_wrapper .post_list_item_tags a,
body.skin_custom_color .post_list_main_section_wrapper .post_list_cats .post_list_divider,
body.skin_custom_color .post_list_main_section_wrapper .post_list_cats a,
body.skin_custom_color .post_list_main_section_wrapper .post_list_item_title:active,
body.skin_custom_color .post_list_main_section_wrapper .post_list_item_title:focus,
body.skin_custom_color .post_list_main_section_wrapper .post_list_item_title:hover
',
			) 
		),
	)
));

Redux::setSection( $opt_name, array(
	'title'   => __( 'Sidebars', 'stm_domain' ),
	'desc'    => '',
	'icon'    => 'el-icon-website',
	'submenu' => true,
	'fields'  => array(
		array(
			'id'      => 'blog_layout',
			'type'    => 'button_set',
			'options' => array(
				'grid' => __( 'Grid view', 'stm_domain' ),
				'list' => __( 'List view', 'stm_domain' )
			),
			'default' => 'grid',
			'title'   => __( 'Blog Layout', 'stm_domain' )
		),
		array(
			'id'    => 'blog_sidebar',
			'type'  => 'select',
			'data'  => 'posts',
			'args'  => array( 'post_type' => array( 'sidebar' ), 'posts_per_page' => - 1 ),
			'title' => __( 'Blog Sidebar', 'stm_domain' ),
			'default' => '655'
		),
		array(
			'id'      => 'blog_sidebar_position',
			'type'    => 'button_set',
			'title'   => __( 'Blog Sidebar - Position', 'stm_domain' ),
			'options' => array(
				'left'  => __( 'Left', 'stm_domain' ),
				'none'  => __( 'No Sidebar', 'stm_domain' ),
				'right' => __( 'Right', 'stm_domain' )
			),
			'default' => 'right'
		),
	)
) );

Redux::setSection( $opt_name, array(
	'title'   => __( 'Teachers', 'stm_domain' ),
	'desc'    => '',
	'icon'    => 'el-icon-user',
	'subsection' => true,
	'fields'  => array(
		array(
			'id'    => 'teachers_sidebar',
			'type'  => 'select',
			'data'  => 'posts',
			'args'  => array( 'post_type' => array( 'sidebar' ), 'posts_per_page' => - 1 ),
			'title' => __( 'Teachers Sidebar', 'stm_domain' ),
		),
		array(
			'id'      => 'teachers_sidebar_position',
			'type'    => 'button_set',
			'title'   => __( 'Teachers Sidebar - Position', 'stm_domain' ),
			'options' => array(
				'left'  => __( 'Left', 'stm_domain' ),
				'none'  => __( 'No Sidebar', 'stm_domain' ),
				'right' => __( 'Right', 'stm_domain' )
			),
			'default' => 'none'
		),
	)
) );

Redux::setSection( $opt_name, array(
	'title'   => __( 'Events', 'stm_domain' ),
	'desc'    => '',
	'icon'    => 'el-icon-calendar',
	'subsection' => true,
	'fields'  => array(
		array(
			'id'    => 'events_sidebar',
			'type'  => 'select',
			'data'  => 'posts',
			'args'  => array( 'post_type' => array( 'sidebar' ), 'posts_per_page' => - 1 ),
			'title' => __( 'Events Sidebar', 'stm_domain' ),
		),
		array(
			'id'      => 'events_sidebar_position',
			'type'    => 'button_set',
			'title'   => __( 'Events Sidebar - Position', 'stm_domain' ),
			'options' => array(
				'left'  => __( 'Left', 'stm_domain' ),
				'none'  => __( 'No Sidebar', 'stm_domain' ),
				'right' => __( 'Right', 'stm_domain' )
			),
			'default' => 'none'
		),
	)
) );

Redux::setSection( $opt_name, array(
	'title'   => __( 'Gallery', 'stm_domain' ),
	'desc'    => '',
	'icon'    => 'el-icon-picture',
	'subsection' => true,
	'fields'  => array(
		array(
			'id'    => 'gallery_sidebar',
			'type'  => 'select',
			'data'  => 'posts',
			'args'  => array( 'post_type' => array( 'sidebar' ), 'posts_per_page' => - 1 ),
			'title' => __( 'Gallery Sidebar', 'stm_domain' ),
		),
		array(
			'id'      => 'gallery_sidebar_position',
			'type'    => 'button_set',
			'title'   => __( 'Gallery Sidebar - Position', 'stm_domain' ),
			'options' => array(
				'left'  => __( 'Left', 'stm_domain' ),
				'none'  => __( 'No Sidebar', 'stm_domain' ),
				'right' => __( 'Right', 'stm_domain' )
			),
			'default' => 'none'
		),
	)
) );

Redux::setSection( $opt_name, array(
	'title'   => __( 'Shop', 'stm_domain' ),
	'desc'    => '',
	'icon'    => 'el el-shopping-cart',
	'subsection' => true,
	'fields'  => array(
		array(
			'id'      => 'shop_layout',
			'type'    => 'button_set',
			'options' => array(
				'grid' => __( 'Grid view', 'stm_domain' ),
				'list' => __( 'List view', 'stm_domain' )
			),
			'default' => 'grid',
			'title'   => __( 'Shop Layout', 'stm_domain' )
		),
		array(
			'id'    => 'shop_sidebar',
			'type'  => 'select',
			'data'  => 'posts',
			'args'  => array( 'post_type' => array( 'sidebar' ), 'posts_per_page' => - 1 ),
			'title' => __( 'Sidebar', 'stm_domain' ),
			'default' => '740'
		),
		array(
			'id'      => 'shop_sidebar_position',
			'type'    => 'button_set',
			'title'   => __( 'Sidebar - Position', 'stm_domain' ),
			'options' => array(
				'left'  => __( 'Left', 'stm_domain' ),
				'right' => __( 'Right', 'stm_domain' )
			),
			'default' => 'right'
		),
	)
) );

Redux::setSection( $opt_name, array(
	'title'   => __( 'Events', 'stm_domain' ),
	'desc'    => '',
	'icon'    => 'el el-calendar',
	'submenu' => true,
	'fields'  => array(
		array(
			'id'      => 'paypal_email',
			'type'    => 'text',
			'title'   => __( 'Paypal Email', 'stm_domain' ),
		),
		array(
			'id'      => 'currency',
			'type'    => 'text',
			'title'   => __( 'Currency', 'stm_domain' ),
			'default' => __('USD', 'stm_domain'),
			'description' => __('Ex. USD', 'stm_domain'),
		),
		array(
			'id'      => 'paypal_mode',
			'type'    => 'select',
			'title'   => __( 'Paypal Mode', 'stm_domain' ),
			'options'  => array(
		        'sand' => 'SandBox',
		        'live' => 'Live',
		    ),
			'default' => 'sand',
		),
		array(
			'id'      => 'admin_subject',
			'type'    => 'text',
			'title'   => __( 'Admin Subject', 'stm_domain' ),
			'default' => __('New Participant for [event]', 'stm_domain'),
		),
		array(
			'id'      => 'admin_message',
			'type'    => 'textarea',
			'title'   => __( 'Admin Message', 'stm_domain' ),
			'default' => __('A new member wants to join your [event]<br>Participant Info:<br>Name: [name]<br>Email: [email]<br>Phone: [phone]<br>Message: [message]', 'stm_domain'),
			'description' => __('Shortcodes Available - [name], [email], [phone], [message].', 'stm_domain')
		),
		array(
			'id'      => 'user_subject',
			'type'    => 'text',
			'title'   => __( 'User Subject', 'stm_domain' ),
			'default' => __('Confirmation of your pariticipation in the [event]', 'stm_domain'),
		),
		array(
			'id'      => 'user_message',
			'type'    => 'textarea',
			'title'   => __( 'User Message', 'stm_domain' ),
			'default' => __('Dear [name].<br/> This email is sent to you to confirm your participation in the event.<br/>We will contact you soon with further details.<br>With any question, feel free to phone +999999999999 or write to <a href="mailto:timur@stylemix.net">timur@stylemix.net</a>.<br>Regards,<br>MasterStudy Team.'),
			'description' => __('Shortcodes Available - [name], [email], [phone], [message].', 'stm_domain')
		),
	)
) );

Redux::setSection( $opt_name, array(
	'title'   => __( 'Typography', 'stm_domain' ),
	'icon'    => 'el-icon-font',
	'submenu' => true,
	'fields'  => array(
		array(
			'id'             => 'font_body',
			'type'           => 'typography',
			'title'          => __( 'Body', 'stm_domain' ),
			'compiler'       => true,
			'google'         => true,
			'font-backup'    => false,
			'font-weight'    => false,
			'all_styles'     => true,
			'font-style'     => false,
			'subsets'        => true,
			'font-size'      => true,
			'line-height'    => false,
			'word-spacing'   => false,
			'letter-spacing' => false,
			'color'          => true,
			'preview'        => true,
			'output'         => array( 'body, .normal_font' ),
			'units'          => 'px',
			'subtitle'       => __( 'Select custom font for your main body text.', 'stm_domain' ),
			'default'        => array(
				'color'       => "#555555",
				'font-family' => 'Open Sans',
				'font-size'   => '14px',
			)
		),
		array(
			'id'             => 'menu_heading',
			'type'           => 'typography',
			'title'          => __( 'Menu', 'stm_domain' ),
			'compiler'       => true,
			'google'         => true,
			'font-backup'    => false,
			'all_styles'     => true,
			'font-weight'    => true,
			'font-style'     => false,
			'subsets'        => true,
			'font-size'      => false,
			'line-height'    => false,
			'word-spacing'   => false,
			'letter-spacing' => false,
			'color'          => true,
			'preview'        => true,
			'output'         => array( '.header-menu' ),
			'units'          => 'px',
			'subtitle'       => __( 'Select custom font for menu', 'stm_domain' ),
			'default'        => array(
				'color'       => "#fff",
				'font-family' => 'Montserrat',
				'font-weight' => '900',
			)
		),
		array(
			'id'             => 'font_heading',
			'type'           => 'typography',
			'title'          => __( 'Heading', 'stm_domain' ),
			'compiler'       => true,
			'google'         => true,
			'font-backup'    => false,
			'all_styles'     => true,
			'font-weight'    => false,
			'font-style'     => false,
			'subsets'        => true,
			'font-size'      => false,
			'line-height'    => false,
			'word-spacing'   => false,
			'letter-spacing' => false,
			'color'          => true,
			'preview'        => true,
			'output'         => array( 'h1,.h1,h2,.h2,h3,.h3,h4,.h4,h5,.h5,h6,.h6,.heading_font,.widget_categories ul li a,.sidebar-area .widget ul li a,.select2-selection__rendered,blockquote,.select2-chosen,.vc_tta-tabs.vc_tta-tabs-position-top .vc_tta-tabs-container .vc_tta-tabs-list li.vc_tta-tab a,.vc_tta-tabs.vc_tta-tabs-position-left .vc_tta-tabs-container .vc_tta-tabs-list li.vc_tta-tab a' ),
			'units'          => 'px',
			'subtitle'       => __( 'Select custom font for headings', 'stm_domain' ),
			'default'        => array(
				'color'       => "#333333",
				'font-family' => 'Montserrat',
			)
		),
		array(
			'id'             => 'h1_params',
			'type'           => 'typography',
			'title'          => __( 'H1', 'stm_domain' ),
			'compiler'       => true,
			'google'         => false,
			'font-backup'    => false,
			'all_styles'     => true,
			'font-weight'    => true,
			'font-family'    => false,
			'text-align'     => false,
			'font-style'     => false,
			'subsets'        => false,
			'font-size'      => true,
			'line-height'    => false,
			'word-spacing'   => false,
			'letter-spacing' => false,
			'color'          => false,
			'preview'        => true,
			'output'         => array( 'h1,.h1' ),
			'units'          => 'px',
			'default'        => array(
				'font-size' => '50px',
				'font-weight' => '700'
			)
		),
		array(
			'id'             => 'h2_params',
			'type'           => 'typography',
			'title'          => __( 'H2', 'stm_domain' ),
			'compiler'       => true,
			'google'         => false,
			'font-backup'    => false,
			'all_styles'     => true,
			'font-weight'    => true,
			'font-family'    => false,
			'text-align'     => false,
			'font-style'     => false,
			'subsets'        => false,
			'font-size'      => true,
			'line-height'    => false,
			'word-spacing'   => false,
			'letter-spacing' => false,
			'color'          => false,
			'preview'        => true,
			'output'         => array( 'h2,.h2' ),
			'units'          => 'px',
			'default'        => array(
				'font-size' => '32px',
				'font-weight' => '700'
			)
		),
		array(
			'id'             => 'h3_params',
			'type'           => 'typography',
			'title'          => __( 'H3', 'stm_domain' ),
			'compiler'       => true,
			'google'         => false,
			'font-backup'    => false,
			'all_styles'     => true,
			'font-weight'    => true,
			'font-family'    => false,
			'text-align'     => false,
			'font-style'     => false,
			'subsets'        => false,
			'font-size'      => true,
			'line-height'    => false,
			'word-spacing'   => false,
			'letter-spacing' => false,
			'color'          => false,
			'preview'        => true,
			'output'         => array( 'h3,.h3' ),
			'units'          => 'px',
			'default'        => array(
				'font-size' => '18px',
				'font-weight' => '700'
			)
		),
		array(
			'id'             => 'h4_params',
			'type'           => 'typography',
			'title'          => __( 'H4', 'stm_domain' ),
			'compiler'       => true,
			'google'         => false,
			'font-backup'    => false,
			'all_styles'     => true,
			'font-weight'    => true,
			'font-family'    => false,
			'text-align'     => false,
			'font-style'     => false,
			'subsets'        => false,
			'font-size'      => true,
			'line-height'    => false,
			'word-spacing'   => false,
			'letter-spacing' => false,
			'color'          => false,
			'preview'        => true,
			'output'         => array( 'h4,.h4,blockquote' ),
			'units'          => 'px',
			'default'        => array(
				'font-size' => '16px',
				'font-weight' => '400'
			)
		),
		array(
			'id'             => 'h5_params',
			'type'           => 'typography',
			'title'          => __( 'H5', 'stm_domain' ),
			'compiler'       => true,
			'google'         => false,
			'font-backup'    => false,
			'all_styles'     => true,
			'font-weight'    => true,
			'font-family'    => false,
			'text-align'     => false,
			'font-style'     => false,
			'subsets'        => false,
			'font-size'      => true,
			'line-height'    => false,
			'word-spacing'   => false,
			'letter-spacing' => false,
			'color'          => false,
			'preview'        => true,
			'output'         => array( 'h5,.h5,.select2-selection__rendered' ),
			'units'          => 'px',
			'default'        => array(
				'font-size' => '14px',
				'font-weight' => '700'
			)
		),
		array(
			'id'             => 'h6_params',
			'type'           => 'typography',
			'title'          => __( 'H6', 'stm_domain' ),
			'compiler'       => true,
			'google'         => false,
			'font-backup'    => false,
			'all_styles'     => true,
			'font-weight'    => true,
			'font-family'    => false,
			'text-align'     => false,
			'font-style'     => false,
			'subsets'        => false,
			'font-size'      => true,
			'line-height'    => false,
			'word-spacing'   => false,
			'letter-spacing' => false,
			'color'          => false,
			'preview'        => true,
			'output'         => array( 'h6,.h6,.widget_pages ul li a, .widget_nav_menu ul li a, .footer_menu li a,.widget_categories ul li a,.sidebar-area .widget ul li a' ),
			'units'          => 'px',
			'default'        => array(
				'font-size' => '12px',
				'font-weight' => '400'
			)
		),
	)
) );

Redux::setSection( $opt_name, array(
	'title'   => __( 'Footer', 'stm_domain' ),
	'desc'    => '',
	'icon'    => 'el-icon-photo',
	'submenu' => true,
	'fields'  => array(
		array(
			'id'      => 'footer_top',
			'type'    => 'switch',
			'title'   => __( 'Enable footer widgets area.', 'stm_domain' ),
			'default' => true,
		),
		array(
			'id'      => 'footer_top_color',
			'type'    => 'color',
			'title'   => __( 'Footer Background Color', 'stm_domain' ),
			'output'    => array('background-color' => '#footer_top'),
			'default'   => '#414b4f',
		),
		array(
			'id'       => 'footer_first_columns',
			'type'     => 'button_set',
			'title'    => __( 'Footer Columns', 'stm_domain' ),
			'desc'     => __( 'Select the number of columns to display in the footer.', 'stm_domain' ),
			'type'     => 'button_set',
			'default'  => '4',
			'required' => array( 'footer_top', '=', true, ),
			'options'  => array(
				'1' => __( '1 Column', 'stm_domain' ),
				'2' => __( '2 Columns', 'stm_domain' ),
				'3' => __( '3 Columns', 'stm_domain' ),
				'4' => __( '4 Columns', 'stm_domain' ),
			),
		),
	)
) );

Redux::setSection( $opt_name, array(
	'title'   => __( 'Footer Bottom', 'stm_domain' ),
	'desc'    => '',
	'icon'    => 'el-icon-photo',
	'subsection' => true,
	'fields'  => array(
		array(
			'id'      => 'footer_bottom',
			'type'    => 'switch',
			'title'   => __( 'Enable footer bottom widgets area.', 'stm_domain' ),
			'default' => false,
		),
		array(
			'id'      => 'footer_bottom_color',
			'type'    => 'color',
			'title'   => __( 'Footer Bottom Background Color', 'stm_domain' ),
			'output'    => array('background-color' => '#footer_bottom'),
			'default'   => '#414b4f',
		),
		array(
			'id'       => 'footer_bottom_columns',
			'type'     => 'button_set',
			'title'    => __( 'Footer Bottom Columns', 'stm_domain' ),
			'desc'     => __( 'Select the number of columns to display in the footer bottom.', 'stm_domain' ),
			'type'     => 'button_set',
			'default'  => '4',
			'required' => array( 'footer_bottom', '=', true, ),
			'options'  => array(
				'1' => __( '1 Column', 'stm_domain' ),
				'2' => __( '2 Columns', 'stm_domain' ),
				'3' => __( '3 Columns', 'stm_domain' ),
				'4' => __( '4 Columns', 'stm_domain' ),
			),
		),
	)
) );

Redux::setSection( $opt_name, array(
    'title'      => __( 'Copyright', 'stm_domain' ),
    'desc'       => __( 'Copyright block at the bottom of footer', 'stm_domain'),
    'id'         => 'footer_copyright',
    'subsection' => true,
    'fields'     => array(
	    array(
			'id'      => 'footer_copyright',
			'type'    => 'switch',
			'title'   => __( 'Enable footer copyright section.', 'stm_domain' ),
			'default' => true,
		),
		array(
			'id'      => 'footer_logo_enabled',
			'type'    => 'switch',
			'required' => array(
				array( 'footer_copyright', '=', true, ),
			),
			'title'   => __( 'Enable footer logo.', 'stm_domain' ),
			'default' => true,
		),
		array(
			'id'       => 'footer_logo',
			'url'      => false,
			'type'     => 'media',
			'title'    => __( 'Footer Logo', 'stm_domain' ),
			'required' => array(
				array( 'footer_copyright', '=', true, ),
				array( 'footer_logo_enabled', '=', true, ),
			),
			'default'  => array( 'url' => get_template_directory_uri() . '/assets/img/tmp/footer-logo2x.png' ),
			'subtitle' => __( 'Upload your logo file here. Size - 50*56 (Retina 2x). Note, bigger images will be cropped to default size', 'stm_domain' ),
		),
		array(
			'id'      => 'footer_copyright_color',
			'type'    => 'color',
			'title'   => __( 'Footer Bottom Background Color', 'stm_domain' ),
			'required' => array(
				array( 'footer_copyright', '=', true, ),
			),
			'output'    => array('background-color' => '#footer_copyright'),
			'default'   => '#414b4f',
		),
        array(
            'id'       => 'footer_copyright_text',
            'type'     => 'textarea',
            'title'    => __( 'Footer Copyright', 'stm_domain' ),
			'subtitle' => __( 'Enter the copyright text.', 'stm_domain' ),
			'required' => array(
				array( 'footer_copyright', '=', true, ),
			),
			'default'  => __( 'Copyright &copy; 2015 MasterStudy Theme by <a target="_blank" href="http://www.stylemixthemes.com/">Stylemix Themes</a>', 'stm_domain' ),
        ),
        array(
			'id'       => 'copyright_use_social',
			'type'     => 'sortable',
			'mode'     => 'checkbox',
			'title'    => __( 'Select Social Media Icons to display in copyright section', 'stm_domain' ),
			'subtitle' => __( 'The urls for your social media icons will be taken from Social Media settings tab.', 'stm_domain' ),
			'options'  => array(
				'facebook'   => 'Facebook',
				'twitter'    => 'Twitter',
				'instagram'  => 'Instagram',
				'behance'    => 'Behance',
				'dribbble'   => 'Dribbble',
				'flickr'     => 'Flickr',
				'git'        => 'Git',
				'linkedin'   => 'Linkedin',
				'pinterest'  => 'Pinterest',
				'yahoo'      => 'Yahoo',
				'delicious'  => 'Delicious',
				'dropbox'    => 'Dropbox',
				'reddit'     => 'Reddit',
				'soundcloud' => 'Soundcloud',
				'google'     => 'Google',
				'google-plus'     => 'Google +',
				'skype'      => 'Skype',
				'youtube'    => 'Youtube',
				'youtube-play' => 'Youtube Play',
				'tumblr'     => 'Tumblr',
				'whatsapp'   => 'Whatsapp',
				'telegram'   => 'Telegram',
			),
			'default'  => array(
				'facebook'   => '0',
				'twitter'    => '0',
				'instagram'  => '0',
				'behance'    => '0',
				'dribbble'   => '0',
				'flickr'     => '0',
				'git'        => '0',
				'linkedin'   => '0',
				'pinterest'  => '0',
				'yahoo'      => '0',
				'delicious'  => '0',
				'dropbox'    => '0',
				'reddit'     => '0',
				'soundcloud' => '0',
				'google'     => '0',
				'google-plus'     => '0',
				'skype'      => '0',
				'youtube'    => '0',
				'youtube-play' => '0',
				'tumblr'     => '0',
				'whatsapp'   => '0',
			),
		),
    )
) );

Redux::setSection( $opt_name, array(
	'title'   => __( 'Social Media', 'stm_domain' ),
	'icon'    => 'el-icon-address-book',
	'desc'    => __( 'Enter social media urls here and then you can enable them for footer or header. Please add full URLs including "http://".', 'stm_domain' ),
	'submenu' => true,
	'fields'  => array(
		array(
			'id'       => 'facebook',
			'type'     => 'text',
			'title'    => __( 'Facebook', 'stm_domain' ),
			'subtitle' => '',
			'default' => 'https://www.facebook.com/',
			'desc'     => __( 'Enter your Facebook URL.', 'stm_domain' ),
		),
		array(
			'id'       => 'twitter',
			'type'     => 'text',
			'title'    => __( 'Twitter', 'stm_domain' ),
			'subtitle' => '',
			'default' => 'https://www.twitter.com/',
			'desc'     => __( 'Enter your Twitter URL.', 'stm_domain' ),
		),
		array(
			'id'       => 'instagram',
			'type'     => 'text',
			'title'    => __( 'Instagram', 'stm_domain' ),
			'subtitle' => '',
			'default' => 'https://www.instagram.com/',
			'desc'     => __( 'Enter your Instagram URL.', 'stm_domain' ),
		),
		array(
			'id'       => 'behance',
			'type'     => 'text',
			'title'    => __( 'Behance', 'stm_domain' ),
			'subtitle' => '',
			'desc'     => __( 'Enter your Behance URL.', 'stm_domain' ),
		),
		array(
			'id'       => 'dribbble',
			'type'     => 'text',
			'title'    => __( 'Dribbble', 'stm_domain' ),
			'subtitle' => '',
			'desc'     => __( 'Enter your Dribbble URL.', 'stm_domain' ),
		),
		array(
			'id'       => 'flickr',
			'type'     => 'text',
			'title'    => __( 'Flickr', 'stm_domain' ),
			'subtitle' => '',
			'desc'     => __( 'Enter your Flickr URL.', 'stm_domain' ),
		),
		array(
			'id'       => 'git',
			'type'     => 'text',
			'title'    => __( 'Git', 'stm_domain' ),
			'subtitle' => '',
			'desc'     => __( 'Enter your Git URL.', 'stm_domain' ),
		),
		array(
			'id'       => 'linkedin',
			'type'     => 'text',
			'title'    => __( 'Linkedin', 'stm_domain' ),
			'subtitle' => '',
			'desc'     => __( 'Enter your Linkedin URL.', 'stm_domain' ),
		),
		array(
			'id'       => 'pinterest',
			'type'     => 'text',
			'title'    => __( 'Pinterest', 'stm_domain' ),
			'subtitle' => '',
			'desc'     => __( 'Enter your Pinterest URL.', 'stm_domain' ),
		),
		array(
			'id'       => 'yahoo',
			'type'     => 'text',
			'title'    => __( 'Yahoo', 'stm_domain' ),
			'subtitle' => '',
			'desc'     => __( 'Enter your Yahoo URL.', 'stm_domain' ),
		),
		array(
			'id'       => 'delicious',
			'type'     => 'text',
			'title'    => __( 'Delicious', 'stm_domain' ),
			'subtitle' => '',
			'desc'     => __( 'Enter your Delicious URL.', 'stm_domain' ),
		),
		array(
			'id'       => 'dropbox',
			'type'     => 'text',
			'title'    => __( 'Dropbox', 'stm_domain' ),
			'subtitle' => '',
			'desc'     => __( 'Enter your Dropbox URL.', 'stm_domain' ),
		),
		array(
			'id'       => 'reddit',
			'type'     => 'text',
			'title'    => __( 'Reddit', 'stm_domain' ),
			'subtitle' => '',
			'desc'     => __( 'Enter your Reddit URL.', 'stm_domain' ),
		),
		array(
			'id'       => 'soundcloud',
			'type'     => 'text',
			'title'    => __( 'Soundcloud', 'stm_domain' ),
			'subtitle' => '',
			'desc'     => __( 'Enter your Soundcloud URL.', 'stm_domain' ),
		),
		array(
			'id'       => 'google',
			'type'     => 'text',
			'title'    => __( 'Google', 'stm_domain' ),
			'subtitle' => '',
			'desc'     => __( 'Enter your Google URL.', 'stm_domain' ),
		),
		array(
			'id'       => 'google-plus',
			'type'     => 'text',
			'title'    => __( 'Google +', 'stm_domain' ),
			'subtitle' => '',
			'desc'     => __( 'Enter your Google + URL.', 'stm_domain' ),
		),
		array(
			'id'       => 'skype',
			'type'     => 'text',
			'title'    => __( 'Skype', 'stm_domain' ),
			'subtitle' => '',
			'desc'     => __( 'Enter your Skype URL.', 'stm_domain' ),
		),
		array(
			'id'       => 'youtube',
			'type'     => 'text',
			'title'    => __( 'Youtube', 'stm_domain' ),
			'subtitle' => '',
			'desc'     => __( 'Enter your Youtube URL.', 'stm_domain' ),
		),
		array(
			'id'       => 'youtube-play',
			'type'     => 'text',
			'title'    => __( 'Youtube Play', 'stm_domain' ),
			'subtitle' => '',
			'desc'     => __( 'Enter your Youtube Play(only icon differ) URL.', 'stm_domain' ),
		),
		array(
			'id'       => 'tumblr',
			'type'     => 'text',
			'title'    => __( 'Tumblr', 'stm_domain' ),
			'subtitle' => '',
			'desc'     => __( 'Enter your Tumblr URL.', 'stm_domain' ),
		),
		array(
			'id'       => 'whatsapp',
			'type'     => 'text',
			'title'    => __( 'Whatsapp', 'stm_domain' ),
			'subtitle' => '',
			'desc'     => __( 'Enter your Whatsapp URL.', 'stm_domain' ),
		),
		array(
			'id'       => 'telegram',
			'type'     => 'text',
			'title'    => __( 'Telegram', 'stm_domain' ),
			'subtitle' => '',
			'desc'     => __( 'Enter your Telegram URL.', 'stm_domain' ),
		),
	)
) );

Redux::setSection( $opt_name, array(
    'title'      => __( 'Social Widget', 'stm_domain' ),
    'desc'       => __( 'Choose socials for widget, and their order', 'stm_domain'),
    'id'         => 'social_widget_opt',
    'subsection' => true,
    'fields'     => array(
       array(
			'id'       => 'stm_social_widget_sort',
			'type'     => 'sortable',
			'mode'     => 'checkbox',
			'title'    => __( 'Select Social Widget Icons to display', 'stm_domain' ),
			'subtitle' => __( 'The urls for your social media icons will be taken from Social Media settings tab.', 'stm_domain' ),
			'options'  => array(
				'facebook'   => 'Facebook',
				'twitter'    => 'Twitter',
				'instagram'  => 'Instagram',
				'behance'    => 'Behance',
				'dribbble'   => 'Dribbble',
				'flickr'     => 'Flickr',
				'git'        => 'Git',
				'linkedin'   => 'Linkedin',
				'pinterest'  => 'Pinterest',
				'yahoo'      => 'Yahoo',
				'delicious'  => 'Delicious',
				'dropbox'    => 'Dropbox',
				'reddit'     => 'Reddit',
				'soundcloud' => 'Soundcloud',
				'google'     => 'Google',
				'google-plus'     => 'Google +',
				'skype'      => 'Skype',
				'youtube'    => 'Youtube',
				'youtube-play' => 'Youtube Play',
				'tumblr'     => 'Tumblr',
				'whatsapp'   => 'Whatsapp',
				'telegram'   => 'Telegram',
			),
		),
    )
) );

Redux::setSection( $opt_name, array(
	'title'   => __( 'MailChimp', 'stm_domain' ),
	'icon'    => 'el-icon-paper-clip',
	'submenu' => true,
	'fields'  => array(
		array(
			'id'       => 'mailchimp_api_key',
			'type'     => 'text',
			'title'    => __( 'Mailchimp API key', 'stm_domain' ),
			'subtitle' => __( 'Paste your MailChimp API key', 'stm_domain' ),
			'default'  => ""
		),
		array(
			'id'       => 'mailchimp_list_id',
			'type'     => 'text',
			'title'    => __( 'Mailchimp list id', 'stm_domain' ),
			'subtitle' => __( 'Paste your MailChimp List id', 'stm_domain' ),
			'default'  => ""
		)
	)
));

Redux::setSection( $opt_name, array(
	'title'   => __( 'Custom CSS', 'stm_domain' ),
	'icon'    => 'el-icon-css',
	'submenu' => true,
	'fields'  => array(
		array(
			'id'       => 'site_css',
			'type'     => 'ace_editor',
			'title'    => __( 'CSS Code', 'stm_domain' ),
			'subtitle' => __( 'Paste your custom CSS code here.', 'stm_domain' ),
			'mode'     => 'css',
			'default'  => ""
		)
	)
));

Redux::setSection( $opt_name, array(
	'icon'       => 'el-refresh',
	'icon_class' => 'el-icon-large',
	'title'      => __( 'One Click Update', 'stm_domain' ),
	'desc'       => __( 'You already receive notifications from Themeforest about our Theme Updates! Here we added an option of Updating your theme with just one button click and forget about complications! But Should you have any issues while using this option update (it might be connected with permissions issues) then you still can use the regular manual update option.', 'stm_domain' ),
	'submenu'    => true,
	'fields'     => array(
		array(
			'id'       =>'envato_username',
			'type'     => 'text',
			'title'    => __('ThemeForest Username', 'stm_domain'),
			'subtitle' => '',
			'desc'     => __('Enter here your ThemeForest (or Envato) username here (i.e. Stylemixthemes).', 'stm_domain'),
		),
		array(
			'id'       =>'envato_api',
			'type'     => 'text',
			'title'    => __('ThemeForest Secret API Key', 'stm_domain'),
			'subtitle' => '',
			'desc'     => __('Enter the secret API key you have on ThemeForest here. You can create a new one under the Settings > API Keys section of your profile.', 'stm_domain'),
		),
	)
));

/*
 * <--- END SECTIONS
 */

if ( ! function_exists( 'stm_option' ) ) {
	function stm_option( $id, $fallback = false, $key = false ) {
		global $stm_option;
		if ( $fallback == false ) {
			$fallback = '';
		}
		$output = ( isset( $stm_option[ $id ] ) && $stm_option[ $id ] !== '' ) ? $stm_option[ $id ] : $fallback;
		if ( ! empty( $stm_option[ $id ] ) && $key ) {
			$output = $stm_option[ $id ][ $key ];
		}

		return $output;
	}
}
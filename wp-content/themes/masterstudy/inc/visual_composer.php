<?php

add_action( 'vc_before_init', 'stm_vc_set_as_theme' );

function stm_vc_set_as_theme() {
	vc_set_as_theme( true );
}

if( function_exists( 'vc_set_default_editor_post_types' ) ){
	vc_set_default_editor_post_types( array( 'page', 'post', 'service', 'project', 'sidebar', 'events', 'product', 'teachers' ) );
}

if ( is_admin() ) {
	if ( ! function_exists( 'stm_vc_remove_teaser_metabox' ) ) {
		function stm_vc_remove_teaser_metabox() {
			$post_types = get_post_types( '', 'names' );
			foreach ( $post_types as $post_type ) {
				remove_meta_box( 'vc_teaser', $post_type, 'side' );
			}
		}
		add_action( 'do_meta_boxes', 'stm_vc_remove_teaser_metabox' );
	}
}

add_action( 'admin_init', 'stm_update_existing_shortcodes' );

function stm_update_existing_shortcodes(){

	if ( function_exists( 'vc_add_params' ) ) {

		vc_add_params( 'vc_gallery', array(
			array(
				'type'       => 'dropdown',
				'heading'    => __( 'Gallery type', 'stm_domain' ),
				'param_name' => 'type',
				'value'    => array(
					__( 'Image grid', 'stm_domain' ) => 'image_grid',
					__( 'Slick slider', 'stm_domain' ) => 'slick_slider',
					__( 'Slick slider 2', 'stm_domain' ) => 'slick_slider_2'
				)
			),
			array(
				'type'       => 'textfield',
				'heading'    => __( 'Thumbnail size', 'stm_domain' ),
				'param_name' => 'thumbnail_size',
				'dependency' => array(
					'element' => 'type',
					'value' => array( 'slick_slider_2' )
				),
			),
			array(
				'type'       => 'css_editor',
				'heading'    => __( 'Css', 'stm_domain' ),
				'param_name' => 'css',
				'group'      => __( 'Design options', 'stm_domain' )
			)
		));

		vc_add_params( 'vc_column_inner', array(
			array(
				'type' => 'column_offset',
				'heading' => __( 'Responsiveness', 'js_composer' ),
				'param_name' => 'offset',
				'group' => __( 'Width & Responsiveness', 'js_composer' ),
				'description' => __( 'Adjust column for different screen sizes. Control width, offset and visibility settings.', 'js_composer' )
			)
		));

		vc_add_params( 'vc_separator', array(
			array(
				'type'       => 'dropdown',
				'heading'    => __( 'Type', 'stm_domain' ),
				'param_name' => 'type',
				'value'    => array(
					__( 'Type 1', 'stm_domain' ) => 'type_1',
					__( 'Type 2', 'stm_domain' ) => 'type_2'
				)
			),
			array(
				'type'       => 'css_editor',
				'heading'    => __( 'Css', 'stm_domain' ),
				'param_name' => 'css',
				'group'      => __( 'Design options', 'stm_domain' )
			),
		) );

		vc_add_params( 'vc_video', array(
			array(
				'type' => 'textfield',
				'heading' => __( 'Iframe Link', 'stm_domain' ),
				'param_name' => 'link'
			),
			array(
				'type' => 'attach_image',
				'heading' => __( 'Preview Image', 'stm_domain' ),
				'param_name' => 'image'
			),
		) );

		vc_add_params( 'vc_wp_pages', array(
			array(
				'type'       => 'css_editor',
				'heading'    => __( 'Css', 'stm_domain' ),
				'param_name' => 'css',
				'group'      => __( 'Design options', 'stm_domain' )
			)
		) );

		vc_add_params( 'vc_basic_grid', array(
			array(
				'type' => 'dropdown',
				'heading' => __( 'Gap', 'js_composer' ),
				'param_name' => 'gap',
				'value' => array(
					__( '0px', 'js_composer' ) => '0',
					__( '1px', 'js_composer' ) => '1',
					__( '2px', 'js_composer' ) => '2',
					__( '3px', 'js_composer' ) => '3',
					__( '4px', 'js_composer' ) => '4',
					__( '5px', 'js_composer' ) => '5',
					__( '10px', 'js_composer' ) => '10',
					__( '15px', 'js_composer' ) => '15',
					__( '20px', 'js_composer' ) => '20',
					__( '25px', 'js_composer' ) => '25',
					__( '30px', 'js_composer' ) => '30',
					__( '35px', 'js_composer' ) => '35',
					__( '40px', 'js_composer' ) => '40',
					__( '45px', 'js_composer' ) => '45',
					__( '50px', 'js_composer' ) => '50',
					__( '55px', 'js_composer' ) => '55',
					__( '60px', 'js_composer' ) => '60',
				),
				'std' => '30',
				'description' => __( 'Select gap between grid elements.', 'js_composer' ),
				'edit_field_class' => 'vc_col-sm-6 vc_column',
			)
		) );

	}

	if( function_exists( 'vc_remove_param' ) ){
		vc_remove_param( 'vc_cta_button2', 'h2' );
		vc_remove_param( 'vc_cta_button2', 'content' );
		vc_remove_param( 'vc_cta_button2', 'btn_style' );
		vc_remove_param( 'vc_cta_button2', 'color' );
		vc_remove_param( 'vc_cta_button2', 'size' );
		vc_remove_param( 'vc_cta_button2', 'css_animation' );
	}

    if( function_exists( 'vc_remove_element' ) ){
        vc_remove_element( "vc_cta_button" );
        vc_remove_element( "vc_posts_slider" );
        vc_remove_element( "vc_icon" );
        vc_remove_element( "vc_pinterest" );
        vc_remove_element( "vc_googleplus" );
        vc_remove_element( "vc_facebook" );
        vc_remove_element( "vc_tweetmeme" );
    }

}

if ( function_exists( 'vc_map' ) ) {
	add_action( 'init', 'vc_stm_elements' );
}

function vc_stm_elements(){
	$order_by_values = array(
		'',
		__( 'Date', 'js_composer' ) => 'date',
		__( 'ID', 'js_composer' ) => 'ID',
		__( 'Author', 'js_composer' ) => 'author',
		__( 'Title', 'js_composer' ) => 'title',
		__( 'Modified', 'js_composer' ) => 'modified',
		__( 'Random', 'js_composer' ) => 'rand',
		__( 'Comment count', 'js_composer' ) => 'comment_count',
		__( 'Menu order', 'js_composer' ) => 'menu_order',
	);

	$order_way_values = array(
		'',
		__( 'Descending', 'js_composer' ) => 'DESC',
		__( 'Ascending', 'js_composer' ) => 'ASC',
	);
	vc_map( array(
		'name'        => __( 'STM Teachers', 'stm_domain' ),
		'base'        => 'stm_experts',
		'icon'        => 'stm_experts',
		'params'      => array(
			array(
				'type' => 'textfield',
				'holder' => 'div',
				'heading' => __( 'Section title', 'stm_domain' ),
				'param_name' => 'experts_title',
				'description' => __( "Title will be shown on the top of section", 'stm_domain' )
			),
			array(
				'type' => 'number_field',
				'holder' => 'div',
				'heading' => __( 'Number of Teachers to output', 'stm_domain' ),
				'param_name' => 'experts_max_num',
				'description' => __( "Fill field with number only", 'stm_domain' )
			),
			array(
				'type'       => 'dropdown',
				'heading'    => __( 'Style', 'stm_domain' ),
				'param_name' => 'experts_output_style',
				'value'      => array(
					'Carousel' => 'experts_carousel',
					'List' => 'experts_list'
				)
			),
			array(
				'type'       => 'dropdown',
				'heading'    => __( 'All teachers', 'stm_domain' ),
				'param_name' => 'experts_all',
				'value'      => array(
					'Show link to all Teachers' => 'yes',
					'Hide link to all Teachers' => 'no'
				)
			),
			array(
				'type' => 'dropdown',
				'holder' => 'div',
				'heading' => __( 'Number of Teachers per row', 'stm_domain' ),
				'param_name' => 'expert_slides_per_row',
				'std' => 2,
				'value'      => array(
					'1' => 1,
					'2' => 2,
				)
			),
		)
	) );
	
	vc_map( array(
		'name'        => __( 'STM Teacher Details', 'stm_domain' ),
		'base'        => 'stm_teacher_detail',
		'icon'        => 'stm_teacher_detail',
		'category'    => __( 'STM', 'stm_domain' ),
		'description' => __('Only on expert page', 'stm_domain'),
		'params'      => array(
			array(
				'type'       => 'css_editor',
				'heading'    => __( 'Css', 'stm_domain' ),
				'param_name' => 'css'
			)
		)
	) );
	
	
	vc_map( array(
		'name'        => __( 'STM Testimonials', 'stm_domain' ),
		'base'        => 'stm_testimonials',
		'icon'        => 'stm_testimonials',
		'params'      => array(
			array(
				'type' => 'textfield',
				'holder' => 'div',
				'heading' => __( 'Section title', 'stm_domain' ),
				'param_name' => 'testimonials_title',
				'description' => __( "Title will be shown on the top of section", 'stm_domain' )
			),
			array(
				'type' => 'number_field',
				'heading' => __( 'Number of testimonials to output', 'stm_domain' ),
				'param_name' => 'testimonials_max_num',
				'description' => __( "Fill field with number only", 'stm_domain' )
			),
			array(
				'type' => 'colorpicker',
				'heading' => __( 'Text Color', 'stm_domain' ),
				'param_name' => 'testimonials_text_color',
				'value' => '#aaaaaa',
			),
			array(
				'type' => 'dropdown',
				'heading' => __( 'Number of testimonials per row', 'stm_domain' ),
				'param_name' => 'testimonials_slides_per_row',
				'std' => 2,
				'value'      => array(
					'1' => 1,
					'2' => 2,
				)
			),
		)
	) );
	
	// Get post types to offer
	$post_list_data = array(
		'Post'	=> 'post',
		'Experts' => 'teachers',
		'Testimonials' => 'testimonial'
	);
	
	vc_map( array(
		'name'        => __( 'STM Post List', 'stm_domain' ),
		'base'        => 'stm_post_list',
		'icon'        => 'stm_post_list',
		'params'      => array(
			array(
				'type' => 'dropdown',
				'heading' => __( 'Post Data', 'stm_domain' ),
				'param_name' => 'post_list_data_source',
				'description' => __( "Choose post type", 'stm_domain' ),
				'value' => $post_list_data,
			),
			array(
				'type' => 'number_field',
				'heading' => __( 'Number of items to output', 'stm_domain' ),
				'param_name' => 'post_list_per_page',
				'description' => __( "Fill field with number only", 'stm_domain' )
			),
			array(
				'type' => 'dropdown',
				'heading' => __( 'Number of items to output per row', 'stm_domain' ),
				'param_name' => 'post_list_per_row',
				'value' => array(
					'1' => 1,
					'2' => 2,
					'3' => 3,
					'4' => 4,
					'6' => 6,
				),
				'std' => 3,
				'group' => __('List design', 'stm_domain'),
			),
			array(
				'type' => 'checkbox',
				'heading' => __( 'Show post date', 'stm_domain' ),
				'param_name' => 'post_list_show_date',
				'group' => __('Item design', 'stm_domain'),
			),
			array(
				'type' => 'checkbox',
				'heading' => __( 'Show post categories', 'stm_domain' ),
				'param_name' => 'post_list_show_cats',
				'group' => __('Item design', 'stm_domain'),
			),
			array(
				'type' => 'checkbox',
				'heading' => __( 'Show post tags', 'stm_domain' ),
				'param_name' => 'post_list_show_tags',
				'group' => __('Item design', 'stm_domain'),
			),
			array(
				'type' => 'checkbox',
				'heading' => __( 'Show comments tags', 'stm_domain' ),
				'param_name' => 'post_list_show_comments',
				'group' => __('Item design', 'stm_domain'),
			),
			array(
				'type'       => 'css_editor',
				'heading'    => __( 'Css', 'stm_domain' ),
				'param_name' => 'css',
				'group'      => __( 'Design options', 'stm_domain' )
			)
		)
	) );
	
	vc_map( array(
		'name'        => __( 'Icon Box', 'stm_domain' ),
		'base'        => 'stm_icon_box',
		'icon'        => 'stm_icon_box',
		'category'    => __( 'STM', 'stm_domain' ),
		'params'      => array(
			array(
				'type' => 'textfield',
				'holder' => 'div',
				'heading' => __( 'Title', 'stm_domain' ),
				'param_name' => 'title'
			),
			array(
				'type' => 'vc_link',
				'heading' => __( 'Link', 'stm_domain' ),
				'param_name' => 'link'
			),
			array(
				'type' => 'dropdown',
				'heading' => __( 'Title Holder', 'stm_domain' ),
				'param_name' => 'title_holder',
				'value' => array(
					'H1' => 'h1',
					'H2' => 'h2',
					'H3' => 'h3',
					'H4' => 'h4',
					'H5' => 'h5',
				),
				'std' => 'h3'
			),
			array(
				'type' => 'colorpicker',
				'heading' => __( 'Box background color', 'stm_domain' ),
				'param_name' => 'box_bg_color',
				'description' => 'default - green'
			),
			array(
				'type' => 'colorpicker',
				'heading' => __( 'Box text color', 'stm_domain' ),
				'param_name' => 'box_text_color',
				'description' => 'Default - white'
			),
			array(
				'type' 				=> 'dropdown',
				'heading' 			=> __( 'Link color style', 'stm_domain' ),
				'param_name' 		=> 'link_color_style',
				'value'				=> array(
					'Standart' => 'standart',
					'Dark'  => 'dark',
				),
				'description'       => __( 'Enter icon size in px', 'stm_domain' )
			),
			array(
				'type' 				=> 'iconpicker',
				'heading' 			=> __( 'Icon', 'stm_domain' ),
				'param_name' 		=> 'icon',
				'value'				=> ''
			),
			array(
				'type' 				=> 'number_field',
				'heading' 			=> __( 'Icon Size', 'stm_domain' ),
				'param_name' 		=> 'icon_size',
				'value'				=> '60',
				'description'       => __( 'Enter icon size in px', 'stm_domain' )
			),
			array(
				'type' 				=> 'dropdown',
				'heading' 			=> __( 'Icon Align', 'stm_domain' ),
				'param_name' 		=> 'icon_align',
				'value'				=> array(
					'Center' => 'center',
					'Left'  => 'left',
					'Right' => 'right'
				),
				'description'       => __( 'Enter icon size in px', 'stm_domain' )
			),
			array(
				'type' 				=> 'number_field',
				'heading' 			=> __( 'Icon Height', 'stm_domain' ),
				'param_name' 		=> 'icon_height',
				'value'				=> '65',
				'dependency' => array(
					'element' => 'icon_align',
					'value' => array( 'center' )
				),
				'description'       => __( 'Enter icon height in px', 'stm_domain' )
			),
			array(
				'type' 				=> 'number_field',
				'heading' 			=> __( 'Icon Width', 'stm_domain' ),
				'param_name' 		=> 'icon_width',
				'value'				=> '65',
				'dependency' => array(
					'element' => 'icon_align',
					'value' => array( 'left', 'right' )
				),
				'description'       => __( 'Enter icon height in px', 'stm_domain' )
			),
			array(
				'type' 				=> 'colorpicker',
				'heading' 			=> __( 'Icon Color', 'stm_domain' ),
				'param_name' 		=> 'icon_color',
				'value' 			=> '#fff',
				'description'		=> 'Default - White'
			),
			array(
				'type' => 'textarea_html',
				'heading' => __( 'Text', 'stm_domain' ),
				'param_name' => 'content'
			),
			array(
				'type'       => 'css_editor',
				'heading'    => __( 'Icon Css', 'stm_domain' ),
				'param_name' => 'css_icon',
				'group'      => __( 'Icon Design options', 'stm_domain' )
			),
			array(
				'type'       => 'css_editor',
				'heading'    => __( 'Css', 'stm_domain' ),
				'param_name' => 'css',
				'group'      => __( 'Design options', 'stm_domain' )
			)
		)
	) );
	
	vc_map( array(
		'name'        => __( 'Stats Counter', 'stm_domain' ),
		'base'        => 'stm_stats_counter',
		'icon'        => 'stm_stats_counter',
		'category'    => __( 'STM', 'stm_domain' ),
		'params'      => array(
			array(
				'type' => 'textfield',
				'holder' => 'div',
				'heading' => __( 'Title', 'stm_domain' ),
				'param_name' => 'title'
			),
			array(
				'type' 				=> 'number_field',
				'heading' 			=> __( 'Counter Value', 'stm_domain' ),
				'param_name' 		=> 'counter_value',
				'value'				=> '1000'
			),
			array(
				'type' 				=> 'textfield',
				'heading' 			=> __( 'Duration', 'stm_domain' ),
				'param_name' 		=> 'duration',
				'value'				=> '2.5'
			),
			array(
				'type' 				=> 'iconpicker',
				'heading' 			=> __( 'Icon', 'stm_domain' ),
				'param_name' 		=> 'icon',
				'value'				=> ''
			),
			array(
				'type' 				=> 'textfield',
				'heading' 			=> __( 'Icon Size', 'stm_domain' ),
				'param_name' 		=> 'icon_size',
				'value'				=> '65',
				'description'       => __( 'Enter icon size in px', 'stm_domain' )
			),
			array(
				'type' 				=> 'textfield',
				'heading' 			=> __( 'Icon Height', 'stm_domain' ),
				'param_name' 		=> 'icon_height',
				'value'				=> '90',
				'description'       => __( 'Enter icon height in px', 'stm_domain' )
			),
			array(
				'type' 				=> 'dropdown',
				'heading' 			=> __( 'Text alignment', 'stm_domain' ),
				'param_name' 		=> 'icon_text_alignment',
				'value' => array(
					'Center' => 'center',
					'Left' => 'left',
					'Right' => 'right',
				),
				'description'       => __( 'Text alignment in block', 'stm_domain' )
			),
			array(
				'type' 				=> 'colorpicker',
				'heading' 			=> __( 'Text color', 'stm_domain' ),
				'param_name' 		=> 'icon_text_color',
				'description'       => __( 'Text color(white - default)', 'stm_domain' )
			),
			array(
				'type' 				=> 'colorpicker',
				'heading' 			=> __( 'Counter text color', 'stm_domain' ),
				'param_name' 		=> 'counter_text_color',
				'description'       => __( 'Counter Text color(yellow - default)', 'stm_domain' )
			),
			array(
				'type'       => 'css_editor',
				'heading'    => __( 'Css', 'stm_domain' ),
				'param_name' => 'css',
				'group'      => __( 'Design options', 'stm_domain' )
			)
		)
	) );
	
	vc_map( array(
		'name'        => __( 'Icon Button', 'stm_domain' ),
		'base'        => 'stm_icon_button',
		'icon'        => 'stm_icon_button',
		'category'    => __( 'STM', 'stm_domain' ),
		'params'      => array(
			array(
				'type' => 'vc_link',
				'heading' => __( 'Link', 'stm_domain' ),
				'param_name' => 'link'
			),
			array(
				'type' 				=> 'textfield',
				'heading' 			=> __( 'Link tooltip (title)', 'stm_domain' ),
				'param_name' 		=> 'link_tooltip',
				'value'				=> ''
			),
			array(
				'type' 				=> 'dropdown',
				'heading' 			=> __( 'Button alignment', 'stm_domain' ),
				'param_name' 		=> 'btn_align',
				'value' 			=> array(
					'Left' => 'left',
					'Center' => 'center',
					'Right' => 'right'
				),
				'std' => 'left',
			),
			array(
				'type' 				=> 'dropdown',
				'heading' 			=> __( 'Button Size', 'stm_domain' ),
				'param_name' 		=> 'btn_size',
				'value' 			=> array(
					'Normal' => 'btn-normal-size',
					'Small' => 'btn-sm',
				),
				'std' => 'left',
			),
			array(
				'type' 				=> 'colorpicker',
				'heading' 			=> __( 'Button Text Color', 'stm_domain' ),
				'param_name' 		=> 'button_color',
				'value'				=> ''
			),
			array(
				'type' 				=> 'colorpicker',
				'heading' 			=> __( 'Button Text Color Hover', 'stm_domain' ),
				'param_name' 		=> 'button_text_color_hover',
				'value'				=> ''
			),
			array(
				'type' 				=> 'colorpicker',
				'heading' 			=> __( 'Button Background Color', 'stm_domain' ),
				'param_name' 		=> 'button_bg_color',
				'value'				=> ''
			),
			array(
				'type' 				=> 'colorpicker',
				'heading' 			=> __( 'Button Background Color Hover', 'stm_domain' ),
				'param_name' 		=> 'button_bg_color_hover',
				'value'				=> ''
			),
			array(
				'type' 				=> 'colorpicker',
				'heading' 			=> __( 'Button Border Color', 'stm_domain' ),
				'param_name' 		=> 'button_border_color',
				'value'				=> ''
			),
			array(
				'type' 				=> 'colorpicker',
				'heading' 			=> __( 'Button Border Color Hover', 'stm_domain' ),
				'param_name' 		=> 'button_border_color_hover',
				'value'				=> ''
			),
			array(
				'type' 				=> 'iconpicker',
				'heading' 			=> __( 'Icon', 'stm_domain' ),
				'param_name' 		=> 'icon',
				'value'				=> ''
			),
			array(
				'type'	 			=> 'dropdown',
				'heading'			=> 'Icon Size',
				'param_name'		=> 'icon_size',
				'value' => array(
					__( '10px', 'js_composer' ) => '10',
					__( '11px', 'js_composer' ) => '11',
					__( '12px', 'js_composer' ) => '12',
					__( '13px', 'js_composer' ) => '13',
					__( '14px', 'js_composer' ) => '14',
					__( '15px', 'js_composer' ) => '15',
					__( '16px', 'js_composer' ) => '16',
					__( '17px', 'js_composer' ) => '17',
					__( '18px', 'js_composer' ) => '18',
					__( '19px', 'js_composer' ) => '19',
					__( '20px', 'js_composer' ) => '20',
				),
				'std' => '16',
			),
			array(
				'type'       => 'css_editor',
				'heading'    => __( 'Css', 'stm_domain' ),
				'param_name' => 'css',
				'group'      => __( 'Design options', 'stm_domain' )
			)
		)
	) );
	
	vc_map( array(
		'name'        => __( 'Colored Separator', 'stm_domain' ),
		'base'        => 'stm_color_separator',
		'icon'        => 'stm_color_separator',
		'category'    => __( 'STM', 'stm_domain' ),
		'params'      => array(
			array(
				'type' => 'colorpicker',
				'heading' => __( 'Separator Color', 'stm_domain' ),
				'param_name' => 'color'
			),
			array(
				'type'       => 'css_editor',
				'heading'    => __( 'Css', 'stm_domain' ),
				'param_name' => 'css',
				'group'      => __( 'Design options', 'stm_domain' )
			)
		)
	) );
	
	if ( in_array( 'woocommerce/woocommerce.php', apply_filters( 'active_plugins', get_option( 'active_plugins' ) ) ) || ( function_exists( 'is_plugin_active_for_network' ) && is_plugin_active_for_network( 'woocommerce/woocommerce.php' ) )  ) {
		vc_map( array(
			'name'        => __( 'Product Categories', 'stm_domain' ),
			'base'        => 'stm_product_categories',
			'icon'        => 'stm_product_categories',
			'category'    => __( 'STM', 'stm_domain' ),
			'params'      => array(
				array(
					'type' => 'dropdown',
					'heading' => __( 'View type', 'stm_domain' ),
					'param_name' => 'view_type',
					'value' => array(
						'Carousel' => 'stm_vc_product_cat_carousel',
						'List' => 'stm_vc_product_cat_list',
					),
					'std' => 'stm_vc_product_cat_carousel'
				),
				array(
					'type' => 'checkbox',
					'heading' => __( 'Carousel Auto Scroll', 'stm_domain' ),
					'param_name' => 'auto',
				),
				array(
					'type' => 'number_field',
					'heading' => __( 'Number of items to output', 'stm_domain' ),
					'param_name' => 'number',
					'description' => 'Leave field empty to display all categories',
				),
				array(
					'type' => 'dropdown',
					'heading' => __( 'Number of items per row', 'stm_domain' ),
					'param_name' => 'per_row',
					'value' => array(
						'6' => 6,
						'4' => 4,
						'3' => 3,
						'2' => 2,
						'1' => 1
					),
					'std' => 6
				),
				array(
					'type' => 'colorpicker',
					'heading' => __( 'Box text Color', 'stm_domain' ),
					'param_name' => 'box_text_color',
					'group' => 'Item Options'
				),
				array(
					'type' => 'dropdown',
					'heading' => __( 'Text box Align', 'stm_domain' ),
					'param_name' => 'text_align',
					'value' => array(
						'Center' => 'center',
						'Left' => 'left',
						'Right' => 'right',
					),
					'group' => 'Item Options'
				),
				array(
					'type' => 'number_field',
					'heading' => __( 'Icon size', 'stm_domain' ),
					'param_name' => 'icon_size',
					'group' => 'Item Options',
					'value' => '60',
					'description' => 'If category has font icon chosen - size will be apllied',
				),
				array(
					'type' => 'number_field',
					'heading' => __( 'Icon height', 'stm_domain' ),
					'param_name' => 'icon_height',
					'group' => 'Item Options',
					'value' => '69',
					'description' => 'If category has font icon chosen - height will be apllied',
				),
				array(
					'type'       => 'css_editor',
					'heading'    => __( 'Css', 'stm_domain' ),
					'param_name' => 'css',
					'group'      => __( 'Design options', 'stm_domain' )
				)
			)
		) );
		
		
		$experts = array(
		    'Choose expert for course' => 'no_expert',
	    );
		
		$experts_args = array(
			'post_type'		=> 'teachers',
			'post_status' => 'publish',
			'posts_per_page'=> -1,
		);
		
		$experts_query = new WP_Query($experts_args);
		
		foreach($experts_query->posts as $expert){
			$experts[$expert->post_title] = $expert->ID;
		};
		
		$stm_product_categories = array();
		
		$all_product_categories = get_terms('product_cat', array('hide_empty'=>true));

		if(!empty($all_product_categories)){
			foreach($all_product_categories as $category) {
				$stm_product_categories[html_entity_decode($category->name)] = $category->slug;
			}
		}

		// STM product tags		// ALP adds filter by tag

		$stm_product_tags = array();

		$all_product_tags = get_terms('product_tag', array('hide_empty'=>true));

		if(!empty($all_product_tags)){
			foreach($all_product_tags as $tag) {
				$stm_product_tags[html_entity_decode($tag->name)] = $tag->slug;
			}
		}

		vc_map( array(
			'name'        => __( 'Products List (All, featured, teacher courses)', 'stm_domain' ),
			'base'        => 'stm_featured_products',
			'icon'        => 'stm_color_separator',
			'category'    => __( 'STM', 'stm_domain' ),
			'params'      => array(
				array(
					'type' => 'dropdown',
					'heading' => __( 'Meta sorting key', 'stm_domain' ),
					'param_name' => 'meta_key',
					'value' => array(
						'All' => 'all',
						'Featured' => '_featured',
						'Expert' => 'expert',
						'Category' => 'category',
						'Tag' => 'tag',
					),
					'std' => 'all'
				),
				array(
					'type' => 'dropdown',
					'heading' => __( 'Choose expert', 'stm_domain' ),
					'param_name' => 'expert_id',
					'value' => $experts,
					'std' => 'no_expert',
					'dependency' => array(
						'element' => 'meta_key',
						'value' => array( 'expert' )
					),
				),
				// Tag  Sorting // ALP filters by tag
				array(
					'type' => 'dropdown',
					'heading' => __( 'Choose tag', 'stm_domain' ),
					'param_name' => 'product_tag_id',
					'value' => $stm_product_tags,
					'std' => 'no_tag',
					'dependency' => array(
						'element' => 'meta_key',
						'value' => array( 'tag' )
					),
				),
				// Category Sorting
				array(
					'type' => 'dropdown',
					'heading' => __( 'Choose category', 'stm_domain' ),
					'param_name' => 'category_id',
					'value' => $stm_product_categories,
					'std' => 'no_category',
					'dependency' => array(
						'element' => 'meta_key',
						'value' => array( 'category' )
					),
				),
				array(
					'type' => 'dropdown',
					'heading' => __( 'View type', 'stm_domain' ),
					'param_name' => 'view_type',
					'value' => array(
						'Carousel' => 'featured_products_carousel',
						'List' => 'featured_products_list',
					),
				),
				array(
					'type' => 'checkbox',
					'heading' => __( 'Carousel Auto Scroll', 'stm_domain' ),
					'param_name' => 'auto',
				),
				array(
					'type' => 'number_field',
					'heading' => __( 'Number of items to output', 'stm_domain' ),
					'param_name' => 'per_page',
					'description' => __( 'Leave empty to display all', 'stm_domain' ),
				),
				array(
					'type' => 'dropdown',
					'heading' => __( 'Number of items per row', 'stm_domain' ),
					'param_name' => 'per_row',
					'value' => array(
						'4' => 4,
						'3' => 3,
						'2' => 2,
						'1' => 1
					),
					'std' => 4
				),
				array(
					'type' => 'dropdown',
					'heading' => __( 'Order', 'stm_domain' ),
					'param_name' => 'order',
					'value' => array(
						'Descending' => 'DESC',
						'Ascending' => 'ASC',
					),
					'std' => 'DESC'
				),
				array(
					'type' => 'dropdown',
					'heading' => __( 'Order by', 'stm_domain' ),
					'param_name' => 'orderby',
					'value' => $order_by_values,
					'std' => 'date'
				),
				array(
					'type' => 'checkbox',
					'heading' => __( 'Don\'t Show price', 'stm_domain' ),
					'param_name' => 'hide_price',
					'group' => 'Item Options'
				),
				array(
					'type' => 'checkbox',
					'heading' => __( 'Don\'t Show rating', 'stm_domain' ),
					'param_name' => 'hide_rating',
					'group' => 'Item Options'
				),
				array(
					'type' => 'checkbox',
					'heading' => __( 'Don\'t Show comments number', 'stm_domain' ),
					'param_name' => 'hide_comments',
					'group' => 'Item Options'
				),
				array(
					'type' => 'colorpicker',
					'heading' => __( 'Price Badge background color', 'stm_domain' ),
					'param_name' => 'price_bg',
					'group' => 'Item Options'
				),
				array(
					'type' => 'colorpicker',
					'heading' => __( 'Price Badge (Free) background color', 'stm_domain' ),
					'param_name' => 'free_price_bg',
					'group' => 'Item Options'
				),
				array(
					'type'       => 'css_editor',
					'heading'    => __( 'Css', 'stm_domain' ),
					'param_name' => 'css',
					'group'      => __( 'Design options', 'stm_domain' )
				)
			)
		) );
	}
	
	vc_map( array(
		'name'        => __( 'Mailchimp', 'stm_domain' ),
		'base'        => 'stm_mailchimp',
		'icon'        => 'stm_mailchimp',
		'category'    => __( 'STM', 'stm_domain' ),
		'params'      => array(
			array(
				'type' => 'textfield',
				'heading' => __( 'Title', 'stm_domain' ),
				'param_name' => 'title'
			),
			array(
				'type'       => 'css_editor',
				'heading'    => __( 'Css', 'stm_domain' ),
				'param_name' => 'css',
				'group'      => __( 'Design options', 'stm_domain' )
			)
		)
	) );
	
	vc_map( array(
		'name'        => __( 'Countdown', 'stm_domain' ),
		'base'        => 'stm_countdown',
		'icon'        => 'stm_countdown',
		'category'    => __( 'STM', 'stm_domain' ),
		'params'      => array(
			array(
				'type' => 'stm_datepicker_vc',
				'heading' => __( 'Count to date', 'stm_domain' ),
				'param_name' => 'datepicker',
				'holder' => 'div'
			),
			array(
				'type' => 'colorpicker',
				'heading' => __( 'Labels color', 'stm_domain' ),
				'param_name' => 'label_color',
			),
			array(
				'type'       => 'css_editor',
				'heading'    => __( 'Css', 'stm_domain' ),
				'param_name' => 'css',
				'group'      => __( 'Design options', 'stm_domain' )
			)
		)
	) );
	
	
	
	
	if ( in_array( 'contact-form-7/wp-contact-form-7.php', apply_filters( 'active_plugins', get_option( 'active_plugins' ) ) ) ) {
		$args = array('post_type' => 'wpcf7_contact_form', 'posts_per_page' => -1);
		$available_cf7 = array();
		if( $cf7Forms = get_posts( $args ) ){
			foreach($cf7Forms as $cf7Form){
				$available_cf7[$cf7Form->post_title] = $cf7Form->ID;
			};
		} else {
			$available_cf7['No CF7 forms found'] = 'none';
		};
		vc_map( array(
			'name'        => __( 'Sign Up Now', 'stm_domain' ),
			'base'        => 'stm_sign_up_now',
			'icon'        => 'icon-wpb-contactform7',
			'category'    => __( 'STM', 'stm_domain' ),
			'params'      => array(
				array(
					'type' => 'textfield',
					'heading' => __( 'Title', 'stm_domain' ),
					'param_name' => 'title'
				),
				array(
					'type' => 'dropdown',
					'heading' => __( 'Choose form', 'stm_domain' ),
					'param_name' => 'form',
					'value' => $available_cf7,
				),
				array(
					'type'       => 'css_editor',
					'heading'    => __( 'Css', 'stm_domain' ),
					'param_name' => 'css',
					'group'      => __( 'Design options', 'stm_domain' )
				)
			)
		) );
	}
	
	vc_map( array(
		'name'        => __( 'Post info', 'stm_domain' ),
		'base'        => 'stm_post_info',
		'icon'        => 'stm_post_info',
		'description' => __('Only on post page', 'stm_domain'),
		'category'    => __( 'STM', 'stm_domain' ),
		'params'      => array(
			array(
				'type'       => 'css_editor',
				'heading'    => __( 'Css', 'stm_domain' ),
				'param_name' => 'css'
			)
		)
	) );
	
	vc_map( array(
		'name'        => __( 'Post tags', 'stm_domain' ),
		'base'        => 'stm_post_tags',
		'icon'        => 'stm_post_tags',
		'category'    => __( 'STM', 'stm_domain' ),
		'description' => __('Only on post page', 'stm_domain'),
		'params'      => array(
			array(
				'type'       => 'css_editor',
				'heading'    => __( 'Css', 'stm_domain' ),
				'param_name' => 'css'
			)
		)
	) );
	
	vc_map( array(
		'name'        => __( 'Share', 'stm_domain' ),
		'base'        => 'stm_share',
		'category'    => __( 'STM', 'stm_domain' ),
		'params'      => array(
			array(
				'type'       => 'textfield',
				'heading'    => __( 'Title', 'stm_domain' ),
				'param_name' => 'title',
				'value'      => __( 'Share:', 'stm_domain' )
			),
			array(
				'type'       => 'textarea_raw_html',
				'heading'    => __( 'Code', 'stm_domain' ),
				'param_name' => 'code',
				'value'      => "<span class='st_facebook_large' displayText=''></span>
<span class='st_twitter_large' displayText=''></span>
<span class='st_googleplus_large' displayText=''></span>"
			),
			array(
				'type'       => 'css_editor',
				'heading'    => __( 'Css', 'stm_domain' ),
				'param_name' => 'css',
				'group' => __( 'Design options', 'stm_domain' )
			)
		)
	) );
	
	vc_map( array(
		'name'        => __( 'Multiply separator', 'stm_domain' ),
		'base'        => 'stm_multy_separator',
		'icon'        => 'stm_multy_separator',
		'category'    => __( 'STM', 'stm_domain' ),
		'params'      => array(
			array(
				'type'       => 'css_editor',
				'heading'    => __( 'Css', 'stm_domain' ),
				'param_name' => 'css'
			)
		)
	) );
	
	vc_map( array(
		'name'        => __( 'Post author', 'stm_domain' ),
		'base'        => 'stm_post_author',
		'icon'        => 'stm_post_author',
		'description' => __('Only on post page', 'stm_domain'),
		'category'    => __( 'STM', 'stm_domain' ),
		'params'      => array(
			array(
				'type'       => 'css_editor',
				'heading'    => __( 'Css', 'stm_domain' ),
				'param_name' => 'css'
			)
		)
	) );
	
	vc_map( array(
		'name'        => __( 'Post comments', 'stm_domain' ),
		'base'        => 'stm_post_comments',
		'icon'        => 'stm_post_comments',
		'description' => __('Only on post page', 'stm_domain'),
		'category'    => __( 'STM', 'stm_domain' ),
		'params'      => array(
			array(
				'type'       => 'css_editor',
				'heading'    => __( 'Css', 'stm_domain' ),
				'param_name' => 'css'
			)
		)
	) );
	
	vc_map( array(
		'name'        => __( 'Course Lessons', 'stm_domain' ),
		'base'        => 'stm_course_lessons',
		'as_parent'   => array('only' => 'stm_course_lesson'),
		'category'    => __( 'STM', 'stm_domain' ),
		'params'      => array(
			array(
				'type' => 'textfield',
				'heading' => __( 'Section Title', 'stm_domain' ),
				'param_name' => 'title',
				'holder'	=> 'div'
			),
			array(
				'type'       => 'css_editor',
				'heading'    => __( 'Css', 'stm_domain' ),
				'param_name' => 'css',
				'group'      => __( 'Design options', 'stm_domain' )
			)
		),
		'js_view' => 'VcColumnView'
	) );
	
	vc_map( array(
		'name'        => __( 'Lesson', 'stm_domain' ),
		'base'        => 'stm_course_lesson',
		'as_child' => array('only' => 'stm_course_lessons'),
		'category'    => __( 'STM', 'stm_domain' ),
		'params'      => array(
			array(
				'type' => 'textfield',
				'heading' => __( 'Lesson title', 'stm_domain' ),
				'param_name' => 'title',
				'holder'	=> 'div'
			),
			array(
				'type'	 => 'checkbox',
				'heading' => __('Private', 'stm_domain'),
				'param_name' => 'private_lesson',
			),
			array(
				'type' 				=> 'iconpicker',
				'heading' 			=> __( 'Icon', 'stm_domain' ),
				'param_name' 		=> 'icon',
				'value'				=> ''
			),
			array(
				'type'	=> 'textarea_html',
				'param_name' => 'content',
				'holder'	=> 'div',
				'group'	=> 'Tab Text'
			),
			array(
				'type' => 'dropdown',
				'heading' => __( 'Lesson badge', 'stm_domain' ),
				'param_name' => 'badge',
				'value' => array(
					'Choose Badge'	=> 'no_badge',
					'Test'		=> 'test',
					'Video'		=> 'video',
					'Exam'		=> 'exam',
					'Quiz'		=> 'quiz',
					'Lecture'   => 'lecture',
					'Seminar'	=> 'seminar',
					'Free'		=> 'free',
					'Practice'  => 'practice',
					'Exercise'  => 'exercise',
					'Activity'  => 'activity',
				),
			),
			array(
				'type' => 'textfield',
				'heading' => __( 'Preview video', 'stm_domain' ),
				'description' => __('This video will be opened in popup by clicking "Preview" button (just insert link to the video)', 'stm_domain'),
				'param_name' => 'preview_video',
			),
			array(
				'type' => 'textfield',
				'heading' => __( 'Private lesson content placeholder', 'stm_domain' ),
				'description' => __('You can change standart placeholder to your custom text', 'stm_domain'),
				'param_name' => 'private_placeholder',
			),
			array(
				'type' => 'textfield',
				'heading' => __( 'Lesson meta', 'stm_domain' ),
				'param_name' => 'meta',
				'holder'	=> 'div',
				'group' => 'Lesson meta',
			),
			array(
				'type' => 'iconpicker',
				'heading' => __( 'Lesson Icon', 'stm_domain' ),
				'param_name' => 'meta_icon',
				'group' => 'Lesson meta',
			),
		)
	) );
	
	vc_map( array(
		'name'        => __( 'Pricing Plan', 'stm_domain' ),
		'base'        => 'stm_pricing_plan',
		'icon'        => 'stm_pricing_plan',
		'category'    => __( 'STM', 'stm_domain' ),
		'params'      => array(
			array(
				'type' => 'textfield',
				'heading' => __( 'Plan title', 'stm_domain' ),
				'param_name' => 'title',
				'holder'	=> 'div'
			),
			array(
				'type' => 'colorpicker',
				'heading' => __( 'Plan Color', 'stm_domain' ),
				'param_name' => 'color',
			),
			array(
				'type' => 'textfield',
				'heading' => __( 'Plan price', 'stm_domain' ),
				'param_name' => 'price',
				'holder'	=> 'div'
			),
			array(
				'type' => 'textfield',
				'heading' => __( 'Plan payment period', 'stm_domain' ),
				'param_name' => 'period',
				'holder'	=> 'div'
			),
			array(
				'type' => 'textarea_html',
				'heading' => __( 'Plan Text', 'stm_domain' ),
				'param_name' => 'content',
				'holder'	=> 'div'
			),
			array(
				'type' => 'vc_link',
				'heading' => __( 'Plan Button', 'stm_domain' ),
				'param_name' => 'button',
			),
			array(
				'type'       => 'css_editor',
				'heading'    => __( 'Css', 'stm_domain' ),
				'param_name' => 'css',
				'group' => __('Design Options', 'stm_domain'),
			)
		)
	) );
	
	vc_map( array(
		'name'        => __( 'Contact', 'stm_domain' ),
		'base'        => 'stm_contact',
		'category'    => __( 'STM', 'stm_domain' ),
		'params'      => array(
			array(
				'type'       => 'textfield',
				'heading'    => __( 'Name', 'stm_domain' ),
				'param_name' => 'name'
			),
			array(
				'type'       => 'attach_image',
				'heading'    => __( 'Image', 'stm_domain' ),
				'param_name' => 'image'
			),
			array(
				'type' => 'textfield',
				'heading' => __( 'Image Size', 'stm_domain' ),
				'param_name' => 'image_size',
				'description' => __( 'Enter image size. Example: "thumbnail", "medium", "large", "full" or other sizes defined by current theme. Alternatively enter image size in pixels: 200x100 (Width x Height). Leave empty to use "projects_gallery" size.', 'stm_domain' )
			),
			array(
				'type'       => 'textfield',
				'heading'    => __( 'Job', 'stm_domain' ),
				'param_name' => 'job'
			),
			array(
				'type'       => 'textfield',
				'heading'    => __( 'Phone', 'stm_domain' ),
				'param_name' => 'phone'
			),
			array(
				'type'       => 'textfield',
				'heading'    => __( 'Email', 'stm_domain' ),
				'param_name' => 'email'
			),
			array(
				'type'       => 'textfield',
				'heading'    => __( 'Skype', 'stm_domain' ),
				'param_name' => 'skype'
			),
			array(
				'type'       => 'css_editor',
				'heading'    => __( 'Css', 'stm_domain' ),
				'param_name' => 'css',
				'group' => __( 'Design options', 'stm_domain' )
			)
		)
	) );
	
	vc_map( array(
		'name'        => __( 'Gallery Grid', 'stm_domain' ),
		'base'        => 'stm_gallery_grid',
		'icon'        => 'stm_gallery_grid',
		'category'    => __( 'STM', 'stm_domain' ),
		'params'      => array(
			array(
				'type'       => 'textfield',
				'heading'    => __( 'Title', 'stm_domain' ),
				'param_name' => 'title'
			),
			array(
				'type'       => 'checkbox',
				'heading'    => __( 'Masonry Mode', 'stm_domain' ),
				'param_name' => 'masonry'
			),
			array(
				'type'       => 'number_field',
				'heading'    => __( 'Gallery per page', 'stm_domain' ),
				'param_name' => 'per_page'
			),
			array(
				'type'       => 'css_editor',
				'heading'    => __( 'Css', 'stm_domain' ),
				'param_name' => 'css'
			)
		)
	) );
	
	vc_map( array(
		'name'        => __( 'Certificate', 'stm_domain' ),
		'base'        => 'stm_certificate',
		'category'    => __( 'STM', 'stm_domain' ),
		'params'      => array(
			array(
				'type'       => 'textfield',
				'heading'    => __( 'Certificate name', 'stm_domain' ),
				'param_name' => 'title'
			),
			array(
				'type'       => 'attach_image',
				'heading'    => __( 'Certificate Print', 'stm_domain' ),
				'param_name' => 'image'
			),
			array(
				'type'       => 'css_editor',
				'heading'    => __( 'Css', 'stm_domain' ),
				'param_name' => 'css'
			)
		)
	) );
	
	vc_map( array(
		'name'        => __( 'Event info', 'stm_domain' ),
		'base'        => 'stm_event_info',
		'icon'        => 'stm_event_info',
		'description' => __('Only on event page', 'stm_domain'),
		'category'    => __( 'STM', 'stm_domain' ),
		'params'      => array(
			array(
				'type'       => 'css_editor',
				'heading'    => __( 'Css', 'stm_domain' ),
				'param_name' => 'css'
			)
		)
	) );
	
	vc_map( array(
		'name'        => __( 'Teachers Grid', 'stm_domain' ),
		'base'        => 'stm_teachers_grid',
		'icon'        => 'stm_teachers_grid',
		'category'    => __( 'STM', 'stm_domain' ),
		'params'      => array(
			array(
				'type'       => 'number_field',
				'heading'    => __( 'Teacher per page', 'stm_domain' ),
				'param_name' => 'per_page',
				'default'	 => '8',
				
			),
			array(
				'type'       => 'css_editor',
				'heading'    => __( 'Css', 'stm_domain' ),
				'param_name' => 'css'
			)
		)
	) );
	
	vc_map( array(
		'name'        => __( 'Teachers Grid', 'stm_domain' ),
		'base'        => 'stm_teachers_grid',
		'icon'        => 'stm_teachers_grid',
		'category'    => __( 'STM', 'stm_domain' ),
		'params'      => array(
			array(
				'type'       => 'number_field',
				'heading'    => __( 'Teacher per page', 'stm_domain' ),
				'param_name' => 'per_page',
				'default'	 => '8',
				
			),
			array(
				'type'       => 'css_editor',
				'heading'    => __( 'Css', 'stm_domain' ),
				'param_name' => 'css'
			)
		)
	) );
	
	vc_map( array(
		'name'        => __( 'Events Grid', 'stm_domain' ),
		'base'        => 'stm_events_grid',
		'icon'        => 'stm_events_grid',
		'category'    => __( 'STM', 'stm_domain' ),
		'params'      => array(
			array(
				'type'       => 'number_field',
				'heading'    => __( 'Events per page', 'stm_domain' ),
				'param_name' => 'per_page',
				'default'	 => '8',
				
			),
			array(
				'type'       => 'css_editor',
				'heading'    => __( 'Css', 'stm_domain' ),
				'param_name' => 'css'
			)
		)
	) );
	
	$stm_sidebars_array = get_posts( array( 'post_type' => 'sidebar', 'posts_per_page' => -1 ) );
	$stm_sidebars = array( __( 'Select', 'stm_domain' ) => 0 );
	if( $stm_sidebars_array ){
		foreach( $stm_sidebars_array as $val ){
			$stm_sidebars[ get_the_title( $val ) ] = $val->ID;
		}
	}

	vc_map( array(
		'name'        => __( 'STM Sidebar', 'stm_domain' ),
		'base'        => 'stm_sidebar',
		'category'    => __( 'STM', 'stm_domain' ),
		'params'      => array(
			array(
				'type'       => 'dropdown',
				'heading'    => __( 'Code', 'stm_domain' ),
				'param_name' => 'sidebar',
				'value'      => $stm_sidebars
			),
			array(
				'type'       => 'dropdown',
				'heading'    => __( 'Sidebar position', 'stm_domain' ),
				'param_name' => 'sidebar_position',
				'value'      => array(
					'Right'  => 'right',
					'Left'   => 'left'
				)
			),
			array(
				'type'       => 'css_editor',
				'heading'    => __( 'Css', 'stm_domain' ),
				'param_name' => 'css',
				'group' => __( 'Design options', 'stm_domain' )
			)
		)
	) );

}

if ( class_exists( 'WPBakeryShortCodesContainer' ) ) {
	class WPBakeryShortCode_Stm_Course_Lessons extends WPBakeryShortCodesContainer {
	}
}

if ( class_exists( 'WPBakeryShortCode' ) ) {
	class WPBakeryShortCode_Stm_Experts extends WPBakeryShortCode {
	}
	class WPBakeryShortCode_Stm_Teacher_Detail extends WPBakeryShortCode {
	}
	class WPBakeryShortCode_Stm_Testimonials extends WPBakeryShortCode {
	}
	class WPBakeryShortCode_Stm_Post_List extends WPBakeryShortCode {
	}
	class WPBakeryShortCode_Stm_Icon_Box extends WPBakeryShortCode {
	}
	class WPBakeryShortCode_Stm_Stats_Counter extends WPBakeryShortCode {
	}
	class WPBakeryShortCode_Stm_Icon_Button extends WPBakeryShortCode {
	}
	class WPBakeryShortCode_Stm_Product_Categories extends WPBakeryShortCode {
	}
	class WPBakeryShortCode_Stm_Color_Separator extends WPBakeryShortCode {
	}
		if ( in_array( 'woocommerce/woocommerce.php', apply_filters( 'active_plugins', get_option( 'active_plugins' ) ) ) || ( function_exists( 'is_plugin_active_for_network' ) && is_plugin_active_for_network( 'woocommerce/woocommerce.php' ) )  ) {
			class WPBakeryShortCode_Stm_Featured_Products extends WPBakeryShortCode {
		}
	}
	class WPBakeryShortCode_Stm_Mailchimp extends WPBakeryShortCode {
	}
	class WPBakeryShortCode_Stm_Countdown extends WPBakeryShortCode {
	}
	if ( in_array( 'contact-form-7/wp-contact-form-7.php', apply_filters( 'active_plugins', get_option( 'active_plugins' ) ) ) ) {
		class WPBakeryShortCode_Stm_Sign_Up_Now extends WPBakeryShortCode {
		}
	}
	class WPBakeryShortCode_Stm_Post_Info extends WPBakeryShortCode {
	}
	class WPBakeryShortCode_Stm_Post_Tags extends WPBakeryShortCode {
	}
	class WPBakeryShortCode_Stm_Share extends WPBakeryShortCode {
	}
	class WPBakeryShortCode_Stm_Multy_Separator extends WPBakeryShortCode {
	}
	class WPBakeryShortCode_Stm_Post_Author extends WPBakeryShortCode {
	}
	class WPBakeryShortCode_Stm_Post_Comments extends WPBakeryShortCode {
	}
	class WPBakeryShortCode_Stm_Course_Lesson extends WPBakeryShortCode {
	}
	class WPBakeryShortCode_Stm_Pricing_Plan extends WPBakeryShortCode {
	}
	class WPBakeryShortCode_Stm_Contact extends WPBakeryShortCode {
	}
	class WPBakeryShortCode_Stm_Gallery_Grid extends WPBakeryShortCode {
	}
	class WPBakeryShortCode_Stm_Certificate extends WPBakeryShortCode {
	}
	class WPBakeryShortCode_Stm_Event_Info extends WPBakeryShortCode {
	}
	class WPBakeryShortCode_Stm_Teachers_Grid extends WPBakeryShortCode {
	}
	class WPBakeryShortCode_Stm_Events_Grid extends WPBakeryShortCode {
	}
	class WPBakeryShortCode_Stm_Sidebar extends WPBakeryShortCode {
	}
}

add_filter( 'vc_iconpicker-type-fontawesome', 'stm_construct_icons' );

function stm_construct_icons( $fonts ){
	
	$fonts['Master Study icons'] = array(
		array( "fa-icon-stm_icon_teacher" => __( "STM Teacher", 'stm_domain' ) ),
		array( "fa-icon-stm_icon_category" => __( "STM Category", 'stm_domain' ) ),
		array( "fa-icon-stm_icon_film-play" => __( "STM Film play", 'stm_domain' ) ),
		array( "fa-icon-stm_icon_clock" => __( "STM Clock", 'stm_domain' ) ),
		array( "fa-icon-stm_icon_bullhorn" => __( "STM Bullhorn", 'stm_domain' ) ),
		array( "fa-icon-stm_icon_mail-o" => __( "STM Mail-o", 'stm_domain' ) ),
		array( "fa-icon-stm_icon_phone-o" => __( "STM Phone-o", 'stm_domain' ) ),
		array( "fa-icon-stm_icon_pin-o" => __( "STM Pin-o", 'stm_domain' ) ),
		array( "fa-icon-stm_icon_skype-o" => __( "STM Skype-o", 'stm_domain' ) ),
		array( "fa-icon-stm_icon_book" => __( "STM Book", 'stm_domain' ) ),
		array( "fa-icon-stm_icon_alarm" => __( "STM Alarm", 'stm_domain' ) ),
		array( "fa-icon-stm_icon_briefcase" => __( "STM Briefcase", 'stm_domain' ) ),
		array( "fa-icon-stm_icon_diamond" => __( "STM Diamond", 'stm_domain' ) ),
		array( "fa-icon-stm_icon_earth" => __( "STM Earth", 'stm_domain' ) ),
		array( "fa-icon-stm_icon_graduation-hat" => __( "STM Graduation Hat", 'stm_domain' ) ),
		array( "fa-icon-stm_icon_license" => __( "STM License", 'stm_domain' ) ),
		array( "fa-icon-stm_icon_users" => __( "STM Users", 'stm_domain' ) ),
		array( "fa-icon-stm_icon_brain" => __( "STM Brain", 'stm_domain' ) ),
		array( "fa-icon-stm_icon_handshake" => __( "STM Handshake", 'stm_domain' ) ),
		array( "fa-icon-stm_icon_net" => __( "STM Net", 'stm_domain' ) ),
		array( "fa-icon-stm_icon_linkedin" => __( "STM LinkedIn", 'stm_domain' ) ),
		array( "fa-icon-stm_icon_pin" => __( "STM Pin", 'stm_domain' ) ),
		array( "fa-icon-stm_icon_market_research" => __( "STM Market Researches", 'stm_domain' ) ),
		array( "fa-icon-stm_icon_medal_one" => __( "STM Champion Medal", 'stm_domain' ) ),
		array( "fa-icon-stm_icon_mountain_biking" => __( "STM Bike Riding", 'stm_domain' ) ),
		array( "fa-icon-stm_icon_paint_palette" => __( "STM Paint Palette", 'stm_domain' ) ),
		array( "fa-icon-stm_icon_phone" => __( "STM Phone", 'stm_domain' ) ),
		array( "fa-icon-stm_icon_fax" => __( "STM Fax", 'stm_domain' ) ),
		array( "fa-icon-stm_icon_seo_monitoring" => __( "STM SEO monitoring", 'stm_domain' ) ),
		array( "fa-icon-stm_icon_seo_performance_up" => __( "STM SEO performance up", 'stm_domain' ) ),
		array( "fa-icon-stm_icon_user" => __( "STM User", 'stm_domain' ) ),
		array( "fa-icon-stm_icon_guitar" => __( "STM Guitar", 'stm_domain' ) ),
		array( "fa-icon-stm_icon_add_user" => __( "STM Add User", 'stm_domain' ) ),
		array( "fa-icon-stm_icon_aps" => __( "STM Adope PhotoShop", 'stm_domain' ) ),
		array( "fa-icon-stm_icon_chevron_right" => __( "STM Chevrone Right", 'stm_domain' ) ),
		array( "fa-icon-stm_icon_chevron_left" => __( "STM Chevrone Left", 'stm_domain' ) ),
		array( "fa-icon-stm_icon_viral_marketing" => __( "STM Viral Marketing", 'stm_domain' ) ),
		array( "fa-icon-stm_icon_yoga" => __( "STM Yoga", 'stm_domain' ) ),
		array( "fa-icon-stm_icon_youtube_play" => __( "STM Youtube Play", 'stm_domain' ) ),
		array( "fa-icon-stm_icon_book_black" => __( "STM Book solid", 'stm_domain' ) ),
		array( "fa-icon-stm_icon_book_stack" => __( "STM Book stack", 'stm_domain' ) ),
		array( "fa-icon-stm_icon_ecommerce_cart" => __( "STM Ecommerce cart", 'stm_domain' ) ),
		array( "fa-icon-stm_icon_certificate" => __( "STM Certificate", 'stm_domain' ) ),
		array( "fa-icon-stm_icon_climbing" => __( "STM Mountain Climbing", 'stm_domain' ) ),
		array( "fa-icon-stm_icon_comment_o" => __( "STM Comment solid", 'stm_domain' ) ),
		array( "fa-icon-stm_icon_drawing_tool_circle" => __( "STM Circle Drawer", 'stm_domain' ) ),
		array( "fa-icon-stm_icon_diploma_paper" => __( "STM Diploma Paper", 'stm_domain' ) ),
		array( "fa-icon-stm_icon_drawing_tool_point" => __( "STM Point Drawer", 'stm_domain' ) ),
		array( "fa-icon-stm_icon_dribble" => __( "STM Dribble", 'stm_domain' ) ),
		array( "fa-icon-stm_icon_doc_edit" => __( "STM Document Edit", 'stm_domain' ) ),
		array( "fa-icon-stm_icon_users_group" => __( "STM Users group", 'stm_domain' ) ),
		array( "fa-icon-stm_icon_ms_logo" => __( "STM Small logo", 'stm_domain' ) ),
	);

    return $fonts;
}

add_filter( 'vc_load_default_templates', 'vc_right_sidebar_template' );

function vc_right_sidebar_template( $data ) {
	$template               = array();
	$template['name']       = __( 'Content with Right sidebar', 'stm_domain' );
	$template['content']    = <<<CONTENT
        [vc_row full_width="" parallax="" parallax_image=""][vc_column width="3/4" el_class="vc_sidebar_position_right" offset="vc_col-lg-9 vc_col-md-9 vc_col-sm-12"][/vc_column][vc_column width="1/4" offset="vc_hidden-sm vc_hidden-xs"][vc_widget_sidebar sidebar_id="default" el_class="sidebar-area-right sidebar-area"][/vc_column][/vc_row]
CONTENT;

	array_unshift( $data, $template );
	return $data;
}

add_filter( 'vc_load_default_templates', 'vc_left_sidebar_template' );

function vc_left_sidebar_template( $data ) {
	$template               = array();
	$template['name']       = __( 'Content with left sidebar', 'stm_domain' );
	$template['content']    = <<<CONTENT
        [vc_row full_width="" parallax="" parallax_image=""][vc_column width="1/4" offset="vc_hidden-sm vc_hidden-xs"][vc_widget_sidebar sidebar_id="default" el_class="sidebar-area-left sidebar-area"][/vc_column][vc_column width="3/4" el_class="vc_sidebar_position_left" offset="vc_col-lg-9 vc_col-md-9 vc_col-sm-12"][/vc_column][/vc_row]
CONTENT;

	array_unshift( $data, $template );
	return $data;
}


// Add number field
vc_add_shortcode_param( 'number_field', 'number_field_vc_st' );
function number_field_vc_st( $settings, $value ) {
	return '<div class="stm_number_field_block">'
		.'<input type="number" name="' . esc_attr( $settings['param_name'] ) . '" class="wpb_vc_param_value wpb-textinput ' .
		esc_attr( $settings['param_name'] ) . ' ' .
		esc_attr( $settings['type'] ) . '_field" type="text" value="' . esc_attr( $value ) . '" />' .
		'</div>'; // This is html markup that will be outputted in content elements edit form
}

// Datepicker field

vc_add_shortcode_param( 'stm_datepicker_vc', 'stm_datepicker_vc_st', get_template_directory_uri().'/inc/vc_extend/jquery.stmdatetimepicker.js' );
function stm_datepicker_vc_st( $settings, $value ) {
	return '<div class="stm_datepicker_vc_field">'
		.'<input type="text" name="' . esc_attr( $settings['param_name'] ) . '" class="stm_datepicker_vc wpb_vc_param_value wpb-textinput ' .
		esc_attr( $settings['param_name'] ) . ' ' .
		esc_attr( $settings['type'] ) . '_field" type="text" value="' . esc_attr( $value ) . '" />' .
		'</div>';
}
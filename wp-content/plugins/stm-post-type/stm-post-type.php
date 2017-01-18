<?php
/*
Plugin Name: STM Post Type
Plugin URI: http://stylemixthemes.com/
Description: STM Post Type
Author: Stylemix Themes
Author URI: http://stylemixthemes.com/
Text Domain: stm_post_type
Version: 1.3
*/

define( 'STM_POST_TYPE', 'stm_post_type' );

$plugin_path = dirname(__FILE__);

require_once $plugin_path . '/post_type.class.php';


if(!is_textdomain_loaded('stm_post_type'))
{
	load_plugin_textdomain('stm_post_type', false, 'stm-post-type/languages');
}

$options = get_option('stm_post_types_options');

$defaultPostTypesOptions = array(
	/*
'testimonial' => array(
		'title' => __( 'Testimonial', STM_POST_TYPE ),
		'plural_title' => __( 'Testimonials', STM_POST_TYPE ),
		'rewrite' => 'testimonial'
	),
	'sidebar' => array(
		'title' => __( 'Sidebar', STM_POST_TYPE ),
		'plural_title' => __( 'Sidebars', STM_POST_TYPE ),
		'rewrite' => 'sidebar'
	),
*/
	'teachers' => array(
		'title' => __( 'Teachers', STM_POST_TYPE ),
		'plural_title' => __( 'Teachers', STM_POST_TYPE ),
		'rewrite' => 'teachers'
	),
	'gallery' => array(
		'title' => __( 'Gallery', STM_POST_TYPE ),
		'plural_title' => __( 'Galleries', STM_POST_TYPE ),
		'rewrite' => 'gallery'
	),
	'events' => array(
		'title' => __( 'Events', STM_POST_TYPE ),
		'plural_title' => __( 'Events', STM_POST_TYPE ),
		'rewrite' => 'events'
	),
);

$stm_post_types_options = wp_parse_args( $options, $defaultPostTypesOptions );

STM_PostType::registerPostType( 'testimonial', __( 'Testimonial', STM_POST_TYPE ), 
	array(  
		'menu_icon' => 'dashicons-testimonial',
		'supports' => array( 'title', 'excerpt', 'thumbnail' ), 
		'exclude_from_search' => true, 
		'publicly_queryable' => false 
	)
);

STM_PostType::registerPostType( 'sidebar', __('Sidebar', STM_POST_TYPE), 
	array( 
		'menu_icon' => 'dashicons-schedule',
		'supports' => array( 'title', 'editor' ), 
		'exclude_from_search' => true, 
		'publicly_queryable' => false 
	) 
);

// Teachers post type
STM_PostType::registerPostType( 'teachers', $stm_post_types_options['teachers']['title'], 
	array( 
		'pluralTitle' => $stm_post_types_options['teachers']['plural_title'], 
		'menu_icon' => 'dashicons-awards', 
		'supports' => array( 'title', 'editor', 'thumbnail', 'comments', 'excerpt' ) ,
		'rewrite' => array( 'slug' => $stm_post_types_options['teachers']['rewrite'] ),
	) 
);

// Gallery
STM_PostType::registerPostType( 'gallery', $stm_post_types_options['gallery']['title'], 
	array( 
		'menu_icon' => 'dashicons-images-alt',
		'pluralTitle' => $stm_post_types_options['gallery']['plural_title'], 
		'supports' => array( 'title', 'thumbnail' ),
		'rewrite' => array( 'slug' => $stm_post_types_options['gallery']['rewrite'] ),
	) 
);

STM_PostType::addTaxonomy( 'gallery_category', __( 'Categories', STM_POST_TYPE ), 'gallery' );

// Events
STM_PostType::registerPostType( 'events', $stm_post_types_options['events']['plural_title'], 
	array( 
		'menu_icon' => 'dashicons-calendar-alt',
		'pluralTitle' => $stm_post_types_options['events']['plural_title'], 
		'taxonomies' => array('post_tag'), 
		'supports' => array( 'title', 'thumbnail', 'editor', 'excerpt', 'revisions' ),
		'rewrite' => array( 'slug' => $stm_post_types_options['events']['rewrite'] ),
	) 
);
STM_PostType::registerPostType( 'event_participant', __( 'Participant', STM_POST_TYPE ), array( 'supports' => array( 'title', 'excerpt' ), 'exclude_from_search' => true, 'publicly_queryable' => false, 'show_in_menu' => 'edit.php?post_type=events' ) );


// Get experts and list them in dropdown woo products
add_action( 'admin_init', 'expert_list' );

function expert_list() {
	if ( in_array( 'woocommerce/woocommerce.php', apply_filters( 'active_plugins', get_option( 'active_plugins' ) ) ) ) {
	    $experts = array(
		    'no_expert' => 'Choose teacher for course',
	    );
		
		$experts_args = array(
			'post_type'		=> 'teachers',
			'post_status' => 'publish',
			'posts_per_page'=> -1,
		);
		
		$experts_query = new WP_Query($experts_args);
		
		foreach($experts_query->posts as $expert){
			$experts[$expert->ID] = $expert->post_title;
		}
		
		if(!empty($experts)) {
		
			STM_PostType::addMetaBox( 'stm_woo_product_expert', __( 'Course Teacher', STM_POST_TYPE ), array( 'product' ), '', '', '', 
				array(
					'fields' => array(
						'course_expert'   => array(
							'label' => __( 'Teacher', STM_POST_TYPE ),
							'type'  => 'multi-select',
							'options' => $experts,
							'description' => 'Choose Teacher for course'
						),
					)
				)
			);
		}
		
		STM_PostType::addMetaBox( 'stm_woo_product_status', __( 'Course Details', STM_POST_TYPE ), array( 'product' ), '', '', '', 
			array(
				'fields' => array(
					'course_status'   => array(
						'label' => __( 'Status', STM_POST_TYPE ),
						'type'  => 'select',
						'options' => array(
							'no_status' => 'No Status',
							'hot'		=> 'Hot',
							'special'	=> 'Special',
							'new' 		=> 'New',
						),
					),
					'duration' => array(
						'label'   => __( 'Duration', STM_POST_TYPE ),
						'type'    => 'text'
					),
					'lectures' => array(
						'label'   => __( 'Lectures', STM_POST_TYPE ),
						'type'    => 'text'
					),
					'video' => array(
						'label'   => __( 'Video', STM_POST_TYPE ),
						'type'    => 'text'
					),
					'certificate' => array(
						'label'   => __( 'Certificate', STM_POST_TYPE ),
						'type'    => 'text'
					),
				)
			)
		);
		
		STM_PostType::addMetaBox( 'stm_woo_product_button_link', __( 'Course Link', STM_POST_TYPE ), array( 'product' ), '', '', '', 
			array(
				'fields' => array(
					'woo_course_url' => array(
						'label'   => __( 'URL', STM_POST_TYPE ),
						'type'    => 'text'
					),
					'woo_course_label' => array(
						'label' => __('Button text', STM_POST_TYPE),
						'type'  => 'text'
					)
				)
			)
		);
		
		
	}
}


STM_PostType::addMetaBox( 'page_options', __( 'Page Options', STM_POST_TYPE ), array( 'page', 'post', 'service', 'project', 'product', 'teachers', 'gallery', 'events' ), '', '', '', array(
	'fields' => array(
		'transparent_header' => array(
			'label'   => __( 'Transparent Header', STM_POST_TYPE ),
			'type'    => 'checkbox'
		),
		/*
'separator_page_background' => array(
			'label'   => __( 'Page Background', STM_POST_TYPE ),
			'type'    => 'separator'
		),
		'page_bg_image' => array(
			'label' => __( 'Background Image', STM_POST_TYPE ),
			'type'  => 'image'
		),
		'page_bg_position' => array(
			'label'   => __( 'Background Position', STM_POST_TYPE ),
			'type'    => 'text'
		),
		'page_bg_repeat' => array(
			'label'   => __( 'Background Repeat', STM_POST_TYPE ),
			'type'    => 'select',
			'options' => array(
				'repeat' => __( 'Repeat', STM_POST_TYPE ),
				'no-repeat' => __( 'No Repeat', STM_POST_TYPE ),
				'repeat-x' => __( 'Repeat-X', STM_POST_TYPE ),
				'repeat-y' => __( 'Repeat-Y', STM_POST_TYPE )
			)
		),
*/
		'separator_title_box' => array(
			'label'   => __( 'Title Box', STM_POST_TYPE ),
			'type'    => 'separator'
		),
		'title' => array(
			'label'   => __( 'Title', STM_POST_TYPE ),
			'type'    => 'select',
			'options' => array(
				'show' => __( 'Show', STM_POST_TYPE ),
				'hide' => __( 'Hide', STM_POST_TYPE )
			)
		),
		'sub_title' => array(
			'label'   => __( 'Sub Title', STM_POST_TYPE ),
			'type'    => 'text'
		),
		'title_box_bg_color' => array(
			'label' => __( 'Background Color', STM_POST_TYPE ),
			'type'  => 'color_picker'
		),
		'title_box_font_color' => array(
			'label' => __( 'Font Color', STM_POST_TYPE ),
			'type'  => 'color_picker'
		),
		'title_box_line_color' => array(
			'label' => __( 'Line Color', STM_POST_TYPE ),
			'type'  => 'color_picker'
		),
		'title_box_subtitle_font_color' => array(
			'label' => __( 'Sub Title Font Color', STM_POST_TYPE ),
			'type'  => 'color_picker'
		),
		'title_box_custom_bg_image' => array(
			'label' => __( 'Custom Background Image', STM_POST_TYPE ),
			'type'  => 'image'
		),
		'title_box_bg_position' => array(
			'label'   => __( 'Background Position', STM_POST_TYPE ),
			'type'    => 'text'
		),
		'title_box_bg_repeat' => array(
			'label'   => __( 'Background Repeat', STM_POST_TYPE ),
			'type'    => 'select',
			'options' => array(
				'repeat' => __( 'Repeat', STM_POST_TYPE ),
				'no-repeat' => __( 'No Repeat', STM_POST_TYPE ),
				'repeat-x' => __( 'Repeat-X', STM_POST_TYPE ),
				'repeat-y' => __( 'Repeat-Y', STM_POST_TYPE )
			)
		),
		'title_box_overlay' => array(
			'label'   => __( 'Overlay', STM_POST_TYPE ),
			'type'    => 'checkbox'
		),
		'title_box_small' => array(
			'label'   => __( 'Small', STM_POST_TYPE ),
			'type'    => 'checkbox'
		),
		'separator_breadcrumbs' => array(
			'label'   => __( 'Breadcrumbs', STM_POST_TYPE ),
			'type'    => 'separator'
		),
		'breadcrumbs' => array(
			'label'   => __( 'Breadcrumbs', STM_POST_TYPE ),
			'type'    => 'select',
			'options' => array(
				'show' => __( 'Show', STM_POST_TYPE ),
				'hide' => __( 'Hide', STM_POST_TYPE )
			)
		),
		'breadcrumbs_font_color' => array(
			'label' => __( 'Breadcrumbs Color', STM_POST_TYPE ),
			'type'  => 'color_picker'
		),
		/*
'separator_title_box_button' => array(
			'label'   => __( 'Title Box Button', STM_POST_TYPE ),
			'type'    => 'separator'
		),
		'title_box_button_text' => array(
			'label'   => __( 'Button Text', STM_POST_TYPE ),
			'type'    => 'text'
		),
		'title_box_button_url' => array(
			'label'   => __( 'Button URL', STM_POST_TYPE ),
			'type'    => 'text'
		),
		'title_box_button_border_color' => array(
			'label' => __( 'Border Color', STM_POST_TYPE ),
			'type'  => 'color_picker',
			'default' => '#ffffff'
		),
		'title_box_button_font_color' => array(
			'label' => __( 'Font Color', STM_POST_TYPE ),
			'type'  => 'color_picker',
			'default' => '#333333'
		),
		'title_box_button_font_color_hover' => array(
			'label' => __( 'Font Color (hover)', STM_POST_TYPE ),
			'type'  => 'color_picker',
			'default' => '#333333'
		),
		'title_box_button_font_arrow_color' => array(
			'label' => __( 'Arrow Color', STM_POST_TYPE ),
			'type'  => 'color_picker',
			'default' => '#ffffff'
		),
*/
		/*
'prev_next_buttons_title_box' => array(
			'label'   => __( 'Prev/Next Buttons', STM_POST_TYPE ),
			'type'    => 'separator'
		),
		'prev_next_buttons' => array(
			'label'   => __( 'Enable', STM_POST_TYPE ),
			'type'    => 'checkbox'
		),
		'prev_next_buttons_border_color' => array(
			'label' => __( 'Border Color', STM_POST_TYPE ),
			'type'  => 'color_picker',
			'default' => '#ffffff'
		),
		'prev_next_buttons_arrow_color_hover' => array(
			'label' => __( 'Arrow Color (hover)', STM_POST_TYPE ),
			'type'  => 'color_picker',
			'default' => '#dac725'
		),
*/
	)
) );

STM_PostType::addMetaBox( 'testimonial_info', __( 'Testimonial Info', STM_POST_TYPE ), array( 'testimonial' ), '', '', '', array(
	'fields' => array(
		'testimonial_profession'   => array(
			'label' => __( 'Profession', STM_POST_TYPE ),
			'type'  => 'text'
		)
	)
) );

STM_PostType::addMetaBox( 'expert_info', __( 'Expert Info', STM_POST_TYPE ), array( 'teachers' ), '', '', '', array(
	'fields' => array(
		'expert_sphere'   => array(
			'label' => __( 'Teacher Sphere', STM_POST_TYPE ),
			'type'  => 'text'
		),
		'expert_certified'   => array(
			'label' => __( 'Teacher Certified By', STM_POST_TYPE ),
			'type'  => 'text'
		),
	)
) );

STM_PostType::addMetaBox( 'expert_socials', __( 'Expert Socials', STM_POST_TYPE ), array( 'teachers' ), '', '', '', array(
	'fields' => array(
		'facebook'   => array(
			'label' => __( 'Facebook', STM_POST_TYPE ),
			'type'  => 'text'
		),
		'twitter'   => array(
			'label' => __( 'Twitter', STM_POST_TYPE ),
			'type'  => 'text'
		),
		'google-plus'   => array(
			'label' => __( 'Google +', STM_POST_TYPE ),
			'type'  => 'text'
		),
		'linkedin'   => array(
			'label' => __( 'LinkedIn', STM_POST_TYPE ),
			'type'  => 'text'
		),
		'youtube-play'   => array(
			'label' => __( 'Youtube', STM_POST_TYPE ),
			'type'  => 'text'
		),
	)
) );

STM_PostType::addMetaBox( 'event_info', __( 'Event Info', STM_POST_TYPE ), array( 'events' ), '', '', '', array(
	'fields' => array(
		'event_start'   => array(
			'label' => __( 'Event Start', STM_POST_TYPE ),
			'type'  => 'date_picker'
		),
		'event_end'   => array(
			'label' => __( 'Event End', STM_POST_TYPE ),
			'type'  => 'date_picker'
		),
		'event_location'   => array(
			'label' => __( 'Event Location', STM_POST_TYPE ),
			'type'  => 'text'
		),
		'event_price'   => array(
			'label' => __( 'Event Price', STM_POST_TYPE ),
			'type'  => 'text'
		)
	)
) );

STM_PostType::addMetaBox( 'participant_info', __( 'Participant Info', STM_POST_TYPE ), array( 'event_participant' ), '', '', '', array(
	'fields' => array(
		'participant_email'   => array(
			'label' => __( 'Email', STM_POST_TYPE ),
			'type'  => 'text'
		),
		'participant_phone'   => array(
			'label' => __( 'Phone', STM_POST_TYPE ),
			'type'  => 'text'
		),
		'participant_event'   => array(
			'label' => __( 'Event ID', STM_POST_TYPE ),
			'type'  => 'text'
		)
	)
) );

function stm_plugin_styles() {
    $plugin_url =  plugins_url('', __FILE__);

    wp_enqueue_style( 'admin-styles', $plugin_url . '/assets/css/admin.css', null, null, 'all' );

    wp_enqueue_style( 'wp-color-picker' );
    wp_enqueue_script( 'wp-color-picker');

    wp_enqueue_style( 'stmcss-datetimepicker', $plugin_url . '/assets/css/jquery.stmdatetimepicker.css', null, null, 'all' );
    wp_enqueue_script( 'stmjs-datetimepicker', $plugin_url . '/assets/js/jquery.stmdatetimepicker.js', array( 'jquery' ), null, true );

    wp_enqueue_media();
}

add_action( 'admin_enqueue_scripts', 'stm_plugin_styles' );

// STM Post Type Rewrite subplugin
add_action( 'admin_menu', 'stm_register_post_types_options_menu' );

if( ! function_exists( 'stm_register_post_types_options_menu' ) ){
	function stm_register_post_types_options_menu(){
		add_submenu_page( 'tools.php', __('STM Post Types', STM_POST_TYPE), __('STM Post Types', STM_POST_TYPE), 'manage_options', 'stm_post_types', 'stm_post_types_options' );
	}
}

if( ! function_exists( 'stm_post_types_options' ) ){
	function stm_post_types_options(){

		if ( ! empty( $_POST['stm_post_types_options'] ) ) {
			update_option( 'stm_post_types_options', $_POST['stm_post_types_options'] );
		}

		$options = get_option('stm_post_types_options');

		$defaultPostTypesOptions = array(
			/*
'testimonial' => array(
				'title' => __( 'Testimonial', STM_POST_TYPE ),
				'plural_title' => __( 'Testimonials', STM_POST_TYPE ),
				'rewrite' => 'testimonial'
			),
			'sidebar' => array(
				'title' => __( 'Sidebar', STM_POST_TYPE ),
				'plural_title' => __( 'Sidebars', STM_POST_TYPE ),
				'rewrite' => 'sidebar'
			),
*/
			'teachers' => array(
				'title' => __( 'Teachers', STM_POST_TYPE ),
				'plural_title' => __( 'Teachers', STM_POST_TYPE ),
				'rewrite' => 'teachers'
			),
			'gallery' => array(
				'title' => __( 'Gallery', STM_POST_TYPE ),
				'plural_title' => __( 'Galleries', STM_POST_TYPE ),
				'rewrite' => 'gallery'
			),
			'events' => array(
				'title' => __( 'Events', STM_POST_TYPE ),
				'plural_title' => __( 'Events', STM_POST_TYPE ),
				'rewrite' => 'events'
			),
		);

		$options = wp_parse_args( $options, $defaultPostTypesOptions );
		
		$content = '';

		$content .= '
			<div class="wrap">
		        <h2>' . __( 'Custom Post Type Renaming Settings', STM_POST_TYPE ) . '</h2>

		        <form method="POST" action="">
		            <table class="form-table">';
						foreach ($defaultPostTypesOptions as $key => $value){
							$content .= '
								<tr valign="top">
									<th scope="row">
										<label for="'.$key.'_title">' . __( '"'.$value['title'].'" title (admin panel tab name)', STM_POST_TYPE ) . '</label>
									</th>
									<td>
				                        <input type="text" id="'.$key.'_title" name="stm_post_types_options['.$key.'][title]" value="' . $options[$key]['title'] . '"  size="25" />
				                    </td>
								</tr>
								<tr valign="top">
				                    <th scope="row">
				                        <label for="'.$key.'_plural_title">' . __( '"'.$value['plural_title'].'" plural title', STM_POST_TYPE ) . '</label>
				                    </th>
				                    <td>
				                        <input type="text" id="'.$key.'_plural_title" name="stm_post_types_options['.$key.'][plural_title]" value="' . $options[$key]['plural_title'] . '"  size="25" />
				                    </td>
				                </tr>
				                <tr valign="top">
				                    <th scope="row">
				                        <label for="'.$key.'_rewrite">' . __( '"'.$value['plural_title'].'" rewrite (URL text)', STM_POST_TYPE ) . '</label>
				                    </th>
				                    <td>
				                        <input type="text" id="'.$key.'_rewrite" name="stm_post_types_options['.$key.'][rewrite]" value="' . $options[$key]['rewrite'] . '"  size="25" />
				                    </td>
				                </tr>
				                <tr valign="top"><th scope="row"></th></tr>
			                ';
						}
		 $content .='</table>
		            <p>' . __( "NOTE: After you change the rewrite field values, you'll need to refresh permalinks under Settings -> Permalinks", STM_POST_TYPE ) . '</p>
		            <br/>
		            <p>
						<input type="submit" value="' . __( 'Save settings', STM_POST_TYPE ) . '" class="button-primary"/>
					</p>
		        </form>
		    </div>
		';
		
		echo $content;
	}
}
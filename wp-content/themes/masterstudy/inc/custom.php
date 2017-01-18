<?php
// Add svg support
function stm_svg_mime($mimes) {
	$mimes['ico'] = 'image/icon';
	return $mimes;
}

add_filter('upload_mimes', 'stm_svg_mime');


// Comments
if(!function_exists('stm_comment')) {
	function stm_comment($comment, $args, $depth) {
		$GLOBALS['comment'] = $comment;
		extract($args, EXTR_SKIP);
	
		if ( 'div' == $args['style'] ) {
			$tag = 'div';
			$add_below = 'comment';
		} else {
			$tag = 'li';
			$add_below = 'div-comment';
		}
		?>
		<<?php echo $tag ?> <?php comment_class( empty( $args['has_children'] ) ? '' : 'parent' ) ?> id="comment-<?php comment_ID() ?>">
		<?php if ( 'div' != $args['style'] ) { ?>
			<div id="div-comment-<?php comment_ID() ?>" class="comment-body clearfix">
		<?php } ?>
		<?php if ( $args['avatar_size'] != 0 ) { ?>
			<div class="vcard">
				<?php echo get_avatar( $comment, 75 ); ?>
			</div>
		<?php } ?>
		<div class="comment-info clearfix">
			<div class="comment-author pull-left"><span class="h4"><?php echo get_comment_author_link(); ?></span></div>
			<div class="comment-meta commentmetadata pull-right">
				<a href="<?php echo htmlspecialchars( get_comment_link( $comment->comment_ID ) ); ?>">
					<?php printf( __( '%1$s at %2$s', 'stm_domain' ), get_comment_date(),  get_comment_time() ); ?>
				</a>
				<span class="h6"><?php comment_reply_link( array_merge( $args, array( 'reply_text' => __( '<span class="vertical_divider"></span>Reply <i class="fa fa-reply"></i>', 'stm_domain' ), 'add_below' => $add_below, 'depth' => $depth, 'max_depth' => $args['max_depth'] ) ) ); ?></span>
				<span class="h6"><?php edit_comment_link( __( '<span class="vertical_divider"></span>Edit <i class="fa fa-pencil-square-o"></i>', 'stm_domain' ), '  ', '' ); ?></span>
			</div>
			<?php if ( $comment->comment_approved == '0' ) { ?>
				<em class="comment-awaiting-moderation"><?php _e( 'Your comment is awaiting moderation.', 'stm_domain' ); ?></em>
			<?php } ?>
		</div>
		<div class="comment-text">
			<?php comment_text(); ?>
		</div>
	
		<?php if ( 'div' != $args['style'] ) { ?>
			</div>
		<?php } ?>
	<?php
	}
}

add_filter( 'comment_form_default_fields', 'bootstrap3_comment_form_fields' );

if(!function_exists('bootstrap3_comment_form_fields')){
	function bootstrap3_comment_form_fields( $fields ) {
		$commenter = wp_get_current_commenter();
		$req       = get_option( 'require_name_email' );
		$aria_req  = ( $req ? " aria-required='true'" : '' );
		$html5     = current_theme_supports( 'html5', 'comment-form' ) ? 1 : 0;
		$fields    = array(
			'author' => '<div class="row">
							<div class="col-xs-12 col-sm-6 col-md-6 col-lg-6">
								<div class="form-group comment-form-author">
			            			<input placeholder="' . __( 'Name', 'stm_domain' ) . ( $req ? ' *' : '' ) . '" class="form-control" name="author" type="text" value="' . esc_attr( $commenter['comment_author'] ) . '" size="30"' . $aria_req . ' />
		                        </div>
		                    </div>',
			'email'  => '<div class="col-xs-12 col-sm-6 col-md-6 col-lg-6">
							<div class="form-group comment-form-email">
								<input placeholder="' . __( 'E-mail', 'stm_domain' ) . ( $req ? ' *' : '' ) . '" class="form-control" name="email" ' . ( $html5 ? 'type="email"' : 'type="text"' ) . ' value="' . esc_attr( $commenter['comment_author_email'] ) . '" size="30"' . $aria_req . ' />
							</div>
						</div>',
			'url'    => '</div>'
		);
	
		return $fields;
	}
}

add_filter( 'comment_form_defaults', 'bootstrap3_comment_form' );

if(!function_exists('bootstrap3_comment_form')){
	function bootstrap3_comment_form( $args ) {
		$args['comment_field'] = '<div class="form-group comment-form-comment">
							        <textarea placeholder="' . _x( 'Message', 'noun', 'stm_domain' ) . ' *" class="form-control" name="comment" rows="9" aria-required="true"></textarea>
								  </div>';
	
		return $args;
	}
}

// Remove redux demo
function removeDemoModeLink() {
    if ( class_exists('ReduxFrameworkPlugin') ) {
        remove_filter( 'plugin_row_meta', array( ReduxFrameworkPlugin::get_instance(), 'plugin_metalinks'), null, 2 );
    }
    if ( class_exists('ReduxFrameworkPlugin') ) {
        remove_action('admin_notices', array( ReduxFrameworkPlugin::get_instance(), 'admin_notices' ) );    
    }
}
add_action('init', 'removeDemoModeLink');

function function_stm_subscribe() {

	$json = array();
	$email = urldecode(filter_input(INPUT_POST, 'email', FILTER_SANITIZE_EMAIL));

	if(!filter_var($email, FILTER_VALIDATE_EMAIL)){
		$json['error'] = __('Enter a valid email', 'stm_domain');
		echo json_encode($json);
		exit;
	}else{
		require_once("lib/mailchimp/Handling.class.php");
		Handling::handling_request_with_confirmation($email, NULL);
	}
}

add_action('wp_ajax_stm_subscribe', 'function_stm_subscribe');
add_action('wp_ajax_nopriv_stm_subscribe', 'function_stm_subscribe');

add_action( 'wp_head', 'stm_ajaxurl' );

function stm_ajaxurl() {
	?>
	<script type="text/javascript">
		var ajaxurl = '<?php echo esc_url( admin_url('admin-ajax.php') ); ?>';
	</script>
<?php
}


// Event Sign up form
if (!function_exists('event_sign_up')) {
    function event_sign_up()
    {
	    // Get event details
	    $json           = array();
	    $json['errors'] = array();

	    $_POST['event']['event_id'] = filter_var( $_POST['event']['event_id'], FILTER_VALIDATE_INT );

	    if( empty( $_POST['event']['event_id'] ) ){
		    return false;
	    }

	    $event_price = get_post_meta( $_POST['event']['event_id'], 'event_price', true );

	    if ( ! filter_var( $_POST['event']['name'], FILTER_SANITIZE_STRING ) ) {
		    $json['errors']['name'] = true;
	    }
	    if ( ! is_email( $_POST['event']['email'] ) ) {
		    $json['errors']['email'] = true;
	    }
	    if ( ! is_numeric( $_POST['event']['phone'] ) ) {
   		    $json['errors']['phone'] = true;
  	    }
	    if ( ! filter_var( $_POST['event']['message'], FILTER_SANITIZE_STRING ) ) {
		    $json['errors']['message'] = true;
	    }

	    if( ! empty( $event_price ) && empty( $json['errors'] ) ){

		    $participant_data['post_title'] = $_POST['event']['name'];
		    $participant_data['post_type']  = 'event_participant';
		    $participant_data['post_status']  = 'draft';
		    $participant_data['post_excerpt']  = $_POST['event']['message'];
		    $participant_id = wp_insert_post( $participant_data );
		    update_post_meta( $participant_id, 'participant_email', $_POST['event']['email'] );
		    update_post_meta( $participant_id, 'participant_phone', $_POST['event']['phone'] );
		    update_post_meta( $participant_id, 'participant_event', $_POST['event']['event_id'] );

		    $json['redirect_url'] = generatePayment( $_POST['event'], $participant_id );
	    } elseif ( empty( $json['errors'] ) ) {

		    $participant_data['post_title'] = $_POST['event']['name'];
		    $participant_data['post_type']  = 'event_participant';
		    $participant_data['post_status']  = 'pending';
		    $participant_data['post_excerpt']  = $_POST['event']['message'];
		    $participant_id = wp_insert_post( $participant_data );

		    update_post_meta( $participant_id, 'participant_email', $_POST['event']['email'] );
		    update_post_meta( $participant_id, 'participant_phone', $_POST['event']['phone'] );
		    update_post_meta( $participant_id, 'participant_event', $_POST['event']['event_id'] );

	        $events_admin_email_subject = str_replace( array( '[event]' ), array( get_the_title($_POST['event']['event_id']) ), stm_option('admin_subject'));
	        
	        $events_admin_email_message = str_replace( array( '[event]', '[name]', '[email]', '[phone]', '[message]' ), array( get_the_title($_POST['event']['event_id']), $_POST['event']['name'], $_POST['event']['email'], $_POST['event']['phone'], $_POST['event']['message'] ), stm_option('admin_message'));
	        
	        $events_participant_email_subject = str_replace( array( '[event]' ), array( get_the_title($_POST['event']['event_id']) ), stm_option('user_subject'));
	        
	        $events_participant_email_message = str_replace( array( '[name]' ), array( $_POST['event']['name'] ), stm_option('user_message'));

            add_filter('wp_mail_content_type', 'set_html_content_type');

            $headers[] = 'From: ' . get_bloginfo('blogname') . ' <' . get_bloginfo('admin_email') . '>';
            
	        wp_mail( get_bloginfo( 'admin_email' ), $events_admin_email_subject, nl2br( $events_admin_email_message ), $headers );

            wp_mail( $_POST['event']['email'], $events_participant_email_subject, nl2br( $events_participant_email_message ), $headers );

            remove_filter('wp_mail_content_type', 'set_html_content_type');

            $json['success'] = __('Your application has been successfully sent', 'stm_domain');
        }

        echo json_encode($json);
        exit;
    }
}

add_action('wp_ajax_event_sign_up', 'event_sign_up');
add_action('wp_ajax_nopriv_event_sign_up', 'event_sign_up');

function set_html_content_type() {
    return 'text/html';
}

/* Custom ajax loader */
add_filter('wpcf7_ajax_loader', 'my_wpcf7_ajax_loader');
function my_wpcf7_ajax_loader () {
	return get_stylesheet_directory_uri() . '/assets/img/ajax-loader.gif';
}

function stm_wp_head() {
	if ( $favicon = stm_option( 'favicon', false, 'url' ) ) {
		echo '<link rel="shortcut icon" type="image/x-icon" href="' . esc_url( $favicon ) . '" />' . "\n";
	} else {
		echo '<link rel="shortcut icon" type="image/x-icon" href="' . get_template_directory_uri() . '/favicon.ico" />' . "\n";
	}
}

add_action( 'wp_head', 'stm_wp_head' );



if ( ! function_exists( '_wp_render_title_tag' ) ) {
	function theme_slug_render_title() {
?>
<title><?php wp_title( '|', true, 'right' ); ?></title>
<?php
	}
	add_action( 'wp_head', 'theme_slug_render_title' );
}



function is_stm(){
	$host = $_SERVER['HTTP_HOST'];
	if( $host == "www.mstudy.stm" || $host == "mstudy.stm" || $host == "www.masterstudy.stylemixthemes.com" || $host == "masterstudy.stylemixthemes.com" ) {
		return true;
	}else{
		return false;
	}
}


function stm_gallery_posts_per_page( $query ) {
    if ( is_admin() || ! $query->is_main_query() )
        return;
		
    if ( is_post_type_archive( 'gallery' ) ) {
        $query->set( 'posts_per_page', -1 );
        return;
    }
    
    if( is_category() || is_tag() && empty( $query->query_vars['suppress_filters'] ) ) {
		$query->set( 'post_type', array('events', 'post') );
		return $query;
	}

}

add_action( 'pre_get_posts', 'stm_gallery_posts_per_page', 1 );




if ( !function_exists( 'stm_after_content_import' ) ) {

	function stm_after_content_import( $demo_active_import , $demo_directory_path ) {

		reset( $demo_active_import );
		$current_key = key( $demo_active_import );

		$locations = get_theme_mod('nav_menu_locations');
		$menus  = wp_get_nav_menus();

		if(!empty($menus))
		{
			foreach($menus as $menu)
			{
				if(is_object($menu) && $menu->name == 'Primary menu')
				{
					$locations['primary'] = $menu->term_id;
				}
				if(is_object($menu) && $menu->name == 'Footer menu')
				{
					$locations['secondary'] = $menu->term_id;
				}
			}
		}

		set_theme_mod('nav_menu_locations', $locations);

		update_option( 'show_on_front', 'page' );

		$front_page = get_page_by_title( 'Front Page' );
		if ( isset( $front_page->ID ) ) {
			update_option( 'page_on_front', $front_page->ID );
		}
		$blog_page = get_page_by_title( 'Blog' );
		if ( isset( $blog_page->ID ) ) {
			update_option( 'page_for_posts', $blog_page->ID );
		}
		$shop_page = get_page_by_title( 'All courses' );
		if ( isset( $shop_page->ID ) ) {
			update_option( 'woocommerce_shop_page_id', $shop_page->ID );
			update_option( 'shop_single_image_size[width]', 840 );
			update_option( 'shop_single_image_size[height]', 400 );
			update_option( 'shop_thumbnail_image_size[width]', 150 );
			update_option( 'shop_thumbnail_image_size[height]', 75 );
		}

		if ( class_exists( 'RevSlider' ) ) {

			$wbc_sliders_array = array(
				'demo' => 'rev_slider_full_screen_slider.zip'
			);

			if ( isset( $demo_active_import[$current_key]['directory'] ) && !empty( $demo_active_import[$current_key]['directory'] ) && array_key_exists( $demo_active_import[$current_key]['directory'], $wbc_sliders_array ) ) {
				$wbc_slider_import = $wbc_sliders_array[$demo_active_import[$current_key]['directory']];

				if ( file_exists( $demo_directory_path.$wbc_slider_import ) ) {
					$slider = new RevSlider();
					$slider->importSliderFromPost( true, true, $demo_directory_path.$wbc_slider_import );
				}
			}
		}


	}

	add_action( 'wbc_importer_after_content_import', 'stm_after_content_import', 10, 2 );
}

// STM Updater
if ( ! function_exists( 'stm_updater' ) ) {
	function stm_updater() {
		global $stm_option;
		if( isset( $stm_option['envato_username'] ) && isset( $stm_option['envato_api'] ) ){
			$envato_username = trim( $stm_option['envato_username'] );
			$envato_api_key  = trim( $stm_option['envato_api'] );
			if ( ! empty( $envato_username ) && ! empty( $envato_api_key ) ) {
				load_template( get_template_directory() . '/inc/updater/envato-theme-update.php' );

				if ( class_exists( 'Envato_Theme_Updater' ) ) {
					Envato_Theme_Updater::init( $envato_username, $envato_api_key, 'StylemixThemes' );
				}
			}
		}
	}
	add_action( 'after_setup_theme', 'stm_updater' );
}

function stm_body_class( $classes ) {
	$classes[] = stm_option( 'color_skin' );
	return $classes;
}

add_filter( 'body_class', 'stm_body_class' );

function stm_print_styles() {

	$site_css = stm_option( 'site_css' );
	if( $site_css ){
		$site_css .= preg_replace( '/\s+/', ' ', $site_css );
	}

	wp_add_inline_style( 'theme-style', $site_css );
}

add_action( 'wp_enqueue_scripts', 'stm_print_styles' );

function stm_move_comment_field_to_bottom( $fields ) {
	$comment_field = $fields['comment'];
	unset( $fields['comment'] );
	$fields['comment'] = $comment_field;
	return $fields;
}

add_filter( 'comment_form_fields', 'stm_move_comment_field_to_bottom' );
<?php
//This code will add standart WPcolorpicker to woocommerce categories
// Add term page
function stm_theme_taxonomy_add_new_meta_field() {
	$counter = 0;
	$fa_icons = stm_get_cat_icons('fa');
	$stm_custom_icons_type_1 = stm_get_cat_icons('type_1');
	// this will add the custom meta field to the add new term page
	?>
	<div class="form-field">
		<label for="term_meta[custom_term_meta]"><?php _e( 'Category Background Color', 'stm_domain' ); ?></label>
		<input type="text" class="stm_theme_admin_cat_colorpicker" name="term_meta[custom_term_meta]" id="term_meta[custom_term_meta]" value="">
		<p class="description"><?php _e( 'Enter a value for this field','stm_domain' ); ?></p>
		<label for="term_meta[custom_term_font]"><?php _e( 'Category Background font', 'stm_domain' ); ?></label>
		<input type="hidden" class="stm_theme_admin_cat_icon" name="term_meta[custom_term_font]" id="term_meta[custom_term_font]" value="">
		<div class="stm_theme_cat_chosen_icon_preview"></div>
		<div class="stm_theme_font_pack_holder">
			<button type="button" class="stm_theme_choose_fa_icons button"><?php _e( 'Choose icons from Font Awesome Pack', 'stm_domain' ); ?></button>
			<table class="form-table stm_theme_icon_font_table">
				<tr>
					<?php foreach($fa_icons as $fa_icon): $counter++; ?>
						<td>
							<i class="fa fa-<?php echo esc_attr($fa_icon); ?>" data-value="<?php echo esc_attr($fa_icon); ?>"></i>
						</td>
						<?php if($counter%15 == 0): ?>
							</tr>
							<tr>
						<?php endif; ?>
					<?php endforeach; ?>
				</tr>
			</table>
		</div>
		<div class="stm_theme_font_pack_holder">
			<button type="button" class="stm_theme_choose_custom_icons button"><?php _e( 'Choose from Master Study Icons Pack', 'stm_domain' ); ?></button>
			<table class="form-table stm_theme_icon_font_table">
				<tr>
					<?php $counter = 0; ?>
					<?php foreach($stm_custom_icons_type_1 as $stm_custom_icon_type_1): $counter++; ?>
						<td>
							<i class="fa-<?php echo esc_attr($stm_custom_icon_type_1); ?>" data-value="fa-<?php echo esc_attr($stm_custom_icon_type_1); ?>"></i>
						</td>
						<?php if($counter%15 == 0): ?>
							</tr>
							<tr>
						<?php endif; ?>
					<?php endforeach; ?>
				</tr>
			</table>
		</div>
		<p class="description"><?php _e( 'Click on button, then choose icon, which will be held for this category','stm_domain' ); ?></p>
		<p class="description"><?php _e( 'If none of this icons suits you, upload thumbnail (130*120)','stm_domain' ); ?></p>
	</div>
	<script type="text/javascript">
		jQuery(function($) {
		    $(function() {
		        $(".stm_theme_admin_cat_colorpicker").wpColorPicker();
		        
		        $('.stm_theme_font_pack_holder .button').click(function(){
					$(this).closest('.stm_theme_font_pack_holder').find('.stm_theme_icon_font_table').toggleClass('visible');
				});
				
				$('.stm_theme_icon_font_table i').click(function(){
					$('.stm_theme_icon_font_table i').closest('td').removeClass('cat_icon_chosen');
					$(this).closest('td').addClass('cat_icon_chosen');
					var chosen_icon_cat_stm_theme = $(this).attr('data-value');
					$('.stm_theme_admin_cat_icon').val(chosen_icon_cat_stm_theme);
					var cat_chosen_icon_preview = $(this).closest('td').html();
					$('.stm_theme_cat_chosen_icon_preview').html(cat_chosen_icon_preview);
				});
				
				var stm_theme_cat_current_icon = $('.stm_theme_admin_cat_icon').val();
				if(stm_theme_cat_current_icon != '') {
					$('.stm_theme_icon_font_table i[data-value='+stm_theme_cat_current_icon+']').closest('td').addClass('cat_icon_chosen');	
				}
		    });
		});
	</script>
<?php
}

add_action( 'product_cat_add_form_fields', 'stm_theme_taxonomy_add_new_meta_field', 10, 2 );

// Edit term page
function stm_theme_taxonomy_edit_meta_field($term) {
 	$counter = 0;
	$fa_icons = stm_get_cat_icons('fa');
	$stm_custom_icons_type_1 = stm_get_cat_icons('type_1');
	// put the term ID into a variable
	$t_id = $term->term_id;
 
	// retrieve the existing value(s) for this meta field. This returns an array
	$term_meta = get_option( "taxonomy_$t_id" ); ?>
	<tr class="form-field">
		<th scope="row" valign="top"><label for="term_meta[custom_term_meta]"><?php _e( 'Category Background Color', 'stm_domain' ); ?></label></th>
		<td>
			<input type="text" class="stm_theme_admin_cat_colorpicker" name="term_meta[custom_term_meta]" id="term_meta[custom_term_meta]" value="<?php echo esc_attr( $term_meta['custom_term_meta'] ) ? esc_attr( $term_meta['custom_term_meta'] ) : ''; ?>">
			<p class="description"><?php _e( 'Enter a value for this field','stm_domain' ); ?></p>
		</td>
	</tr>
	<tr class="form-field">
		<th scope="row" valign="top"><label for="term_meta[custom_term_meta]"><?php _e( 'Category Background Color', 'stm_domain' ); ?></label></th>
		<td>
			<input type="hidden" class="stm_theme_admin_cat_icon" name="term_meta[custom_term_font]" id="term_meta[custom_term_font]" value="<?php echo esc_attr( $term_meta['custom_term_font'] ) ? esc_attr( $term_meta['custom_term_font'] ) : ''; ?>">
			<div class="stm_theme_cat_chosen_icon_preview"></div>
			<div class="stm_theme_font_pack_holder">
				<button type="button" class="stm_theme_choose_fa_icons button"><?php _e( 'Choose icons from Font Awesome Pack', 'stm_domain' ); ?></button>
				<table class="form-table stm_theme_icon_font_table">
					<tr>
						<?php foreach($fa_icons as $fa_icon): $counter++; ?>
							<td>
								<i class="fa fa-<?php echo esc_attr($fa_icon); ?>" data-value="fa-<?php echo esc_attr($fa_icon); ?>" data-search="<?php echo esc_attr($fa_icon); ?>"></i>
							</td>
							<?php if($counter%15 == 0): ?>
								</tr>
								<tr>
							<?php endif; ?>
						<?php endforeach; ?>
					</tr>
				</table>
			</div>
			<div class="stm_theme_font_pack_holder">
				<button type="button" class="stm_theme_choose_custom_icons button"><?php _e( 'Choose from Master Study Icons Pack', 'stm_domain' ); ?></button>
				<table class="form-table stm_theme_icon_font_table">
					<tr>
						<?php $counter = 0; ?>
						<?php foreach($stm_custom_icons_type_1 as $stm_custom_icon_type_1): $counter++; ?>
							<td>
								<i class="fa-<?php echo esc_attr($stm_custom_icon_type_1); ?>" data-value="fa-<?php echo esc_attr($stm_custom_icon_type_1); ?>"></i>
							</td>
							<?php if($counter%15 == 0): ?>
								</tr>
								<tr>
							<?php endif; ?>
						<?php endforeach; ?>
					</tr>
				</table>
			</div>
			<button type="button" class="button stm_theme_remove_cat_icon"><?php _e( 'Remove icon', 'stm_domain' ); ?></button>
		</td>
	</tr>
	<script type="text/javascript">
		jQuery(function($) {
		    $(function() {
		        $(".stm_theme_admin_cat_colorpicker").wpColorPicker();
		        
		        $('.stm_theme_font_pack_holder .button').click(function(){
					$(this).closest('.stm_theme_font_pack_holder').find('.stm_theme_icon_font_table').toggleClass('visible');
				});
				
				$('.stm_theme_icon_font_table i').click(function(){
					$('.stm_theme_icon_font_table i').closest('td').removeClass('cat_icon_chosen');
					$(this).closest('td').addClass('cat_icon_chosen');
					var chosen_icon_cat_stm_theme = $(this).attr('data-value');
					$('.stm_theme_admin_cat_icon').val(chosen_icon_cat_stm_theme);
					var cat_chosen_icon_preview = $(this).closest('td').html();
					$('.stm_theme_cat_chosen_icon_preview').html(cat_chosen_icon_preview);
				});
				
				var stm_theme_cat_current_icon = $('.stm_theme_admin_cat_icon').val();
				
				if(stm_theme_cat_current_icon != '') {
					$('.stm_theme_icon_font_table i[data-value='+stm_theme_cat_current_icon+']').closest('td').addClass('cat_icon_chosen');
					var cat_chosen_icon_preview = $('.cat_icon_chosen').closest('td').html();
					$('.stm_theme_cat_chosen_icon_preview').html(cat_chosen_icon_preview);
				}
				
				$('.stm_theme_remove_cat_icon').click(function(){
					$('.stm_theme_admin_cat_icon').val("");
					$('.stm_theme_cat_chosen_icon_preview').empty();
				})
		    });

		});
	</script>
<?php
}
add_action( 'product_cat_edit_form_fields', 'stm_theme_taxonomy_edit_meta_field', 10, 2 );

// Save extra taxonomy fields callback function.
function save_taxonomy_custom_meta( $term_id ) {
	if ( isset( $_POST['term_meta'] ) ) {
		$t_id = $term_id;
		$term_meta = get_option( "taxonomy_$t_id" );
		$cat_keys = array_keys( $_POST['term_meta'] );
		foreach ( $cat_keys as $key ) {
			if ( isset ( $_POST['term_meta'][$key] ) ) {
				$term_meta[$key] = $_POST['term_meta'][$key];
			}
		}
		// Save the option array.
		update_option( "taxonomy_$t_id", $term_meta );
	}
}  
add_action( 'edited_category', 'save_taxonomy_custom_meta', 10, 2 );  
add_action( 'create_category', 'save_taxonomy_custom_meta', 10, 2 );

add_action( 'edited_product_cat', 'save_taxonomy_custom_meta', 10, 2 );  
add_action( 'create_product_cat', 'save_taxonomy_custom_meta', 10, 2 );

// Pick icon to cat font awesome
function stm_get_cat_icons($font_pack = 'fa') {
	$fonts  = array();
	
	if($font_pack == 'fa') {
		$font_icons = file( get_template_directory() . '/inc/font-awesome.json' );
		$font_icons = json_decode( implode( '', $font_icons ), true );
		foreach ( $font_icons as $key => $val ) {
			$fonts[] = $key;
		};
	} elseif($font_pack == 'type_1') {
		// Pick icon to cat custom font pack 1
		$fonts_custom_type_1 = file( get_template_directory() . '/inc/custom-icon-font.json' );
		$fonts_custom_type_1 = json_decode( implode( '', $fonts_custom_type_1 ), true );
		foreach ($fonts_custom_type_1 as $font_custom_type_1) {
			$fonts[] = str_replace(' ', '', $font_custom_type_1);
		}
	}
	
	return $fonts;
};



// Declare Woo support
add_action( 'after_setup_theme', 'woocommerce_support' );
function woocommerce_support() {
    add_theme_support( 'woocommerce' );
}


// Remove woo styles
add_filter( 'woocommerce_enqueue_styles', '__return_empty_array' );

//Change the breadcrumb separator
add_filter( 'woocommerce_breadcrumb_defaults', 'jk_change_breadcrumb_delimiter' );
function jk_change_breadcrumb_delimiter( $defaults ) {
	// Change the breadcrumb delimeter from '/' to '>'
	$defaults['delimiter'] = '<i class="fa fa-chevron-right"></i>';
	return $defaults;
}

add_action('woocommerce_before_main_content', 'stm_woo_theme_wrapper_start', 10);
add_action('woocommerce_after_main_content', 'stm_woo_theme_wrapper_end', 10);

function stm_woo_theme_wrapper_start() {
  echo '';
}

function stm_woo_theme_wrapper_end() {
  echo '';
}


// Remove product count
remove_action( 'woocommerce_before_shop_loop', 'woocommerce_result_count', 20 );


remove_action( 'woocommerce_single_product_summary', 'woocommerce_template_single_title', 5 );
remove_action( 'woocommerce_single_product_summary', 'woocommerce_template_single_rating', 10 );
remove_action( 'woocommerce_single_product_summary', 'woocommerce_template_single_excerpt', 20 );
remove_action( 'woocommerce_single_product_summary', 'woocommerce_template_single_meta', 40 );
remove_action( 'woocommerce_single_product_summary', 'woocommerce_template_single_sharing', 50 );


remove_action( 'woocommerce_before_single_product_summary', 'woocommerce_show_product_sale_flash', 10 );


// Change out of stock text
add_filter( 'woocommerce_get_availability', 'custom_get_availability', 1, 2);

// Our hooked in function $availablity is passed via the filter!
function custom_get_availability( $availability, $_product ) {
	if ( !$_product->is_in_stock() ) $availability['availability'] = __('No available seats', 'woocommerce');
return $availability;
}

// Change single button text add to cart
// Change single button text add to cart
add_filter( 'woocommerce_product_single_add_to_cart_text', 'woo_custom_cart_button_text' );    // 2.1 +

function woo_custom_cart_button_text() {
	return __( 'Enroll this Course', 'stm_domain' );
}


/* Checkout fields unsetting */
// Hook in
add_filter( 'woocommerce_checkout_fields' , 'custom_override_checkout_fields1' );

// Our hooked in function - $fields is passed via the filter!
function custom_override_checkout_fields1( $fields ) {
    unset($fields['billing']['billing_country']);
    //unset($fields['billing']['billing_last_name']);
    //unset($fields['billing']['billing_first_name']);
    unset($fields['billing']['billing_company']);
    unset($fields['billing']['billing_address_1']);
    unset($fields['billing']['billing_address_2']);
    unset($fields['billing']['billing_city']);
    unset($fields['billing']['billing_postcode']);
    unset($fields['billing']['billing_state']);
    //unset($fields['billing']['billing_email']);
    //unset($fields['billing']['billing_phone']);
    unset($fields['shipping']['shipping_first_name']);
    unset($fields['shipping']['shipping_last_name']);
    unset($fields['shipping']['shipping_company']);
    unset($fields['shipping']['shipping_address_1']);
    unset($fields['shipping']['shipping_address_2']);
    unset($fields['shipping']['shipping_city']);
    unset($fields['shipping']['shipping_postcode']);
    unset($fields['shipping']['shipping_country']);
    unset($fields['shipping']['shipping_state']);
    //unset($fields['order']['order_comments']);
    return $fields;
}

// Display 24 products per page. Goes in functions.php
add_filter( 'loop_shop_per_page', create_function( '$cols', 'return 9;' ), 20 );
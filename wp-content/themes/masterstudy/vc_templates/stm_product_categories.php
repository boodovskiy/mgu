<?php
extract( shortcode_atts( array(
	'title' => '',
	'view_type' => 'stm_vc_product_cat_carousel',
	'number' => '',
	'per_row' => 6,
	'box_text_color' => '#fff',
	'text_align' => 'center',
	'icon_size' => '60',
	'auto' => '0',
	'icon_height' => '69',
	'css'   => ''
), $atts ) );
$css_class = apply_filters( VC_SHORTCODE_CUSTOM_CSS_FILTER_TAG, vc_shortcode_custom_css_class( $css, ' ' ) );

$carousel_num = rand(0, 9999);

//per row
$cols_per_row = 12/$per_row;
$counter = 0;

// Building terms args
$taxonomy = array( 
    'product_cat',
);

$args = array(
	'hide_empty' => true,
	'number' => $number,
);

$terms = get_terms($taxonomy, $args); 
?>

<?php if(!empty($terms)): ?>

	<div class="product_categories_main_wrapper">		
		<?php if($view_type == 'stm_vc_product_cat_list'): ?>
			<div class="row">
		<?php endif; ?>
		
		<?php if($view_type == 'stm_vc_product_cat_carousel'): ?>
			<div class="simple_carousel_with_bullets">
				<div class="simple_carousel_bullets_init_<?php echo($carousel_num); ?> clearfix">
		<?php endif; ?>
		
			<?php foreach($terms as $term): $counter++; ?>

			<?php $term_meta = get_option( "taxonomy_".$term->term_id );
				
			//Get bg color
			if(!empty($term_meta['custom_term_meta'])){
				$item_clr = $term_meta['custom_term_meta'];
			} else {
				$item_clr = '#eab830';
			} 
			
			// Get thumbnail
			$thumbnail_id = get_woocommerce_term_meta( $term->term_id, 'thumbnail_id', true );
			if($thumbnail_id) {
				$cat_image = wp_get_attachment_image_src($thumbnail_id, 'img-122-120');
			} else {
				$cat_image = false;
			}
			?>
								
				<div class="single-course-col <?php if($view_type != 'stm_vc_product_cat_carousel'){ ?> col-md-<?php echo esc_attr($cols_per_row) ?> col-sm-4 col-xs-12 <?php }; ?>">
					<a href="<?php echo esc_attr(get_term_link($term)); ?>" title="<?php _e('View course', 'stm_domain') ?>">
						<div class="<?php if($view_type != 'stm_vc_product_cat_carousel'){ ?>stm-no-animation<?php }; ?> project_cat_single_item <?php echo esc_attr( $css_class ); ?> text-<?php echo esc_attr($text_align); ?>" style="background-color:<?php echo esc_attr($item_clr); ?>; color: <?php echo esc_attr($box_text_color); ?>">
							<?php if(!empty($term_meta['custom_term_font']) and !$cat_image): ?>
								<i class="fa <?php echo($term_meta['custom_term_font']); ?>" style="font-size:<?php echo esc_attr($icon_size) ?>px; height:<?php echo esc_attr($icon_height); ?>px;"></i>
							<?php else: ?>
								<div class="cat_image_uploaded" style="height:<?php echo esc_attr($icon_height); ?>px;">
									<?php if(!empty($cat_image[0])): ?>
										<img src="<?php echo esc_attr($cat_image[0]); ?>" style="height:<?php echo esc_attr($icon_size) ?>px;" alt="<?php _e('Category image', 'stm_domain'); ?>"/>
									<?php endif; ?>
								</div>
							<?php endif; ?>
							<div class="course_title_wrapper">
								<div class="course_category_title h5" style="color: <?php echo esc_attr($box_text_color); ?>"><?php echo esc_attr($term->name); ?></div>
							</div>
						</div>
					</a>
				</div>
			<?php endforeach; ?>
		
		<?php if($view_type == 'stm_vc_product_cat_carousel'): ?>
				</div> <!-- simple_carousel_bullets_init -->
				<div class="simple-carousel-bullets"></div>
 			</div><!-- simple_carousel_with_bullets -->
		<?php endif; ?>
		
		<?php if($view_type == 'stm_vc_product_cat_list'): ?>
			</div> <!-- row -->
		<?php endif; ?>
	</div>

<?php endif; ?>

<!-- If styled as carousel add inline script in footer -->
<script type="text/javascript">
	(function($) {
	    "use strict";
		
		$(document).ready(function() {
			coursesSingleMaxHeight();
		});
		
		$(window).load(function() {
			coursesSingleMaxHeight();
		});
		
		$(window).resize(function() {
			coursesSingleMaxHeight();
		});
		
		var singleCourseHeight = 0;
		
		function coursesSingleMaxHeight(){
			$('.product_categories_main_wrapper .single-course-col').each(function(){
				var elementHeight = $(this).find('.project_cat_single_item').height();
				if(elementHeight > singleCourseHeight) {
					singleCourseHeight = elementHeight;
				}
			});
			$('.project_cat_single_item').height(singleCourseHeight);
		};
	})(jQuery);
</script>
<?php if($view_type == 'stm_vc_product_cat_carousel'): ?>
	<script type="text/javascript">
		(function($) {
		    "use strict";
			
			$(document).ready(function() {
				simple_carousel_bullets_cfs();
			});
			
			$(window).load(function() {
				$('.simple_carousel_bullets_init_<?php echo($carousel_num); ?>').trigger('destroy');
				simple_carousel_bullets_cfs();
			});
			
			$(window).resize(function() {
				$('.simple_carousel_bullets_init_<?php echo($carousel_num); ?>').trigger('destroy');
				simple_carousel_bullets_cfs();
			});
			
			var items = 1;
			
			function simple_carousel_bullets_cfs(){
				$('.simple_carousel_bullets_init_<?php echo($carousel_num); ?>').carouFredSel({
					scroll   : {
					    items: items,
						fx : "direct",
				        duration : 800,                         
				        pauseOnHover : true
				    },
				    debug: true,
				    auto: {
				        play:<?php if( $auto ) { echo esc_attr($auto); } else { echo esc_attr('false'); }; ?>,
				        timeoutDuration: 5000
				    },
				    swipe: { 
					    onTouch: true 
					},
				    width: "100%",
				    height: "auto",
				    responsive: true,
				    items: {
				        visible: {
				            min:1,
				            max:<?php echo esc_attr($per_row) ?>
				        },
				        height: '100%'
				    },
				    pagination: {
						container: function() {
				            return $(this).closest('.simple_carousel_with_bullets').find('.simple-carousel-bullets');
				        }
					}
				});
				
				items = $('.simple_carousel_bullets_init_<?php echo($carousel_num); ?>').triggerHandler("currentVisible");
			};
		})(jQuery);
	</script>
<?php endif; ?>
<?php
extract( shortcode_atts( array(
	'name' => '',
	'image' => '',
	'testimonials_title' => '',
	'testimonials_text_color' => '#aaaaaa',
	'testimonials_max_num' => '-1',
	'testimonials_slides_per_row' => 2,
), $atts ) );

$testimonials = new WP_Query( array( 'post_type' => 'testimonial', 'posts_per_page' => $testimonials_max_num ) );
?>

<?php 
	/* Count slide and columns of slides */ 
	$slide_col = 12/$testimonials_slides_per_row;
?>

<?php if($testimonials->have_posts()): ?>
	<div class="testimonials_main_wrapper simple_carousel_wrapper">
		<div class="clearfix testimonials_control_bar_top">
			<?php if($testimonials_title): ?>
				<div class="pull-left">
					<h2 class="testimonials_main_title"><?php echo esc_attr($testimonials_title); ?></h2>
				</div>
			<?php endif; ?>
			<div class="pull-right testimonials_control_bar">
				<div class="clearfix">
					<div class="pull-right">
						<a href="#" class="btn-carousel-control simple_carousel_prev" title="<?php _e('Scroll Carousel left', 'stm_domain'); ?>">
							<i class="fa-icon-stm_icon_chevron_left"></i>
						</a>
						<a href="#" class="btn-carousel-control simple_carousel_next" title="<?php _e('Scroll Carousel right', 'stm_domain'); ?>">
							<i class="fa-icon-stm_icon_chevron_right"></i>
						</a>
					</div>
				</div>
			</div>
		</div>
		<div class="testimonials-carousel-unit">
			<div class="testimonials-carousel-init simple_carousel_init clearfix">
				<?php while($testimonials->have_posts()): $testimonials->the_post(); ?>	
					<?php $sphere = get_post_meta(get_the_id(), 'testimonial_profession', true); ?>
					<div class="col-md-<?php echo($slide_col) ?> col-sm-12 col-xs-12">
						<div class="testimonial_inner_wrapper">
							<?php if(!has_post_thumbnail()): ?>
								<h4 class="testimonials-inner-title"><?php the_title(); ?></h4>
								<?php if(!empty($sphere)): ?>
									<div class="testimonial_sphere"><?php echo($sphere); ?></div>
								<?php endif; ?>
								<div class="short_separator"></div>
							<?php else: ?>
								<div class="media">
									<div class="media-left media-top">
										<div class="testimonial-media-unit">
											<?php the_post_thumbnail('img-69-69', array('class'=>'testimonial-media-unit-rounded')); ?>
										</div>
									</div>
									<div class="media-body">
										<h4 class="testimonials-inner-title"><?php the_title(); ?></h4>
										<?php if(!empty($sphere)): ?>
											<div class="testimonial_sphere"><?php echo($sphere); ?></div>
										<?php endif; ?>
										<div class="short_separator"></div>
									</div>
								</div>
							<?php endif; ?>
							<div class="testimonial_inner_content" style="color:<?php echo esc_attr($testimonials_text_color); ?>"><?php the_excerpt(); ?></div>
						</div> <!-- inner wrapper -->
					</div>
				<?php endwhile; ?>
			</div>
		</div>
	</div> <!-- testimonials main wrapper -->
	<?php wp_reset_postdata(); ?>
<?php endif; ?>

<?php
// <!-- Register inline script for carousel with testimonials -->

	if(!function_exists('simple_carousel_inline_script')) {
		function simple_carousel_inline_script() {
			if ( wp_script_is( 'custom', 'registered' ) ){ ?>
				<script type="text/javascript">
					(function($) {
					    "use strict";
						
						$(document).ready(function() {
							simple_carousel_cfs();
						});
						
						$(window).load(function() {
							$('.simple_carousel_init').trigger('destroy');
							simple_carousel_cfs();
						});
						
						$(window).resize(function() {
							$('.simple_carousel_init').trigger('destroy');
							simple_carousel_cfs();
						});
						
						function simple_carousel_cfs(){
							$('.simple_carousel_init').carouFredSel({
								scroll   : {
								    items: 1,
									fx : "direct",
							        duration : 1000,                         
							        pauseOnHover : true,
							        easing: 'quadratic',
							    },
							    auto: {
							        play:false,
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
							            max:2,
							        },
							        height: '100%'
							    },
							    prev: {
							    	button: function() {
						            	return $(this).closest('.simple_carousel_wrapper').find('.simple_carousel_prev');
						            }
						        },
							    next: {
							        button: function() {
							            return $(this).closest('.simple_carousel_wrapper').find('.simple_carousel_next');
							        }
							    }
							});
						};
					})(jQuery);
				</script>
		<?php }
		}
		add_action( 'wp_footer', 'simple_carousel_inline_script' );
	}
?>
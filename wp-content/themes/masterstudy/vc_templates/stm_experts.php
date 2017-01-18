<?php
extract( shortcode_atts( array(
	'name' => '',
	'image' => '',
	'experts_title' => '',
	'experts_max_num' => '-1',
	'experts_output_style' => 'experts_carousel',
	'expert_slides_per_row' => 2,
	'experts_all' => true,
), $atts ) );
$experts = new WP_Query( array( 'post_type' => 'teachers', 'posts_per_page' => $experts_max_num ) );
?>

<?php 
	/* Count slide and columns of slides */ 
	$slide_col = 12/$expert_slides_per_row;
?>

<?php if($experts->have_posts()): $count = 0; ?>
	<div class="experts_main_wrapper simple_carousel_wrapper">
		<div class="clearfix experts_control_bar_top">
			<?php if(!empty($experts_title)): ?>
				<div class="pull-left">
					<h2 class="experts_main_title"><?php echo balancetags($experts_title, true); ?></h2>
				</div>
			<?php endif; ?>
			<div class="pull-right experts_control_bar">
				<div class="clearfix">
					<?php if($experts_output_style == 'experts_carousel'): ?>
						<div class="pull-right">
							<a href="#" class="btn-carousel-control simple_carousel_prev" title="<?php _e('Scroll Carousel left', 'stm_domain'); ?>">
								<i class="fa fa-chevron-left"></i>
							</a>
							<a href="#" class="btn-carousel-control simple_carousel_next" title="<?php _e('Scroll Carousel right', 'stm_domain'); ?>">
								<i class="fa fa-chevron-right"></i>
							</a>
						</div>
					<?php endif; ?>
					<?php if($experts_all == 'yes'): ?>
						<div class="pull-right btn-experts-all">
							<a class="btn btn-primary btn-sm" href="<?php echo(get_post_type_archive_link('teachers')); ?>" title="<?php _e('View all teachers', 'stm_domain'); ?>">
								<span class="icon-stm_icon_brain"></span><?php _e('View all', 'stm_domain'); ?>
							</a>
						</div>
					<?php endif; ?>
				</div>
			</div>
		</div>
		<div class="<?php echo balanceTags($experts_output_style); ?>_unit">
			<div class="<?php echo balanceTags($experts_output_style); ?>">
				<div class="expert-carousel-init <?php if($experts_output_style == 'experts_carousel') { ?>simple_carousel_init<?php } ?>">
					<?php if($experts_output_style == 'experts_list'): ?>
						<div class="row">
					<?php endif; ?>
						<?php while($experts->have_posts()): $experts->the_post(); $count++; ?>
							<?php // <!-- get expert job sphere -->
							$job = get_post_meta(get_the_id(), 'expert_sphere', true); ?>
							
							<?php // <!-- Construct socials and get all custom fields -->
							$origin_socials = array(
								'facebook',
								'linkedin',
								'twitter',
								'google-plus',
								'youtube-play',
							); ?>
							
							<?php // <!-- get certificate -->
							$certificate = get_post_meta(get_the_id(), 'expert_certified', true); ?>
							<div class="col-md-<?php echo($slide_col); ?> col-sm-12 col-xs-12 expert-single-slide">
								<div class="st_experts <?php echo($experts_output_style); ?>">
									<div class="media">
										<div class="media-left expert-media">
											<?php if(has_post_thumbnail()): ?>
												<?php the_post_thumbnail('img-129-129', array('class'=>'img-responsive')); ?>
											<?php endif; ?>
											<div class="expert_socials clearfix">
												<?php foreach($origin_socials as $social): ?>
													<?php $current_social = get_post_custom_values($social, get_the_id()); ?>
													<?php if(!empty($current_social[0])): ?>
														<a class="expert-social-<?php echo($social); ?>" href="<?php echo($current_social[0]); ?>" title="<?php echo __('View expert on', 'stm_domain').' '.$social ?>">
															<i class="fa fa-<?php echo($social); ?>"></i>
														</a>
													<?php endif; ?>
												<?php endforeach; ?>
											</div>
										</div>
										<div class="media-body">
											<a class="expert_inner_title_link" href="<?php echo get_the_permalink(get_the_id()); ?>" title="<?php _e('View teacher page', 'stm_domain'); ?>">
												<h3 class="expert_inner_title"><?php the_title(); ?></h3>
											</a>
											<?php if(!empty($job)): ?>
												<div class="expert_job"><?php echo($job); ?></div>
											<?php endif; ?>
											<hr>
											<div class="expert_excerpt">
												<?php the_excerpt(); ?>
											</div>
											<?php if(!empty($certificate)): ?>
												<div class="expert_certified"><?php echo _e("Certified by", "stm_theme").' '; ?><span class="orange"><?php echo balanceTags($certificate); ?></span></div>
											<?php endif; ?>
										</div>
									</div>
								</div>
							</div> <!-- col -->
							<?php if($experts_output_style == 'experts_list'): ?>
								<?php if($count%2==0): ?>
									</div> <!-- close row to prevent blocks mixing -->
									<div class="row"> <!-- open new row in loop -->
								<?php endif; ?>
							<?php endif; ?>
						<?php endwhile; ?>
						<?php wp_reset_postdata(); ?>
					<?php if($experts_output_style == 'experts_list'): ?>
						</div> <!-- row if style = list -->
					<?php endif; ?>
				</div>	<!-- init carousel -->
			</div> <!-- style output -->
		</div> <!-- unit -->
	</div> <!-- experts main wrapper -->
<?php endif; ?>

<!-- If styled as carousel add inline script in footer -->
<?php if($experts_output_style == 'experts_carousel') {
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
							    debug: true,
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
}
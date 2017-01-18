<?php
extract( shortcode_atts( array(
	'per_page' => '4',
	'css'   => ''
), $atts ) );
$css_class = apply_filters( VC_SHORTCODE_CUSTOM_CSS_FILTER_TAG, vc_shortcode_custom_css_class( $css, ' ' ) );

$paged = get_query_var( 'paged', 1 );

$teachers = new WP_Query( array( 'post_type' => 'teachers', 'posts_per_page' => $per_page ,'paged' => $paged ) );

?>

<?php if($teachers->have_posts()): ?>
	<div class="row">
		<?php while($teachers->have_posts()): $teachers->the_post(); ?>
			<?php // <!-- Construct socials and get all custom fields -->
			$origin_socials = array(
				'facebook',
				'linkedin',
				'twitter',
				'google-plus',
				'youtube-play',
			); ?>
			<?php $job = get_post_meta(get_the_id(), 'expert_sphere', true); ?>
			<div class="col-md-3 col-sm-4 col-xs-6 teacher-col">
				<div class="teacher_content">
					
						<?php if(has_post_thumbnail()): ?>
							<div class="teacher_img">
								<a href="<?php the_permalink(); ?>" title="<?php _e('Watch teacher page', 'stm_domain'); ?>">
									<?php the_post_thumbnail('img-270-180', array('class'=>'img-responsive')); ?>
								</a>
								<div class="expert_socials clearfix text-center">
									<div class="display_inline_block">
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
							</div>
						<?php endif; ?>
						<a href="<?php the_permalink(); ?>" title="<?php _e('Watch teacher page', 'stm_domain'); ?>">
							<h4 class="title"><?php the_title(); ?></h4>
						</a>
					<?php if(!empty($job)): ?>
						<div class="job heading_font"><?php echo esc_attr($job); ?></div>
					<?php endif; ?>	
					<div class="content">
						<?php the_excerpt(); ?>
					</div>
				</div>
				<div class="multiseparator"></div>
			</div>
		<?php endwhile; ?>
	</div>
	
	<?php
		echo paginate_links( array(
			'type'      => 'list',
			'total' => $teachers->max_num_pages,
			'prev_text' => '<i class="fa fa-chevron-left"></i><span class="pagi_label">'.__('Previous', 'stm_domain').'</span>',
			'next_text' => '<span class="pagi_label">'.__('Next', 'stm_domain').'</span><i class="fa fa-chevron-right"></i>',
		) );
	?>
	
<?php endif; ?>
<?php wp_reset_postdata(); ?>
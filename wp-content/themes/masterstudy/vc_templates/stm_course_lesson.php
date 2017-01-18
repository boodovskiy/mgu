<?php
extract( shortcode_atts( array(
	'title' => '',
	'icon' => '',
	'private_lesson' => '',
	'badge' => '',
	'meta' => '',
	'meta_icon' => '',
	'preview_video' => '',
	'private_placeholder' => '',
	'css'   => ''
), $atts ) );

$css_class = apply_filters( VC_SHORTCODE_CUSTOM_CSS_FILTER_TAG, vc_shortcode_custom_css_class( $css, ' ' ) );
$stm_tab_id = 'tab'.rand(0,9999);
$tapableTab = '';
if(!empty($content)){
	$tapableTab = 'tapable';
}

// Get current user and check if he bought current course
$bought_course = false;
$current_user = wp_get_current_user();
if( !empty($current_user->user_email) and !empty($current_user->ID) ) {
	if ( wc_customer_bought_product( $current_user->user_email, $current_user->ID, get_the_id() ) ) {
		$bought_course = true;
	}
}



?>

<div class="panel panel-default">
	<div class="panel-heading" role="tab" id="heading_<?php echo esc_attr($stm_tab_id); ?>">
		<div class="course_meta_data">
			<div class="panel-title">
				<a class="collapsed <?php echo esc_attr($tapableTab); ?>" role="button" data-toggle="collapse"  href="#<?php echo esc_attr($stm_tab_id); ?>" aria-expanded="false" aria-controls="collapseOne">
				<table class="course_table">
					<tr>
						<td class="number"></td>
						
						<td class="icon">
							<?php if(!empty($icon)): ?>
								<i class="fa <?php echo esc_attr($icon); ?>"></i>
							<?php endif; ?>
						</td>
						
						<?php if(!empty($title)): ?>
							<td class="title">
								
								<div class="course-title-holder">
									<strong><?php echo esc_attr($title); ?></strong>
									<?php if(!empty($content)): ?><i class="fa fa-sort-down"></i><?php else: ?>&nbsp;<?php endif; ?>
									
									<?php if(!empty($badge) and $badge != 'no_badge'): ?>
										<div class="stm_badge stm_small_badge">
											<div class="badge_unit heading_font <?php echo esc_attr($badge); ?>">
												<?php echo esc_attr(_e($badge, 'stm_domain')); ?>
											</div>
										</div>
									<?php endif; ?>
								</div>
								
							</td>
						<?php endif; ?>
						
						<td class="stm_badge">
							<?php if(!empty($preview_video)): ?>
								<div class="badge_unit heading_font video_course_preview" data-fancybox="<?php echo esc_attr( $preview_video ); ?>">
									<?php echo esc_attr(_e('Preview', 'stm_domain')); ?>
								</div>
							<?php endif; ?>
							
							<?php if(!empty($private_lesson) and $private_lesson):
								if($bought_course):
									if(!empty($meta) or !empty($meta_icon)): ?>
										<div class="meta">
											<?php if(!empty($meta_icon)): ?>
												<i class="fa <?php echo esc_attr($meta_icon); ?>"></i>
											<?php endif;
											echo esc_attr($meta); ?>
										</div>
									<?php endif;
								else: ?>
									<div class="meta">
										<i class="fa fa-lock"></i> <?php _e('Private', 'stm_domain'); ?>
									</div>
								<?php endif;
							else:
								if(!empty($meta) or !empty($meta_icon)): ?>
									<div class="meta">
										<?php if(!empty($meta_icon)): ?>
											<i class="fa <?php echo esc_attr($meta_icon); ?>"></i>
										<?php endif;
										echo esc_attr($meta); ?>
									</div>
								<?php endif;
							endif; ?>
								
						</td>
					</tr>
				</table>
				</a>
			</div>
		</div>
	</div>
	<?php if(!empty($content)): ?>
		<div id="<?php echo esc_attr($stm_tab_id); ?>" class="panel-collapse collapse" role="tabpanel" aria-labelledby="heading_<?php echo esc_attr($stm_tab_id); ?>">
			<div class="panel-body">
				<div class="course-panel-body">
					<?php 
						// Check for private content only on course page
						if(!empty($private_lesson) and $private_lesson){
							if($bought_course) {
								echo($content);
							} else {
								// placeholder
								if(!empty($private_placeholder)) {
									echo balancetags($private_placeholder);
								} else {
									echo esc_attr(_e('The content of this lesson is locked. To unlock it, you need to Buy this Course.', 'stm_domain'));
								}
							}
						} else {
							echo $content;
						}
					?>
				</div>
			</div>
		</div>
	<?php endif; ?>
</div>
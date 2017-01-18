<?php
extract( shortcode_atts( array(
	'css'   => ''
), $atts ) );

$css_class = apply_filters( VC_SHORTCODE_CUSTOM_CSS_FILTER_TAG, vc_shortcode_custom_css_class( $css, ' ' ) );

$job = get_post_meta(get_the_id(), 'expert_sphere', true);
$origin_socials = array(
	'facebook',
	'linkedin',
	'twitter',
	'google-plus',
	'youtube-play',
); 
?>

<div class="stm_teacher_single_featured_image">
	<?php if(has_post_thumbnail()): ?>
		<div class="display_inline_block">
			<?php the_post_thumbnail('img-840-400', array('class'=>'img-responsive')); ?>
			<div class="stm_teacher_single_socials text-center">
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
</div>


<?php
extract( shortcode_atts( array(
	'title' => '',
	'form' => '',
	'css'   => ''
), $atts ) );
$css_class = apply_filters( VC_SHORTCODE_CUSTOM_CSS_FILTER_TAG, vc_shortcode_custom_css_class( $css, ' ' ) );

?>

	<div class="stm_sign_up_now <?php echo esc_attr($css_class); ?>">
		<div class="stm_sign_up_now_inner">
			<?php if($title): ?>
				<h2><?php echo esc_attr($title); ?></h2>
			<?php endif; ?>
			<?php if($form != '' and $form != 'none'): ?>
				<?php $cf7 = get_post($form); ?>
				<div class="stm_sign_up_form">
					<?php echo(do_shortcode('[contact-form-7 id="'.$cf7->ID.'" title="'.($cf7->post_title).'"]')); ?>
				</div>
			<?php endif; ?>
		</div>
	</div> <!-- stm_subscribe -->
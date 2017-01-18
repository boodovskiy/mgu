<?php
extract( shortcode_atts( array(
	'title' => '',
	'image'	=> '',
	'css'   => ''
), $atts ) );
$css_class = apply_filters( VC_SHORTCODE_CUSTOM_CSS_FILTER_TAG, vc_shortcode_custom_css_class( $css, ' ' ) );

if(!empty($image)){
	$certificate_url = wp_get_attachment_image_src($image, 'img-480-380', true);
}
?>

<?php if(!empty($image)): ?>
	<div class="certificate <?php echo esc_attr($css_class); ?>">
		<div class="certificate-frame">
			<div class="certificate-holder">
				<img class="img-responsive" src="<?php echo esc_url($certificate_url[0]); ?>" />
			</div>
		</div>
		<?php if(!empty($title)): ?>
			<div class="h4 title text-center"><?php echo esc_attr($title); ?></div>
		<?php endif; ?>
	</div>
<?php endif; ?>
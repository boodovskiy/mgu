<?php
extract( shortcode_atts( array(
	'title' => '',
	'css'   => ''
), $atts ) );

$css_class = apply_filters( VC_SHORTCODE_CUSTOM_CSS_FILTER_TAG, vc_shortcode_custom_css_class( $css, ' ' ) );

$accordeon_id = rand(0,9999);
?>

<?php if(!empty($title)): ?>
	<h4 class="course_title"><?php echo esc_attr($title); ?></h4>
<?php endif; ?>
<?php if( !empty( $content ) ){ ?>
	<div class="course_lessons_section">
		<div class="panel-group" id="accordion_<?php echo esc_attr($accordeon_id); ?>" role="tablist" aria-multiselectable="true">
			<?php echo wpb_js_remove_wpautop($content); ?>
		</div>
	</div>
<?php } ?>
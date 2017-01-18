<?php
extract( shortcode_atts( array(
	'color' => '#fdc735',
	'css'   => ''
), $atts ) );
$css_class = apply_filters( VC_SHORTCODE_CUSTOM_CSS_FILTER_TAG, vc_shortcode_custom_css_class( $css, ' ' ) );

?>

	<div class="stm_colored_separator<?php echo esc_attr( $css_class ); ?>">
		<div class="triangled_colored_separator" style="background-color:<?php echo esc_attr($color); ?>; ">
			<div class="triangle" style="border-bottom-color:<?php echo esc_attr($color); ?>;"></div>
		</div>
	</div>
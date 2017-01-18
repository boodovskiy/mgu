<?php
extract( shortcode_atts( array(
	'title' => '',
	'css'   => ''
), $atts ) );
$css_class = apply_filters( VC_SHORTCODE_CUSTOM_CSS_FILTER_TAG, vc_shortcode_custom_css_class( $css, ' ' ) );


// Mailchimp widget settings
$widget = 'Stm_Mailchimp_Widget';
$instance = array(
	'title' => $title,
);

$args = array(
	
);
?>

	<div class="stm_subscribe <?php echo esc_attr($css_class); ?>">
		<?php the_widget( $widget, $instance, $args ); ?>
	</div> <!-- stm_subscribe -->
<?php
$output = $title = $el_class = $sortby = $exclude = $css = '';
extract( shortcode_atts( array(
	'title' => '',
	'sortby' => 'menu_order',
	'exclude' => null,
	'el_class' => '',
	'css' => ''
), $atts ) );

$el_class = $this->getExtraClass( $el_class );
$css_class = apply_filters( VC_SHORTCODE_CUSTOM_CSS_FILTER_TAG, vc_shortcode_custom_css_class( $css, ' ' ) );

$type = 'WP_Widget_Pages';
$args = array(
	'before_widget' => '<aside class="widget widget_pages wpb_content_element vc_widgets' . $css_class . ' ' . $el_class . '">',
	'after_widget'  => '</aside>',
	'before_title'  => '<div class="widget_title"><h5>',
	'after_title'   => '</h5></div>'
);

ob_start();
the_widget( $type, $atts, $args );
$output .= ob_get_clean();

echo $output;
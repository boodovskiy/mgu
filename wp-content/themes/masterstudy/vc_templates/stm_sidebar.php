<?php
extract( shortcode_atts( array(
	'css' => '',
	'sidebar' => '0',
	'sidebar_position' => 'right'
), $atts ) );

$css_class = apply_filters( VC_SHORTCODE_CUSTOM_CSS_FILTER_TAG, vc_shortcode_custom_css_class( $css, ' ' ) );

$post_sidebar = get_post( $sidebar );
if( empty( $post_sidebar ) || $sidebar == '0' ){
	return;
};


?>

<style type="text/css">
	<?php echo get_post_meta( $sidebar, '_wpb_shortcodes_custom_css', true ); ?>
</style>

<div class="sidebar-area sidebar-area-<?php echo esc_attr($sidebar_position); ?> <?php echo esc_attr( $css_class ); ?>">
	<?php echo apply_filters( 'the_content' , $post_sidebar->post_content); ?>
</div>
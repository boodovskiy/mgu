<?php
$atts = vc_map_get_attributes( $this->getShortcode(), $atts );
extract( $atts );
$css_class = apply_filters( VC_SHORTCODE_CUSTOM_CSS_FILTER_TAG, vc_shortcode_custom_css_class( $css, ' ' ) );
$css_icon_class = apply_filters( VC_SHORTCODE_CUSTOM_CSS_FILTER_TAG, vc_shortcode_custom_css_class( $css_icon, ' ' ) );

$icon_inline_css = '';
if($icon_align == 'center') {
	$icon_inline_css = "style=height:".esc_attr($icon_height)."px" ;
} else {
	$icon_inline_css = "style=width:".esc_attr($icon_width)."px" ;
}

$link = vc_build_link( $link );

?>

<?php if(!empty($link['url'])): ?>
	<a 
		href="<?php echo esc_url($link['url']) ?>" 
		title="<?php if(!empty($link['title'])){ echo esc_attr($link['title']); }; ?>"
		<?php if(!empty($link['target'])): ?>
			target="_blank"
		<?php endif; ?>
	>
<?php endif; ?>

	<div class="icon_box<?php echo esc_attr( $css_class.' '.$link_color_style ); ?> clearfix" style="background:<?php echo esc_attr($box_bg_color); ?>; color:<?php echo esc_attr($box_text_color); ?>">
		<div class="icon_alignment_<?php echo esc_attr($icon_align); ?>">
			<?php if( $icon ){ ?>
				<div class="icon<?php echo esc_attr($css_icon_class); ?>" <?php echo esc_attr($icon_inline_css); ?>>
					<i style="font-size: <?php echo esc_attr( $icon_size ); ?>px; color:<?php echo esc_attr($icon_color); ?>" class="fa <?php echo esc_attr( $icon ); ?>"></i>
				</div>
			<?php } ?>
			
			<div class="icon_text">
				<?php if ( $title ) { ?>
					<<?php echo esc_attr($title_holder); ?> style="color:<?php echo esc_attr($box_text_color); ?>"><?php echo balanceTags( $title, true ); ?></<?php echo esc_attr($title_holder); ?>>
				<?php } ?>
				<?php echo wpb_js_remove_wpautop( $content, true ); ?>
			</div>
		</div> <!-- align icons -->
	</div>

<?php if(!empty($link['url'])): ?>
	</a>
<?php endif; ?>
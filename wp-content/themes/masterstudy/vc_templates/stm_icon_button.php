<?php
extract( shortcode_atts( array(
	'link' => '',
	'link_tooltip' => '',
	'btn_align' => 'left',
	'btn_size' => 'btn-normal-size',
	
	'button_color' => '#fff',
	'button_text_color_hover' => '',
	
	'button_bg_color' => 'transparent',
	'button_bg_color_hover' => 'transparent',
	
	'button_border_color' => '#48a7d4',
	'button_border_color_hover' => '',
	
	'icon' => '',
	'icon_size' => '16px',
	'css' => ''
), $atts ) );

$css_class = apply_filters( VC_SHORTCODE_CUSTOM_CSS_FILTER_TAG, vc_shortcode_custom_css_class( $css, ' ' ) );
$link = vc_build_link( $link );


$btn_rand_style = 'btn_number_'.rand(0,99999);

$btn_styles = "color:".$button_color."; background-color:".$button_bg_color."; border-color:".$button_border_color.";";
$icon_styles = "color:".$button_border_color."; border-color:".$button_border_color."; font-size:".$icon_size.'px;';

if(empty($icon)) {
	$btn_classes = 'btn btn-default btn-no-icon '.$btn_size;
} else {
	$btn_classes = 'icon-btn';
	$btn_styles = "color:".$button_color."; border-color:".$button_border_color.";";
}

?>


<?php if( !empty($link['url']) and !empty($link['title']) ): ?>
	<div class="heading_font text-<?php echo esc_attr($btn_align.' '.$css_class.' '.$btn_rand_style); ?>">
		<a href="<?php echo esc_attr($link['url']) ?>" class="<?php echo esc_attr($btn_classes); ?>" title="<?php echo esc_attr($link_tooltip); ?>" style="<?php echo esc_attr($btn_styles); ?>" <?php if(!empty($link['target']) ) echo 'target="' . $link['target'] . '"' ;?>>
			<?php if(!empty($icon)): ?>
				<i class="fa <?php echo esc_attr($icon); ?> icon_in_btn" style="<?php echo esc_attr($icon_styles); ?>"></i>
			<?php endif; ?>
			<span class="link-title" style="background-color:<?php echo esc_attr($button_bg_color); ?>;"><?php echo esc_attr($link['title']); ?></span>
		</a>
	</div>
<?php endif; ?>

<style>
	<?php if( !empty($button_bg_color_hover) and empty($icon) ): ?>
		.<?php echo esc_attr($btn_rand_style) ?> .btn.btn-default:after {
			background-color: <?php echo esc_attr($button_bg_color_hover); ?>;
		}
	<?php endif; ?>
	
	<?php if( !empty($button_text_color_hover) and empty($icon) ): ?>
		.<?php echo esc_attr($btn_rand_style) ?> .btn.btn-default:hover {
			color: <?php echo esc_attr($button_text_color_hover); ?> !important;
		}
	<?php endif; ?>
	
	<?php if(!empty($button_text_color_hover)): ?>
		.<?php echo esc_attr($btn_rand_style) ?> .icon-btn:hover .link-title{
			color: <?php echo esc_attr($button_text_color_hover) ?> !important;
		}
	<?php endif; ?>
	
	<?php if(!empty($button_bg_color_hover)): ?>
		.<?php echo esc_attr($btn_rand_style) ?> .icon-btn:hover .link-title {
			background-color: <?php echo esc_attr($button_bg_color_hover) ?> !important;
		}
	<?php endif; ?>
	
	<?php if(!empty($button_border_color_hover)): ?>
		.<?php echo esc_attr($btn_rand_style) ?> .icon-btn:hover{
			border-color: <?php echo esc_attr($button_border_color_hover) ?> !important;
		}
		.<?php echo esc_attr($btn_rand_style) ?> .icon-btn:hover .icon_in_btn{
			color: <?php echo esc_attr($button_border_color_hover) ?> !important;
			border-color: <?php echo esc_attr($button_border_color_hover) ?> !important;
		}
	<?php endif; ?>
	
</style>
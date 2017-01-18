<?php
extract( shortcode_atts( array(
	'title' => '',
	'counter_value' => '1000',
	'duration' => '2.5',
	'icon'  => '',
	'icon_size'  => '65',
	'icon_height'  => '90',
	'icon_text_alignment' => 'center',
	'icon_text_color' => '#fff',
	'counter_text_color' => '#eab830',
	'css'   => ''
), $atts ) );

if( ! wp_is_mobile() ){
	wp_enqueue_script( 'countUp.min.js' );
}

$css_class = apply_filters( VC_SHORTCODE_CUSTOM_CSS_FILTER_TAG, vc_shortcode_custom_css_class( $css, ' ' ) );
$id = rand(9,9999);
?>

<div class="stats_counter<?php echo esc_attr( $css_class ); ?> text-<?php echo esc_attr($icon_text_alignment); ?>" style="color:<?php echo esc_attr($icon_text_color); ?>">
	<?php if( $icon ){ ?>
		<div class="icon" style="height: <?php echo esc_attr( $icon_height ); ?>px;"><i style="font-size: <?php echo esc_attr( $icon_size ); ?>px;" class="fa <?php echo esc_attr( $icon ); ?>"></i></div>
	<?php } ?>
	<?php if( wp_is_mobile() ){ ?>
		<div class="h1" id="counter_<?php echo esc_attr( $id ); ?>" style="color:<?php echo esc_attr($counter_text_color); ?>"><?php echo esc_attr( $counter_value ); ?></div>
	<?php }else{ ?>
		<div class="h1" id="counter_<?php echo esc_attr( $id ); ?>" style="color:<?php echo esc_attr($counter_text_color); ?>"></div>
	<?php } ?>
	<?php if ( $title ) { ?>
		<div class="stats_counter_title h5" style="color:<?php echo esc_attr($icon_text_color); ?>"><?php echo balanceTags( $title, true ); ?></div>
	<?php } ?>
	<?php if( ! wp_is_mobile() ){ ?>
		<script type="text/javascript">
			jQuery(document).ready(function($) {
				var counter_<?php echo esc_attr( $id ); ?> = new countUp("counter_<?php echo esc_attr( $id ); ?>", 0, <?php echo esc_attr( $counter_value ); ?>, 0, <?php echo esc_attr( $duration ); ?>, {
					useEasing : true,
					useGrouping: true,
					separator : ',',
				});
				
				$(window).scroll(function(){
					if( $("#counter_<?php echo esc_attr( $id ); ?>").is_on_screen() ){
						counter_<?php echo esc_attr( $id ); ?>.start();
					}
				});
			});
		</script>
	<?php } ?>
</div>
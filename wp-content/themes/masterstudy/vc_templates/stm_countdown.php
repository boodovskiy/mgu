<?php
extract( shortcode_atts( array(
	'datepicker' => '',
	'label_color' => '',
	'css'   => ''
), $atts ) );
$css_class = apply_filters( VC_SHORTCODE_CUSTOM_CSS_FILTER_TAG, vc_shortcode_custom_css_class( $css, ' ' ) );

$countdown = rand(0,999999);
?>
<div class="text-center <?php echo esc_attr($css_class); ?>">
	<div class="stm_countdown" id="countdown_<?php echo esc_attr($countdown); ?>"></div>
</div>

<?php if(!empty($datepicker)): ?>
	<script type="text/javascript">
		jQuery(function($){
			var flash = false;
			var ts = <?php echo strtotime($datepicker) * 1000; ?>;
		    if((new Date()) < ts){
		        $('#countdown_<?php echo esc_attr($countdown); ?>').countdown({
			        timestamp   : ts,
			        callback    : function(days, hours, minutes, seconds){
				        var summaryTime = days + hours+ minutes + seconds;
				        if(summaryTime == 0) {
							$('#countdown_<?php echo esc_attr($countdown); ?>').html('<div class="countdown_ended h2">Time is up, sorry!</div>');
				        }
				        /*
if(flash){
					        $('#countdown_<?php echo esc_attr($countdown); ?> .countDiv').addClass('flash');
							flash = false;
					    } else {
						    $('#countdown_<?php echo esc_attr($countdown); ?> .countDiv').removeClass('flash');
							flash = true;
					    }
*/
			        }
			    });
		    } else {
			    $('#countdown_<?php echo esc_attr($countdown); ?>').html('<div class="countdown_ended h2">Time is up, sorry!</div>');
		    }
		});
	</script>
<?php endif; ?>

<?php if(!empty($label_color)): ?>
	<style>
		.stm_countdown .countdown_label {
			color: <?php echo esc_attr($label_color); ?> !important;
		}
	</style>
<?php endif; ?>
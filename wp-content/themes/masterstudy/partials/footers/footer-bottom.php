<?php if ( is_active_sidebar( 'footer_bottom' ) ) { ?>

		<?php 
			$footer_enabled = stm_option('footer_bottom');
			$widget_areas = stm_option('footer_bottom_columns');
			if( ! $widget_areas ){
				$widget_areas = 4;
			};
		?>
		<?php if ( $footer_enabled ) { ?>
		<div id="footer_bottom">
			<div class="footer_widgets_wrapper">
				<div class="container">
					<div class="widgets <?php echo 'cols_' . esc_attr( $widget_areas ); ?> clearfix">
						<?php dynamic_sidebar( 'footer_bottom' ); ?>
					</div>
				</div>
			</div>
		</div>
	
		<?php } ?>

<?php } ?>
			</div> <!--#main-->
		</div> <!--#wrapper-->
		<footer id="footer">
			<div class="footer_wrapper">
				<?php get_template_part('partials/footers/footer', 'top'); ?>
				<?php get_template_part('partials/footers/footer', 'bottom'); ?>
				<?php get_template_part('partials/footers/copyright'); ?>
			</div>
		</footer>
		
		<?php if(is_singular('events')): ?>
			<?php get_template_part( 'partials/event', 'form' ); ?>
		<?php endif; ?>
		
		<!-- Searchform -->
		<?php get_template_part('partials/searchform'); ?>
		
		<script type="text/javascript">
			var cf7_custom_image = '<?php echo esc_url( get_stylesheet_directory_uri() )  ?>/assets/img/';
		</script>
		
		<?php
			global $wp_customize;
			if( is_stm() && ! $wp_customize ){
				get_template_part( 'partials/frontend_customizer' );
			}
		?>
		
	<?php wp_footer(); ?>
	</body>
</html>
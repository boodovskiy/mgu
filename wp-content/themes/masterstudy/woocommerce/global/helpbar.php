<div class="stm_woo_helpbar clearfix">
	<div class="pull-left">
		<?php get_product_search_form(); ?>
	</div>
	<?php 
		$get_array = $_GET;
		$params_grid = array_merge($get_array, array("view_type" => "grid"));
		$new_query_grid = http_build_query($params_grid);
		
		$params_list = array_merge($get_array, array("view_type" => "list"));
		$new_query_list = http_build_query($params_list);
		
		$active_type = 'active_' . stm_option('shop_layout');
		if( isset($_GET['view_type']) and $_GET['view_type'] == 'list' ) {
			$active_type = 'active_list';
		} elseif ( isset($_GET['view_type']) and $_GET['view_type'] == 'grid' ) {
			$active_type = 'active_grid';
		}
	?>
	<div class="pull-right xs-right-help">
		<div class="clearfix">
			<div class="pull-right">
				<div class="view_type_switcher">
					<a class="view_grid <?php echo $active_type; ?>" href="?<?php echo esc_attr($new_query_grid); ?>">
						<i class="fa fa-th-large"></i>
					</a>
					<a class="view_list <?php echo $active_type; ?>" href="?<?php echo esc_attr($new_query_list); ?>">
						<i class="fa fa-th-list"></i>
					</a>
				</div>
			</div>
			<?php
				// Building terms args
				$taxonomy = array( 
				    'product_cat',
				);
				
				$args = array(
					'hide_empty' => true,
				);
				
				$terms = get_terms($taxonomy, $args); 
				
				$current_term = get_queried_object();

			?>
			<div class="pull-right select-xs-left">
				<?php //do_action( 'woocommerce_before_shop_loop' ); ?>
				<?php if(!empty($terms)): ?>
					<select id="product_categories_filter">
						<option value="<?php echo get_post_type_archive_link('product') ?>"><?php _e('All courses', 'stm_domain'); ?></option>
						<?php foreach($terms as $term): ?>
							<?php 
								$selected = '0';
								if(!empty($current_term->slug) and $term->slug == $current_term->slug){
									$selected = '1';
								} else {
									$selected = '0';
								}
							?>
							<option value="<?php echo esc_url(get_term_link($term)); ?>" <?php if($selected == '1'){ ?>selected<?php } ?>><?php echo $term->name; ?></option>
						<?php endforeach; ?>
					</select>
				<?php endif; ?>
			</div>
		</div>
	</div>
</div>
<?php
extract( shortcode_atts( array(
	'name' => '',
	'image' => '',
	'post_list_data_source' => 'post',
	'post_list_per_page' => '3',
	'post_list_per_row' => '3',
	'post_list_show_date' => '',
	'post_list_show_cats' => '',
	'post_list_show_tags' => '',
	'post_list_show_comments' => '',
), $atts ) );

$query = new WP_Query( array( 'post_type' => $post_list_data_source, 'posts_per_page' => $post_list_per_page ) );

?>
<?php 
	// Set bootstrap cols in order with chosen per row
	$post_list_item_col = 12/$post_list_per_row;
	$current_list_item = 0;
?>

<?php if($query->have_posts()): ?>
	<div class="post_list_main_section_wrapper">
		<?php /*if($post_list_title): ?>
			<div class="post_list_section_main_title text-<?php echo esc_attr($post_list_title_alignment); ?>">
				<h1><?php echo esc_attr($post_list_title); ?></h1>
			</div>
		<?php endif; */?>
		<div class="row">
			<?php while($query->have_posts()): $query->the_post(); $current_list_item++; ?>
				<div class="col-md-<?php echo esc_attr($post_list_item_col); ?> col-sm-<?php echo esc_attr($post_list_item_col); ?> col-xs-12">
					<div class="post_list_content_unit">
						<?php if(has_post_thumbnail()): ?>
							<div class="post_list_featured_image">
								<a href="<?php the_permalink() ?>" title="<?php _e('View post details', 'stm_domain'); ?>">
									<?php the_post_thumbnail('img-370-193', array('class'=>'img-responsive')); ?>
								</a>
							</div>
						<?php endif; ?>
						<div class="row">
							<?php if($post_list_show_date): ?>
								<div class="col-md-3 col-sm-4 col-xs-12">
									<div class="post_list_meta_unit">
										<div class="date-d"><?php echo get_the_date('d'); ?></div>
										<div class="date-m"><?php echo get_the_date('M'); ?></div>
										<?php if($post_list_show_comments): ?>
											<?php $comments_num = get_comments_number(get_the_id()); ?>
											<?php if($comments_num): ?>
												<div class="post_list_comment_num">
													<span><?php echo esc_attr($comments_num); ?></span><i class="fa-icon-stm_icon_comment_o"></i>
												</div>
											<?php endif; ?>
										<?php endif; ?>
										<?php if(is_sticky(get_the_id())): ?>
											<div class="sticky_post heading_font"><?php _e('Sticky Post','stm_domain'); ?></div>
										<?php endif; ?>
									</div>
								</div>
							<?php endif; ?> 
							<div class="<?php if($post_list_show_date) { ?>col-md-9 col-sm-8 col-xs-12 <?php } else { ?>col-md-12<?php } ?>">
								<div class="post_list_inner_content_unit <?php if($post_list_show_date) { ?>post_list_inner_content_unit_left<?php } ?>">
									<a href="<?php the_permalink(); ?>" class="post_list_item_title h3"><?php the_title(); ?></a>
									<div class="post_list_item_excerpt"><?php the_excerpt(); ?></div>
									<div class="short_separator"></div>
									
									<?php if($post_list_show_cats): ?>
										<!-- Post cats -->
										<?php $post_list_item_categories = wp_get_post_categories( get_the_id() );
										if(!empty($post_list_item_categories)): ?>
											<div class="post_list_cats">
												<span class="post_list_cats_label"><?php _e('Posted in:', 'stm_domain'); ?></span>
												<?php foreach($post_list_item_categories as $post_list_single_cat): ?>
													<?php $post_list_cat = get_category( $post_list_single_cat ); ?>
													<a href="<?php echo esc_url(get_term_link($post_list_cat)); ?>"><?php echo($post_list_cat->name); ?></a><span class="post_list_divider">,</span>
												<?php endforeach; ?>
											</div>
										<?php endif; ?>
									<?php endif; ?>
									
									<!-- Post tags -->
									<?php if($post_list_show_tags): ?>
									<?php 
										$posttags = get_the_tags();
										if ($posttags): ?>
											<div class="post_list_item_tags">
												<span class="post_list_tags_label"><?php _e('Tags:', 'stm_domain'); ?></span>
												<?php foreach($posttags as $tag): ?>
													<a href="<?php echo get_tag_link($tag->term_id); ?>"><?php echo($tag->name); ?></a><span class="post_list_divider">,</span>
												<?php endforeach; ?>
											</div>	
										<?php endif; ?>
									<?php endif; ?>
								</div> <!-- post_list_inner_content_unit -->
							</div> <!-- inner col -->
						</div> <!-- row -->
					</div> <!-- post_list_content_unit -->
				</div> <!-- col -->
				<?php if($current_list_item%$post_list_per_row == 0): ?>
					</div> <!-- close row to prevent blocks jumping -->
					<div class="row">
				<?php endif; ?>
			<?php endwhile; ?>
		</div> <!-- row -->
	</div> <!-- post_list_main_section_wrapper -->
	<?php wp_reset_postdata(); ?>
<?php endif; ?>
<?php
$blog_sidebar_position = stm_option( 'blog_sidebar_position', 'none');

if( !empty( $_GET['sidebar_position'] ) and $_GET['sidebar_position'] == 'right'  ){
	$blog_sidebar_position = 'right';
} 
elseif( !empty( $_GET['sidebar_position'] ) and $_GET['sidebar_position'] == 'left'  ){
	$blog_sidebar_position = 'left';
} 
elseif( !empty( $_GET['sidebar_position'] ) and $_GET['sidebar_position'] == 'none'  ){
	$blog_sidebar_position = 'none';
}

$blog_col_layout = 'col-md-4 col-sm-6 col-xs-12';
if($blog_sidebar_position != 'none') {
	$blog_col_layout = 'col-md-6 col-sm-6 col-xs-12 blog-cols-sidebar';
}
?>

<div class="<?php echo $blog_col_layout; ?>">
	<div class="post_list_content_unit">
		<?php if(has_post_thumbnail()): ?>
			<div>
				<div class="post_list_featured_image">
					<a href="<?php the_permalink() ?>" title="<?php _e('Watch full', 'stm_domain'); ?>">
						<?php the_post_thumbnail('img-370-193', array('class'=>'img-responsive')); ?>
					</a>
				</div>
			</div>
		<?php endif; ?>
		<div class="post_list_meta_unit">
			<div class="date-d"><?php echo get_the_date('d'); ?></div>
			<div class="date-m"><?php echo get_the_date('M'); ?></div>
				<?php $comments_num = get_comments_number(get_the_id()); ?>
				<?php if($comments_num): ?>
					<div class="post_list_comment_num">
						<span><?php echo esc_attr($comments_num); ?></span><i class="fa-icon-stm_icon_comment_o"></i>
					</div>
				<?php endif; ?>
			<?php if(is_sticky(get_the_id())): ?>
				<div class="sticky_post heading_font"><?php _e('Sticky Post','stm_domain'); ?></div>
			<?php endif; ?>
		</div>
		<div class="post_list_inner_content_unit post_list_inner_content_unit_left">
			<?php if (get_the_title()){ ?>
				<a href="<?php the_permalink(); ?>" class="post_list_item_title h3"><?php the_title(); ?></a>
			<?php }else{ ?>
				<a href="<?php the_permalink(); ?>" class="post_list_item_title h3"><?php _e('No title', 'stm_domain') ?></a>
			<?php } ?>
			
			<div class="post_list_item_excerpt"><?php the_excerpt(); ?></div>
			<div class="short_separator"></div>
			
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
			
			<!-- Post tags -->
			<?php  $posttags = get_the_tags();
			if ($posttags): ?>
				<div class="post_list_item_tags">
					<span class="post_list_tags_label"><?php _e('Tags:', 'stm_domain'); ?></span>
					<?php foreach($posttags as $tag): ?>
						<a href="<?php echo get_tag_link($tag->term_id); ?>"><?php echo($tag->name); ?></a><span class="post_list_divider">,</span>
					<?php endforeach; ?>
				</div>	
			<?php endif; ?>
		</div> <!-- post_list_inner_content_unit -->
	</div> <!-- post_list_content_unit -->
</div> <!-- col -->
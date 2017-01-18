<?php
extract( shortcode_atts( array(
	'title' => '',
	'masonry' => '',
	'per_page' => '12',
	'css'   => ''
), $atts ) );
$css_class = apply_filters( VC_SHORTCODE_CUSTOM_CSS_FILTER_TAG, vc_shortcode_custom_css_class( $css, ' ' ) );

$paged = get_query_var( 'paged', 1 );

$gallery = new WP_Query( array( 'post_type' => 'gallery', 'posts_per_page' => $per_page, 'paged' => $paged ) );


$category_name = 'gallery_category';
$args = array( 
	'order' => 'ASC'
); 
$terms = get_terms($category_name , $args);

$title_empty = '';
?>

<?php if($gallery->have_posts()): ?>

	<div class="row gallery_entry_unit">
		<?php if(!empty($title)): ?>
			<div class="col-md-4 col-sm-3"><h2 class="archive_title_gallery"><?php echo esc_attr($title); ?></h2></div>
		<?php else:
			$title_empty = 'col-md-offset-4 col-sm-offset-4 col-xs-offset-0';
		endif; ?>
	
		<?php if(!empty($terms)): ?>
			<div class="col-md-8 col-sm-9 <?php echo $title_empty; ?>">
				<ul class="gallery_terms_list heading_font xs-text-left">
					<li class="active all">
						<a href="#" data-filter=".all"><?php _e('All images', 'stm_domain'); ?></a>
					</li>
					<?php foreach ($terms as $term): ?>
						<li>
							<a href="#" data-filter=".<?php echo($term->slug) ?>"><?php echo($term->name) ?></a>
						</li>
					<?php endforeach; ?>
				</ul>
			</div>
		<?php endif; ?>
		
	</div>
	
	<div class="wait-for-images">
		<div id="stm_isotope" class="row">
	        <?php while ( $gallery->have_posts() ): $gallery->the_post(); ?>
				
				<?php $terms = (get_the_terms( get_the_ID(), 'gallery_category' )); ?> 
					<div class="col-md-3 col-sm-4 col-xs-6 stm-isotope-item teacher-col gallery-col all <?php if(!empty($terms)): foreach($terms as $term):echo($term->slug).' '; endforeach; endif; ?>">
							
						<?php if(has_post_thumbnail()): ?>
							<div class="gallery_single_view">
								<div class="gallery_img">
									<?php $url_big = wp_get_attachment_image_src( get_post_thumbnail_id(get_the_id()), 'full' ); ?>
									<a class="stm_fancybox" 
										href="<?php echo esc_url($url_big[0]); ?>" 
										title="<?php _e('Watch full image', 'stm_domain'); ?>"
										data-caption="<?php the_title(); ?>"
										rel="gallery_rel">
											<?php 
												if($masonry and !empty($masonry)){
													the_post_thumbnail('full', array('class'=>'img-responsive'));
												} else {
													the_post_thumbnail('img-270-180', array('class'=>'img-responsive'));
												}
											?>
									</a>
								</div>
							</div>
						<?php endif; ?>
							
					</div>
				
	        <?php endwhile; ?>
		</div>
	</div>
	
	<div class="multiseparator gallery_sep"></div>
	
	<?php
		echo paginate_links( array(
			'type'      => 'list',
			'total' => $gallery->max_num_pages,
			'prev_text' => '<i class="fa fa-chevron-left"></i><span class="pagi_label">'.__('Previous', 'stm_domain').'</span>',
			'next_text' => '<span class="pagi_label">'.__('Next', 'stm_domain').'</span><i class="fa fa-chevron-right"></i>',
		) );
	?>

<?php endif; ?>
<?php

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/**
 * Top Rated Products Widget
 *
 * Gets and displays top rated products in an unordered list
 *
 * @author   WooThemes
 * @category Widgets
 * @package  WooCommerce/Widgets
 * @version  2.5
 * @extends  WC_Widget
 */
class WC_Widget_Stm_Top_Rated_Products extends WC_Widget {

	/**
	 * Constructor
	 */
	public function __construct() {
		$this->widget_cssclass    = 'stm_widget_top_rated_products';
		$this->widget_description = __( 'Display a list of your top rated products on your site with course expert.', 'stm_domain' );
		$this->widget_id          = 'stm_widget_top_rated_products';
		$this->widget_name        = __( 'STM WooCommerce Top Rated Products', 'stm_domain' );
		$this->settings           = array(
			'title'  => array(
				'type'  => 'text',
				'std'   => __( 'Popular courses', 'stm_domain' ),
				'label' => __( 'Title', 'stm_domain' )
			),
			'style'  => array(
				'type'  => 'select',
				'std'   => __( 'style_1', 'stm_domain' ),
				'options' => array(
					'style_1' => 'Style 1',
					'style_2' => 'Style 2',
				),
				'label' => __( 'Style', 'stm_domain' )
			),
			'number' => array(
				'type'  => 'number',
				'step'  => 1,
				'min'   => 1,
				'max'   => '',
				'std'   => 5,
				'label' => __( 'Number of products to show', 'stm_domain' )
			)
		);

		parent::__construct();
	}

	public function widget( $args, $instance ) {

		if ( $this->get_cached_widget( $args ) ) {
			return;
		}

		ob_start();

		$number = ! empty( $instance['number'] ) ? absint( $instance['number'] ) : $this->settings['number']['std'];
		
		
		$style = ! empty( $instance['style'] ) ? $instance['style'] : $this->settings['style']['std'];
		

		add_filter( 'posts_clauses',  array( WC()->query, 'order_by_rating_post_clauses' ) );

		$query_args = array( 'posts_per_page' => $number, 'no_found_rows' => 1, 'post_status' => 'publish', 'post_type' => 'product' );

		$query_args['meta_query'] = WC()->query->get_meta_query();

		$r = new WP_Query( $query_args );

		if ( $r->have_posts() ) {

			$this->widget_start( $args, $instance );

			echo '<ul class="stm_product_list_widget widget_woo_stm_'.$style.'">';

			while ( $r->have_posts() ) {
				$r->the_post();
				global $product; ?>
				
				<?php $experts = get_post_meta($product->id, 'course_expert', true);?>
				
				
				<?php if($style == 'style_1'): ?>
					<?php $stm_prod_image = wp_get_attachment_image_src( get_post_thumbnail_id($product->id), 'img-50-50' ); ?>
					<li>
						<a href="<?php echo esc_url( get_permalink( $product->id ) ); ?>" title="<?php echo esc_attr( $product->get_title() ); ?>">
							<img class="img-responsive" src="<?php echo esc_attr($stm_prod_image[0]); ?> " />
							<div class="meta">
								<div class="title"><?php echo balanceTags($product->get_title()); ?></div>
								<?php if( !empty($experts) and $experts != 'no_expert' and (is_array($experts) && !in_array("no_expert", $experts) ) ): ?>
										<?php if( is_array($experts) ){ ?>
											<div class="expert"><?php _e('By', 'stm_domain'); ?> 
											<?php foreach( $experts as $expert ){ ?>	
												<?php echo esc_attr(get_the_title($expert)); ?><br/>
											<?php }?>
											</div>
										<?php }else{ ?>
											<div class="expert"><?php _e('By', 'stm_domain'); ?> <?php echo esc_attr(get_the_title($experts)); ?></div>
										<?php }?>
								<?php endif; ?>
							</div>
						</a>
					</li>
				<?php else: ?>
					<?php 
					$stm_prod_image = wp_get_attachment_image_src( get_post_thumbnail_id($product->id), 'img-75-75' );
					$regular_price = get_post_meta(get_the_id(), '_regular_price', true ); 
					$sale_price = get_post_meta(get_the_id(), '_sale_price', true );
					?>
					<li>
						<a href="<?php echo esc_url( get_permalink( $product->id ) ); ?>" title="<?php echo esc_attr( $product->get_title() ); ?>">
							<img class="img-responsive" src="<?php echo esc_attr($stm_prod_image[0]); ?> " />
							<div class="meta">
								<div class="title h5"><?php echo balanceTags($product->get_title()); ?></div>								
								<div class="stm_featured_product_price">
									<?php if(!empty($sale_price) and $sale_price != 0): ?>
										<div class="price">
											<?php echo esc_attr($sale_price .' '. get_woocommerce_currency_symbol()); ?>
										</div>
									<?php elseif(!empty($regular_price) and $regular_price != 0): ?>
										<div class="price">
											<?php echo esc_attr($regular_price .' '. get_woocommerce_currency_symbol()); ?>
										</div>
									<?php else: ?>
										<div class="price price_free">
											<?php _e('Free', 'stm_domain'); ?>
										</div>
									<?php endif; ?>
								</div>
								<div class="rating">
									<?php do_action( 'woocommerce_after_shop_loop_item_title' ); ?>
								</div>
									<?php if( !empty($experts) and $experts != 'no_expert' and (is_array($experts) && !in_array("no_expert", $experts) ) ): ?>
										<?php if( is_array($experts) ){ ?>
											<div class="expert">
											<?php foreach( $experts as $expert ){ ?>	
												<?php echo esc_attr(get_the_title($expert)); ?><br/>
											<?php }?>
											</div>
										<?php }else{ ?>
											<div class="expert"><?php echo esc_attr(get_the_title($experts)); ?></div>
										<?php }?>
								<?php endif; ?>
							</div>
						</a>
					</li>
				<?php endif; ?>
			<?php }

			echo '</ul>';

			$this->widget_end( $args );
		}

		remove_filter( 'posts_clauses', array( WC()->query, 'order_by_rating_post_clauses' ) );

		wp_reset_postdata();

		$content = ob_get_clean();

		echo $content;

		$this->cache_widget( $args, $content );
	}
}

function wpb_load_widget() {
    register_widget( 'WC_Widget_Stm_Top_Rated_Products' );
}

add_action( 'widgets_init', 'wpb_load_widget' );
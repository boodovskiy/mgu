<?php
/**
 * The Template for displaying product archives, including the main shop page which is a post type archive.
 *
 * Override this template by copying it to yourtheme/woocommerce/archive-product.php
 *
 * @author 		WooThemes
 * @package 	WooCommerce/Templates
 * @version     2.0.0
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}

get_header(); ?>

<?php
	$shop_sidebar_id = stm_option( 'shop_sidebar' );
	$shop_sidebar_position = stm_option( 'shop_sidebar_position', 'none' );
	$content_before = $content_after =  $sidebar_before = $sidebar_after = '';
	
	// For demo
	if(isset($_GET['sidebar_position']) and $_GET['sidebar_position']=='right') {
		$shop_sidebar_position = 'right';
	} elseif (isset($_GET['sidebar_position']) and $_GET['sidebar_position']=='left') {
		$shop_sidebar_position = 'left';
	} elseif (isset($_GET['sidebar_position']) and $_GET['sidebar_position'] == 'none') {
		$shop_sidebar_position = 'none';
	}
		
	if( $shop_sidebar_id ) {
		$shop_sidebar = get_post( $shop_sidebar_id );
	}
	
	if( $shop_sidebar_position == 'right' && isset( $shop_sidebar ) ) {
		$content_before .= '<div class="row">';
			$content_before .= '<div class="col-lg-9 col-md-9 col-sm-12 col-xs-12">';
				$content_before .= '<div class="sidebar_position_right">';
				// .products
				$content_after .= '</div>'; // sidebar right
			$content_after .= '</div>'; // col
			$sidebar_before .= '<div class="col-lg-3 col-md-3 hidden-sm hidden-xs">';
				$sidebar_before .= '<div class="sidebar-area sidebar-area-right">';
				// .sidebar-area
				$sidebar_after .= '</div>'; // sidebar area
			$sidebar_after .= '</div>'; // col
		$sidebar_after .= '</div>'; // row
	}
	
	if( $shop_sidebar_position == 'left' && isset( $shop_sidebar ) ) {
		$content_before .= '<div class="row">';
			$content_before .= '<div class="col-lg-9 col-lg-push-3 col-md-9 col-md-push-3 col-sm-12 col-xs-12">';
				$content_before .= '<div class="sidebar_position_left">';
				// .products
				$content_after .= '</div>'; // sidebar right
			$content_after .= '</div>'; // col
			$sidebar_before .= '<div class="col-lg-3 col-lg-pull-9 col-md-3 col-md-pull-9 hidden-sm hidden-xs">';
				$sidebar_before .= '<div class="sidebar-area sidebar-area-left">';
				// .sidebar-area
				$sidebar_after .= '</div>'; // sidebar area
			$sidebar_after .= '</div>'; // col
		$sidebar_after .= '</div>'; // row
	};
	
	
	// Grid or list
	$layout_products = stm_option('shop_layout');
	if( isset($_GET['view_type']) ){
		if( $_GET['view_type'] == 'list' ){
			$layout_products = 'list';
		}else{
			$layout_products = 'grid';
		}
	}
?>
	<?php get_template_part('partials/title_box'); ?>

	<div class="container">
		
	
		<?php echo $content_before; ?>
			<?php if ( apply_filters( 'woocommerce_show_page_title', true ) ) : ?>
				<h2 class="archive-course-title"><?php woocommerce_page_title(); ?></h2>
			<?php endif; ?>
		
			<?php do_action( 'woocommerce_archive_description' ); ?>
			
			<?php wc_get_template_part('global/helpbar'); ?>
			
			<div class="stm_archive_product_inner_grid_content">
				<?php if ( have_posts() ) : ?>
		
					<?php woocommerce_product_loop_start(); ?>
		
						<?php woocommerce_product_subcategories(); ?>
		
						<?php while ( have_posts() ) : the_post(); ?>
						
							<?php if( $layout_products == 'list' ): ?>
							
								<div class="stm_woo_archive_view_type_list">

									<?php wc_get_template_part( 'content', 'product-list' ); ?>
									
								</div>
							
							<?php else: ?>

								<?php wc_get_template_part( 'content', 'product' ); ?>
							
							<?php endif; ?>
		
						<?php endwhile; // end of the loop. ?>
		
					<?php woocommerce_product_loop_end(); ?>
		
					<div class="multiseparator <?php echo esc_attr($layout_products); ?>"></div>
		
					<?php do_action( 'woocommerce_after_shop_loop' ); /* Pagination */ ?>
		
				<?php elseif ( ! woocommerce_product_subcategories( array( 'before' => woocommerce_product_loop_start( false ), 'after' => woocommerce_product_loop_end( false ) ) ) ) : ?>
		
					<?php wc_get_template( 'loop/no-products-found.php' ); ?>
		
				<?php endif; ?>
						
					
			</div> <!-- stm_product_inner_grid_content -->
		<?php echo $content_after; ?>
			
		<?php echo $sidebar_before; ?>
			<?php
				if( isset( $shop_sidebar ) && $shop_sidebar_position != 'none' ) {
					echo apply_filters( 'the_content' , $shop_sidebar->post_content);;
				}
			?>					
		<?php echo $sidebar_after; ?>
	</div> <!-- container -->

<?php get_footer(); ?>

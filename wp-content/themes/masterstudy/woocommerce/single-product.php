<?php
/**
 * The Template for displaying all single products.
 *
 * Override this template by copying it to yourtheme/woocommerce/single-product.php
 *
 * @author 		WooThemes
 * @package 	WooCommerce/Templates
 * @version     1.6.4
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}

get_header(); 


	$shop_sidebar_id = stm_option( 'shop_sidebar' );
	$shop_sidebar_position = stm_option( 'shop_sidebar_position', 'none' );
	$content_before = $content_after =  $sidebar_before = $sidebar_after = '';
	
	// For demo
	if(isset($_GET['sidebar_position']) and $_GET['sidebar_position']=='right') {
		$shop_sidebar_position = 'right';
	} elseif (isset($_GET['sidebar_position']) and $_GET['sidebar_position']=='left') {
		$shop_sidebar_position = 'left';
	}
		
	if( $shop_sidebar_id ) {
		$shop_sidebar = get_post( $shop_sidebar_id );
	}
	
	if( $shop_sidebar_position == 'right' ) {
		$content_before .= '<div class="row">';
			$content_before .= '<div class="col-lg-9 col-md-9 col-sm-12 col-xs-12">';
				// .products
			$content_after .= '</div>'; // col
			$sidebar_before .= '<div class="col-lg-3 col-md-3 hidden-sm hidden-xs">';
				// .sidebar-area
			$sidebar_after .= '</div>'; // col
		$sidebar_after .= '</div>'; // row
	}
	
	if( $shop_sidebar_position == 'left' ) {
		$content_before .= '<div class="row">';
			$content_before .= '<div class="col-lg-9 col-lg-push-3 col-md-9 col-md-push-3 col-sm-12 col-xs-12">';
				// .products
			$content_after .= '</div>'; // col
			$sidebar_before .= '<div class="col-lg-3 col-lg-pull-9 col-md-3 col-md-pull-9 hidden-sm hidden-xs">';
				// .sidebar-area
			$sidebar_after .= '</div>'; // col
		$sidebar_after .= '</div>'; // row
	};
	
	// Breads
	get_template_part('partials/title_box'); 
?>

	<div class="container">
		
		<div class="row">
			<div class="col-md-12">
				<?php				
				/**
				 * woocommerce_before_single_product hook
				 *
				 * @hooked wc_print_notices - 10
				 */
				 do_action( 'woocommerce_before_single_product' );
				 ?>
			</div>
		</div>
		
		<?php echo $content_before; ?>
			
			<div class="sidebar_position_<?php echo $shop_sidebar_position; ?>">
				<?php while ( have_posts() ) : the_post(); ?>
		
					<?php wc_get_template_part( 'content', 'single-product' ); ?>
		
				<?php endwhile; // end of the loop. ?>
			</div>
		
		<?php echo $content_after; ?>
		
		<?php echo $sidebar_before; ?>
		
			<div class="stm_product_meta_single_page <?php echo $shop_sidebar_position; ?>">
				<?php while ( have_posts() ) : the_post(); ?>
		
					<?php wc_get_template_part( 'content', 'single-product-meta-side' ); ?>
		
				<?php endwhile; // end of the loop. ?>
			</div>
			
			<div class="shop_sidebar_single_page sidebar-area sidebar-area-<?php echo $shop_sidebar_position; ?>">
				<?php
					if( isset( $shop_sidebar ) && $shop_sidebar_position != 'none' ) {
						echo apply_filters( 'the_content' , $shop_sidebar->post_content);
					}
				?>
			</div>
			
		<?php echo $sidebar_after; ?>
			
	</div> <!-- container -->

<?php get_footer(); ?>

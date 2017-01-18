<?php
/**
 * Simple product add to cart
 *
 * @author 		WooThemes
 * @package 	WooCommerce/Templates
 * @version     2.1.0
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}

global $product;

if ( ! $product->is_purchasable() ) {
	return;
}

?>

<?php
	// Availability
	$availability      = $product->get_availability();
	$availability_html = empty( $availability['availability'] ) ? '' : '<p class="stock ' . esc_attr( $availability['class'] ) . '">' . esc_html( $availability['availability'] ) . '</p>';

	echo apply_filters( 'woocommerce_stock_html', $availability_html, $availability['availability'], $product );
	
	$woo_stm_btn_link = get_post_meta(get_the_id(), 'woo_course_url', true);
	$woo_stm_btn_label = get_post_meta(get_the_id(), 'woo_course_label', true);
	
?>

<?php if(empty($woo_stm_btn_label) and empty($woo_stm_btn_link)): ?>

	<?php if ( $product->is_in_stock() ) : ?>
	
		<?php do_action( 'woocommerce_before_add_to_cart_form' ); ?>
	
		<form class="cart" method="post" enctype='multipart/form-data'>
		 	<?php do_action( 'woocommerce_before_add_to_cart_button' ); ?>
	
		 	<?php
		 		if ( ! $product->is_sold_individually() )
		 			woocommerce_quantity_input( array(
		 				'min_value' => apply_filters( 'woocommerce_quantity_input_min', 1, $product ),
		 				'max_value' => apply_filters( 'woocommerce_quantity_input_max', $product->backorders_allowed() ? '' : $product->get_stock_quantity(), $product )
		 			) );
		 	?>
	
		 	<input type="hidden" name="add-to-cart" value="<?php echo esc_attr( $product->id ); ?>" />
	
		 	<button type="submit" class="single_add_to_cart_button button alt"><?php echo $product->single_add_to_cart_text(); ?></button>
	
			<?php do_action( 'woocommerce_after_add_to_cart_button' ); ?>
		</form>
	
		<?php do_action( 'woocommerce_after_add_to_cart_form' ); ?>
	
	<?php endif; ?>

<?php else: ?>
	<a href="<?php echo esc_attr($woo_stm_btn_link) ?>" class="single_add_to_cart_button single_add_to_cart_button_link button alt"><?php echo esc_attr($woo_stm_btn_label); ?></a>
<?php endif; ?>
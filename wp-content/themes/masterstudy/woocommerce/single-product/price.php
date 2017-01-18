<?php
/**
 * Single Product Price, including microdata for SEO
 *
 * @author 		WooThemes
 * @package 	WooCommerce/Templates
 * @version     2.4.9
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}

global $product;

?>
<div itemprop="offers" itemscope itemtype="http://schema.org/Offer">
	
	<?php 
		/* check for price */ 
		$noPrice = $product->get_price_html();
	?>
	<?php if(!empty($noPrice)): ?>
		<p class="price heading_font">
			<label class="h6 stm_price_label"><?php _e('Price', 'stm_domain'); ?></label>
			<?php echo $product->get_price_html(); ?>
		</p>
	<?php endif; ?>

	<meta itemprop="price" content="<?php echo $product->get_price(); ?>" />
	<meta itemprop="priceCurrency" content="<?php echo get_woocommerce_currency(); ?>" />
	<link itemprop="availability" href="http://schema.org/<?php echo $product->is_in_stock() ? 'InStock' : 'OutOfStock'; ?>" />

</div>

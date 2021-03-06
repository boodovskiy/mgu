<?php
/**
 * Shop breadcrumb
 *
 * @author 		WooThemes
 * @package 	WooCommerce/Templates
 * @version     2.3.0
 * @see         woocommerce_breadcrumb()
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

if ( $breadcrumb ) {

	echo $wrap_before; ?>
		
		<div class="container">
			<?php foreach ( $breadcrumb as $key => $crumb ) {
		
				echo $before;
		
				if ( ! empty( $crumb[1] ) && sizeof( $breadcrumb ) !== $key + 1 ) {
					echo '<a href="' . esc_url( $crumb[1] ) . '">' . esc_html( $crumb[0] ) . '</a>';
				} else {
					echo esc_html( $crumb[0] );
				}
		
				echo $after;
		
				if ( sizeof( $breadcrumb ) !== $key + 1 ) {
					echo $delimiter;
				}
		
			} ?>
		</div>

	<?php echo $wrap_after;

}
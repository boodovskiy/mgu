<?php
/**
 * Single Product Thumbnails
 *
 * @author 		WooThemes
 * @package 	WooCommerce/Templates
 * @version     2.3.0
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}

global $post, $product, $woocommerce;

$attachment_ids = $product->get_gallery_attachment_ids();

if ( $attachment_ids ) {
	$loop 		= 0;
	$columns 	= apply_filters( 'woocommerce_product_thumbnails_columns', 3 );
	?>
	<div class="text-center"><div class="stm_thumnbails_gallery_unit"><div class="thumbnails hidden-xs stm_thumnbails_gallery <?php echo 'columns-' . $columns; ?>"><?php
		
		
		// First Image of gallery - product thumb
		if ( has_post_thumbnail() ) {

			$image_title 	= esc_attr( get_the_title( get_post_thumbnail_id() ) );
			$image_caption 	= get_post( get_post_thumbnail_id() )->post_excerpt;
			$image_link  	= wp_get_attachment_url( get_post_thumbnail_id() );
			$image       	= get_the_post_thumbnail( $post->ID, apply_filters( 'single_product_small_thumbnail_size', 'shop_thumbnail' ), array(
				'title'	=> $image_title,
				'alt'	=> $image_title
				) );
				
			$thumbnail_id = get_post_thumbnail_id($post->ID);
			$image_full_main = wp_get_attachment_image_src($thumbnail_id, 'full');

			$attachment_count = count( $product->get_gallery_attachment_ids() );

			if ( $attachment_count > 0 ) {
				$gallery = '[product-gallery]';
			} else {
				$gallery = '';
			}
			?>
			
				<a href="#" class="first" data-custom="stm_slide-<?php echo($thumbnail_id); ?>">
					<?php echo $image; ?>
				</a>
				
			<?php
		} else {

			echo apply_filters( 'woocommerce_single_product_image_html', sprintf( '<img src="%s" alt="%s" />', wc_placeholder_img_src(), __( 'Placeholder', 'woocommerce' ) ), $post->ID );

		}
		
		
		foreach ( $attachment_ids as $attachment_id ) {

			$classes = array( 'stm_shop_thumb' );

			if ( $loop == 0 || $loop % $columns == 0 )
				$classes[] = 'first';

			if ( ( $loop + 1 ) % $columns == 0 )
				$classes[] = 'last';

			$image_link = wp_get_attachment_url( $attachment_id );
			

			if ( ! $image_link )
				continue;

			$image       = wp_get_attachment_image( $attachment_id, apply_filters( 'single_product_small_thumbnail_size', 'shop_thumbnail' ) );
			$image_class = esc_attr( implode( ' ', $classes ) );
			$image_title = esc_attr( get_the_title( $attachment_id ) ); ?>
			
			<a href="#" data-custom="slide_id-<?php echo($attachment_id); ?>">
				<?php echo $image; ?>
			</a>

			<?php $loop++;
		}

	?></div></div></div>
	<?php
}

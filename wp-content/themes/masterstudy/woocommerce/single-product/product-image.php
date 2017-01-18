<?php
/**
 * Single Product Image
 *
 * @author 		WooThemes
 * @package 	WooCommerce/Templates
 * @version     2.0.14
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}

global $post, $woocommerce, $product;

?>
<div class="images">
	<div class="stm_custom_product_gallery">

		<?php
			if ( has_post_thumbnail() ) {
	
				$image_title 	= esc_attr( get_the_title( get_post_thumbnail_id() ) );
				$image_caption 	= get_post( get_post_thumbnail_id() )->post_excerpt;
				$image_link  	= wp_get_attachment_url( get_post_thumbnail_id() );
				$image       	= get_the_post_thumbnail( $post->ID, apply_filters( 'single_product_large_thumbnail_size', 'shop_single' ), array(
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
				
					<a href="<?php echo $image_full_main[0] ?>" class="stm_fancybox stm_product_gallery_images active" data-custom="stm_slide-<?php echo($thumbnail_id); ?>" rel="stm_product_gallery">
						<?php echo $image; ?>
					</a>
					
				<?php
			} else {
	
				echo apply_filters( 'woocommerce_single_product_image_html', sprintf( '<img src="%s" alt="%s" />', wc_placeholder_img_src(), __( 'Placeholder', 'woocommerce' ) ), $post->ID );
	
			}
		?>
		
		<!-- Gallery images -->
		<?php $attachment_ids = $product->get_gallery_attachment_ids(); 
		if ( $attachment_ids ) {
			$loop = 0;
			foreach ( $attachment_ids as $attachment_id ) {
				$loop++;
			
				$image = wp_get_attachment_image( $attachment_id, apply_filters( 'single_product_large_thumbnail_size', 'shop_single' ) );
				
				$image_full = wp_get_attachment_image_src($attachment_id, 'full'); ?>
				
				<a data-custom="slide_id-<?php echo esc_attr($attachment_id); ?>" href="<?php echo esc_url($image_full[0]); ?>" class="stm_fancybox stm_product_gallery_images" rel="stm_product_gallery">
					<?php echo $image; ?>
				</a>
			<?php };
		} ?>
	</div>
	
	<?php do_action( 'woocommerce_product_thumbnails' ); ?>

</div>

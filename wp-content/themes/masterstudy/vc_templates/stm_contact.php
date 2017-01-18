<?php
extract( shortcode_atts( array(
	'name'  => '',
	'image'  => '',
	'image_size'  => 'thumb-124x108',
	'job'  => '',
	'phone'  => '',
	'email'  => '',
	'skype'  => '',
	'css'  => ''
), $atts ) );

$css_class = apply_filters( VC_SHORTCODE_CUSTOM_CSS_FILTER_TAG, vc_shortcode_custom_css_class( $css, ' ' ) );
$image = wpb_getImageBySize( array( 'attach_id' => $image, 'thumb_size' => $image_size ) );
?>

<div class="stm_contact<?php echo esc_attr( $css_class ); ?> clearfix">
	<?php if( ! empty( $image['thumbnail'] ) ){ ?>
		<div class="stm_contact_image">
			<?php echo balanceTags( $image['thumbnail'], true ); ?>
		</div>
	<?php } ?>
	<div class="stm_contact_info">
		<h4 class="name"><?php echo balanceTags( $name, true ); ?></h4>
		<?php if( $job ){ ?>
			<div class="stm_contact_job heading_font"><?php echo balanceTags( $job, true ); ?></div>
		<?php } ?>
		<?php if( $phone ){ ?>
			<div class="stm_contact_row"><?php _e( 'Phone: ', 'stm_domain' ); ?><?php echo balanceTags( $phone, true ); ?></div>
		<?php } ?>
		<?php if( $email ){ ?>
			<div class="stm_contact_row"><?php _e( 'Email: ', 'stm_domain' ); ?><a href="mailto:<?php echo balanceTags( $email, true ); ?>"><?php echo balanceTags( $email, true ); ?></a></div>
		<?php } ?>
		<?php if( $skype ){ ?>
			<div class="stm_contact_row"><?php _e( 'Skype: ', 'stm_domain' ); ?><a href="skype:<?php echo balanceTags( $skype, true ); ?>?chat"><?php echo balanceTags( $skype, true ); ?></a></div>
		<?php } ?>
	</div>
</div>
<!DOCTYPE html>
<html <?php language_attributes(); ?> class="no-js">
<head>
    <meta charset="<?php bloginfo( 'charset' ); ?>">
	<meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="profile" href="http://gmpg.org/xfn/11">
    <link rel="pingback" href="<?php bloginfo( 'pingback_url' ); ?>">
    <?php wp_head(); ?>
</head>
<body <?php body_class(); ?>>
	<div id="wrapper">
		<?php 
			// Header main setups
			// Get top bar enable/disable
			//$header_top_bar = get_theme_mod('header_top_bar');  
			$header_top_bar = stm_option('top_bar');
			
			// Get header styles
			//$header_styles = stm_option('header_style');
			
			$header_styles = 'header_default';
			
			$page_id = get_the_ID();
			if( is_search() ){
				$page_id = get_option( 'page_for_posts' );
			}
			// Get transparent header mode
			$transparent_header = get_post_meta($page_id, 'transparent_header', true);
			$sticky_header = stm_option('sticky_header');
			$sticky_header_color = stm_option('header_fixed_color');
			if($transparent_header) {
				$transparent_header = 'transparent_header';
			} else {
				$transparent_header = 'transparent_header_off';
				$sticky_header_color = stm_option('header_color');
			};
			
			if($sticky_header) {
				$transparent_header .= ' sticky_header';
			}
		?>
		
		<div id="header" class="<?php echo esc_attr($transparent_header); ?>" data-color="<?php echo esc_attr($sticky_header_color); ?>">
			<?php if($header_top_bar and !empty($header_top_bar)): ?>
				<?php get_template_part('partials/top', 'bar'); ?>
			<?php endif; ?>
			
			<!-- Check if transparent header chosen -->
			
			<?php if($sticky_header): ?>
				<div class="sticky_header_holder"></div>
			<?php endif; ?>
			
			<div class="<?php echo esc_attr($header_styles); ?>">
				<?php 
					if($header_styles == 'header_centered'):
						get_template_part('partials/headers/header', 'center');
					else:
						get_template_part('partials/headers/header', 'default');
					endif; 
				?>
			</div>
		</div> <!-- id header -->
		<div id="main">
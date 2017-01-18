<?php
// Get transparent header mode
$page_id = get_the_ID();
if( is_search() ){
	$page_id = get_option( 'page_for_posts' );
}
$transparent_header = get_post_meta($page_id, 'transparent_header', true);
if($transparent_header) {
	$logo = stm_option( 'logo_transparent', false, 'url' );
	$logo_black = stm_option( 'logo', false, 'url' );
} else {
	$logo = stm_option( 'logo', false, 'url' );
};
?>

<div class="container">
    <div class="row">
	    <div class="col-md-3 col-sm-12 col-xs-12">
		    <div class="logo-unit">
		        <?php if($logo): ?>
			        <a href="<?php echo esc_url( home_url( '/' ) ); ?>">
						<img class="img-responsive logo_transparent_static visible" src="<?php echo esc_attr($logo); ?>" style="width: <?php echo stm_option( 'logo_width', '246' ); ?>px;" alt="<?php bloginfo( 'name' ); ?>"/>
						<?php if($transparent_header): ?>
							<img class="img-responsive logo_colored_fixed hidden" src="<?php echo esc_attr($logo_black); ?>" style="width: <?php echo stm_option( 'logo_width', '246' ); ?>px;" alt="<?php bloginfo( 'name' ); ?>"/>
						<?php endif; ?>
			        </a>
				<?php else: ?>
					<a href="<?php echo esc_url( home_url( '/' ) ); ?>"><span class="logo"><?php bloginfo( 'name' ); ?></span></a>
				<?php endif; ?>
		    </div>
		    
	        <!-- Navbar toggle MOBILE -->
		    <button type="button" class="navbar-toggle collapsed hidden-lg hidden-md" data-toggle="collapse" data-target="#header_menu_toggler">
				<span class="sr-only">Toggle navigation</span>
				<span class="icon-bar"></span>
				<span class="icon-bar"></span>
				<span class="icon-bar"></span>
			</button>
	    </div> <!-- md-3 -->
	    
	  
	    
	    
	    <!-- MObile menu -->
	    <div class="col-xs-12 col-sm-12 visible-xs visible-sm">
		    <div class="collapse navbar-collapse header-menu-mobile" id="header_menu_toggler">
			    <ul class="header-menu clearfix">
				    <?php
                        wp_nav_menu( array(
                                'menu'              => 'primary',
                                'theme_location'    => 'primary',
                                'depth'             => 3,
                                'container'         => false,
                                'menu_class'        => 'header-menu clearfix',
                                'items_wrap'        => '%3$s',
                                'fallback_cb' => false
                            )
                        );
                    ?>
                    <li>
                    	<form role="search" method="get" id="searchform-mobile" action="<?php echo( home_url( '/' ) ); ?>">
						    <div class="search-wrapper">
						        <input placeholder="<?php _e('Search...', 'stm_domain'); ?>" type="text" class="form-control search-input" value="<?php echo get_search_query(); ?>" name="s" />
						        <button type="submit" class="search-submit" ><i class="fa fa-search"></i></button>
						    </div>
						</form>
                    </li>
			    </ul>
		    </div>
	    </div>
	    
	    <!-- Desktop menu -->
	    <div class="col-md-8 col-md-offset-1 col-sm-9 col-sm-offset-0 hidden-xs hidden-sm">
		    <?php 
			    $header_margin = stm_option('menu_top_margin');
			    if(empty($header_margin)) {
				    $header_margin = 5;
			    }
			    if(!$transparent_header) {
					$header_margin += 4;
				}
				$menu_style = 'style="margin-top:'.$header_margin.'px;"';
		    ?>
		    
		    
		    <div class="header_main_menu_wrapper clearfix" <?php echo $menu_style; ?>>
			    <div class="pull-right hidden-xs">
				    <div class="search-toggler-unit">
				    	<div class="search-toggler" data-toggle="modal" data-target="#searchModal"><i class="fa fa-search"></i></div>
				    </div>
			    </div>
			    
			    <div class="collapse navbar-collapse pull-right">
				    <ul class="header-menu clearfix">
					    <?php
	                        wp_nav_menu( array(
	                                'menu'              => 'primary',
	                                'theme_location'    => 'primary',
	                                'depth'             => 3,
	                                'container'         => false,
	                                'menu_class'        => 'header-menu clearfix',
	                                'items_wrap'        => '%3$s',
	                                'fallback_cb' => false
	                            )
	                        );
	                    ?>
				    </ul>
			    </div>
			    
		    </div>
	    </div><!-- md-8 desk menu -->
	    
    </div> <!-- row -->
</div> <!-- container -->
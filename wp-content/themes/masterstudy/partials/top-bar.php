<?php global $stm_option; ?>
<?php $header_top_bar_color = stm_option('top_bar_color'); ?>
<?php if(empty($header_top_bar_color)) {
	$header_top_bar_color = '#333';
}; ?>
<div class="header_top_bar" style="background-color:<?php echo($header_top_bar_color); ?>">
	<div class="container">
		<?php if(function_exists('icl_get_languages')):
			$langs = icl_get_languages('skip_missing=1&orderby=id&order=asc');
		endif; ?>
		<div class="clearfix">
			<?php if( stm_option( 'top_bar_wpml' ) ): ?>
				<?php if(!empty($langs)): ?>
					<?php 
					if(count($langs) > 1){ 
						$langs_exist = 'dropdown_toggle';
					} else {
						$langs_exist = 'no_other_langs';
					}	
					?>
					<div class="pull-left language-switcher-unit">
						<div class="stm_current_language <?php echo esc_attr($langs_exist); ?>" <?php if(count($langs) > 1){ ?> id="lang_dropdown" data-toggle="dropdown" <?php } ?>><?php echo esc_attr(ICL_LANGUAGE_NAME); ?><?php if(count($langs) > 1){ ?><i class="fa fa-chevron-down"></i><?php } ?></div>
						<?php if(count($langs) > 1): ?>
							<ul class="dropdown-menu lang_dropdown_menu" role="menu" aria-labelledby="lang_dropdown">
								<?php foreach($langs as $lang): ?>
									<?php if(!$lang['active']): ?>
										<li role="presentation"><a role="menuitem" tabindex="-1" href="<?php echo esc_attr($lang['url']); ?>"><?php echo esc_attr($lang['native_name']); ?></a></li>
									<?php endif; ?>
								 <?php endforeach; ?>
							 </ul>
						<?php endif; ?>
					</div>
				<?php endif; ?>
			<?php endif; ?>
			
			<!-- Header Top bar Login -->
			<?php if( stm_option( 'top_bar_login' ) ): ?>
				<?php if ( in_array( 'woocommerce/woocommerce.php', apply_filters( 'active_plugins', get_option( 'active_plugins' ) ) ) || ( function_exists( 'is_plugin_active_for_network' ) && is_plugin_active_for_network( 'woocommerce/woocommerce.php' ) )  ): ?>
					<div class="pull-right hidden-xs">
						<div class="header_login_url">
							<?php if(is_user_logged_in()):
								$current_user = wp_get_current_user();
								if(!empty($current_user->user_login)):
								?>
									<a href="<?php echo get_permalink( get_option( 'woocommerce_myaccount_page_id' ) ); ?>">
										<i class="fa fa-user"></i><?php echo esc_attr($current_user->user_login); ?>
									</a>
									<span class="vertical_divider"></span>
								<?php endif; ?>
								<a class="logout-link" href="<?php echo wp_logout_url('/'); ?>" title="<?php _e('Log out', STM_DOMAIN); ?>">
									<?php _e('Log out', STM_DOMAIN); ?>
								</a>
							<?php else: ?>
								<a href="<?php echo get_permalink( get_option( 'woocommerce_myaccount_page_id' ) ); ?>">
									<i class="fa fa-user"></i><?php _e('Login', STM_DOMAIN); ?>
								</a>
								<span class="vertical_divider"></span>
								<a href="<?php echo get_permalink( get_option( 'woocommerce_myaccount_page_id' ) ); ?>"><?php _e('Register', STM_DOMAIN); ?></a>
							<?php endif; ?>
						</div>
					</div>
				<?php endif; ?>
			<?php endif; ?>
			
			<?php $socials = stm_option('top_bar_social'); ?>
			<!-- Header top bar Socials -->
			<?php if(!empty($socials) and stm_option( 'top_bar_social' )): ?>
				<div class="pull-right">
					<div class="header_top_bar_socs">
						<ul class="clearfix">
							<?php
								foreach ( $stm_option['top_bar_use_social'] as $key => $val ) {
									if ( ! empty( $stm_option[$key] ) && $val == 1 ) {
										echo "<li><a href='{$stm_option[$key]}'><i class='fa fa-{$key}'></i></a></li>";
									}
								}
							?>
						</ul>
					</div>
				</div>
			<?php endif; ?>
			
			<?php
			$top_bar_address = stm_option( 'top_bar_address' );
			$top_bar_address_mobile = stm_option( 'top_bar_address_mobile' );
			
			$top_bar_working_hours = stm_option( 'top_bar_working_hours' );
			$top_bar_working_hours_mobile = stm_option( 'top_bar_working_hours_mobile' );
			
			$top_bar_phone = stm_option( 'top_bar_phone' );
			$top_bar_phone_mobile = stm_option( 'top_bar_phone_mobile' );
			
			if( $top_bar_address || $top_bar_working_hours || $top_bar_phone ): ?>
				<div class="pull-right xs-pull-left">
					<ul class="top_bar_info clearfix">
						<?php if( $top_bar_working_hours ){ ?>
							<li <?php if(!$top_bar_working_hours_mobile){ ?>class="hidden-info"<?php } ?>><i class="fa fa-clock-o"></i> <?php _e( balanceTags( $top_bar_working_hours, true ) ); ?></li>
						<?php } ?>
						<?php if( $top_bar_address ){ ?>
							<li <?php if(!$top_bar_address_mobile){ ?>class="hidden-info"<?php } ?>><i class="fa fa-map-marker"></i> <?php _e( balanceTags( $top_bar_address, true ) ); ?></li>
						<?php } ?>
						<?php if( $top_bar_phone ){ ?>
							<li <?php if(!$top_bar_phone_mobile){ ?>class="hidden-info"<?php } ?>><i class="fa fa-phone"></i> <?php _e( balanceTags( $top_bar_phone, true ) ); ?></li>
						<?php } ?>
					</ul>
				</div>
			<?php endif; ?>
		</div>
	</div>
</div>
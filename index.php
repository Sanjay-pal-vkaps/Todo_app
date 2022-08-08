<?php
/**
 * The template for displaying the footer.
 */

				invetex_close_wrapper();	// <!-- </.content> -->

				// Show main sidebar
				get_sidebar();

				if (invetex_get_custom_option('body_style')!='fullscreen') invetex_close_wrapper();	// <!-- </.content_wrap> -->
				?>
			
			</div>		<!-- </.page_content_wrap> -->

			<?php
			// Footer area TOP
			$footer_area_show  = invetex_get_custom_option('show_footer_area_top');
			$footer_area = invetex_get_custom_option('footer_area_top');
			if (!invetex_param_is_off($footer_area_show) && !empty($footer_area)) { ?>
			<footer class="footer_area_top_wrap scheme_<?php echo esc_attr(invetex_get_custom_option('footer_area_top_scheme')); ?>">
				<div class="footer_wrap_inner">
					<div class="content_wrap">
						<?php invetex_show_layout(do_shortcode($footer_area)); ?>
					</div>	<!-- /.content_wrap -->
				</div>	<!-- /.footer_wrap_inner -->
			</footer>	<!-- /.footer_area_wrap -->
			<?php
			}
			?>



			<?php
			// Footer Testimonials stream
			if (invetex_get_custom_option('show_testimonials_in_footer')=='yes') { 
				$count = max(1, invetex_get_custom_option('testimonials_count'));
				$data = invetex_sc_testimonials(array('count'=>$count));
				if ($data) {
					?>
					<footer class="testimonials_wrap sc_section scheme_<?php echo esc_attr(invetex_get_custom_option('testimonials_scheme')); ?>">
						<div class="testimonials_wrap_inner sc_section_inner sc_section_overlay">
							<div class="content_wrap"><?php invetex_show_layout($data); ?></div>
						</div>
					</footer>
					<?php
				}
			}
			
			// Footer sidebar
			$footer_show  = invetex_get_custom_option('show_sidebar_footer');
			$sidebar_name = invetex_get_custom_option('sidebar_footer');
			if (!invetex_param_is_off($footer_show) && is_active_sidebar($sidebar_name)) { 
				invetex_storage_set('current_sidebar', 'footer');
				?>
				<footer class="footer_wrap widget_area scheme_<?php echo esc_attr(invetex_get_custom_option('sidebar_footer_scheme')); ?>">
					<div class="footer_wrap_inner widget_area_inner">
						<div class="content_wrap">
							<div class="columns_wrap"><?php
							ob_start();
							do_action( 'before_sidebar' );
                                if ( is_active_sidebar( $sidebar_name ) ) {
                                    dynamic_sidebar( $sidebar_name );
                                }
							do_action( 'after_sidebar' );
							$out = ob_get_contents();
							ob_end_clean();
							invetex_show_layout(chop(preg_replace("/<\/aside>[\r\n\s]*<aside/", "</aside><aside", $out)));
							?></div>	<!-- /.columns_wrap -->
						</div>	<!-- /.content_wrap -->
					</div>	<!-- /.footer_wrap_inner -->
				</footer>	<!-- /.footer_wrap -->
				<?php
			}


			// Footer area
			$footer_area_show  = invetex_get_custom_option('show_footer_area');
			$footer_area = invetex_get_custom_option('footer_area');
			if (!invetex_param_is_off($footer_area_show) && !empty($footer_area)) { ?>
				<footer class="footer_area_wrap scheme_<?php echo esc_attr(invetex_get_custom_option('footer_area_scheme')); ?>">
					<div class="footer_wrap_inner">
						<div class="content_wrap">
							<?php invetex_show_layout(do_shortcode($footer_area)); ?>
						</div>	<!-- /.content_wrap -->
					</div>	<!-- /.footer_wrap_inner -->
				</footer>	<!-- /.footer_area_wrap -->
			<?php
			}


			// Footer Twitter stream
			if (invetex_get_custom_option('show_twitter_in_footer')=='yes') { 
				$count = max(1, invetex_get_custom_option('twitter_count'));
				$data = invetex_sc_twitter(array('count'=>$count));
				if ($data) {
					?>
					<footer class="twitter_wrap sc_section scheme_<?php echo esc_attr(invetex_get_custom_option('twitter_scheme')); ?>">
						<div class="twitter_wrap_inner sc_section_inner sc_section_overlay">
							<div class="content_wrap"><?php invetex_show_layout($data); ?></div>
						</div>
					</footer>
					<?php
				}
			}


			// Google map
			if ( invetex_get_custom_option('show_googlemap')=='yes' ) { 
				$map_address = invetex_get_custom_option('googlemap_address');
				$map_latlng  = invetex_get_custom_option('googlemap_latlng');
				$map_zoom    = invetex_get_custom_option('googlemap_zoom');
				$map_style   = invetex_get_custom_option('googlemap_style');
				$map_height  = invetex_get_custom_option('googlemap_height');
				if (!empty($map_address) || !empty($map_latlng)) {
					$args = array();
					if (!empty($map_style))		$args['style'] = esc_attr($map_style);
					if (!empty($map_zoom))		$args['zoom'] = esc_attr($map_zoom);
					if (!empty($map_height))	$args['height'] = esc_attr($map_height);
					invetex_show_layout(invetex_sc_googlemap($args));
				}
			}

			// Footer contacts
			if (invetex_get_custom_option('show_contacts_in_footer')=='yes') { 
				$address_1 = invetex_get_theme_option('contact_address_1');
				$address_2 = invetex_get_theme_option('contact_address_2');
				$phone = invetex_get_theme_option('contact_phone');
				$fax = invetex_get_theme_option('contact_fax');
				if (!empty($address_1) || !empty($address_2) || !empty($phone) || !empty($fax)) {
					?>
					<footer class="contacts_wrap scheme_<?php echo esc_attr(invetex_get_custom_option('contacts_scheme')); ?>">
						<div class="contacts_wrap_inner">
							<div class="content_wrap">
								<?php invetex_show_logo(false, false, true); ?>
								<div class="contacts_address">
									<address class="address_right">
										<?php if (!empty($phone)) echo esc_html__('Phone:', 'invetex') . ' ' . esc_html($phone) . '<br>'; ?>
										<?php if (!empty($fax)) echo esc_html__('Fax:', 'invetex') . ' ' . esc_html($fax); ?>
									</address>
									<address class="address_left">
										<?php if (!empty($address_2)) echo esc_html($address_2) . '<br>'; ?>
										<?php if (!empty($address_1)) echo esc_html($address_1); ?>
									</address>
								</div>
								<?php
                                if(function_exists('invetex_sc_socials'))
                                invetex_show_layout(invetex_sc_socials(array('size'=>"medium"))); ?>
							</div>	<!-- /.content_wrap -->
						</div>	<!-- /.contacts_wrap_inner -->
					</footer>	<!-- /.contacts_wrap -->
					<?php
				}
			}

			// Copyright area
			$copyright_style = invetex_get_custom_option('show_copyright_in_footer');
			if (!invetex_param_is_off($copyright_style)) {
				?> 
				<div class="copyright_wrap copyright_style_<?php echo esc_attr($copyright_style); ?>  scheme_<?php echo esc_attr(invetex_get_custom_option('copyright_scheme')); ?>">
					<div class="copyright_wrap_inner">
						<div class="content_wrap">
							<?php
							if ($copyright_style == 'menu') {
								if (($menu = invetex_get_nav_menu('menu_footer'))!='') {
									invetex_show_layout($menu);
								}
							} else if ($copyright_style == 'socials') {
                                if(function_exists('invetex_sc_socials'))
								invetex_show_layout(invetex_sc_socials(array('size'=>"tiny")));
							}
							if ($copyright_style == 'soc') {
                                if(function_exists('invetex_sc_socials'))
								invetex_show_layout(invetex_sc_socials(array('size'=>"tiny")));
							} else {
							?>
                                <div class="copyright_text"><?php invetex_show_layout(do_shortcode(str_replace(array('{{Y}}', '{Y}'), date('Y'), invetex_get_custom_option('footer_copyright')))); ?></div>

							<?php } ?>
						</div>
					</div>
				</div>
				<?php
			}
			?>
			
		</div>	<!-- /.page_wrap -->

	</div>		<!-- /.body_wrap -->
	
	<?php wp_footer(); ?>

</body>
</html>



(jQuery('.footer_menu a').attr('href', 'google.com'))


https://zapier.com/app/login?next=%2Fdashboard%2Fauth%2Foauth%2Freturn%2FApp163518CLIAPI%2F%3Fcode%3D4a2cd7fcceda40cbb1859d59f53e38dd%26state%3D6465465465465464ghfghfhgghf%26instance_url%3Dhttps%253A%252F%252Fna1.foxitesign.foxit.com%252F

3D4a2cd7fcceda40cbb1859d59f53e38dd


https://zapier.com/app/login?next=/dashboard/auth/oauth/return/App163518CLIAPI/?
code=4a2cd7fcceda40cbb1859d59f53e38dd
&state=6465465465465464ghfghfhgghf
&instance_url=https%3A%2F%2Fna1.foxitesign.foxit.com%2F
&instance_url=https://na1.foxitesign.foxit.com/
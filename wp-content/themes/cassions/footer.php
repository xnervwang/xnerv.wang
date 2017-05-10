<?php
/**
 * The template for displaying the footer.
 *
 * Contains the closing of the #content div and all content after.
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package Cassions
 */

?>

		</div><!-- #content -->

		<footer id="colophon" class="site-footer" role="contentinfo">
			
			<?php if ( is_active_sidebar( 'footer' ) ) { ?>
			<div class="footer-widgets">
				<div class="container">
					<div class="footer-inner">
					<?php	dynamic_sidebar( 'footer' ); ?>
					</div>
				</div>
			</div>
			<?php } ?>

			<div class="site-info">
				<div class="container">
					<div class="site-copyright">
						<?php printf( esc_html__( 'Copyright &copy; %1$s %2$s. All Rights Reserved.', 'cassions' ), date( 'Y' ), get_bloginfo( 'name' ) ); ?>
					</div>

					<?php do_action( 'cassions_footer_site_info' ) ?>
				</div>
			</div><!-- .site-info -->

		</footer><!-- #colophon -->
	</div><!-- .site-pusher -->
</div><!-- #page -->

<?php wp_footer(); ?>

</body>
</html>

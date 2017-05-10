<?php
/**
 * The sidebar containing the main widget area.
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package Cassions
 */

if ( ! is_active_sidebar( 'sidebar-1' ) ) {
	return;
}
?>

<aside id="secondary" class="sidebar widget-area" role="complementary">

	<?php if ( is_active_sidebar( 'sidebar-1' ) ) { ?>

			<?php dynamic_sidebar( 'sidebar-1' ); ?>

	<?php } ?>

</aside><!-- #secondary -->

<?php
/**
 * Template part for displaying page content in single.php.
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package cassions
 */

?>
<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
	<header class="entry-header">
		<?php the_title( '<h1 class="entry-title">', '</h1>' ); ?>

		<div class="entry-meta">
			<?php cassions_posted_on(); ?>
		</div><!-- .entry-meta -->
	</header><!-- .entry-header -->

    <?php if ( has_post_thumbnail() ) : ?>
    <div class="entry-thumb">
        <?php the_post_thumbnail( 'full' ); ?>
    </div>
    <?php endif; ?>

	<?php if ( ! empty ( get_the_content() ) ) { ?>
	<div class="entry-content">
		<?php the_content(); ?>
		<?php
			wp_link_pages( array(
				'before' => '<div class="page-links">' . esc_html__( 'Pages:', 'cassions' ),
				'after'  => '</div>',
			) );
		?>
	</div><!-- .entry-content -->
	<?php } ?>

	<?php the_post_navigation( array(
            'prev_text'                  => '<span>' . esc_html__( 'Previous article', 'cassions' ) .'</span> %title',
            'next_text'                  => '<span>' . esc_html__( 'Next article', 'cassions' ) .'</span> %title',
            'in_same_term'               => true,
            'screen_reader_text' 		 => esc_html__( 'Continue Reading', 'cassions' ),
        ) ); ?>

	<footer class="entry-footer">
		<?php cassions_entry_footer(); ?>
	</footer><!-- .entry-footer -->

</article><!-- #post-## -->

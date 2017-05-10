<?php
/**
 * The main template file.
 *
 * This is the most generic template file in a WordPress theme
 * and one of the two required files for a theme (the other being style.css).
 * It is used to display a page when nothing more specific matches a query.
 * E.g., it puts together the home page when no home.php file exists.
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package Cassions
 */

get_header(); ?>

<div class="container">


	<div id="primary" class="content-area">
		<main id="main" class="site-main" role="main">
			<div class="featured-posts">

				<?php

				if ( have_posts() ) {

					/* Start the Loop */
					while ( have_posts() ) : the_post();
							/*
							 * Include the Post-Format-specific template for the content.
							 * If you want to override this in a child theme, then include a file
							 * called content-___.php (where ___ is the Post Format name) and that will be used instead.
							 */
		 				get_template_part( 'template-parts/content', 'list' );
					endwhile;

				} else {

					get_template_part( 'template-parts/content', 'none' );

				}

				echo '<div class="post-pagination">';
				the_posts_pagination(array(
					'prev_next' => true,
					'prev_text' => '',
					'next_text' => '',
					'before_page_number' => '<span class="screen-reader-text">' . esc_html__('Page', 'cassions') . ' </span>',
				));
				echo '</div>';

				?>
			</div><!-- .featured-posts -->
		</main><!-- #main -->
	</div><!-- #primary -->

	<?php get_sidebar(); ?>

</div>

<?php
get_footer();

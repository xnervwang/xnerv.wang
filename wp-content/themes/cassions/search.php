<?php
/**
 * The template for displaying search results pages.
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/#search-result
 *
 * @package Cassions
 */

get_header(); ?>

<div class="container">
	<section id="primary" class="content-area">
		<main id="main" class="site-main" role="main">

		<?php
		global $wp_query;
		$total_pages = $wp_query->max_num_pages;
		$current_page = max( 1, get_query_var('paged') );
		$archive_layout = get_theme_mod( 'cassions_archive_layout', 'default' );
		if ( have_posts() ) : ?>

			<header class="page-header">
				<h1 class="entry-title"><?php printf( esc_html__( 'Search Results for: %s', 'cassions' ), '<span>' . get_search_query() . '</span>' ); ?></h1>
			</header><!-- .page-header -->

			<?php
			/* Start the Loop */
			while ( have_posts() ) : the_post();

				/**
				 * Run the loop for the search to output the results.
				 * If you want to overload this in a child theme then include a file
				 * called content-search.php and that will be used instead.
				 */

	 			get_template_part( 'template-parts/content', 'list' );


			endwhile;

			the_posts_navigation();

		else :

			get_template_part( 'template-parts/content', 'none' );

		endif;

		if (  $wp_query->max_num_pages > 1 ) {
			echo '<div class="post-pagination">';
			the_posts_pagination(array(
				'prev_next' => true,
				'prev_text' => '',
				'next_text' => '',
				'before_page_number' => '<span class="screen-reader-text">' . __('Page', 'cassions') . ' </span>',
			));
			echo '</div>';
		}
		?>

		</main><!-- #main -->
	</section><!-- #primary -->
	<?php get_sidebar(); ?>
</div>

<?php
get_footer();

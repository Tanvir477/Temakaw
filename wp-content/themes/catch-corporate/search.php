<?php
/**
 * The template for displaying search results pages
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/#search-result
 *
 * @package Catch_Corporate
 */

get_header(); ?>

	<section id="primary" class="content-area">
		<main id="main" class="site-main">
			<div class="archive-posts-wrapper">
				<?php
					$header_image = catch_corporate_featured_overall_image();

					if ( 'disable' !== $header_image ) : ?>

					<header class="page-header">
						<h2 class="page-title section-title"><?php printf( esc_html__( 'Search Results for: %s', 'catch-corporate' ), '<span>' . get_search_query() . '</span>' ); ?></h2>
					</header><!-- .entry-header -->

				<?php endif; ?>
				<?php
				if ( have_posts() ) : ?>
				<div class="section-content-wrapper layout-one">
					<div id="infinite-post-wrap" class="archive-post-wrap grid masonry">
						<?php
						/* Start the Loop */
						while ( have_posts() ) : the_post();

							/**
							 * Run the loop for the search to output the results.
							 * If you want to overload this in a child theme then include a file
							 * called content-search.php and that will be used instead.
							 */
							get_template_part( 'template-parts/content/content', 'search' );

						endwhile;
						?>
					</div><!-- .archive-post-wrap -->
				</div><!-- .section-content-wrap -->

				<?php catch_corporate_content_nav(); ?>

				<?php
				else :

					get_template_part( 'template-parts/content/content', 'none' );

				endif; ?>
			</div><!-- .archive-post-wrapper -->
		</main><!-- #main -->
	</section><!-- #primary -->

<?php
get_sidebar();
get_footer();

<?php
/**
 * Home main template file.
 *
 *
 * @package GreatMag
 */
if ( ! defined( 'ABSPATH' ) ) exit; // <- correct
get_header();

$layout = get_theme_mod( 'blog_layout', 'list' );
if ( $layout == 'masonry-full' ) {
	$cols = 'fullwidth';
} else {
	$cols = 'col-md-8';
}
?>

    <div class="portfolio-grid">

		<?php
				while ( have_posts() ) : the_post();

					/*
					 * Include the Post-Format-specific template for the content.
					 * If you want to override this in a child theme, then include a file
					 * called content-___.php (where ___ is the Post Format name) and that will be used instead.
					 */
					get_template_part( 'template-parts/content', get_post_format() );

                 endwhile;
         ?>

	</div>

<?php
$layout = get_theme_mod( 'blog_layout', 'list' );
if ( $layout != 'masonry-full' ) {
	get_sidebar();
}
get_footer();

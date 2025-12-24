<?php
/**
 * The template for displaying search results pages.
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/#search-result
 *
 * @package GreatMag
 */

get_header();

$slmod = get_theme_mod( 'search_layout' );
$slayout = get_theme_mod( 'search_layout', 'list' );

if( isset($slmod) && $slmod != false ) {
	if ( ($slayout == 'masonry-full') ) {
		$cols = 'fullwidth';
	} else {
		$cols = 'col-md-8';
	}
}else{
	$cols = 'col-md-8';
}

?>

    <header class="page-header">
        <h1 class="page-title"><?php printf( esc_html__( 'Search Results for: %s', 'greatmag' ), '<span>' . get_search_query() . '</span>' ); ?></h1>
    </header><!-- .page-header -->

    <div class="portfolio-grid">

		<?php
		if ( have_posts() ) : ?>


			<?php
			/* Start the Loop */
			while ( have_posts() ) : the_post();

				/**
				 * Run the loop for the search to output the results.
				 * If you want to overload this in a child theme then include a file
				 * called content-search.php and that will be used instead.
				 */
				get_template_part( 'template-parts/content');

			endwhile;

		endif; ?>
    </div>

<?php
get_footer();

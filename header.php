<?php
/**
 * The header for our theme.
 *
 * This is the template that displays all of the <head> section and everything up until <div id="content">
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package GreatMag
 */
if ( ! defined( 'ABSPATH' ) ) exit; // <- correct
?><!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
<meta charset="<?php bloginfo( 'charset' ); ?>">
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="profile" href="http://gmpg.org/xfn/11">
<script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
<script src="<?php echo get_stylesheet_directory_uri(); ?>/main.js"></script>

<?php wp_head(); ?>
</head>

<body <?php body_class(); ?>>
<?php wp_body_open(); ?>
<div id="page" data-bodyimg="<?php header_image(); ?>" class="site">

    <div class="head">
        <div class="col">
            <a href="/"><img src="https://ruku.io/wp-content/uploads/2025/07/cropped-cropped-logo.jpg" alt="logo" class="logo" /></a>
        </div>
        <div class="col">
            <h1><a href="/">Ruku IO</a></h1>
            <p class="subtitle">Deodorize every day, change my shirt and fly away.</p>
        </div>
    </div>

    <nav class="nav-bar">
        <div class="nav-container">
            <div class="menu-toggle" id="menu-toggle">
                <span></span>
                <span></span>
                <span></span>
            </div>

            <?php
            $categories = get_categories( array(
                    'slug' => array( 'literature', 'photo-montage', 'music', 'video', 'labs' ),
                    'hide_empty' => false,
            ) );

            // Sort descending by count
            usort( $categories, function( $a, $b ) {
                return $b->count - $a->count;
            });
            ?>
            <ul class="nav-links" id="nav-links">
                <?php
                    $count_posts = wp_count_posts();  // returns an object with counts by status
                    $total_published = $count_posts->publish;
                ?>
                <li>
                    <a href="/">
                        Everything
                        <span class="count">(<?php echo intval( $total_published ); ?>)</span>
                    </a>
                </li>
                <?php foreach ( $categories as $category ) : ?>
                    <?php
                    $published = new WP_Query( array(
                            'cat'            => $category->term_id,
                            'post_status'    => 'publish',
                            'post_type'      => 'post',
                            'posts_per_page' => 1,  // we don't actually need the posts
                            'fields'         => 'ids', // faster
                    ) );
                    ?>
                    <li>
                        <a href="<?php echo esc_url( get_category_link( $category->term_id ) ); ?>">
                            <?php echo esc_html( $category->name ); ?>
                            <span class="count">(<?php echo intval( $published->found_posts); ?>)</span>
                        </a>
                    </li>
                <?php wp_reset_postdata();
                endforeach; ?>
            </ul>

            <div class="search-box">
                <form action="/" method="get">
                    <input name="s" type="text" id="searchInput" placeholder="Search..." />
                    <input type="submit" value="Seek" />
                </form>
            </div>
        </div>
    </nav>

	<div id="content" class="site-content">
		<div class="container">
			<div class="row">

<?php
/**
 * Template part for displaying posts.
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package GreatMag
 */

if ( ! defined( 'ABSPATH' ) ) exit;

$post_date = get_the_date('U'); // UNIX timestamp of publish date
$one_month_ago = strtotime('-1 month');
$new_html = '';
if ( $post_date > $one_month_ago ) {
    $new_html = '<div class="new">NEW</div>';
}

?>
<?php if (in_category('literature')): ?>
<div class="tile" data-type="scribble"  data-id="<?php echo  get_the_ID(); ?>">
    <div class="image-box">
        <?php echo $new_html; ?>
        <div class="written">
            <h2><?php the_title(); ?></h2>
            <div class="content">
                <?php
                    $html = apply_filters('the_content', get_the_content());
                    echo remove_links_but_keep_contents( $html );
                ?>
            </div>
        </div>
    </div>
    <div class="overlay">
        <div class="project-title"><?php the_title(); ?></div>
    </div>
</div>

<?php elseif ( in_category('photo-montage') ) : ?>

    <div class="tile" data-type="doodle" data-id="<?php echo  get_the_ID(); ?>">
        <div class="image-box">
            <?php echo $new_html; ?>
            <?php

            if ( has_post_thumbnail() ) {
            ?>

            <img src="<?php echo get_the_post_thumbnail_url( get_the_ID(), 'medium' ); ?>"
                 alt="<?php the_title(); ?>"
                 class="matrix-image"
                 loading="lazy">
            <?php
            } else {
            ?>
                <div class="written">
                    <h2><?php the_title(); ?></h2>
                    <div class="content">
                        <?php
                            $html = apply_filters('the_content', get_the_content());
                            echo remove_links_but_keep_contents( $html );
                        ?>
                    </div>
                </div>

                <?php
            }

            ?>
        </div>
        <div class="overlay">
            <div class="project-title"><?php the_title(); ?></div>
            <div class="date"><?php the_modified_date('d/m/Y'); ?></div>
        </div>
    </div>
<?php elseif ( in_category('music') ) : ?>
    <div class="tile" data-type="music"  data-id="<?php echo  get_the_ID(); ?>">
        <div class="image-box">
            <?php echo $new_html; ?>
            <div class="written">
                <h2 style="margin-bottom:30px;"><?php the_title(); ?></h2>
                <div class="content">
                    <?php
                    $html = apply_filters('the_content', get_the_content());
                    echo remove_links_but_keep_contents( $html );
                    ?>
                </div>
            </div>
        </div>
        <div class="overlay">
            <div class="project-title"><?php the_title(); ?></div>
        </div>
    </div>
<?php elseif ( in_category('video') ) : ?>
    <div class="tile" data-type="video" data-id="<?php echo  get_the_ID(); ?>">
        <?php echo $new_html; ?>
        <div class="image-box">
            <?php

            if ( has_post_thumbnail() ) {
                ?>

                <img src="<?php echo get_the_post_thumbnail_url( get_the_ID(), 'medium' ); ?>"
                     alt="<?php the_title(); ?>"
                     class="matrix-image"
                     loading="lazy">
                <?php
            } else {
                ?>
                <div class="written">
                    <h2><?php the_title(); ?></h2>
                    <div class="content">
                        <?php
                        $html = apply_filters('the_content', get_the_content());
                        echo remove_links_but_keep_contents( $html );
                        ?>
                    </div>
                </div>

                <?php
            }

            ?>
        </div>
        <div class="overlay">
            <div class="project-title"><?php the_title(); ?></div>
            <div class="date"><?php the_modified_date('d/m/Y'); ?></div>
        </div>
    </div>
<?php elseif ( in_category('labs') ) : ?>
    <?php
    $html = apply_filters('the_content', get_the_content());

    libxml_use_internal_errors(true);
    $dom = new DOMDocument();
    $dom->loadHTML('<?xml encoding="utf-8" ?>' . $html, LIBXML_HTML_NOIMPLIED | LIBXML_HTML_NODEFDTD);
    libxml_clear_errors();

    $links = $dom->getElementsByTagName('a');

    $first_link_url = '';
    if ( $links->length > 0 ) {
        $first_link_url = $links->item(0)->getAttribute('href');
    }

    ?>
    <div class="tile" data-type="labs" data-id="<?php echo  get_the_ID(); ?>" data-link="<?php echo $first_link_url; ?>">
        <div class="image-box">
            <?php echo $new_html; ?>
            <?php

            if ( has_post_thumbnail() ) {
                ?>

                <img src="<?php echo get_the_post_thumbnail_url( get_the_ID(), 'medium' ); ?>"
                     alt="<?php the_title(); ?>"
                     class="matrix-image"
                     loading="lazy">
                <?php
            } else {
                ?>
                <div class="written">
                    <h2><?php the_title(); ?></h2>
                    <div class="content">
                        <?php
                        $html = apply_filters('the_content', get_the_content());
                        echo remove_links_but_keep_contents( $html );
                        ?>
                    </div>
                </div>

                <?php
            }

            ?>
            <div class="new-tab"><svg
                        class="icon-newtab"
                        xmlns="http://www.w3.org/2000/svg"
                        viewBox="0 0 24 24"
                        width="20"
                        height="20"
                        aria-hidden="true"
                        focusable="false"
                >
                    <path
                            d="M14 3h7v7h-2V6.41l-9.29 9.3-1.42-1.42 9.3-9.29H14V3zM19 19H5V5h7V3H5a2 2 0 0 0-2 2v14
       a2 2 0 0 0 2 2h14a2 2 0 0 0 2-2v-7h-2v7z"
                            fill="#fff"
                    />
                </svg></div>
        </div>
        <div class="overlay">
            <div class="project-title"><?php the_title(); ?></div>
            <div class="date"><?php the_modified_date('d/m/Y'); ?></div>
        </div>
    </div>
<?php endif; ?>
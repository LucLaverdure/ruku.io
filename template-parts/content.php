<?php
/**
 * Template part for displaying posts.
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package GreatMag
 */

if ( ! defined( 'ABSPATH' ) ) exit; // <- correct
?>
<?php if (in_category('literature')): ?>
<div class="tile" data-type="scribble"  data-id="<?php echo  get_the_ID(); ?>">
    <div class="image-box">
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
            <?php
            $post_date = get_the_date('U'); // UNIX timestamp of publish date
            $one_month_ago = strtotime('-1 month');

            if ( $post_date > $one_month_ago ) {
                echo '<div class="new">NEW</div>';
            }

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

<?php endif; ?>
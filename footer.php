<?php
/**
 * The template for displaying the footer.
 *
 * Contains the closing of the #content div and all content after.
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package GreatMag
 */
if ( ! defined( 'ABSPATH' ) ) exit; // <- correct
?>

			</div>
		</div><!-- .container -->
	</div><!-- #content -->


</div><!-- #page -->

<?php wp_footer(); ?>

<!-- ===== MATRIX LIGHTBOX ===== -->
<div id="lightbox" class="lightbox">
    <div class="lightbox-content">
        <span class="lightbox-close">&times;</span>
        <div class="lightbox-body">

        </div>
    </div>
</div>

<div class="matrix-spinner" id="matrixSpinner" style="display: none;">
    <div class="matrix-core"></div>
    <div class="matrix-ring">
        <span></span><span></span><span></span><span></span><span></span><span></span>
        <span></span><span></span><span></span><span></span><span></span><span></span>
    </div>
</div>

</body>
</html>

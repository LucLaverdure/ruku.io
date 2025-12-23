<?php 
/* Child theme generated with WPS Child Theme Generator */
            
if ( ! function_exists( 'b7ectg_theme_enqueue_styles' ) ) {            
    add_action( 'wp_enqueue_scripts', 'b7ectg_theme_enqueue_styles' );
    
    function b7ectg_theme_enqueue_styles() {
        wp_enqueue_style( 'parent-style', get_template_directory_uri() . '/style.css' );
        wp_enqueue_style( 'child-style', get_stylesheet_directory_uri() . '/style.css', array( 'parent-style' ) );
        wp_enqueue_style(
            'sign',
            'https://fonts.googleapis.com/css2?family=Montserrat:ital,wght@0,400;0,500;0,600;0,700;0,800;1,400;1,500;1,600;1,700;1,800&family=Parisienne:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;1,100;1,200;1,300;1,400;1,500;1,600;1,700&display=swap',
            array(),
            null, // No versioning
            'all' // For all devices
        );
    }
}
wp_enqueue_script("jquery");
wp_enqueue_script( 'main-js-file', get_stylesheet_directory_uri() . '/main.js');

function add_lightbox_to_featured_image($html, $post_id, $post_thumbnail_id, $size, $attr) {
    // Check if on a single post and if there's a post thumbnail set (adjust the condition as needed)
    if (is_single() && has_post_thumbnail($post_id)) {
        // Get the original image URL (bypassing the scaled version)
        $attachment_data = wp_get_attachment_metadata($post_thumbnail_id);
        $upload_dir = wp_upload_dir();
        $original_image_url = $upload_dir['baseurl'] . '/' . $attachment_data['file'];

        // Retrieve the caption
        $image_caption = get_post($post_thumbnail_id)->post_excerpt;

        // Wrap the image HTML in an anchor tag for the lightbox
        $html = '<a href="' . esc_url($original_image_url) . '" data-fancybox="gallery" data-caption="' . esc_attr($image_caption) . '">' . $html . '</a>';
    }
    return $html;
}
add_filter('post_thumbnail_html', 'add_lightbox_to_featured_image', 10, 5);

function custom_code_after_post_content($content) {
    // Check if it's a single post
    if (is_singular('post') && in_the_loop() && is_main_query()) {
        // Add your custom code after the content
        $custom_code = '<div id="signature">Luc Laverdure</div>';
        return $content . $custom_code;
    }

    // Return the original content if conditions are not met
    return $content;
}
add_filter('the_content', 'custom_code_after_post_content');

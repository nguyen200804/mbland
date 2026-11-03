<?php
/**
 * Các hàm hỗ trợ khác cho theme
 * @package HomeNest Theme
 */

// Hàm ví dụ:
function homenest_get_logo_url() {
    $custom_logo_id = get_theme_mod( 'custom_logo' );
    $logo = wp_get_attachment_image_src( $custom_logo_id , 'full' );
    if ( is_array( $logo ) ) {
        return esc_url( $logo[0] );
    }
    return esc_url( home_url( '/' ) );
}

// KHÔNG CÓ THẺ ĐÓNG PHP ?>
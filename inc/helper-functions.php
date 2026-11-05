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

/**
 * Làm sạch chuỗi plain text, loại bỏ cả thẻ HTML lẫn ký tự mã hóa HTML entity (&lt;p&gt;, &nbsp;, ...)
 */
if ( ! function_exists( 'mbland_clean_plain_text' ) ) {
    function mbland_clean_plain_text( $text ) {
        if ( empty( $text ) ) {
            return '';
        }
        // Giải mã HTML entities (gọi 2 lần đề phòng trường hợp bị double-encoded như &amp;lt;p&amp;gt;)
        $decoded = html_entity_decode( (string) $text, ENT_QUOTES, 'UTF-8' );
        $decoded = html_entity_decode( $decoded, ENT_QUOTES, 'UTF-8' );
        
        // Loại bỏ thẻ HTML chuẩn
        $clean = wp_strip_all_tags( $decoded, true );
        
        // Loại bỏ triệt để các thẻ còn sót lại dạng <...> hoặc các ký tự khoảng trắng đặc biệt
        $clean = preg_replace( '/<[^>]*>/', '', $clean );
        $clean = str_replace( array( '&nbsp;', '&#160;' ), ' ', $clean );
        
        return trim( $clean );
    }
}
